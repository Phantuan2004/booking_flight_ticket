<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Đặt vé khứ hồi</title>
    <script src="https://kit.fontawesome.com/9046a62732.js" crossorigin="anonymous"></script>
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
            width: 95%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .trip-summary {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .trip-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .trip-route {
            font-size: 18px;
            font-weight: bold;
        }

        .trip-dates {
            display: flex;
            gap: 20px;
        }

        .date-box {
            text-align: center;
        }

        .date-label {
            font-size: 14px;
            color: #666;
        }

        .date-value {
            font-weight: bold;
        }

        .passenger-info {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .flight-selection-header {
            margin: 30px 0 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #e7f1ff;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 5px solid #003580;
        }

        .flight-selection-title {
            font-size: 18px;
            color: #003580;
            font-weight: bold;
        }

        .flight-selection-subtitle {
            font-size: 15px;
            color: #333;
            margin-top: 3px;
        }

        .booking-content {
            display: flex;
            gap: 20px;
            margin: 30px 0;
        }

        .flight-selection {
            flex: 2;
        }

        /* Cột header cho danh sách chuyến bay */
        .flight-list {
            background-color: white;
            border-radius: 3px;
            padding: 0 5px;
            margin-bottom: 8px;
            width: 100%;
        }

        /* Thay đổi flight-card thành dạng hàng (row) trong grid */
        .flight-card {
            display: grid;
            grid-template-columns: 70px 60px 45px 25px auto auto;
            align-items: center;
            padding: 8px;
            border-bottom: 1px solid #ebebeb;
            text-align: left;
            gap: 5px;
        }

        .flight-card:last-child {
            border-bottom: none;
        }

        .airline-logo {
            display: flex;
            align-items: center;
        }

        .airline-logo img {
            max-width: 65px;
            max-height: 60px;
            object-fit: contain;
        }

        .flight-code {
            font-size: 12px;
            font-weight: 600;
            color: #666;
        }

        .flight-time {
            font-weight: bold;
            font-size: 15px;
            color: #333;
        }

        .flight-duration {
            color: #666;
            font-size: 14px;
        }

        .airline-name {
            font-size: 14px;
            color: #003580;
        }

        .flight-route {
            font-size: 13px;
            color: #666;
        }

        .price {
            font-size: 15px;
            font-weight: 600;
            color: #e74c3c;
            white-space: nowrap;
            text-align: right;
            padding-right: 5px;
        }

        .select-btn {
            background-color: #ff5722;
            color: white;
            border: none;
            padding: 6px 15px;
            border-radius: 3px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            transition: background-color 0.3s;
        }

        .select-btn:hover {
            background-color: #f4511e;
        }

        .select-btn.selected {
            background-color: #28a745;
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

        .search-form {
            width: 100%;
            flex: 1.2;
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            align-self: flex-start;
            position: sticky;
            top: 20px;
        }

        .search-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #003580;
            font-weight: 600;
        }

        .search-group {
            margin-bottom: 20px;
        }

        .search-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .search-group input,
        .search-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .search-group input:focus,
        .search-group select:focus {
            border-color: #003580;
            outline: none;
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
            background-color: #ff5722;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            width: 100%;
            font-size: 15px;
            margin-top: 15px;
        }

        .search-btn:hover {
            background-color: #f4511e;
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

        .next-step-container {
            text-align: center;
            margin: 30px 0;
        }

        .next-step-btn {
            background-color: #ccc;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 16px;
            cursor: not-allowed;
            transition: all 0.3s ease;
        }

        .next-step-btn:not(:disabled):hover {
            background-color: #218838;
        }

        .selected-flights-summary {
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-top: 30px;
        }

        .summary-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #003580;
        }

        .selected-flight-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .selected-flight-info {
            flex: 1;
        }

        .selected-flight-price {
            font-weight: bold;
            color: #003580;
        }

        .total-price {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
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

            .flight-selection-container {
                flex-direction: column;
                gap: 8px;
            }

            .flight-card {
                grid-template-columns: 1fr;
                gap: 3px;
                padding: 1px;
            }

            .price {
                text-align: left;
                padding-right: 0;
            }

            .select-btn {
                float: none;
                width: 100%;
                margin-right: 0;
            }

            .search-form {
                position: static;
                margin-bottom: 15px;
                padding: 20px;
            }
        }

        .flight-selection-container {
            display: flex;
            justify-content: space-between;
            gap: 8px;
            width: 100%;
        }

        .container-1,
        .container-2 {
            flex: 1;
            min-width: 0;
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

        .info-button {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
        }

        .info-button:hover i {
            color: #5a9bd5 !important;
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
                        <li>
                            <a href="{{ route('index') }}">Trang Chủ</a>
                        </li>
                        <li><a href="#">Đặt Vé</a></li>
                        <li><a href="#">Khuyến Mãi</a></li>
                        <li><a href="#">Lịch Bay</a></li>
                        <li><a href="{{ route('lienhe') }}">Liên Hệ</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="page-title">
        <div class="container">
            <h1>Đặt Vé Khứ Hồi</h1>
        </div>
    </div>

    <div class="container">
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

        <div class="booking-content">
            <div class="flight-selection">
                <div class="filter-panel">
                    <form action="{{ route('flight-search-roundtrip') }}" method="get">
                        <h2 class="filter-title">Lọc Kết Quả</h2>
                        <div class="filter-form">
                            <div class="filter-group">
                                <label>Hãng Hàng Không</label>
                                <select>
                                    <option>Tất cả hãng</option>
                                    @foreach ($airlines as $airline)
                                        <option value="{{ $airline->id }}">{{ $airline->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>Giá</label>
                                <select>
                                    <option>Sắp xếp theo giá</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Từ thấp
                                        đến cao</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Từ cao
                                        đến thấp</option>
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
                        <button class="filter-btn" type="submit">Áp Dụng</button>
                    </form>
                </div>

                <form action="" method="post">
                    <div class="flight-selection-container">
                        <!-- Chuyến Đi -->
                        <div class="container-1">
                            <div class="flight-selection-header">
                                <div>
                                    <div class="flight-selection-title">
                                        Chuyến Đi
                                    </div>
                                    <div class="flight-selection-subtitle">
                                        {{ $departure }} → {{ $destination }}, {{ $departure_time }}
                                    </div>
                                </div>
                            </div>

                            <div class="flight-list">
                                @foreach ($outboundFlights as $trip)
                                    <div class="flight-card">
                                        <div class="airline-logo">
                                            <img src="{{ asset('storage/airline_logos/' . $trip->airline->logo) }}"
                                                alt="Airline Logo" />
                                        </div>
                                        <div class="flight-code">{{ $trip->flight_code }}</div>
                                        <div class="flight-time">{{ $trip->flight_start }}</div>
                                        <div><button type="button"
                                                onclick="toggleDetails({{ $trip->id }}, 'outbound')"
                                                class="info-button" aria-label="Toggle flight details">
                                                <i class="fa-solid fa-square-plus"
                                                    style="color: #74C0FC; font-size: 18px;"></i>
                                            </button></div>
                                        <div class="price">{{ number_format($trip->price, 0, ',', ',') }}đ
                                        </div>
                                        <button type="button"
                                            onclick="selectFlight({{ $trip->id }}, 'outbound', this)"
                                            class="select-btn">Chọn</button>
                                    </div>

                                    <!-- Thêm phần chi tiết ẩn ngay sau mỗi flight-card -->
                                    <div id="details-{{ $trip->id }}" class="flight-details-container"
                                        style="display: none;">
                                        <div class="flight-details-content">
                                            <table class="details-table">
                                                <tr>
                                                    <th colspan="2">Chi tiết chuyến bay</th>
                                                </tr>
                                                <tr>
                                                    <td>Mã chuyến bay:</td>
                                                    <td>{{ $trip->flight_code ?? 'VN' . rand(1000, 9999) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày bay:</td>
                                                    <td>
                                                        @if ($trip->departure_time instanceof \DateTime)
                                                            {{ $trip->departure_time->format('d/m/Y') }}
                                                        @else
                                                            {{ \Carbon\Carbon::parse($trip->departure_time)->format('d/m/Y') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Giờ bay:</td>
                                                    <td>
                                                        @if ($trip->flight_start instanceof \DateTime)
                                                            {{ $trip->flight_start->format('H:i') }}
                                                        @else
                                                            {{ \Carbon\Carbon::parse($trip->flight_start)->format('H:i') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Giờ đến: (dự kiến)</td>
                                                    <td>
                                                        @if ($trip->flight_end instanceof \DateTime)
                                                            {{ $trip->flight_end->format('H:i') }}
                                                        @else
                                                            {{ \Carbon\Carbon::parse($trip->flight_end)->format('H:i') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Hãng bay: </td>
                                                    <td>{{ $trip->airline->name ?? 'Vietnam Airlines' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Loại máy bay:</td>
                                                    <td>{{ $trip->aircraft_type ?? 'Airbus A' . rand(300, 380) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Hạng vé:</td>
                                                    <td>{{ ucfirst($trip->seat_class) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Hành lý xách tay:</td>
                                                    <td>{{ $trip->seat_class === 'thương gia' ? '12kg' : '7kg' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Hành lý ký gửi:</td>
                                                    <td>{{ $trip->seat_class === 'thương gia' ? '40kg' : '20kg' }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Chuyến Về -->
                        <div class="container-2">
                            <div class="flight-selection-header">
                                <div>
                                    <div class="flight-selection-title">
                                        Chuyến Về
                                    </div>
                                    <div class="flight-selection-subtitle">
                                        {{ $destination }} → {{ $departure }}, {{ $return_time }}
                                    </div>
                                </div>
                            </div>

                            <div class="flight-list">
                                @foreach ($returnFlights as $return)
                                    <div class="flight-card">
                                        <div class="airline-logo">
                                            <img src="{{ asset('storage/airline_logos/' . $return->airline->logo) }}"
                                                alt="Airline Logo" />
                                        </div>
                                        <div class="flight-code">{{ $return->flight_code }}</div>
                                        <div class="flight-time">{{ $return->flight_start }}</div>
                                        <div><button type="button"
                                                onclick="toggleDetails({{ $return->id }}, 'return')"
                                                class="info-button" aria-label="Toggle flight details">
                                                <i class="fa-solid fa-square-plus"
                                                    style="color: #74C0FC; font-size: 18px;"></i>
                                            </button></div>
                                        <div class="price">{{ number_format($return->price, 0, ',', ',') }}đ</div>
                                        <button type="button"
                                            onclick="selectFlight({{ $return->id }}, 'return', this)"
                                            class="select-btn">Chọn</button>
                                    </div>

                                    <!-- Thêm phần chi tiết ẩn ngay sau mỗi flight-card -->
                                    <div id="details-{{ $return->id }}" class="flight-details-container"
                                        style="display: none;">
                                        <div class="flight-details-content">
                                            <table class="details-table">
                                                <tr>
                                                    <th colspan="2">Chi tiết chuyến bay</th>
                                                </tr>
                                                <tr>
                                                    <td>Mã chuyến bay:</td>
                                                    <td>{{ $return->flight_code ?? 'VN' . rand(1000, 9999) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ngày bay:</td>
                                                    <td>
                                                        @if ($return->departure_time instanceof \DateTime)
                                                            {{ $return->departure_time->format('d/m/Y') }}
                                                        @else
                                                            {{ \Carbon\Carbon::parse($return->departure_time)->format('d/m/Y') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Giờ bay:</td>
                                                    <td>
                                                        @if ($return->flight_start instanceof \DateTime)
                                                            {{ $return->flight_start->format('H:i') }}
                                                        @else
                                                            {{ \Carbon\Carbon::parse($return->flight_start)->format('H:i') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Giờ đến: (dự kiến)</td>
                                                    <td>
                                                        @if ($return->flight_end instanceof \DateTime)
                                                            {{ $return->flight_end->format('H:i') }}
                                                        @else
                                                            {{ \Carbon\Carbon::parse($return->flight_end)->format('H:i') }}
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Hãng bay: </td>
                                                    <td>{{ $return->airline->name ?? 'Vietnam Airlines' }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Loại máy bay:</td>
                                                    <td>{{ $return->aircraft_type ?? 'Airbus A' . rand(300, 380) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Hạng vé:</td>
                                                    <td>{{ ucfirst($return->seat_class) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Hành lý xách tay:</td>
                                                    <td>{{ $return->seat_class === 'thương gia' ? '12kg' : '7kg' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Hành lý ký gửi:</td>
                                                    <td>{{ $return->seat_class === 'thương gia' ? '40kg' : '20kg' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="search-form">
                <h2 class="search-title">Tìm Kiếm Chuyến Bay</h2>

                <div class="search-radios">
                    <div class="search-radio">
                        <label>
                            <input type="radio" name="tripType" checked />
                            Một chiều
                        </label>
                    </div>
                    <div class="search-radio">
                        <label>
                            <input type="radio" name="tripType" /> Khứ hồi
                        </label>
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

        <div class="next-step-container">
            <form id="bookingForm" action="{{ route('xacnhan') }}" method="POST">
                @csrf
                <input type="hidden" id="outbound_flight_id" name="outbound_flight_id" value="">
                <input type="hidden" id="return_flight_id" name="return_flight_id" value="">
                <button type="submit" class="next-step-btn" id="submitBtn" disabled>
                    TIẾP TỤC VỚI CHUYẾN BAY ĐÃ CHỌN
                </button>
            </form>
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
        let selectedOutbound = null;
        let selectedReturn = null;

        function selectFlight(flightId, type, button) {
            // Bỏ chọn các button cùng loại
            const container = type === 'outbound' ? 'container-1' : 'container-2';
            const otherButtons = document.querySelectorAll(`.${container} .select-btn`);
            otherButtons.forEach(btn => {
                if (btn !== button) {
                    btn.textContent = 'Chọn';
                    btn.classList.remove('selected');
                }
            });

            // Xử lý button được click
            if (button.classList.contains('selected')) {
                button.textContent = 'Chọn';
                button.classList.remove('selected');
                if (type === 'outbound') {
                    selectedOutbound = null;
                    document.getElementById('outbound_flight_id').value = '';
                } else {
                    selectedReturn = null;
                    document.getElementById('return_flight_id').value = '';
                }
            } else {
                button.textContent = 'Đã chọn';
                button.classList.add('selected');
                if (type === 'outbound') {
                    selectedOutbound = flightId;
                    document.getElementById('outbound_flight_id').value = flightId;
                } else {
                    selectedReturn = flightId;
                    document.getElementById('return_flight_id').value = flightId;
                }
            }

            // Kiểm tra và cập nhật trạng thái nút submit
            const submitBtn = document.getElementById('submitBtn');
            if (selectedOutbound && selectedReturn) {
                submitBtn.disabled = false;
                submitBtn.style.backgroundColor = '#28a745';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.backgroundColor = '#ccc';
                submitBtn.style.cursor = 'not-allowed';
            }
        }
    </script>

    <script>
        function toggleDetails(flightId, type) {
            const detailsSection = document.getElementById('details-' + flightId);
            const clickedButton = document.querySelector(`button[onclick*="${flightId}"]`);
            const icon = clickedButton.querySelector('i');

            // Đóng tất cả details của section khác
            const otherType = type === 'outbound' ? 'return' : 'outbound';
            const otherContainer = document.querySelector(`.container-${otherType === 'outbound' ? '1' : '2'}`);
            if (otherContainer) {
                const otherDetails = otherContainer.querySelectorAll('.flight-details-container');
                const otherIcons = otherContainer.querySelectorAll('.info-button i');

                otherDetails.forEach(detail => {
                    detail.style.display = 'none';
                });

                otherIcons.forEach(i => {
                    i.className = 'fa-solid fa-square-plus';
                });
            }

            // Toggle details hiện tại
            if (detailsSection.style.display === 'none') {
                detailsSection.style.display = 'block';
                icon.className = 'fa-solid fa-square-minus';
            } else {
                detailsSection.style.display = 'none';
                icon.className = 'fa-solid fa-square-plus';
            }
        }
    </script>
</body>

</html>
