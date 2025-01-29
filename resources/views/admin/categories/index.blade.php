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
              <h2>Danh sách danh mục </h2>
                <a href="{{route('categories.create')}}" class="btn btn-success btn-sm mx-1" title="Sửa">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                      <th class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên danh mục </th>
                      <th class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mô tả</th>
                      <th class=" text-center text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Hành động</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td class="text-center" >{{ $category->id }}</td>
                        <td class="text-center" >{{ $category->name }}</td>
                        <td class="text-center" >{{ $category->description }}</td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <!-- Icon Sửa -->
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm mx-1" title="Sửa">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Icon Xóa -->
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
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
