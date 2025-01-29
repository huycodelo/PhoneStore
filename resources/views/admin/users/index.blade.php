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
                    <h2>Danh sách người dùng</h2>
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm mx-1" title="Thêm mới">
                        <i class="fas fa-plus-circle"></i>
                    </a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Họ và tên</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th class="text-center">Ngày cập nhật</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $user->id }}</td>
                                        <td class="text-center">{{ $user->name }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{ $user->created_at }}</td>
                                        <td class="text-center">{{ $user->updated_at }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm mx-1" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mx-1" title="Xóa">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm mx-1" title="Thông tin">
                                                    <i class="fas fa-info-circle"></i>
                                                </a>
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
