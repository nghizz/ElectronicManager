<?php
namespace App\Controllers\Home;

use App\Services\Home\CartService;  // Thêm CartService vào đây
use App\Services\Home\PaymentService; // Thêm PaymentService vào đây
use Psr\Log\LoggerInterface;  // Đảm bảo LoggerInterface được khai báo đúng

class CartController
{
    private $cartService;
    private $logger;
    private $paymentService;

    public function __construct(CartService $cartService, LoggerInterface $logger, PaymentService $paymentService)
    {
        $this->cartService = $cartService;  // Sử dụng CartService thay vì Cart
        $this->logger = $logger;
        $this->paymentService = $paymentService;
    }

    // Phương thức thêm sản phẩm vào giỏ hàng
    public function addToCart($productId)
    {
        $this->cartService->addProductToCart($productId);  // Thay cart thành cartService
        $this->logger->info("Product added to cart: " . $productId);
    }

    // Phương thức thanh toán
    public function checkoutAction()
    {
        $cartProducts = $this->cartService->getCartProducts();  // Lấy sản phẩm trong giỏ
        if (empty($cartProducts)) {
            $this->logger->warning("Cart is empty, cannot proceed with payment.");
            return "Giỏ hàng trống, không thể thanh toán!";
        }

        // Tiến hành thanh toán
        $paymentResult = $this->paymentService->processPayment($this->cartService->getTotalAmount());  // Tính tổng thanh toán

        if ($paymentResult['status'] == 'success') {
            $this->logger->info("Payment successful for amount: " . $paymentResult['amount']);
            return "Thanh toán thành công!";
        } else {
            $this->logger->error("Payment failed for amount: " . $paymentResult['amount']);
            return "Thanh toán thất bại, vui lòng thử lại.";
        }
    }
    private function getTotalAmount($cart_items) {
        $total = 0;
        foreach ($cart_items as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
