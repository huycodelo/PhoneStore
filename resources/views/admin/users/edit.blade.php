@extends('admin.layouts.dashboard')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="row">
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

        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <div class="form-wrapper">
        <div class="form-container">
            <h2>Chỉnh sửa người dùng</h2>

            <!-- Hiển thị lỗi nếu có -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form chỉnh sửa người dùng -->
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Họ và tên</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <small class="form-text text-muted">Để trống nếu không muốn thay đổi mật khẩu.</small>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Vai trò</label>
                    <select class="form-control" id="role" name="role" required>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
            </form>
        </div>
    </div>

            </div>
            
          </div>
        </div>
      </div>
@endsection
