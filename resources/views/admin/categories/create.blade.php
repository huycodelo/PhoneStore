@extends('admin.layouts.dashboard')  <!-- Extend the dashboard layout -->

@section('title', 'Tạo danh mục')

@section('content')
<div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <h2>Thêm danh mục </h2>
        <div class="mb-3">
            <label for="name" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" id="description" name="description" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Tạo danh mục</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>

            </div>
            
          </div>
        </div>
      </div>
@endsection
