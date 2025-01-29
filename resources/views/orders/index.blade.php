@extends('frontend.index')

@section('title', 'Danh sách đơn hàng')

@section('content')
<h1 class="text-center">Danh sách đơn hàng </h1>

<div class="card">
@if (!auth()->check())
    <div class="alert alert-warning text-center">
        Bạn cần <a href="{{ route('login') }}">đăng nhập</a> để xem danh sách đơn hàng.
    </div>
@else
    @if ($orders->isEmpty())
        <p class="text-center bg-light">Không có đơn hàng nào.</p>
    @else
        <table class="table table-bordered bg-light">
            <thead class="bg-dark text-center text-light">
                <tr>
                    <th>#</th>
                    <th>Khách hàng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody >
                @foreach ($orders as $order)
                    <tr>
                        <td class="text-center" >{{ $order->id }}</td>
                        <td class="text-center" >{{ $order->user->name }}</td>
                        <td class="text-center" >{{ number_format($order->total, 0, ',', '.') }} VND</td>
                        <td class="text-center">
                            <span class="badge 
                            {{ $order->status === 'completed' ? 'bg-success' : ($order->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="text-center" >{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="text-center" >
                            <!-- Dùng d-flex để căn chỉnh 2 nút ngang hàng và w-100 để đảm bảo chúng có cùng chiều rộng -->
                            <div class="d-flex">
                                <!-- Nút Chi tiết -->
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary btn-sm mb-1 w-100 me-2">Chi tiết</a>

                                <!-- Form Xóa đơn hàng -->
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');" class="w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
</div>
@endsection
@endif