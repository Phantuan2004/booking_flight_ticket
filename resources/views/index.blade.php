<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyJet - Đặt vé máy bay trực tuyến</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        header {
            background-color: #003580;
            color: white;
            padding: 20px 0;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 28px;
            font-weight: bold;
        }

        .logo span {
            color: #ffd700;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #ffd700;
        }

        .hero {
            background-image: url('/api/placeholder/1200/400');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .hero-content {
            z-index: 1;
            color: white;
            padding: 20px;
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .search-box {
            background-color: white;
            border-radius: 8px;
            padding: 30px;
            margin-top: -50px;
            position: relative;
            z-index: 2;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .search-tabs {
            display: flex;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            border-bottom: 2px solid transparent;
        }

        .tab.active {
            border-bottom: 2px solid #003580;
            color: #003580;
            font-weight: bold;
        }

        .search-form {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .search-btn {
            background-color: #f0ad4e;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            grid-column: 1 / -1;
            margin-top: 10px;
        }

        .search-btn:hover {
            background-color: #ec971f;
        }

        .form-container {
            display: none;
        }

        .form-container.active {
            display: block;
        }

        .features {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
            color: #003580;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .feature-card i {
            font-size: 40px;
            color: #003580;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            margin-bottom: 15px;
            color: #333;
        }

        .feature-card p {
            color: #666;
            line-height: 1.6;
        }

        .popular-flights {
            padding: 60px 0;
            background-color: #f9f9f9;
        }

        .flights-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .flight-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .flight-image {
            height: 180px;
            background-size: cover;
            background-position: center;
        }

        .flight-details {
            padding: 20px;
        }

        .flight-route {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .flight-date {
            color: #666;
            margin-bottom: 15px;
        }

        .flight-price {
            color: #003580;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .book-now {
            background-color: #003580;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .book-now:hover {
            background-color: #00285e;
        }

        footer {
            background-color: #003580;
            color: white;
            padding: 40px 0;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }

        .footer-column h3 {
            margin-bottom: 20px;
            font-size: 18px;
            color: #ffd700;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column ul li a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-column ul li a:hover {
            color: white;
        }

        .copyright {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #ddd;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }

            nav ul {
                margin-top: 20px;
            }

            .hero h1 {
                font-size: 28px;
            }

            .search-box {
                margin-top: -20px;
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">Sky<span>Jet</span></div>
                <nav>
                    <ul>
                        <li><a href="{{ route('index') }}">Trang Chủ</a></li>
                        <li><a href="{{ route('datve_khuhoi') }}">Đặt Vé</a></li>
                        <li><a href="#">Khuyến Mãi</a></li>
                        <li><a href="#">Lịch Bay</a></li>
                        <li><a href="{{ route('lienhe') }}">Liên Hệ</a></li>
                        <li><a href="{{ route('lichsudatve') }}">Xem lại lịch sử</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Khám Phá Thế Giới Cùng SkyJet</h1>
                <p>Đặt vé máy bay với giá ưu đãi nhất và tận hưởng trải nghiệm bay tuyệt vời</p>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="search-box">
            <div class="search-tabs">
                <div class="tab active" onclick="showForm('roundtrip')">Vé Khứ Hồi</div>
                <div class="tab" onclick="showForm('oneway')">Vé Một Chiều</div>
                <div class="tab" onclick="showForm('multi')">Nhiều Chặng Bay</div>
            </div>

            <!-- Form Vé Khứ Hồi -->
            <div id="roundtrip-form" class="form-container active">
                <form class="search-form" action="{{ route('flight-search-roundtrip') }}" method="GET">
                    <div class="form-group">
                        <label>Điểm đi</label>
                        <input type="text" name="departure" placeholder="Chọn thành phố hoặc sân bay">
                    </div>
                    <div class="form-group">
                        <label>Điểm đến</label>
                        <input type="text" name="destination" placeholder="Chọn thành phố hoặc sân bay">
                    </div>
                    <div class="form-group">
                        <label>Ngày đi</label>
                        <input type="date" name="departure_time">
                    </div>
                    <div class="form-group">
                        <label>Ngày về</label>
                        <input type="date" name="return_time">
                    </div>
                    <div class="form-group">
                        <label>Người lớn <span style="color:rgba(0, 0, 0, 0.4)">(12 tuổi trở lên)</span></label>
                        <select name="adults">
                            <option>1 Người lớn</option>
                            <option>2 Người lớn</option>
                            <option>3 Người lớn</option>
                            <option>4 Người lớn</option>
                            <option>5+ Người lớn</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trẻ em <span style="color:rgba(0, 0, 0, 0.4)">(2 đến dưới 12 tuổi)</span></label>
                        <select name="childrens">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Em bé <span style="color:rgba(0, 0, 0, 0.4)">(dưới 2 tuổi)</span></label>
                        <select name="infants">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hạng ghế</label>
                        <select name="seat-class">
                            <option value="">Chọn</option>
                            <option>Phổ thông</option>
                            <option>Thương gia</option>
                        </select>
                    </div>
                    <button type="submit" class="search-btn">TÌM CHUYẾN BAY</button>
                </form>
            </div>

            <!-- Form Vé Một Chiều -->
            <div id="oneway-form" class="form-container">
                <form class="search-form" method="GET" action="{{ route('flight-search-oneway') }}">
                    <div class="form-group">
                        <label>Điểm đi</label>
                        <input name="departure" type="text" placeholder="Chọn thành phố hoặc sân bay">
                    </div>
                    <div class="form-group">
                        <label>Điểm đến</label>
                        <input type="text" name="destination" placeholder="Chọn thành phố hoặc sân bay">
                    </div>
                    <div class="form-group">
                        <label>Ngày đi</label>
                        <input name="departure_time" type="date">
                    </div>
                    <div class="form-group">
                        <label>Người lớn <span style="color:rgba(0, 0, 0, 0.4)">(12 tuổi trở lên)</span></label>
                        <select name="adults">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trẻ em <span style="color:rgba(0, 0, 0, 0.4)">(2 đến dưới 12 tuổi)</span></label>
                        <select name="childrens">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Em bé <span style="color:rgba(0, 0, 0, 0.4)">(dưới 2 tuổi)</span></label>
                        <select name="infants">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Hạng ghế</label>
                        <select name="class">
                            <option value="">Chọn</option>
                            <option>Phổ thông</option>
                            <option>Thương gia</option>
                        </select>
                    </div>
                    <button type="submit" class="search-btn">TÌM CHUYẾN BAY</button>
                </form>
            </div>

            <!-- Form Nhiều Chặng Bay (placeholder) -->
            <div id="multi-form" class="form-container">
                <form class="search-form">
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <p>Form đặt vé nhiều chặng sẽ được cập nhật sau.</p>
                    </div>
                    <button type="submit" class="search-btn">TÌM CHUYẾN BAY</button>
                </form>
            </div>
        </div>
    </div>

    <section class="features">
        <div class="container">
            <h2 class="section-title">Tại Sao Chọn SkyJet?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <i>✈️</i>
                    <h3>Giá Tốt Nhất</h3>
                    <p>Chúng tôi đảm bảo cung cấp giá vé tốt nhất từ hơn 500 hãng hàng không trên toàn thế giới.</p>
                </div>
                <div class="feature-card">
                    <i>🛡️</i>
                    <h3>Đặt Vé An Toàn</h3>
                    <p>Thanh toán an toàn với đa dạng phương thức và bảo mật thông tin cá nhân tuyệt đối.</p>
                </div>
                <div class="feature-card">
                    <i>🏆</i>
                    <h3>Hỗ Trợ 24/7</h3>
                    <p>Đội ngũ hỗ trợ chuyên nghiệp sẵn sàng giúp đỡ bạn mọi lúc, mọi nơi.</p>
                </div>
                <div class="feature-card">
                    <i>🎁</i>
                    <h3>Ưu Đãi Độc Quyền</h3>
                    <p>Nhận các ưu đãi và khuyến mãi độc quyền khi đặt vé qua SkyJet.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="popular-flights">
        <div class="container">
            <h2 class="section-title">Chuyến Bay Phổ Biến</h2>
            <div class="flights-grid">
                @if ($flights->count() == 0)
                    "Không có chuyến bay phổ biến"
                @else
                    @foreach ($flights as $flight)
                        <div class="flight-card">
                            <div class="flight-image" style="background-image: url('{{ $flight->image }}');"></div>
                            <div class="flight-details">
                                <div class="flight-route">{{ $flight->departure }} - {{ $flight->destination }}</div>
                                <div class="flight-date">{{ $flight->departure_time }}</div>
                                <div class="flight-price">{{ number_format($flight->price, 0, ',', '.') }} VNĐ</div>
                                <form action="{{ route('xacnhan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                                    <input type="hidden" name="departure" value="{{ $flight->departure }}">
                                    <input type="hidden" name="destination" value="{{ $flight->destination }}">
                                    <input type="hidden" name="departure_time"
                                        value="{{ $flight->departure_time }}">
                                    <input type="hidden" name="arrival_time" value="{{ $flight->arrival_time }}">
                                    <input type="hidden" name="price" value="{{ $flight->price }}">
                                    <input type="hidden" name="passengers" value="{{ $passengers }}">
                                    <input type="hidden" name="childrens" value="{{ $childrens }}">
                                    <button class="select-btn" type="submit">Đặt ngay</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section> --}}

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>SkyJet</h3>
                    <ul>
                        <li><a href="#">Về Chúng Tôi</a></li>
                        <li><a href="#">Điều Khoản Sử Dụng</a></li>
                        <li><a href="#">Chính Sách Bảo Mật</a></li>
                        <li><a href="#">Chính Sách Hoàn Vé</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Đối Tác</h3>
                    <ul>
                        <li><a href="#">Các Hãng Hàng Không</a></li>
                        <li><a href="#">Khách Sạn Đối Tác</a></li>
                        <li><a href="#">Dịch Vụ Thuê Xe</a></li>
                        <li><a href="#">Bảo Hiểm Du Lịch</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Thanh Toán</h3>
                    <ul>
                        <li><a href="#">Visa / Mastercard</a></li>
                        <li><a href="#">Internet Banking</a></li>
                        <li><a href="#">Ví Điện Tử</a></li>
                        <li><a href="#">Trả Góp</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Liên Hệ</h3>
                    <ul>
                        <li><a href="#">Hotline: 1900 1234</a></li>
                        <li><a href="#">Email: support@skyjet.vn</a></li>
                        <li><a href="#">Địa Chỉ: 123 Nguyễn Huệ, Q.1, TP.HCM</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 SkyJet. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script>
        function showForm(formType) {
            // Ẩn tất cả các form
            document.querySelectorAll('.form-container').forEach(form => {
                form.classList.remove('active');
            });

            // Hiển thị form được chọn
            document.getElementById(formType + '-form').classList.add('active');

            // Cập nhật trạng thái active cho tab
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Tìm tab đang được click và thêm class active
            event.target.classList.add('active');
        }
    </script>

    <script>
        // // Hiển thị thông báo khi chưa nhập thông tin chuyến bay mà đã submit
        // document.querySelector('#roundtrip-form').addEventListener('submit', function(event) {
        //     const contactFormSearch = document.querySelectorAll('.form-container');
        //     let allContactFormSearchFilled = true;
        //     contactFormSearch.forEach(input => {
        //         if (!input.value) {
        //             allContactFormSearchFilled = false;
        //         }
        //     });
        //     if (!allContactFormSearchFilled) {
        //         event.preventDefault();
        //         alert('Vui lòng điền đầy đủ thông tin chuyến bay trước khi tìm kiếm.');
        //     }
        // });

        // document.querySelector('#oneway-form').addEventListener('submit', function(event) {
        //     const contactFormSearch = document.querySelectorAll('.form-container');
        //     let allContactFormSearchFilled = true;
        //     contactFormSearch.forEach(input => {
        //         if (!input.value) {
        //             allContactFormSearchFilled = false;
        //         }
        //     });
        //     if (!allContactFormSearchFilled) {
        //         event.preventDefault();
        //         alert('Vui lòng điền đầy đủ thông tin chuyến bay trước khi tìm kiếm.');
        //     }
        // });
    </script>
</body>

</html>
