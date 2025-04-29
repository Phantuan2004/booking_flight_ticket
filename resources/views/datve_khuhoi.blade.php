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

        .search-radio {
            position: relative;
        }

        .search-radio button {
            background-color: #e0e0e0;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-container {
            display: none;
        }

        .form-container.active {
            display: block;
        }

        .search-btn {
            background-color: #ff5722;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
            width: 300px;
            font-size: 15px;
            margin-top: 20px;
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

        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background-color: #ff4444;
            color: white;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: none;
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
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
            display: flex;
            justify-content: center;
            margin: 20px auto 0;
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
            <h1>Kết quả tìm kiếm</h1>
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
                                    <div class="flight-time">{{ $trip->flight_trip }}</div>
                                    <div><button type="button"
                                            onclick="toggleDetails({{ $trip->id }}, 'outbound')"
                                            class="info-button" aria-label="Toggle flight details">
                                            <i class="fa-solid fa-square-plus"
                                                style="color: #74C0FC; font-size: 18px;"></i>
                                        </button></div>
                                    <div class="price">{{ number_format($trip->price, 0, ',', ',') }}đ
                                    </div>
                                    <button type="button"
                                        onclick="selectFlight(
                                        {{ $trip->id }},
                                        'outbound',
                                        this,
                                        '{{ $trip->flight_code }}',
                                        '{{ $trip->airline->name }}',
                                        '{{ $trip->departure }}',
                                        '{{ $trip->destination }}',
                                        '{{ $trip->departure_time }}',
                                        {{ $trip->price }}
                                    )"
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
                                                    @if ($trip->flight_trip instanceof \DateTime)
                                                        {{ $trip->flight_trip->format('H:i') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($trip->flight_trip)->format('H:i') }}
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
                                                <td>{{ $trip->seat_class === 'thương gia' ? '40kg' : '20kg' }}
                                                </td>
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
                                    <div><button type="button" onclick="toggleDetails({{ $return->id }}, 'return')"
                                            class="info-button" aria-label="Toggle flight details">
                                            <i class="fa-solid fa-square-plus"
                                                style="color: #74C0FC; font-size: 18px;"></i>
                                        </button></div>
                                    <div class="price">{{ number_format($return->price, 0, ',', ',') }}đ</div>
                                    <button type="button"
                                        onclick="selectFlight(
        {{ $return->id }},
        'return',
        this,
        '{{ $return->flight_code }}',
        '{{ $return->airline->name }}',
        '{{ $return->departure }}',
        '{{ $return->destination }}',
        '{{ $return->departure_time }}',
        {{ $return->price }}
    )"
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

                <form action="{{ route('xacnhan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="outbound_flight_id" id="outbound_flight_id"
                        value="{{ $trip->id }}">
                    <input type="hidden" name="outbound_flight_code" id="outbound_flight_code"
                        value="{{ $trip->flight_code }}">
                    <input type="hidden" name="outbound_airline" id="outbound_airline"
                        value="{{ $trip->airline->name }}">
                    <input type="hidden" name="outbound_departure" id="outbound_departure"
                        value="{{ $trip->departure }}">
                    <input type="hidden" name="outbound_destination" id="outbound_destination"
                        value="{{ $trip->destination }}">
                    <input type="hidden" name="outbound_departure_time" id="outbound_departure_time"
                        value="{{ $trip->departure_time }}">
                    <input type="hidden" name="outbound_price" id="outbound_price" value="{{ $trip->price }}">
                    <input type="hidden" name="return_flight_id" id="return_flight_id"
                        value="{{ $return->id }}">
                    <input type="hidden" name="return_flight_code" id="return_flight_code"
                        value="{{ $return->flight_code }}">
                    <input type="hidden" name="return_airline" id="return_airline"
                        value="{{ $return->airline->name }}">
                    <input type="hidden" name="return_departure" id="return_departure"
                        value="{{ $return->departure }}">
                    <input type="hidden" name="return_destination" id="return_destination"
                        value="{{ $return->destination }}">
                    <input type="hidden" name="return_departure_time" id="return_departure_time"
                        value="{{ $return->departure_time }}">
                    <input type="hidden" name="return_price" id="return_price" value="{{ $return->price }}">
                    <input type="hidden" name="adults" value="{{ $adults }}">
                    <input type="hidden" name="childrens" value="{{ $childrens }}">
                    <input type="hidden" name="infants" value="{{ $infants }}">

                    <button type="submit" class="next-step-btn" id="submitBtn" disabled>
                        TIẾP TỤC VỚI CHUYẾN BAY ĐÃ CHỌN
                    </button>
                </form>
            </div>

            <div class="search-form">
                <h2 class="search-title">Tìm Kiếm Chuyến Bay</h2>

                <div class="search-radios">
                    <div class="search-radio">
                        <button onclick="showForm('oneway')" name="tripType">
                            Một chiều
                        </button>
                    </div>
                    <div class="search-radio">
                        <button onclick="showForm('roundtrip')" name="tripType">
                            Khứ hồi
                        </button>
                    </div>
                </div>

                <div id="oneway-form" class="form-container active">
                    <form action="{{ route('flight-search-oneway') }}" method="GET">
                        <div class="search-group">
                            <label>Điểm đi</label>
                            <input type="text" name="departure" placeholder="Chọn thành phố hoặc sân bay"
                                value="{{ old('departure') }}">
                            </input>
                        </div>

                        <div class="search-group">
                            <label>Điểm đến</label>
                            <input type="text" name="destination" placeholder="Chọn thành phố hoặc sân bay"
                                value="{{ old('destination') }}">
                            </input>
                        </div>

                        <div class="search-group">
                            <label>Ngày đi</label>
                            <input type="date" name="departure_time" min="{{ date('Y-m-d') }}"
                                value="{{ old('departure_time') }}" />
                        </div>

                        <div class="search-group">
                            <label>Hành khách</label>
                            <div class="passenger-row">
                                <span>Người lớn</span>
                                <div class="passenger-count">
                                    <div class="count-btn" onclick="decrementPassenger('adult')">-</div>
                                    <div class="count-value" id="adult-count">2</div>
                                    <div class="count-btn" onclick="incrementPassenger('adult')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Trẻ em (2-12 tuổi)</span>
                                <div class="passenger-count">
                                    <div class="count-btn" onclick="decrementPassenger('child')">-</div>
                                    <div class="count-value" id="child-count">1</div>
                                    <div class="count-btn" onclick="incrementPassenger('child')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Em bé (< 2 tuổi)</span>
                                        <div class="passenger-count">
                                            <div class="count-btn" onclick="decrementPassenger('infant')">-</div>
                                            <div class="count-value" id="infant-count">0</div>
                                            <div class="count-btn" onclick="incrementPassenger('infant')">+</div>
                                        </div>
                            </div>
                        </div>
                        <button class="search-btn">TÌM KIẾM</button>
                    </form>
                </div>

                <div id="roundtrip-form" class="form-container">
                    <form action="{{ route('flight-search-roundtrip') }}" method="GET">
                        <div class="search-group">
                            <label>Điểm đi</label>
                            <input type="text" name="departure" placeholder="Chọn thành phố hoặc sân bay"
                                value="{{ old('departure') }}">
                            </input>
                        </div>

                        <div class="search-group">
                            <label>Điểm đến</label>
                            <input type="text" name="destination" placeholder="Chọn thành phố hoặc sân bay"
                                value="{{ old('destination') }}">
                            </input>
                        </div>

                        <div class="search-group">
                            <label>Ngày đi</label>
                            <input type="date" name="departure_time" min="{{ date('Y-m-d') }}"
                                value="{{ old('departure_time') }}" />
                        </div>

                        <div class="search-group">
                            <label>Ngày về</label>
                            <input type="date" name="return_time" min="{{ date('Y-m-d') }}"
                                value="{{ old('return_time') }}" />
                        </div>

                        <div class="search-group">
                            <label>Hành khách</label>
                            <div class="passenger-row">
                                <span>Người lớn</span>
                                <div class="passenger-count">
                                    <div class="count-btn" onclick="decrementPassenger('adult', 'roundtrip')">-</div>
                                    <div class="count-value" id="adult-count-roundtrip">1</div>
                                    <div class="count-btn" onclick="incrementPassenger('adult', 'roundtrip')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Trẻ em (2-12 tuổi)</span>
                                <div class="passenger-count">
                                    <div class="count-btn" onclick="decrementPassenger('child', 'roundtrip')">-</div>
                                    <div class="count-value" id="child-count-roundtrip">0</div>
                                    <div class="count-btn" onclick="incrementPassenger('child', 'roundtrip')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Em bé (< 2 tuổi)</span>
                                        <div class="passenger-count">
                                            <div class="count-btn"
                                                onclick="decrementPassenger('infant', 'roundtrip')">-</div>
                                            <div class="count-value" id="infant-count-roundtrip">0</div>
                                            <div class="count-btn"
                                                onclick="incrementPassenger('infant', 'roundtrip')">+</div>
                                        </div>
                            </div>
                        </div>
                        <input type="hidden" name="adults" id="adults-input-roundtrip" value="1">
                        <input type="hidden" name="childrens" id="childrens-input-roundtrip" value="0">
                        <input type="hidden" name="infants" id="infants-input-roundtrip" value="0">
                        <button class="search-btn">TÌM KIẾM</button>
                    </form>
                </div>
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
        let selectedOutbound = null;
        let selectedReturn = null;

        function selectFlight(flightId, type, button, flightCode, airline, departure, destination, departureTime, price) {
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
                    document.getElementById('outbound_flight_code').value = '';
                    document.getElementById('outbound_airline').value = '';
                    document.getElementById('outbound_departure').value = '';
                    document.getElementById('outbound_destination').value = '';
                    document.getElementById('outbound_departure_time').value = '';
                    document.getElementById('outbound_price').value = '';
                } else {
                    selectedReturn = null;
                    document.getElementById('return_flight_id').value = '';
                    document.getElementById('return_flight_code').value = '';
                    document.getElementById('return_airline').value = '';
                    document.getElementById('return_departure').value = '';
                    document.getElementById('return_destination').value = '';
                    document.getElementById('return_departure_time').value = '';
                    document.getElementById('return_price').value = '';
                }
            } else {
                button.textContent = 'Đã chọn';
                button.classList.add('selected');
                if (type === 'outbound') {
                    selectedOutbound = flightId;
                    document.getElementById('outbound_flight_id').value = flightId;
                    document.getElementById('outbound_flight_code').value = flightCode;
                    document.getElementById('outbound_airline').value = airline;
                    document.getElementById('outbound_departure').value = departure;
                    document.getElementById('outbound_destination').value = destination;
                    document.getElementById('outbound_departure_time').value = departureTime;
                    document.getElementById('outbound_price').value = price;
                } else {
                    selectedReturn = flightId;
                    document.getElementById('return_flight_id').value = flightId;
                    document.getElementById('return_flight_code').value = flightCode;
                    document.getElementById('return_airline').value = airline;
                    document.getElementById('return_departure').value = departure;
                    document.getElementById('return_destination').value = destination;
                    document.getElementById('return_departure_time').value = departureTime;
                    document.getElementById('return_price').value = price;
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

    <script>
        // Giới hạn số lượng hành khách
        const MAX_ADULTS = 9;
        const MAX_CHILDREN = 9;
        const MAX_INFANTS = 9;
        const MIN_PASSENGERS = 0;
        const MAX_TOTAL_PASSENGERS = 9;

        // Hàm hiển thị thông báo
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;
            document.body.appendChild(notification);
            notification.style.display = 'block';

            setTimeout(() => {
                notification.style.display = 'none';
                notification.remove();
            }, 3000);
        }

        // Hàm kiểm tra tổng số hành khách
        function checkTotalPassengers(formType) {
            const suffix = formType === 'roundtrip' ? '-roundtrip' : '-oneway';
            const adultCount = parseInt(document.getElementById(`adults-input${suffix}`).value);
            const childCount = parseInt(document.getElementById(`childrens-input${suffix}`).value);
            const infantCount = parseInt(document.getElementById(`infants-input${suffix}`).value);
            const total = adultCount + childCount + infantCount;

            if (total > MAX_TOTAL_PASSENGERS) {
                showNotification('Tổng số hành khách không được vượt quá 9 người!');
                return false;
            }
            return true;
        }

        // Hàm tăng số lượng hành khách
        function incrementPassenger(type, formType) {
            const suffix = formType === 'roundtrip' ? '-roundtrip' : '-oneway';
            const countElement = document.getElementById(`${type}-count${suffix}`);
            const inputElement = document.getElementById(`${type}s-input${suffix}`);
            let count = parseInt(countElement.textContent);
            const maxLimit = type === 'adult' ? MAX_ADULTS : (type === 'child' ? MAX_CHILDREN : MAX_INFANTS);

            if (count < maxLimit) {
                if (type === 'infant') {
                    const adultCount = parseInt(document.getElementById(`adults-input${suffix}`).value);
                    if (count < adultCount) {
                        count++;
                    } else {
                        showNotification('Số em bé không được vượt quá số người lớn!');
                        return;
                    }
                } else {
                    count++;
                }

                // Kiểm tra tổng số hành khách trước khi cập nhật
                const newTotal = count +
                    parseInt(document.getElementById(`childrens-input${suffix}`).value) +
                    parseInt(document.getElementById(`infants-input${suffix}`).value);

                if (newTotal > MAX_TOTAL_PASSENGERS) {
                    showNotification('Tổng số hành khách không được vượt quá 9 người!');
                    return;
                }

                countElement.textContent = count;
                inputElement.value = count;
            } else {
                showNotification(
                    `Số lượng ${type === 'adult' ? 'người lớn' : (type === 'child' ? 'trẻ em' : 'em bé')} không được vượt quá ${maxLimit}!`
                );
            }
        }

        // Hàm giảm số lượng hành khách
        function decrementPassenger(type, formType) {
            const suffix = formType === 'roundtrip' ? '-roundtrip' : '-oneway';
            const countElement = document.getElementById(`${type}-count${suffix}`);
            const inputElement = document.getElementById(`${type}s-input${suffix}`);
            let count = parseInt(countElement.textContent);

            if (count > MIN_PASSENGERS) {
                if (type === 'adult') {
                    const infantCount = parseInt(document.getElementById(`infants-input${suffix}`).value);
                    if (count > infantCount) {
                        count--;
                    } else {
                        showNotification('Số người lớn không được ít hơn số em bé!');
                        return;
                    }
                } else {
                    count--;
                }

                countElement.textContent = count;
                inputElement.value = count;
            }
        }
    </script>
</body>

</html>
