@extends('frontend.index')

@section('title', 'Về Chúng Tôi')

@section('content')
<div class="container mt-5">
    <!-- Section: Banner -->
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 style="font-size: 2.5em; font-weight: bold;">Chào mừng đến với <span style="color: #007bff;">PhoneStore</span></h1>
            <p style="font-size: 1.25em; color: #6c757d;">
                Chúng tôi là cửa hàng điện thoại di động hàng đầu, mang đến cho bạn các sản phẩm chất lượng cao từ các thương hiệu nổi tiếng như Apple, Samsung, Xiaomi, và nhiều hơn nữa!
            </p>
        </div>
        <div class="col-md-6" style="text-align: center;">
            <img src="{{ asset('images/2.jpg') }}" alt="About Us Banner" style="width: 80%; border-radius: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); height: 300px;">
        </div>
    </div>

    <!-- Section: About Us -->
    <div class="row mt-5">
        <div class="col-md-6">
            <img src="{{ asset('images/3.jpg') }}" alt="Our Team" style="width: 100%; border: 1px solid #ddd; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
        </div>
        <div class="col-md-6">
            <h2 style="font-weight: bold;">Tầm Nhìn Và Sứ Mệnh</h2>
            <p style="color: #6c757d;">
                Tại <strong>PhoneStore</strong>, chúng tôi cam kết cung cấp các thiết bị công nghệ tiên tiến và dịch vụ khách hàng tốt nhất. Chúng tôi luôn đặt sự hài lòng của khách hàng lên hàng đầu, giúp bạn dễ dàng tìm kiếm và sở hữu những sản phẩm phù hợp nhất với nhu cầu.
            </p>
            <ul style="list-style-type: none; padding-left: 0;">
                <li><i style="color: #007bff;">✔</i> Cung cấp sản phẩm chính hãng 100%.</li>
                <li><i style="color: #007bff;">✔</i> Chính sách bảo hành rõ ràng và minh bạch.</li>
                <li><i style="color: #007bff;">✔</i> Đội ngũ hỗ trợ chuyên nghiệp và tận tâm.</li>
            </ul>
        </div>
    </div>

    <!-- Section: Why Choose Us -->
    <div class="row mt-5">
        <div class="col-12" style="text-align: center;">
            <h2 style="font-weight: bold;">Tại Sao Chọn Chúng Tôi?</h2>
            <p style="color: #6c757d;">
                Với hơn 10 năm kinh nghiệm trong lĩnh vực kinh doanh điện thoại, chúng tôi tự hào là điểm đến tin cậy của hàng triệu khách hàng trên toàn quốc.
            </p>
        </div>
        <div class="col-md-4" style="text-align: center; margin-top: 20px;">
            <i style="font-size: 3em; color: #007bff;" class="fas fa-mobile-alt"></i>
            <h5 style="margin-top: 10px;">Sản phẩm đa dạng</h5>
            <p style="color: #6c757d;">Chúng tôi cung cấp mọi dòng sản phẩm từ phổ thông đến cao cấp.</p>
        </div>
        <div class="col-md-4" style="text-align: center; margin-top: 20px;">
            <i style="font-size: 3em; color: #007bff;" class="fas fa-shipping-fast"></i>
            <h5 style="margin-top: 10px;">Giao hàng nhanh chóng</h5>
            <p style="color: #6c757d;">Dịch vụ giao hàng miễn phí trên toàn quốc trong 24-48 giờ.</p>
        </div>
        <div class="col-md-4" style="text-align: center; margin-top: 20px;">
            <i style="font-size: 3em; color: #007bff;" class="fas fa-award"></i>
            <h5 style="margin-top: 10px;">Uy tín và chất lượng</h5>
            <p style="color: #6c757d;">Cam kết sản phẩm chính hãng và bảo hành theo tiêu chuẩn.</p>
        </div>
    </div>
<!-- Section: Contact Us -->
<div class="row mt-5" style="background-color: #f8f9fa; padding: 40px 0;">
    <div class="col-12" style="text-align: center;">
        <h2 style="font-weight: bold;">Liên Hệ Với Chúng Tôi</h2>
        <p style="color: #6c757d;">Chúng tôi luôn sẵn sàng giải đáp mọi thắc mắc của bạn. Hãy liên hệ ngay hôm nay!</p>
    </div>
    <!-- Left: Contact Info -->
    <div class="col-md-4" style="text-align: left;">
        <div style="border: 1px solid #ddd; padding: 20px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
            <h5>Thông Tin Liên Hệ</h5>
            <p><i class="fas fa-phone-alt"></i> Hotline: <strong>1800 1234</strong></p>
            <p><i class="fas fa-envelope"></i> Email: <strong>support@phonestore.com</strong></p>
            <p><i class="fas fa-map-marker-alt"></i> Địa chỉ: <strong>123 Đường ABC, Quận 1, TP. Hồ Chí Minh</strong></p>
        </div>
    </div>

    <!-- Middle: Contact Form -->
    <div class="col-md-4">
        <form action="{{ route('contact.send') }}" method="POST">
            @csrf
            @if(session('success'))
                <div style="background-color: #d4edda; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                    {{ session('success') }}
                </div>
            @endif
            <div style="margin-bottom: 15px;">
                <label for="name" style="font-weight: bold;">Họ và tên</label>
                <input type="text" id="name" name="name" placeholder="Nhập tên của bạn" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="email" style="font-weight: bold;">Email</label>
                <input type="email" id="email" name="email" placeholder="Nhập email của bạn" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" required>
            </div>
            <div style="margin-bottom: 15px;">
                <label for="message" style="font-weight: bold;">Tin nhắn</label>
                <textarea id="message" name="message" placeholder="Viết tin nhắn của bạn" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; height: 150px;" required></textarea>
            </div>
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px;">Gửi Tin Nhắn</button>
        </form>
    </div>

    <!-- Right: Map -->
    <div class="col-md-4">
    <div style="border: 1px solid #ddd; padding: 0; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); height: 100%;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2771.578730239524!2d106.6703199111876!3d10.764953987392296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f9da751a4ff%3A0xa8fd305bf73cdfde!2zMzMgxJAuIFbEqW5oIFZp4buFbiwgUGjGsOG7nW5nIDAzLCBRdeG6rW4gMTAsIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2sus!4v1735263621440!5m2!1sen!2sus"
            width="100%"
            height="400"
            style="border: 0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
        ></iframe>
    </div>
</div>

</div>

</div>
@endsection
