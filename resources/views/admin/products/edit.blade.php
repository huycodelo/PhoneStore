@extends('admin.layouts.dashboard')

@section('title', 'Chỉnh sửa sản phẩm')

@section('content')
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Tên sản phẩm -->
                <div class="mb-3">
                    <label for="name" class="form-label">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                </div>

                <!-- Giá sản phẩm -->
                <div class="mb-3">
                    <label for="price" class="form-label">Giá</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                </div>

                <!-- Số lượng sản phẩm -->
                <div class="mb-3">
                    <label for="quantity" class="form-label">Số lượng</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}" required>
                </div>

                <!-- Danh mục -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Danh mục</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        <option value="">Chọn danh mục</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Mô tả sản phẩm -->
                <div class="mb-3">
                    <label for="description" class="form-label">Mô tả</label>
                    <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Chi tiết sản phẩm -->
                <div class="mb-3">
                    <label for="detail" class="form-label">Chi tiết sản phẩm</label>
                    <textarea name="detail" id="detail" class="form-control" rows="4">{{ old('detail', $product->detail) }}</textarea>
                </div>

                <!-- Thư viện ảnh: Cho phép chọn nhiều ảnh để tải lên -->
                <div class="mb-3">
                    <label for="gallery" class="form-label">Thư viện ảnh</label>
                    <input type="file" class="form-control" name="gallery[]" id="gallery" multiple>
                    <small class="form-text text-muted">Chọn nhiều ảnh nếu cần.</small>
                </div>

                <!-- Hiển thị ảnh trong thư viện nếu có -->
                @if($product->gallery)
                    <div class="mb-3">
                        <p>Ảnh trong thư viện hiện tại:</p>
                        <div class="gallery-images">
                            @foreach(json_decode($product->gallery) as $image)
                                <img src="{{ asset($image) }}" alt="Product Image" class="img-thumbnail" style="max-height: 200px; max-width: 200px; margin-right: 10px;">
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Hình ảnh sản phẩm -->
                <div class="mb-3">
                    <label for="img" class="form-label">Hình ảnh</label>
                    <input type="file" class="form-control" name="img" id="img" onchange="previewImage(event)">
                    <small class="form-text text-muted">Chọn hình ảnh mới nếu bạn muốn thay đổi.</small>
                </div>

                <!-- Hiển thị hình ảnh hiện tại nếu có -->
                @if($product->img)
                    <div class="mb-3">
                        <p>Hình ảnh hiện tại:</p>
                        <img src="{{ asset($product->img) }}" alt="Product Image" id="preview" class="img-fluid" style="max-height: 200px; max-width: 200px;">
                    </div>
                @endif

                <!-- Nút Cập nhật sản phẩm -->
                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
            </form>

            </div>
            
          </div>
        </div>
      </div>
@endsection
