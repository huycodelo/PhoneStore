@extends('admin.layouts.dashboard')

@section('title', 'Danh Sách Tin Nhắn')

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
                    <h2>Danh Sách Tin Nhắn</h2>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    @if($contacts->isEmpty())
                        <div class="alert alert-info m-3">
                            Hiện tại chưa có tin nhắn nào.
                        </div>
                    @else
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Họ và Tên</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tin Nhắn</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ngày Gửi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td class="text-center">{{ $contact->id }}</td>
                                            <td class="text-center">{{ $contact->name }}</td>
                                            <td class="text-center">{{ $contact->email }}</td>
                                            <td class="text-center">{{ $contact->message }}</td>
                                            <td class="text-center">{{ $contact->created_at->format('d-m-Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
