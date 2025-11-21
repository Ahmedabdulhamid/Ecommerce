<?php

namespace App\Services\Front;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MyFatoorahService
{
    private $apiToken;
    private $apiUrl;

    public function __construct()
    {
        $this->apiToken = env('MY_FATOORAH_API_TOKEN');
        $this->apiUrl = env('MY_FATOORAH_URL');
    }

    public function sendPayment($data)
    {
        try {
            $response = Http::withToken($this->apiToken)
                ->post($this->apiUrl . 'v2/ExecutePayment', $data);

            if ($response->successful()) {
                return $response->json();
            } else {
                // سجل الخطأ
                Log::error('MyFatoorah Failed Response: ' . $response->body());
                return null;
            }
        } catch (\Exception $e) {
            // سجل الاستثناء
            Log::error('MyFatoorah Exception: ' . $e->getMessage());
            return null;
        }
    }
    public function getPaymentStatus($paymentId)
    {
        $response = Http::withToken($this->apiToken)
            ->post($this->apiUrl . 'v2/GetPaymentStatus', [
                'Key' => $paymentId,
                'KeyType' => 'PaymentId',
            ]);

        return $response->json();
    }
    public function initiatePaymentAndSaveCard($amount, $customer)
    {
        $response = Http::withToken($this->apiToken)
            ->post("{$this->apiUrl}/v2/InitiatePayment", [
                "CountryCode"     => "SA",        // أو EG حسب حسابك
                "CustomerName"    => $customer->name,
                "CustomerEmail"   => $customer->email,
                "InvoiceValue"    => $amount,
                "DisplayCurrencyIso" => "SAR",
                "SaveToken"       => true,       // هذا المفتاح لحفظ البطاقة
                "CallBackUrl"     => route('cards.callback'),
                "ErrorUrl"        => route('cards.index'),
            ]);

        return $response->throw()->json()['Data'];
    }
    public function getPaymentMethods($amount = 100, $currency = 'EGP')
    {
        try {
            $response = Http::withToken($this->apiToken)
                ->post("{$this->apiUrl}/v2/InitiatePayment", [
                    "InvoiceAmount" => $amount,
                    "CurrencyIso"   => $currency
                ]);

            if ($response->successful()) {
                return $response->json()['Data']['PaymentMethods'];
            } else {
                Log::error('MyFatoorah Payment Methods Error: ' . $response->body());
                return [];
            }
        } catch (\Exception $e) {
            Log::error('MyFatoorah Exception (Payment Methods): ' . $e->getMessage());
            return [];
        }
    }
}
