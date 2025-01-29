@extends('admin.layouts.dashboard')  <!-- Extend the dashboard layout -->

@section('title', 'Tạo danh mục')

@section('content')
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
          <div class="container">
    <div class="form-container">
        <h2>Tạo sản phẩm mới</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tên sản phẩm -->
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea class="form-control" name="description" id="description" required></textarea>
            </div>

            <!-- Giá sản phẩm -->
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" class="form-control" name="price" required>
            </div>

            <!-- Số lượng sản phẩm -->
            <div class="form-group">
                <label for="quantity">Số lượng:</label>
                <input type="number" class="form-control" name="quantity" required>
            </div>

            <!-- Danh mục -->
            <div class="form-group">
                <label for="category_id">Danh mục:</label>
                <select class="form-control" name="category_id" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Chi tiết sản phẩm -->
            <div class="form-group">
                <label for="detail">Chi tiết sản phẩm:</label>
                <textarea class="form-control" name="detail" id="detail"></textarea>
            </div>

            <!-- Hình ảnh sản phẩm -->
            <div class="form-group">
                <label for="img">Hình ảnh:</label>
                <input type="file" class="form-control-file" name="img" id="img" onchange="previewImage(event)">
                <div id="main-preview"></div>
            </div>

            <!-- Thư viện ảnh -->
            <div class="form-group">
                <label for="gallery">Thư viện ảnh:</label>
                <input type="file" class="form-control-file" name="gallery[]" id="gallery" accept="image/*" multiple onchange="previewMultipleImages(event, 'gallery-preview')">
                <div id="gallery-preview"></div>
            </div>

            <!-- Nút submit -->
            <button type="submit" class="btn btn-primary">Tạo sản phẩm</button>
        </form>
    </div>

      </div>
@endsection
