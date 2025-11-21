<?php

namespace App\Livewire;

use App\Http\Requests\OrderRequest;
use App\Services\Front\MyFatoorahService;
use App\Models\Cart;
use App\Models\Countary;
use App\Models\Governorate;
use Livewire\Component;
use App\Services\OrderService;
use App\Services\Front\CouponService;

class CheckoutPage extends Component
{
    public $totalPrice, $cart, $countries, $governorates = [], $countryId, $fname, $lname, $email, $phone, $governorate;
    public $city, $street, $notice, $governorateId, $shipping_price = 0, $code, $coupon, $cartCount;
    public $payment_methods,$paymentMethodId;

    public function rules()
    {
        return (new OrderRequest())->rules();
    }
    public function mount(MyFatoorahService $myFatoorahService)
    {
        $this->cart = Cart::where('session_id', session()->getId())->with('products')->first();


        $this->getTotalPrice();
        $this->countries = Countary::whereStatus('active')->get();
        $this->payment_methods = $myFatoorahService->getPaymentMethods($this->totalPrice, 'EGP');


    }
    public function getTotalPrice()
    {
        if (!isset($this->cart)) {
            return 0;
        }

        $subtotal = $this->cart->products->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });

        $total = $subtotal + ($this->shipping_price ?? 0);

        if (isset($this->coupon)) {
            $discount = ($this->coupon->discount_precentage / 100) * $total;
            $total -= $discount;
        }
        $this->totalPrice = $total;
        return $this->totalPrice;
    }
    public function submit(OrderService $orderService, MyFatoorahService $myFatoorahService)
    {
        $data = $this->validate();
        $data['shipping_price'] = $this->shipping_price;
        $data['total_price'] = $this->totalPrice;
        $order = $orderService->createOrder(
            array_merge($data, ['countryId' => $this->countryId]),
            app()->getLocale(),
            session()->getId()
        );

        if ($order) {
            $paymentData = [
                "PaymentMethodId"     => $this->paymentMethodId, // بطاقة بنكية
                "CustomerName"        => $order->f_name . ' ' . $order->l_name,
                "DisplayCurrencyIso"  => "EGP",
                "MobileCountryCode"   => "+966",
                "CustomerMobile"      => "512345678",
                "CustomerEmail"       => $order->email,
                "InvoiceValue"        => $this->totalPrice,
                "CallBackUrl"         => route('myfatoorah.callback'),
                "ErrorUrl"            => route('myfatoorah.error'),
                "Language"            => app()->getLocale() == 'ar' ? 'ar' : 'en',
                "CustomerReference"   => 'ORDER-' . $order->id,
                "UserDefinedField"    => auth()->check() ? auth()->id() : null,
                "SaveToken"           => true,
                "NotificationOption"=> "LNK", // دي أهم حاجة لحفظ البطاقة
            ];


            $response = $myFatoorahService->sendPayment($paymentData);

            if (isset($response['IsSuccess']) && $response['IsSuccess']) {
                $paymentUrl = $response['Data']['PaymentURL'];

                // إعادة تعيين بيانات الكومبوننت
                $this->cartCount = 0;
                //$this->reset();

                // إرسال إشعارات إلى باقي الكومبوننتات
                $this->dispatch('getCartCount')->to('front.header');
                $this->dispatch('orderCreated');

                // إعادة التوجيه إلى رابط الدفع
                return redirect()->away($paymentUrl);
            } else {
                $this->dispatch('payment');
            }
        }
    }
    public function applyCoupon(CouponService  $couponService)
    {
        $this->validate([
            'code'=>['required']
        ]);

        if (!auth()->check()) {
            $this->dispatch('auth');
            return;
        }
        $result = $couponService->apply($this->code, auth()->id(), session()->getId());
        if (!$result['success']) {
            $this->dispatch('CouponNotFound');
            return;
        }
        $this->coupon = $result['coupon'];
        $this->totalPrice = $this->getTotalPrice(); // تحديث السعر بعد الخصم
        $this->dispatch('SuccesApplyCoupon', [
            'msg' => $result['message']
        ]);
    }

    public function render()
    {
        $country = Countary::whereId($this->countryId)->first();
        if ($country) {
            $this->governorates = Governorate::where('countary_id', $this->countryId)->get();
            $governorate = Governorate::whereId($this->governorateId)->first();
            if ($governorate) {
                $this->shipping_price = $governorate->price;
                $this->getTotalPrice();
            } else {
                $this->shipping_price = 0;
            }
        } else {
            $this->governorates = [];
        }

        return view('livewire.checkout-page', ['countries' => $this->countries, 'governorates' => $this->governorates]);
    }
}
