<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;


class CheckoutController extends Controller
{
    public function index(Request $request)
{
    // Lấy giỏ hàng từ session
    $cart = session('cart', []);

    // Kiểm tra nếu giỏ hàng trống
    if (empty($cart)) {
        return redirect()->route('frontend.cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
    }

    return view('frontend.checkout.index', compact('cart'));
}
public function process(Request $request)
{
    $request->validate([
        'shipping_method' => 'required', // Phương thức giao hàng phải được chọn
    ]);

    // Lưu thông tin vào bảng `orders`
    $order = Order::create([
        'user_id' => auth()->id(), // ID của người dùng
        'total' => array_sum(array_column(session('cart', []), 'price')), // Tổng tiền
        'shipping' => $request->input('shipping_method'), // Phương thức giao hàng
        'status' => 'pending', // Trạng thái mặc định
    ]);

    // Lưu chi tiết sản phẩm trong đơn hàng và giảm số lượng sản phẩm
    foreach (session('cart', []) as $id => $product) {
        $order->details()->create([
            'product_id' => $id,
            'quantity' => $product['quantity'],
            'price' => $product['price'],
        ]);

        // Giảm số lượng sản phẩm trong bảng products
        $productModel = Product::find($id);
        if ($productModel) {
            $productModel->quantity -= $product['quantity'];
            $productModel->save();
        }
    }

    // Xóa giỏ hàng sau khi thanh toán
    session()->forget('cart');

    return redirect()->route('frontend.orders.index')->with('success', 'Đặt hàng thành công!');
}


}
