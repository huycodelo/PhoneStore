@extends('admin.layouts.dashboard')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container py-5">
    <!-- Tiêu đề -->
    <h1 class=" text-light text-center mb-4"><b>Chi tiết đơn hàng  admin</b><span class="text-primary">#{{ $order->id }}</span></h1>

    <!-- Thông tin đơn hàng -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Thông tin đơn hàng</h5>
        </div>
        <div class="card-body">
            <p><strong>Khách hàng:</strong> {{ $order->user->name }}</p>
            <p><strong>Tổng tiền:</strong> <span class="text-danger">{{ number_format($order->total, 0, ',', '.') }} VND</span></p>
            <p><strong>Trạng thái:</strong> 
                <span class="badge 
                {{ $order->status === 'completed' ? 'bg-success' : ($order->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                    {{ ucfirst($order->status) }}
                </span>
            </p>
            <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <h4 class="mb-3">Danh sách sản phẩm</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark text-light text-center">
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng cộng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td>{{ $item->product->name }}</td>
                    <!-- Hiển thị hình ảnh sản phẩm -->
                    <td class="text-center">
                        <img src="{{ url($item->product->img) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 100px; height: auto;">
                    </td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-end">{{ number_format($item->price, 0, ',', '.') }} VND</td>
                    <td class="text-end">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} VND</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Nút điều hướng -->
    <div class="mt-4 text-center">
        <a href="{{ route('admin.orderadmin.index') }}" class="btn btn-secondary">Quay lại danh sách đơn hàng</a>
        <a href="{{ route('shop.store') }}" class="btn btn-primary">Tiếp tục mua sắm</a>
    </div>
</div>
@endsection
