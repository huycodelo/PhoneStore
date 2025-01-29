@extends('frontend.index')

@section('title', 'Cửa hàng')

@section('content')
<section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-center pb-3">
                <h1 class="text-center text-dark mb-4 font-weight-bold"><i>Welcome to My Shop</i></h1>
            </div>
            <!-- Category Filter -->
            <form method="GET" action="{{ route('shop.store') }}" class="mb-4">
    <div class="row align-items-center">
        <!-- Label -->
        <label for="category" class="col-sm-3 col-form-label text-white font-weight-bold">Chọn Danh Mục</label>

        <!-- Dropdown (select) -->
        <div class="col-sm-6">
            <select name="category_id" id="category" class="form-control form-control-lg">
                <option value="">Tất Cả Danh Mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Submit Button -->
        <div class="col-sm-3">
            <button type="submit" class="btn btn-success btn-lg w-100">Tìm kiếm</button>
        </div>
    </div>
</form>

        </div>

        <!-- Product Cards -->
        <div class="row">
            @foreach ($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <!-- Link bao toàn bộ sản phẩm -->
                <a href="{{ route('frontend.shop.details', $product->id) }}" class="text-decoration-none text-dark">
                    <div class="product-card shadow-lg p-3 bg-white rounded position-relative" 
                         style="border: 1px solid #f1f1f1; border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease; display: flex; flex-direction: column; justify-content: space-between; height: 500px; overflow: hidden;"
                         onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 20px rgba(0, 0, 0, 0.15)';" 
                         onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                        <!-- Product Image -->
                        <div class="image-holder position-relative overflow-hidden" 
                             style="height: 60%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                            <img src="{{ asset($product->img) }}" alt="product-item" 
                                 style="max-height: 80%; max-width: 100%; object-fit: contain;">
                            @if ($product->gallery)
                            <div class="gallery mt-2 d-flex justify-content-center gap-2">
                                @foreach (json_decode($product->gallery) as $image)
                                    <img src="{{ asset($image) }}" alt="Gallery Image" 
                                         style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                @endforeach
                            </div>
                            @endif
                        </div>
                        <!-- Product Details -->
                        <div class="card-body text-center mt-3" 
                             style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; text-align: center;">
                            <h5 class="card-title font-weight-bold text-uppercase" 
                                style="font-size: 1rem; margin-bottom: 0.5rem;">{{ $product->name }}</h5>
                            <p class="card-text text-danger font-weight-bold" 
                               style="margin-bottom: 0.5rem;">{{ number_format($product->price, 0, ',', '.') }} VND</p>
                            <p class="card-text text-muted">Số lượng: {{ $product->quantity }}</p>
                        </div>
                        <!-- Add to Cart -->
                        <div class="text-center mb-2">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success btn-block" 
                                        style="background-color: #28a745; border-color: #28a745; border-radius: 15px;">Thêm vào giỏ</button>
                            </form>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection