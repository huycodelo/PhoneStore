@extends('frontend.index')

@section('title', 'Chi tiết đơn hàng')

@section('content')
<div class="container py-5">
    <!-- Vùng chứa toàn bộ nội dung với hiệu ứng đổ bóng -->
    <div class="content-wrapper shadow-lg p-5 bg-white rounded">

        <!-- Tiêu đề -->
        <h1 class="text-center mb-5">Chi tiết đơn hàng <span class="text-primary">#{{ $order->id }}</span></h1>

        <!-- Thông tin đơn hàng -->
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-dark text-white py-4">
                <h5 class="mb-0">Thông tin đơn hàng</h5>
            </div>
            <div class="card-body py-4">
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
        <h4 class="mb-4 text-center">Danh sách sản phẩm</h4>
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
                            <img src="{{ url($item->product->img) }}" alt="{{ $item->product->name }}" class="img-thumbnail" style="width: 120px; height: auto;">
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
        <div class="mt-5 text-center">
            <a href="{{ route('orders.index') }}" class="btn btn-secondary btn-lg px-5 py-3">Quay lại danh sách đơn hàng</a>
            <a href="{{ route('shop.store') }}" class="btn btn-primary btn-lg px-5 py-3">Tiếp tục mua sắm</a>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <style>
        .content-wrapper {
            background-color: #fff;  /* Màu nền trắng */
            border-radius: 8px;  /* Bo góc cho vùng chứa */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);  /* Đổ bóng nhẹ xung quanh vùng chứa */
            padding: 30px;  /* Tăng khoảng cách giữa nội dung và viền */
        }

        /* Tăng khoảng cách cho tiêu đề */
        h1 {
            font-size: 2.5rem;
        }

        /* Tăng khoảng cách cho các phần nội dung */
        .card-header, .card-body {
            padding-top: 30px; /* Tăng khoảng cách trên */
            padding-bottom: 30px; /* Tăng khoảng cách dưới */
        }

        .table th, .table td {
            padding: 20px;  /* Tăng độ rộng các ô trong bảng */
        }

        /* Tăng kích thước nút */
        .btn-lg {
            font-size: 1.2rem;
            padding: 12px 30px;  /* Tăng kích thước và độ rộng của nút */
        }
    </style>
@endpush
