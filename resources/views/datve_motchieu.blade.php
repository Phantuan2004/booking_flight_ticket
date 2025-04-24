<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Tìm kiếm chuyến bay</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        header {
            background-color: #003580;
            color: white;
            padding: 15px 0;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .steps-container {
            display: flex;
            justify-content: center;
            background-color: #f0f8ff;
            padding: 15px 0;
            border-bottom: 1px solid #e6e6e6;
        }

        .booking-steps {
            display: flex;
            align-items: center;
        }

        .step {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #666;
        }

        .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
            color: white;
        }

        .step.completed .step-number {
            background-color: #4caf50;
        }

        .step.completed .step-text {
            color: #4caf50;
            font-weight: bold;
        }

        .step.active .step-number {
            background-color: #003580;
        }

        .step.active .step-text {
            color: #003580;
            font-weight: bold;
        }

        .step-divider {
            width: 50px;
            height: 1px;
            background-color: #ddd;
            margin: 0 15px;
        }

        .logo {
            font-size: 24px;
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
            margin-left: 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
        }

        .page-title {
            background-color: #003580;
            color: white;
            padding: 20px 0;
        }

        .page-title h1 {
            font-size: 24px;
        }

        .booking-content {
            display: flex;
            gap: 20px;
            margin: 30px 0;
        }

        .flight-selection {
            flex: 2;
        }

        .filter-panel {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .filter-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #003580;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 120px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            font-size: 14px;
        }

        .filter-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .filter-btn {
            background-color: #f0ad4e;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 20px;
        }

        .flight-list {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .flight-card {
            border: 1px solid #eee;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .flight-card:hover {
            border-color: #003580;
        }

        .airline-logo {
            width: 60px;
            height: 60px;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }

        .flight-info {
            flex: 1;
            margin-left: 15px;
        }

        .flight-time {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .flight-time .time {
            font-size: 18px;
            font-weight: bold;
        }

        .flight-time .duration {
            margin: 0 10px;
            color: #666;
            font-size: 14px;
        }

        .flight-route {
            font-size: 14px;
            color: #666;
        }

        .airline-name {
            font-size: 14px;
            color: #003580;
            margin-top: 5px;
        }

        .flight-details {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #003580;
            margin-bottom: 10px;
        }

        .select-btn {
            background-color: #003580;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .search-form {
            flex: 1;
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            align-self: flex-start;
            position: sticky;
            top: 20px;
        }

        .search-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #003580;
        }

        .search-group {
            margin-bottom: 15px;
        }

        .search-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .search-group input,
        .search-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .search-radios {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .search-radio label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .search-radio input {
            margin-right: 5px;
        }

        .search-btn {
            background-color: #f0ad4e;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            margin-top: 10px;
        }

        .passenger-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .passenger-count {
            display: flex;
            align-items: center;
        }

        .count-btn {
            width: 30px;
            height: 30px;
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-weight: bold;
        }

        .count-value {
            margin: 0 10px;
            min-width: 20px;
            text-align: center;
        }

        footer {
            background-color: #003580;
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }

        .copyright {
            text-align: center;
            color: #ddd;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .booking-content {
                flex-direction: column;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            nav ul {
                margin-top: 15px;
            }
        }

        /* CSS cho nút hiển thị chi tiết */
        .toggle-details-btn {
            background-color: transparent;
            color: #003580;
            border: 1px solid #003580;
            border-radius: 4px;
            padding: 5px 10px;
            font-size: 13px;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.2s;
        }

        .toggle-details-btn:hover {
            background-color: #f0f8ff;
        }

        /* CSS cho phần hiển thị chi tiết */
        .flight-details-container {
            width: 100%;
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 4px;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .flight-details-content {
            padding: 15px;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-table th {
            text-align: left;
            padding: 8px 0;
            border-bottom: 2px solid #ddd;
            color: #003580;
            font-size: 16px;
        }

        .details-table td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .details-table td:first-child {
            font-weight: 500;
            color: #666;
            width: 40%;
        }
    </style>
</head>

<body>
    {{-- Scroll to top --}}
    @include('components.scroll-to-top')

    <header>
        <div class="container">
            <div class="header-content">
                <div class="logo">Sky<span>Jet</span></div>
                <nav>
                    <ul>
                        <li><a href="{{ route('index') }}">Trang Chủ</a></li>
                        <li><a href="#">Đặt Vé</a></li>
                        <li><a href="#">Khuyến Mãi</a></li>
                        <li><a href="#">Lịch Bay</a></li>
                        <li><a href="/lienhe.html">Liên Hệ</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="page-title">
        <div class="container">
            <h1>Kết Quả Tìm Kiếm Chuyến Bay</h1>
        </div>
    </div>

    <div class="steps-container">
        <div class="booking-steps">
            <div class="step completed">
                <div class="step-number">1</div>
                <div class="step-text">Tìm Chuyến Bay</div>
            </div>
            <div class="step-divider"></div>
            <div class="step active">
                <div class="step-number">2</div>
                <div class="step-text">Chọn Chuyến Bay</div>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-number">3</div>
                <div class="step-text">Thông Tin Hành Khách</div>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-number">4</div>
                <div class="step-text">Thanh Toán</div>
            </div>
            <div class="step-divider"></div>
            <div class="step">
                <div class="step-number">5</div>
                <div class="step-text">Hoàn Tất</div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="booking-content">
            <div class="flight-selection">
                <div class="filter-panel">
                    <h2 class="filter-title">Lọc Kết Quả</h2>

                    <div class="filter-group">
                        <form action="{{ route('flight-search-oneway') }}" method="GET">
                            <!-- Giữ tất cả các tham số tìm kiếm khác -->
                            <input type="hidden" name="departure" value="{{ request('departure') }}">
                            <input type="hidden" name="destination" value="{{ request('destination') }}">
                            <input type="hidden" name="departure_time" value="{{ request('departure_time') }}">
                            <input type="hidden" name="adults" value="{{ request('adults') }}">
                            <input type="hidden" name="childrens" value="{{ request('childrens') }}">
                            <input type="hidden" name="infants" value="{{ request('infants') }}">

                            <div class="filter-form">
                                <div class="filter-group">
                                    <label>Hãng Hàng Không</label>
                                    <select>
                                        <option>Tất cả hãng</option>
                                        <option>Vietnam Airlines</option>
                                        <option>Vietjet Air</option>
                                        <option>Bamboo Airways</option>
                                        <option>Pacific Airlines</option>
                                    </select>
                                </div>
                                <!-- Other filter fields -->
                                <div class="filter-group">
                                    <label>Giá</label>
                                    <select name="sort">
                                        <option value="">Tất cả</option>
                                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Tăng
                                            dần</option>
                                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>
                                            Giảm dần</option>
                                    </select>
                                </div>
                                <!-- Other filter fields -->
                                <div class="filter-group">
                                    <label>Thời Gian Bay</label>
                                    <select>
                                        <option>Tất cả</option>
                                        <option>Sáng (00:00 - 12:00)</option>
                                        <option>Chiều (12:00 - 18:00)</option>
                                        <option>Tối (18:00 - 24:00)</option>
                                    </select>
                                </div>
                                <div class="filter-group">
                                    <label>Sắp Xếp</label>
                                    <select>
                                        <option>Giá thấp nhất</option>
                                        <option>Thời gian bay ngắn nhất</option>
                                        <option>Khởi hành sớm nhất</option>
                                        <option>Khởi hành muộn nhất</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="filter-btn">Áp Dụng</button>
                        </form>
                    </div>
                </div>

                <div class="flight-list">
                    @if ($flights->isEmpty())
                        <h2 style="text-align: center; color: red;">Không tìm thấy chuyến bay phù hợp, vui lòng chọn
                            chuyến bay khác!</h2>
                    @else
                        @foreach ($flights as $flight)
                            <div class="flight-card">
                                <div class="airline-logo"><img
                                        src="{{ asset('storage/airline_logos/' . $flight->airline->logo) }}"
                                        alt="Airline Logo" width="70px" height="70px"></div>
                                <div class="flight-info">
                                    <div class="flight-time">
                                        <div class="time">{{ $flight->departure_time }}</div>
                                    </div>
                                    <div class="flight-route">
                                        {{ $flight->departure }} - {{ $flight->destination }}
                                    </div>
                                    <div class="airline-name">{{ $flight->airline->name }}</div>

                                    <!-- Thêm nút hiển thị chi tiết -->
                                    <button class="toggle-details-btn" onclick="toggleDetails({{ $flight->id }})">
                                        Hiển thị chi tiết
                                    </button>
                                </div>
                                <div class="flight-details">
                                    <div class="price">
                                        @if ($flight->seat_class == 'phổ thông')
                                            {{ number_format($flight->price_economy, 0, ',', '.') }} VNĐ
                                        @else
                                            {{ number_format($flight->price_business, 0, ',', '.') }} VNĐ
                                        @endif
                                    </div>
                                    <form action="{{ route('xacnhan') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                                        <input type="hidden" name="departure" value="{{ $flight->departure }}">
                                        <input type="hidden" name="destination" value="{{ $flight->destination }}">
                                        <input type="hidden" name="departure_time"
                                            value="{{ $flight->departure_time }}">
                                        <input type="hidden" name="price"
                                            value="@if ($flight->seat_class === 'phổ thông') {{ $flight->price_economy }} @else {{ $flight->price_business }} @endif">
                                        <input type="hidden" name="adults" value="{{ $adults }}">
                                        <input type="hidden" name="childrens" value="{{ $childrens }}">
                                        <input type="hidden" name="infants" value="{{ $infants }}">
                                        @if ($flight->seat_class === 'phổ thông')
                                            <button class="select-btn" type="submit">Chọn vé phổ thông</button>
                                        @elseif ($flight->seat_class === 'thương gia')
                                            <button class="select-btn" type="submit">Chọn vé thương gia</button>
                                        @endif
                                    </form>
                                </div>
                            </div>

                            <!-- Thêm phần chi tiết ẩn ngay sau mỗi flight-card -->
                            <div id="details-{{ $flight->id }}" class="flight-details-container"
                                style="display: none;">
                                <div class="flight-details-content">
                                    <table class="details-table">
                                        <tr>
                                            <th colspan="2">Chi tiết chuyến bay</th>
                                        </tr>
                                        <tr>
                                            <td>Mã chuyến bay:</td>
                                            <td>{{ $flight->flight_code ?? 'VN' . rand(1000, 9999) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngày bay:</td>
                                            <td>
                                                @if ($flight->departure_time instanceof \DateTime)
                                                    {{ $flight->departure_time->format('d/m/Y') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($flight->departure_time)->format('d/m/Y') }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Giờ bay:</td>
                                            <td>
                                                @if ($flight->flight_start instanceof \DateTime)
                                                    {{ $flight->flight_start->format('H:i') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($flight->flight_start)->format('H:i') }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Giờ đến: (dự kiến)</td>
                                            <td>
                                                @if ($flight->flight_end instanceof \DateTime)
                                                    {{ $flight->flight_end->format('H:i') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($flight->flight_end)->format('H:i') }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hãng bay: </td>
                                            <td>{{ $flight->airline->name ?? 'Vietnam Airlines' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Loại máy bay:</td>
                                            <td>{{ $flight->aircraft_type ?? 'Airbus A' . rand(300, 380) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hạng vé:</td>
                                            <td>{{ ucfirst($flight->seat_class) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hành lý xách tay:</td>
                                            <td>{{ $flight->seat_class === 'thương gia' ? '12kg' : '7kg' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hành lý ký gửi:</td>
                                            <td>{{ $flight->seat_class === 'thương gia' ? '40kg' : '20kg' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="search-form">
                <h2 class="search-title">Tìm Kiếm Chuyến Bay</h2>

                <div class="search-radios">
                    <div class="search-radio">
                        <label>
                            <input type="radio" name="tripType" checked /> Một chiều
                        </label>
                    </div>
                    <div class="search-radio">
                        <label> <input type="radio" name="tripType" /> Khứ hồi </label>
                    </div>
                </div>

                <div class="search-group">
                    <label>Điểm đi</label>
                    <select>
                        <option>Hà Nội (HAN)</option>
                        <option>TP Hồ Chí Minh (SGN)</option>
                        <option>Đà Nẵng (DAD)</option>
                        <option>Nha Trang (CXR)</option>
                        <option>Phú Quốc (PQC)</option>
                    </select>
                </div>

                <div class="search-group">
                    <label>Điểm đến</label>
                    <select>
                        <option>TP Hồ Chí Minh (SGN)</option>
                        <option>Hà Nội (HAN)</option>
                        <option>Đà Nẵng (DAD)</option>
                        <option>Nha Trang (CXR)</option>
                        <option>Phú Quốc (PQC)</option>
                    </select>
                </div>

                <div class="search-group">
                    <label>Ngày đi</label>
                    <input type="date" value="2025-04-07" />
                </div>

                <div class="search-group">
                    <label>Ngày về</label>
                    <input type="date" disabled />
                </div>

                <div class="search-group">
                    <label>Hành khách</label>
                    <div class="passenger-row">
                        <span>Người lớn</span>
                        <div class="passenger-count">
                            <div class="count-btn">-</div>
                            <div class="count-value">2</div>
                            <div class="count-btn">+</div>
                        </div>
                    </div>
                    <div class="passenger-row">
                        <span>Trẻ em (2-12 tuổi)</span>
                        <div class="passenger-count">
                            <div class="count-btn">-</div>
                            <div class="count-value">1</div>
                            <div class="count-btn">+</div>
                        </div>
                    </div>
                    <div class="passenger-row">
                        <span>Em bé (< 2 tuổi)</span>
                                <div class="passenger-count">
                                    <div class="count-btn">-</div>
                                    <div class="count-value">0</div>
                                    <div class="count-btn">+</div>
                                </div>
                    </div>
                </div>

                <button class="search-btn">TÌM KIẾM</button>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="copyright">
                <p>&copy; 2025 SkyJet. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script>
        function toggleDetails(flightId) {
            const detailsSection = document.getElementById('details-' + flightId);
            const buttons = document.querySelectorAll('.toggle-details-btn');

            // Tìm button đã được click
            let clickedButton;
            buttons.forEach(button => {
                if (button.getAttribute('onclick').includes(flightId)) {
                    clickedButton = button;
                }
            });

            if (detailsSection.style.display === 'none') {
                detailsSection.style.display = 'block';
                clickedButton.textContent = 'Ẩn chi tiết';
            } else {
                detailsSection.style.display = 'none';
                clickedButton.textContent = 'Hiển thị chi tiết';
            }
        }
    </script>
</body>

</html>
