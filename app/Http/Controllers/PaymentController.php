<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use App\Models\SavedCard;
use App\Models\Transaction;
use App\Services\Front\MyFatoorahService;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function paymentCallback(Request $request, MyFatoorahService $myFatoorahService)
    {
        $paymentId = $request->paymentId;

        // الحصول على تفاصيل الدفع
        $response = $myFatoorahService->getPaymentStatus($paymentId);
        if ($response['IsSuccess'] && $response['Data']['InvoiceStatus'] == 'Paid') {
            if (auth()->user()) {
                $invoiceData = $response['Data'];

                $cardData = $invoiceData['InvoiceTransactions'][0]['Card'];
                $cardNumber = $cardData['Number']; // 545301xxxxxx5539

                // استخراج آخر 4 أرقام
                $lastFour = substr($cardNumber, -4);
                SavedCard::create([
                    'user_id' => auth()->id(), // أو أي ID عندك
                    'token' => $invoiceData['InvoiceTransactions'][0]['Card']['PanHash'], // ممكن تستخدمه كـ token
                    'brand' => $cardData['Brand'],
                    'last_four' => $lastFour,
                    'is_default' => false, // أو true لو أول مرة
                ]);
            }
            $invoiceData = $response['Data'];

            $invoice = Invoice::create([
                'user_id'        => auth()->id()??null,
                'invoice_id'     => $invoiceData['InvoiceId'],
                'customer_name'  => $invoiceData['CustomerName'],
                'customer_email' => $invoiceData['CustomerEmail'],
                'customer_mobile' => $invoiceData['CustomerMobile'],
                'amount'         => $invoiceData['InvoiceValue'],
                'currency'       => $invoiceData["InvoiceTransactions"][0]["Currency"],
                'status'         => 'Paid',
                'invoice_url'    => $invoiceData['InvoiceReference'] ?? null,

            ]);

            $orderId = explode('-', $response['Data']['CustomerReference'])[1]; // ORDER-15 => 15
            $order = Order::findOrFail($orderId);
            $order->update([
                'status' => 'paid',

            ]);
            $order->transactions()->create([
                'myfatoorah_transaction_id' => $response['Data']['InvoiceId'],
                'payment_method' => 'myfatoorah',
            ]);
            Flasher::addSuccess('Payment completed successfully!');
            return redirect()->back();
        }
        return redirect()->route('myfatoorah.error');
    }
    public function paymentError(Request $request)
    {
        $orderReference = $request->query('paymentId') ?? $request->query('invoiceId');

        // أو تجيب أي بيانات ضرورية حسب MyFatoorah docs

        // تحدث حالة الطلب لو تعرفت عليه
        if ($orderReference) {
            $orderId = str_replace('ORDER-', '', $orderReference); // لو بتستخدم CustomerReference بالشكل ده
            $order = \App\Models\Order::find($orderId);
            if ($order) {
                $order->update(['status' => 'failed']);
            }
        }
        Flasher::addError('حدث خطأ أثناء الدفع، يرجى المحاولة مرة أخرى.');
        // تعرض صفحة أو رسالة للمستخدم بالخطأ
        return redirect()->back();
    }
    public function refund(Request $request, Order $order, MyFatoorahService $myFatoorahService)
    {
        $transaction = Transaction::where('order_id', $order->id)->first();
        if (!$transaction || $order->status == 'pending') {

            $order->status = 'canceled';
            $order->save();
            Flasher::addSuccess('Your Order Canceled successfully');
            return redirect()->back();
        }
        $response = Http::withToken(env('MY_FATOORAH_API_TOKEN'))->post('https://apitest.myfatoorah.com/v2/MakeRefund', [
            'KeyType' => 'InvoiceId',
            'Key' => $transaction->myfatoorah_transaction_id,
            'ServiceChargeOnCustomer' => false,
            'Amount' => $order->total_price,
            'Comment' => 'Partial refund',
            'AmountDeductedFromSupplier' => 0,
        ]);
        $data = $response->json();

        if (!empty($data['ValidationErrors'])) {
            $errors = collect($data['ValidationErrors'])->pluck('Error')->implode(', ');
            Flasher::addError($errors ?: $data['Message']);
            return redirect()->back();
        }
        if (!empty($data['Message']) && $data['IsSuccess'] === false) {
            Flasher::addError($data['Message']);
            return redirect()->back();
        }
        $order->status = 'canceled';
        $order->save();
        Flasher::addSuccess('Refund Created Successfully');
        return redirect()->back();
    }
}
