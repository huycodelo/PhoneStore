@extends('frontend.index')

@section('title', 'Giỏ hàng')

@section('content')
<h1 class="text-center">Giỏ hàng của bạn</h1>
<div class="container">
    @if (empty($cart))
        <p class="text-center">Giỏ hàng của bạn đang trống.</p>
    @else
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead class="bg-dark text-light">
                    <tr class="text-center" >
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody class="bg-light text-center " >
                    @php $total = 0; @endphp
                    @foreach ($cart as $id => $product)
                        @php $total += $product['price'] * $product['quantity']; @endphp
                        <tr>
                            <td>
                                <img src="{{ asset($product['img']) }}" alt="{{ $product['name'] }}" style="width: 50px; height: 50px; object-fit: cover;">
                            </td>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ number_format($product['price'], 0, ',', '.') }} VND</td>
                            <td>
                                <input type="number" name="quantities[{{ $id }}]" value="{{ $product['quantity'] }}" min="1" class="form-control" style="width: 80px;">
                            </td>
                            <td>{{ number_format($product['price'] * $product['quantity'], 0, ',', '.') }} VND</td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                        <td><strong>{{ number_format($total, 0, ',', '.') }} VND</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-primary">Cập nhật giỏ hàng</button>
                <a href="{{ route('checkout') }}" class="btn btn-success">Thanh toán</a>
            </div>
        </form>
    @endif
</div>
@endsection
