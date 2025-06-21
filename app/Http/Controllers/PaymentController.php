<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\Front\MyFatoorahService;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentCallback(Request $request, MyFatoorahService $myFatoorahService)
    {
        $paymentId = $request->paymentId;

        // الحصول على تفاصيل الدفع
        $response = $myFatoorahService->getPaymentStatus($paymentId);
        if ($response['IsSuccess'] && $response['Data']['InvoiceStatus'] == 'Paid') {
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
    public function paymentError(Request $request){
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
}
