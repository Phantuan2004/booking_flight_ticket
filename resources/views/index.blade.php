<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyJet - Đặt vé máy bay trực tuyến</title>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    {{-- Scroll to top --}}
    @include('components.scroll-to-top')

    {{-- Header --}}
    @include('components.header')

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
            {{-- Flash Message --}}
            @include('components.flash-message')

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
                        <input type="text" name="departure" placeholder="Chọn thành phố hoặc sân bay"
                            value="{{ old('departure') }}">
                    </div>
                    <div class="form-group">
                        <label>Điểm đến</label>
                        <input type="text" name="destination" placeholder="Chọn thành phố hoặc sân bay"
                            value="{{ old('destination') }}">
                    </div>
                    <div class="form-group">
                        <label>Ngày đi</label>
                        <input type="date" min="{{ date('Y-m-d') }}" name="departure_time"
                            value="{{ old('departure_time') }}">
                    </div>
                    <div class="form-group">
                        <label>Ngày về</label>
                        <input type="date" min="{{ date('Y-m-d') }}" name="return_time"
                            value="{{ old('return_time') }}">
                    </div>
                    <div class="form-group">
                        <label>Người lớn <span style="color:rgba(0, 0, 0, 0.4)">(12 tuổi trở lên)</span></label>
                        <select name="adults">
                            <option value="1" {{ old('adults') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('adults') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('adults') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('adults') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('adults') == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trẻ em <span style="color:rgba(0, 0, 0, 0.4)">(2 đến dưới 12 tuổi)</span></label>
                        <select name="childrens">
                            <option value="0" {{ old('childrens') == '0' ? 'selected' : '' }}>0</option>
                            <option value="1" {{ old('childrens') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('childrens') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('childrens') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('childrens') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('childrens') == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Em bé <span style="color:rgba(0, 0, 0, 0.4)">(dưới 2 tuổi)</span></label>
                        <select name="infants">
                            <option value="0" {{ old('infants') == '0' ? 'selected' : '' }}>0</option>
                            <option value="1" {{ old('infants') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('infants') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('infants') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('infants') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('infants') == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label>Hạng ghế</label>
                        <select name="seat-class">
                            <option value="" {{ old('seat-class') == '' ? 'selected' : '' }}>Chọn</option>
                            <option value="Phổ thông" {{ old('seat-class') == 'Phổ thông' ? 'selected' : '' }}>Phổ
                                thông</option>
                            <option value="Thương gia" {{ old('seat-class') == 'Thương gia' ? 'selected' : '' }}>Thương
                                gia</option>
                        </select>
                    </div> --}}
                    <button type="submit" class="search-btn">TÌM CHUYẾN BAY</button>
                </form>
            </div>

            <!-- Form Vé Một Chiều -->
            <div id="oneway-form" class="form-container">
                <form class="search-form" method="GET" action="{{ route('flight-search-oneway') }}">
                    <div class="form-group">
                        <label>Điểm đi</label>
                        <input name="departure" type="text" placeholder="Chọn thành phố hoặc sân bay"
                            value="{{ old('departure') }}">
                    </div>
                    <div class="form-group">
                        <label>Điểm đến</label>
                        <input type="text" name="destination" placeholder="Chọn thành phố hoặc sân bay"
                            value="{{ old('destination') }}">
                    </div>
                    <div class="form-group">
                        <label>Ngày đi</label>
                        <input name='departure_time' type='date' min='{{ date('Y-m-d') }}'
                            value="{{ old('departure_time') }}">
                    </div>
                    {{-- <div class="form-group">
                        <label>Hạng ghế</label>
                        <select name="seat-class">
                            <option value="" {{ old('seat-class') == '' ? 'selected' : '' }}>Chọn</option>
                            <option value="Phổ thông" {{ old('seat-class') == 'Phổ thông' ? 'selected' : '' }}>Phổ
                                thông</option>
                            <option value="Thương gia" {{ old('seat-class') == 'Thương gia' ? 'selected' : '' }}>
                                Thương
                                gia</option>
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label>Người lớn <span style="color:rgba(0, 0, 0, 0.4)">(12 tuổi trở lên)</span></label>
                        <select name="adults">
                            <option value="1" {{ old('adults') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('adults') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('adults') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('adults') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('adults') == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Trẻ em <span style="color:rgba(0, 0, 0, 0.4)">(2 đến dưới 12 tuổi)</span></label>
                        <select name="childrens">
                            <option value="0" {{ old('childrens') == '0' ? 'selected' : '' }}>0</option>
                            <option value="1" {{ old('childrens') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('childrens') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('childrens') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('childrens') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('childrens') == '5' ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Em bé <span style="color:rgba(0, 0, 0, 0.4)">(dưới 2 tuổi)</span></label>
                        <select name="infants">
                            <option value="0" {{ old('infants') == '0' ? 'selected' : '' }}>0</option>
                            <option value="1" {{ old('infants') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('infants') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('infants') == '3' ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('infants') == '4' ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('infants') == '5' ? 'selected' : '' }}>5</option>
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
                        <li><a href="#">Địa Chỉ: 123 Đống Đa, Hà Nội</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 SkyJet. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/index.js')}}"></script>
</body>

</html>
