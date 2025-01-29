<!DOCTYPE html>
<html>
  <head>
    <title>Ministore</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ0K5n6jJU5wrhM2zmtGVkFf7H9eTj9z2MkFhzfGHFfgbtrSsbp2jj0u4EY4" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
  </head>
  <body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-root-margin="0px 0px -40%" data-bs-smooth-scroll="true" tabindex="0">


    <div class="search-popup">
        <div class="search-popup-container">

          <form role="search" method="get" class="search-form" action="">
            <input type="search" id="search-form" class="search-field" placeholder="Type and press enter" value="" name="s" />
            <button type="submit" class="search-submit"><svg class="search"><use xlink:href="#search"></use></svg></button>
          </form>

          <h5 class="cat-list-title">Browse Categories</h5>
        </div>
    </div>
    
<header id="header" class="site-header header-scrolled position-fixed w-100 text-black bg-light shadow-sm">
  <nav id="header-nav" class="navbar navbar-expand-lg px-3">
    <div class="container-fluid">
      <!-- Logo -->
      <a class="navbar-brand" href="{{ route('shop.store') }}">
        <img src="{{ asset('/images/logobe.jpg') }}" style="width: 60px; height: auto;">
        <span class="ms-1 font-weight-bold text-dark"><b>Gia Huy Shop Smart Phone</b></span>
      </a>

      <!-- Toggler button for mobile -->
      <button class="navbar-toggler d-lg-none p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <svg class="navbar-icon">
          <use xlink:href="#navbar-icon"></use>
        </svg>
      </button>

      <!-- Offcanvas Menu -->
      <div class="offcanvas offcanvas-end" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
        <div class="offcanvas-header px-4 pb-0">
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <!-- Navbar Items -->
          <ul id="navbar" class="navbar-nav text-uppercase justify-content-end align-items-center flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link me-4" href="{{ route('shop.store') }}">Cửa hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-4" href="{{ route('orders.index') }}">Đơn hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-4" href="{{ route('frontend.about.index') }}">Giới thiệu</a>
            </li>
            <li class="nav-item">
                @if(Auth::check())
                    <a class="nav-link me-4" href="{{ route('frontend.profile.show', ['user' => auth()->user()->id]) }}">View Profile</a>
                @else
                    <a class="nav-link me-4" href="{{ route('login') }}">View Profile</a>
                @endif
            </li>
            <!-- User Greeting and Logout -->
            <li class="nav-item">
              <div class="user-items ps-5">
                <ul class="d-flex list-unstyled align-items-center">
                  <li class="pe-3">
                    <a href="#" class="search-button">
                      <svg class="search">
                        <use xlink:href="#search"></use>
                      </svg>
                    </a>
                  </li>
                  <li class="pe-3">
                    <a href="#">
                      <svg class="user">
                        <use xlink:href="#user"></use>
                      </svg>
                    </a>
                  </li>
                  <li class="text-dark pe-3">
                      <a href="{{ route('frontend.cart.index') }}" class="text-dark text-decoration-none">
                          <i class="fas fa-shopping-cart"></i>
                          @php
                              $cart = session('cart', []);  // Lấy giỏ hàng từ session
                              $cartCount = count($cart);  // Đếm số lượng đơn hàng trong giỏ hàng
                          @endphp
                          <span class="badge bg-danger text">{{ $cartCount }}</span>
                      </a>
                  </li>
                  
                  <!-- User Greeting -->
                  @auth
                  <li class="text-dark me-3">
                    Xin chào, {{ Auth::user()->name }}
                  </li>
                  <!-- Logout Button -->
                  <li>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                      @csrf
                      <button type="submit" class="btn btn-outline-dark btn-sm px-4">
                          <i class="fas fa-sign-out-alt"></i> <!-- Icon exit -->
                      </button>
                    </form>
                  </li>
                  @endauth

                  @guest
                  <li>
                    <a href="{{ route('login') }}" >
                  <button type="submit" class="btn btn-outline-dark btn-sm px-4">
                    <i class="fas fa-user"></i>
                  </button></a>
                  </li>
                  @endguest
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
</header>

<section  class="position-relative overflow-hidden bg-light-blue">
  <div id="billboard" class="swiper main-swiper">
    <div class="swiper-wrapper">
      <!-- Slide 1 -->
      <div class="swiper-slide">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="banner-content">
                <h1 class="display-2 text-uppercase text-dark pb-5">Your Products Are Great.</h1>
              </div>
            </div>
            <div class="col-md-6 text-center ">
              <div class="image-holder">
                <img style="max-width: 500%" src="{{ asset('images/banner.gif') }}" alt="Your Products Are Great" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Slide 2 -->
      <div class="swiper-slide">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="banner-content">
                <h1 class="display-2 text-uppercase text-dark pb-5">Smart phone at here</h1>
              </div>
            </div>
            <div class="col-md-6 text-center">
              <div class="image-holder">
                <img src="{{ asset('images/banner.png') }}" alt="Your Products Are Great" class="img-fluid">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- Navigation Arrows -->
  <div class="swiper-icon swiper-arrow swiper-arrow-prev">
    <svg class="chevron-left">
      <use xlink:href="#chevron-left"></use>
    </svg>
  </div>
  <div class="swiper-icon swiper-arrow swiper-arrow-next">
    <svg class="chevron-right">
      <use xlink:href="#chevron-right"></use>
    </svg>
  </div>
  </div>

</section>

    @yield('content')

    
    <div id="footer-bottom">
      <div class="container">
        <div class="row d-flex flex-wrap justify-content-between">
          <div class="col-md-4 col-sm-6">
            <div class="Shipping d-flex">
              <p>We ship with:</p>
              <div class="card-wrap ps-2">
                <img src="{{ asset('images/dhl.png') }}" alt="visa">
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="payment-method d-flex">
              <p>Payment options:</p>
              <div class="card-wrap ps-2">
                <img src="{{ asset('images/visa.jpg') }}" alt="visa">
                <img src="{{ asset('images/mastercard.jpg') }}" alt="mastercard">
                <img src="{{ asset('images/paypal.jpg') }}" alt="paypal">
              </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-6">
            <div class="copyright">
              <p>© Copyright 2023 MiniStore. Design by <a href="https://templatesjungle.com/">TemplatesJungle</a> Distribution by <a href="https://themewagon.com">ThemeWagon</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{asset('js/jquery-1.11.0.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/plugins.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
  </body>
  <style>
    #billboard {
      margin-top: 90px; Điều chỉnh giá trị phù hợp
      padding: 10px;
    }
    #header-nav{
      margin-top: 10px;
    }
    /* Image container with fixed dimensions */
.image-container {
    width: 100%;               /* Full width of its column */
    height: 400px;             /* Fixed height for the main image */
    display: flex;             /* Center the image */
    align-items: center;
    justify-content: center;
    border: 1px solid #ddd;    /* Optional: border for styling */
    border-radius: 5px;
    overflow: hidden;          /* Hide overflowing parts of the image */
    background-color: #f8f9fa; /* Optional: Light gray background */
}

.image-container img {
    width: auto;               /* Adjust width to maintain aspect ratio */
    height: 100%;              /* Image will fill the height of the container */
    object-fit: contain;       /* Ensure the image fits nicely within the container */
}

/* Gallery thumbnails */
.gallery-container img {
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 5px;
    transition: border-color 0.3s;
}

.gallery-container img:hover {
    border-color: #007bff; /* Highlight border on hover */
}

.prev-btn,
.next-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(255, 255, 255, 0.8);
    border: none;
    padding: 10px;
    z-index: 10;
    cursor: pointer;
    border-radius: 50%;
    box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
}

.prev-btn {
    left: 10px;
}

.next-btn {
    right: 10px;
}

.prev-btn:hover,
.next-btn:hover {
    background-color: #007bff;
    color: #fff;
}
.image {
        height: 300px;
        width: 80%;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    /* Custom Styles for the page */
    #billboard {
        margin-top: 90px;
        padding: 10px;
    }

    #header-nav {
        margin-top: 10px;
    }

    /* Image container with fixed dimensions */
    .image-container {
        width: 100%;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #ddd;
        border-radius: 5px;
        overflow: hidden;
        background-color: #f8f9fa;
    }

    .image-container img {
        width: auto;
        height: 100%;
        object-fit: contain;
    }

    /* Gallery thumbnails */
    .gallery-container img {
        cursor: pointer;
        border: 1px solid transparent;
        border-radius: 5px;
        transition: border-color 0.3s;
    }

    .gallery-container img:hover {
        border-color: #007bff;
    }

    .prev-btn,
    .next-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        padding: 10px;
        z-index: 10;
        cursor: pointer;
        border-radius: 50%;
        box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);
    }

    .prev-btn {
        left: 10px;
    }

    .next-btn {
        right: 10px;
    }

    .prev-btn:hover,
    .next-btn:hover {
        background-color: #007bff;
        color: #fff;
    }
  </style>

</html>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.main-swiper', {
            loop: true,
            autoplay: {
                delay: 4000, // Thời gian tự động chuyển (4 giây)
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: '.swiper-arrow-next',
                prevEl: '.swiper-arrow-prev',
            },
        });
    });
    //ảnh phóng to thu nhỏ 
    document.addEventListener('DOMContentLoaded', function () {
        const mainImage = document.getElementById('main-image');
        const galleryThumbnails = document.querySelectorAll('.gallery-thumb');
        let currentIndex = 0;
        let autoSlideInterval;

        // Function to update the main image
        const updateMainImage = (index) => {
            const selectedThumbnail = galleryThumbnails[index];
            const newImageSrc = selectedThumbnail.getAttribute('data-image');
            mainImage.setAttribute('src', newImageSrc);
        };

        // Function to start the auto-slide
        const startAutoSlide = () => {
            autoSlideInterval = setInterval(() => {
                currentIndex = (currentIndex + 1) % galleryThumbnails.length; // Loop back to the start
                updateMainImage(currentIndex);
            }, 4000); // Change every 4 seconds
        };

        // Function to stop the auto-slide
        const stopAutoSlide = () => {
            clearInterval(autoSlideInterval);
        };

        // Attach click event to gallery thumbnails
        galleryThumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', function () {
                stopAutoSlide(); // Stop auto-slide when user interacts
                currentIndex = index; // Update the index
                updateMainImage(index);
                startAutoSlide(); // Restart auto-slide after interaction
            });
        });

        // Start the auto-slide when page loads
        startAutoSlide();
    });
</script>
