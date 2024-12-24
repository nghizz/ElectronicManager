<?php
// src/Service/PaymentService.php
namespace App\Services\Home;

class PaymentService
{
    public function processPayment($amount)
    {
        // Giả lập kết quả thanh toán
        if ($amount > 0) {
            return ['status' => 'success', 'amount' => $amount];
        } else {
            return ['status' => 'failed', 'amount' => $amount];
        }
    }
}
