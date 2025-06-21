<?php
namespace App\Services\Front;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MyFatoorahService {
    private $apiToken;
    private $apiUrl;

    public function __construct() {
        $this->apiToken = env('MY_FATOORAH_API_TOKEN');
        $this->apiUrl = env('MY_FATOORAH_URL');
    }

    public function sendPayment($data) {
        try {
            $response = Http::withToken($this->apiToken)
                            ->post($this->apiUrl . 'v2/SendPayment', $data);

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
    }public function getPaymentStatus($paymentId)
    {
        $response = Http::withToken($this->apiToken)
            ->post($this->apiUrl . 'v2/GetPaymentStatus', [
                'Key' => $paymentId,
                'KeyType' => 'PaymentId',
            ]);

        return $response->json();
    }
}

