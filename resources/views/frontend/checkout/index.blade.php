@extends('frontend.index')

@section('title', 'Thanh toán')

@section('content')
<h1 class="text-center">Thanh toán</h1>
<div class="container">
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <h3>Phương thức giao hàng</h3>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="shipping_method" id="delivery" value="Giao hàng tận nơi" required>
            <label class="form-check-label" for="delivery">
                Giao hàng tận nơi
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="shipping_method" id="pickup" value="Nhận tại cửa hàng" required>
            <label class="form-check-label" for="pickup">
                Nhận tại cửa hàng
            </label>
        </div>

        <h3 class="mt-4">Chi tiết giỏ hàng</h3>
        <table class="table table-bordered">
            <thead class="bg-dark text-light">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody class="bg-light">
                @php $total = 0; @endphp
                @foreach ($cart as $product)
                    @php $total += $product['price'] * $product['quantity']; @endphp
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ number_format($product['price'], 0, ',', '.') }} VND</td>
                        <td>{{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }} VND</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                    <td><strong>{{ number_format($total, 0, ',', '.') }} VND</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('frontend.cart.index') }}" class="btn btn-secondary">Quay lại giỏ hàng</a>
            <button type="submit" class="btn btn-success">Xác nhận thanh toán</button>
        </div>
    </form>
</div>
@endsection
