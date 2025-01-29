@extends('admin.layouts.dashboard')

@section('title', 'Quản lý danh mục')

@section('content')
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <div class="form-wrapper">
        <div class="form-container">
            <h1>Chỉnh sửa danh mục</h1>

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

            <!-- Form chỉnh sửa danh mục -->
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Tên danh mục -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
                </div>

                <!-- Mô tả -->
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ $category->description }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
            </form>
        </div>
    </div>

            </div>
            
          </div>
        </div>
      </div>
@endsection
