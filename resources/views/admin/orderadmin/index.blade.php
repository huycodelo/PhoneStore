@extends('admin.layouts.dashboard')
@section('content')
@if(auth()->user()->role !== 'admin') <!-- Check if the user is not an admin -->
    <div class="col-12 text-center">
        <div class="alert alert-warning alert-dismissible fade show mt-5" role="alert">
            <h4 class="alert-heading text-dark">Bạn không có quyền truy cập!</h4>
            <p>Vui lòng đăng nhập bằng tài khoản admin để truy cập trang này.</p>
        </div>
    </div>
@else
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h2 class="text-center">Danh sách đơn hàng </h2>
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            </div>

            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    @if ($orders->isEmpty())
                    <p class="text-center bg-light py-3">Không có đơn hàng nào.</p>
                    @else
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Khách hàng</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tổng tiền</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Trạng thái</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày tạo</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>
                                <td class="text-center">{{ $order->user->name }}</td>
                                <td class="text-center">{{ number_format($order->total, 0, ',', '.') }} VND</td>
                                <td class="text-center text-light ">
                                    @if (Auth::user()->isAdmin())
                                    <div class="d-flex justify-content-center align-items-center">
                                        <form action="{{ route('admin.orderadmin.update', $order->id) }}" method="POST" class="d-inline-flex align-items-center">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-select-sm me-2 w-auto">
                                                <option>Choose</option>
                                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="Completed" {{ $order->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">Cập nhật</button>
                                        </form>
                                        <span class="badge ms-2 
                                        {{ $order->status === 'completed' ? 'bg-success' : ($order->status === 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                            {{ $order->status }}
                                        </span>
                                    </div>
                                    @endif
                                </td>

                                <td class="text-center">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('admin.orderadmin.show', $order->id) }}" class="btn btn-primary btn-sm mx-1" title="Chi tiết">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.orderadmin.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa đơn hàng này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm mx-1" title="Xóa">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection