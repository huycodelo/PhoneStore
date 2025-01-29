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
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h2>Danh sách sản phẩm</h2>
                    <a href="{{route('products.create')}}" class="btn btn-success btn-sm mx-1" title="Thêm sản phẩm">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ảnh</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Thư viện</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Số lượng</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Ngày cập nhật</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Ngày tạo</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $product->id }}</td>
                                        <td class="text-center">{{ $product->name }}</td>
                                        <td class="text-center">
                                            @if ($product->img)
                                                <img src="{{ asset($product->img) }}" alt="Ảnh sản phẩm" style="max-width: 100px;">
                                            @else
                                                <p>Không có ảnh</p>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($product->gallery)
                                                @foreach (json_decode($product->gallery) as $galleryImage)
                                                    <img src="{{ asset($galleryImage) }}" alt="Gallery Image" style="max-width: 50px; margin: 2px;">
                                                @endforeach
                                            @else
                                                <p>Không có hình ảnh</p>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $product->quantity }}</td>
                                        <td class="text-center">{{ $product->created_at }}</td>
                                        <td class="text-center">{{ $product->updated_at }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm mx-1" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
