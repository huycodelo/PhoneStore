<?php
namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth; 

class CartController extends Controller
{   
    public function store(Request $request)
    {
        // Lấy ID danh mục từ request
        $categoryId = $request->get('category_id'); 
    
        // Lấy danh sách danh mục
        $categories = Category::all();
    
        // Lọc sản phẩm theo danh mục (nếu có)
        $products = Product::query();
    
        if ($categoryId) {
            $products->where('category_id', $categoryId); // Lọc sản phẩm theo category_id
        }
    
        $products = $products->get();
    
        // Trả về view và truyền dữ liệu
        return view('frontend.shop.store', compact('products', 'categories'));
    }
    
// Thêm sản phẩm vào giỏ hàng
public function add(Product $product, Request $request)
{
    // Lấy giỏ hàng từ session
    $cart = session()->get('cart', []);

    // Kiểm tra xem sản phẩm đã có trong giỏ chưa
    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            'name' => $product->name,
            'quantity' => 1,
            'price' => $product->price,
            'image' => $product->img,
        ];
    }

    // Lưu giỏ hàng vào session
    session()->put('cart', $cart);

    // Quay lại cửa hàng và hiển thị thông báo
    return redirect()->route('frontend.shop.store')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
}
public function index()
{
    $cart = session()->get('cart', []);
    return view('frontend.cart.index', compact('cart'));
}
public function addToCart(Request $request, $productId)
{
    if (!Auth::check()) {
        // Chuyển hướng đến trang đăng nhập với thông báo lỗi
        return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng!');
    }

    // Lấy thông tin sản phẩm từ database
    $product = Product::findOrFail($productId);

    // Lấy giỏ hàng từ session (nếu chưa có, tạo mảng rỗng)
    $cart = session()->get('cart', []);

    // Kiểm tra xem sản phẩm đã có trong giỏ chưa
    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] += 1; // Tăng số lượng nếu đã có
    } else {
        // Thêm sản phẩm vào giỏ hàng
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'img' => $product->img,
        ];  
    }

    // Lưu giỏ hàng vào session
    session()->put('cart', $cart);

    // Trả về thông báo thành công
    return redirect()->route('frontend.shop.store')->with('success', 'Sản phẩm đã được thêm vào giỏ hàng!');
}

public function update(Request $request)
{
    $cart = session()->get('cart', []);
    $quantities = $request->input('quantities', []);

    foreach ($quantities as $id => $quantity) {
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = max(1, $quantity); // Đảm bảo số lượng tối thiểu là 1
        }
    }

    session()->put('cart', $cart);

    return redirect()->route('frontend.cart.index')->with('success', 'Giỏ hàng đã được cập nhật!');
}
public function remove($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('frontend.cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
}
public function checkout(Request $request)
{
    // Lấy giỏ hàng từ session
    $cart = session()->get('cart', []);

    // Kiểm tra nếu giỏ hàng trống
    if (empty($cart)) {
        return redirect()->route('frontend.cart.index')->with('error', 'Giỏ hàng trống, không thể thanh toán.');
    }

    // Tạo một đơn hàng mới
    $order = new Order();
    $order->user_id = Auth::id(); // Lấy ID người dùng từ session
    $order->payment = 'Chuyển khoản'; // Ví dụ: bạn có thể tùy chỉnh đây
    $order->shipping = 'Giao hàng tận nơi'; // Ví dụ: bạn có thể tùy chỉnh
    $order->status = 'pending'; // Trạng thái đơn hàng ban đầu
    $order->notes = $request->input('notes', ''); // Có thể thêm ghi chú nếu cần
    $order->total = 0; // Tổng tiền sẽ được tính sau
    $order->save();

    // Tính tổng tiền đơn hàng và lưu chi tiết đơn hàng
    $total = 0;

    foreach ($cart as $id => $product) {
        // Lưu thông tin chi tiết đơn hàng
        $orderDetail = new OrderDetail();
        $orderDetail->order_id = $order->id;
        $orderDetail->product_id = $id;
        $orderDetail->quantity = $product['quantity'];
        $orderDetail->price = $product['price'];
        $orderDetail->save();

        // Cộng dồn tổng tiền của đơn hàng
        $total += $product['price'] * $product['quantity'];
    }

    // Cập nhật lại tổng tiền cho đơn hàng
    $order->total = $total;
    $order->save();

    // Xóa giỏ hàng sau khi thanh toán thành công
    session()->forget('cart');

    // Quay lại cửa hàng và thông báo thành công
    return redirect()->route('frontend.shop.store')->with('success', 'Thanh toán thành công! Cảm ơn bạn đã mua hàng.');
}


}

