<?php

// app/Http/Controllers/SavedCardController.php

namespace App\Http\Controllers;

use App\Models\SavedCard;
use App\Services\Front\MyFatoorahService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedCardController extends Controller
{
    protected $mf;

    public function __construct(MyFatoorahService $mf)
    {
        $this->middleware('auth');
        $this->mf = $mf;
    }

    // عرض صفحة البطاقات
    public function index()
    {
        $cards = Auth::user()->savedCards()->get();
        $data = $this->mf->initiatePaymentAndSaveCard(1, Auth::user());

        $paymentMethods = $data['PaymentMethods'];
        return view('front.cards.index', compact('cards','paymentMethods'));
    }

    // بدء عملية إضافة بطاقة
    public function create(Request $request)
    {
        // نعمل دفتر طلب وهمي بقيمة 1 ريال فقط ليتم إنشاء التوكن
         $user = Auth::user();
    $paymentMethodId = $request->payment_method_id;

    // Create invoice data
$data = [
    'PaymentMethodId' => 2, // مثلاً: فيزا/ماستر كارد
    'CustomerName'    => 'Ahmed',
    'InvoiceValue'    => 100,
    'DisplayCurrencyIso' => 'KWD',
    'CallBackUrl'     => route('payment.success'),
    'ErrorUrl'        => route('payment.fail'),
    'MobileCountryCode' => '+965',
    'CustomerMobile'     => '12345678',
    'CustomerEmail'      => 'test@example.com',
    'Language'           => 'en',
    'CustomerReference'  => 'ORDER123',
    'UserDefinedField'   => 'xyz',
    'SaveToken'          => true, // مهم لو عايز تحفظ البطاقة
];



    $response = $this->mf->sendPayment($data);

    if ($response && isset($response['IsSuccess']) && $response['IsSuccess']) {
        return redirect($response['Data']['InvoiceURL']);
    } else {
        return redirect()->back()->with('error', 'Failed to initiate payment');
    }
    }

    // callback بعد حفظ البطاقة
    public function callback(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $data      = $this->mf->getPaymentStatus($paymentId);

        // نفترض أن Data.SaveTokenData يحتوي على توكن البطاقة وبياناتها
        $token      = $data['SaveTokenData']['CardToken'];
        $last4      = $data['SaveTokenData']['Last4Digits'];
        $brand      = $data['SaveTokenData']['CardType'];

        // إذا أول بطاقة نخليها افتراضية
        $isDefault = Auth::user()->savedCards()->count() === 0;

        Auth::user()->savedCards()->create([
            'token'      => $token,
            'last_four'  => $last4,
            'brand'      => $brand,
            'is_default' => $isDefault,
        ]);

        return redirect()->route('cards.index')
            ->with('success', 'تمت إضافة البطاقة بنجاح');
    }

    // حذف بطاقة
    public function destroy(SavedCard $card)
    {
        $this->authorize('manage', $card);
        $card->delete();
        return back()->with('success', 'تم حذف البطاقة');
    }

    // تعيين افتراضية
    public function makeDefault(SavedCard $card)
    {
        $this->authorize('manage', $card);
        Auth::user()->savedCards()->update(['is_default' => false]);
        $card->update(['is_default' => true]);
        return back()->with('success', 'تم تعيين البطاقة الافتراضية');
    }
}
