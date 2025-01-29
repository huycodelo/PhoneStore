<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Orderadmin;

class OrderController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }
        if (Auth::user()->role === 'admin') {
            $orders = Order::latest()->get();
        } else {
            $orders = Order::where('user_id', Auth::id())->latest()->get();
        }
        return view('orders.index', compact('orders'));
    }
    public function show($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem chi tiết đơn hàng.');
        }
        $order = Order::with('items.product')->findOrFail($id);
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem chi tiết đơn hàng.');
        }
        if (Auth::user()->role === 'admin') {   
            $order = Order::with('details')->findOrFail($id);
        } else {
            $order = Order::with('details')->where('user_id', Auth::id())->findOrFail($id);
        }
        return view('orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Bạn không có quyền thực hiện thao tác này.');
        }
        $request->validate([
            'status' => 'required|string|in:Pending,Processing,Completed,Cancelled',
        ]);

        $order->status = $request->status;
        $order->save();
        $order->status = $request->input('status');
        return redirect()->route('orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Xóa đơn hàng thành công!');
    }

//orderadmin
    public function indexadmin()
    {
        $orders = Order::with('user')->latest()->get();
        return view('admin.orderadmin.index', compact('orders'));
    }
    public function showadmin($id)
    {
        $order = Order::with('items.product')->findOrFail($id);
        return view('admin.orderadmin.show', compact('order'));
    }
    public function updateadmin(Request $request, Order $order)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403, 'Bạn không có quyền thực hiện thao tác này.');
        }
    
        $request->validate([
            'status' => 'required|string|in:Pending,Processing,Completed,Cancelled',
        ]);
    
        $order->status = $request->status;
        $order->save();
    
        return redirect()->route('admin.orderadmin.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
    
    

    public function destroyadmin(Order $order)
    {
        $order->delete();

        return redirect()->route('admin.orderadmin.index')->with('success', 'Xóa đơn hàng thành công!');
    }
}

