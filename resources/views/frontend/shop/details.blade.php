@extends('frontend.index')

@section('title', $product->name)

@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Product Image Section -->
        <div class="col-md-6">
            <div class="product-image">
                <div id="image-container" class="image-container">
                    <img id="main-image" src="{{ asset($product->img) }}" alt="{{ $product->name }}" class="main-img">
                </div>
                <!-- Navigation buttons -->
                <button class="btn btn-light prev-btn" id="prev-btn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="btn btn-light next-btn" id="next-btn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Thumbnails Gallery -->
            @if($product->gallery)
                <div class="row mt-3 gallery-container">
                    @foreach(json_decode($product->gallery) as $galleryImage)
                        <div class="col-2 mb-3">
                            <img src="{{ asset($galleryImage) }}" alt="Gallery Image" class="img-fluid gallery-thumb" data-image="{{ asset($galleryImage) }}">
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Product Information Section -->
        <div class="col-md-6">
            <h1 class="display-4 font-weight-bold">{{ $product->name }}</h1>
            <p class="text-muted">Mã sản phẩm: {{ $product->id }}</p>
            <p class="text-danger font-weight-bold display-4">{{ number_format($product->price, 0, ',', '.') }} VND</p>
            <p class="text-success"><strong>Số lượng:</strong> {{ $product->quantity }}</p>
            <p class="text-dark"><strong>Mô tả:</strong> {{ $product->description }}</p>
            <p class="text-dark"><strong>Chi tiết:</strong> {!! $product->detail !!}</p>

            <!-- Add to Cart Button -->
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary btn-lg w-100 mt-3">Thêm vào giỏ hàng</button>
            </form>
        </div>
    </div>
</div>
<div class="related-products mt-5">
    <h3 class="text-center font-weight-bold mb-4">Sản phẩm liên quan</h3>
    <div class="row">
        @foreach ($relatedProducts as $related)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <a href="{{ route('frontend.shop.details', $related->id) }}" class="text-decoration-none text-dark">
                <div class="product-card shadow-lg p-3 bg-white rounded position-relative"
                     style="border: 1px solid #f1f1f1; border-radius: 15px; transition: transform 0.3s ease, box-shadow 0.3s ease; display: flex; flex-direction: column; justify-content: space-between; height: 500px; overflow: hidden;"
                     onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 10px 20px rgba(0, 0, 0, 0.15)';"
                     onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none';">
                    <!-- Hình ảnh sản phẩm -->
                    <div class="image-holder position-relative overflow-hidden"
                         style="height: 60%; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                        <img src="{{ asset($related->img) }}" alt="{{ $related->name }}"
                             style="max-height: 80%; max-width: 100%; object-fit: contain;">
                        @if ($related->gallery)
                        <div class="gallery mt-2 d-flex justify-content-center gap-2">
                            @foreach (json_decode($related->gallery) as $image)
                                <img src="{{ asset($image) }}" alt="Gallery Image"
                                     style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                            @endforeach
                        </div>
                        @endif
                    </div>
                    <!-- Chi tiết sản phẩm -->
                    <div class="card-body text-center mt-3"
                         style="flex-grow: 1; display: flex; flex-direction: column; justify-content: center; text-align: center;">
                        <h5 class="card-title font-weight-bold text-uppercase"
                            style="font-size: 1rem; margin-bottom: 0.5rem;">{{ $related->name }}</h5>
                        <p class="card-text text-danger font-weight-bold"
                           style="margin-bottom: 0.5rem;">{{ number_format($related->price, 0, ',', '.') }} VND</p>
                        <p class="card-text text-muted">Số lượng: {{ $related->quantity }}</p>
                    </div>
                    <!-- Nút thêm vào giỏ hàng -->
                    <div class="text-center mb-2">
                        <form action="{{ route('cart.add', $related->id) }}" method="POST">
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

@endsection
@section('scripts')

@endsection
