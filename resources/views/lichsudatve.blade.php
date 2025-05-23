<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Lịch Sử Đặt Vé</title>
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

        .page-title {
            background-color: #003580;
            color: white;
            padding: 20px 0;
        }

        .page-title h1 {
            font-size: 24px;
        }

        .main-content {
            margin: 30px auto;
        }

        .history-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            color: #003580;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .filter-group {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .filter-label {
            font-size: 14px;
            color: #666;
            margin-right: 10px;
        }

        .filter-select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            min-width: 150px;
        }

        .search-input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            min-width: 220px;
        }

        .filter-button {
            padding: 8px 15px;
            background-color: #003580;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            margin-left: 10px;
        }

        .history-item {
            margin-bottom: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            overflow: hidden;
        }

        .history-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: #f0f8ff;
            border-bottom: 1px solid #eee;
        }

        .booking-id {
            font-weight: bold;
            color: #003580;
        }

        .booking-date {
            font-size: 14px;
            color: #666;
        }

        .booking-status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-completed {
            background-color: #e6f7e6;
            color: #2e7d32;
        }

        .status-upcoming {
            background-color: #e3f2fd;
            color: #0d47a1;
        }

        .status-cancelled {
            background-color: #ffebee;
            color: #c62828;
        }

        .history-content {
            padding: 15px;
        }

        .flight-info-container {
            display: flex;
            gap: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .flight-date {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-right: 15px;
            border-right: 1px solid #eee;
            min-width: 80px;
        }

        .date-number {
            font-size: 24px;
            font-weight: bold;
            color: #003580;
        }

        .date-month {
            font-size: 14px;
            color: #666;
        }

        .flight-details {
            flex: 1;
        }

        .flight-route {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .airport-code {
            font-size: 18px;
            font-weight: bold;
        }

        .flight-arrow {
            margin: 0 10px;
            color: #666;
        }

        .flight-times {
            display: flex;
            align-items: center;
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .flight-duration {
            margin: 0 10px;
            padding: 0 10px;
            border-left: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }

        .airport-names {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }

        .airline-info {
            display: flex;
            align-items: center;
        }

        .airline-logo {
            width: 40px;
            height: 40px;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            margin-right: 10px;
        }

        .airline-name {
            font-size: 14px;
            color: #003580;
        }

        .flight-number {
            font-size: 14px;
            color: #666;
            margin-left: 10px;
        }

        .history-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-top: 1px solid #eee;
            background-color: #fafafa;
        }

        .price-info {
            font-weight: bold;
            color: #003580;
        }

        .price-detail {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            padding: 8px 15px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }

        .primary-btn {
            background-color: #003580;
            color: white;
            border: none;
        }

        .secondary-btn {
            background-color: white;
            color: #003580;
            border: 1px solid #003580;
        }

        .danger-btn {
            background-color: white;
            color: #e53935;
            border: 1px solid #e53935;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .pagination-item {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 5px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
        }

        .pagination-item.active {
            background-color: #003580;
            color: white;
        }

        .pagination-item:not(.active) {
            border: 1px solid #ddd;
            color: #666;
        }

        .pagination-nav {
            color: #003580;
            background-color: white;
            border: 1px solid #ddd;
        }

        .no-bookings {
            padding: 40px 0;
            text-align: center;
            color: #666;
        }

        .no-bookings-icon {
            font-size: 48px;
            color: #ccc;
            margin-bottom: 15px;
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
            .history-container {
                padding: 20px;
                margin: 20px;
            }

            .filter-bar {
                flex-direction: column;
            }

            .filter-group {
                width: 100%;
                margin-bottom: 10px;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            nav ul {
                margin-top: 15px;
            }

            .history-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .booking-status {
                margin-top: 10px;
            }

            .history-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .action-buttons {
                margin-top: 15px;
                width: 100%;
            }

            .action-btn {
                flex: 1;
            }
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
            width: 500px;
            height: auto;
            margin: 96px auto;
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
    </style>
</head>

<body>
    {{-- Scroll to top --}}
    @include('components.scroll-to-top')

    {{-- Header --}}
    @include('components.header')

    <div class="page-title">
        <div class="container">
            <h1>Lịch Sử Đặt Vé</h1>
        </div>
    </div>

    {{-- Form nhập thông tin vé bay --}}
    <form id="search-history" action="{{ route('lichsudatve') }}" method="GET">
        <div class="search-form">
            <h2 class="search-title">Tìm Kiếm lịch sử đặt vé của bạn</h2>
            <div class="search-group">
                <label>Họ tên liên hệ</label>
                <input name="name" id="name" type="text"
                    placeholder="Nhập họ tên liên hệ trong hóa đơn từ email của bạn..."
                    value="{{ $name ?? old('name') }}" />
            </div>
            <div class="search-group">
                <label>Số điện thoại</label>
                <input name="phone" id="phone" type="text"
                    placeholder="Nhập số điện thoại trong hóa đơn từ email của bạn ..."
                    value="{{ $phone ?? old('phone') }}" />
            </div>
            <div class="search-group">
                <label>Email</label>
                <input id="email" name="email" type="text"
                    placeholder="Nhập email trong hóa đơn từ email của bạn ..." value="{{ $email ?? old('email') }}" />
            </div>
            <button type="submit" class="search-btn">TÌM KIẾM</button>
        </div>
    </form>

    <section id="result">
        @if ($histories->isEmpty() && !isset($booking_code))
            <div class="no-bookings">
                <div class="no-bookings-icon">📅</div>
                <p style="margin: auto; font-size: 1.1rem;">Không có lịch sử đặt vé nào.</p>
            </div>
        @else
            <div class="container main-content">
                <div class="history-container">
                    <h2 class="section-title">Các Chuyến Bay Của Bạn</h2>
                    <div class="filter-bar">
                        <div class="filter-group">
                            <span class="filter-label">Trạng thái:</span>
                            <select class="filter-select">
                                <option value="all">Tất cả</option>
                                <option value="upcoming">Sắp tới</option>
                                <option value="completed">Đã hoàn thành</option>
                                <option value="cancelled">Đã hủy</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <span class="filter-label">Thời gian:</span>
                            <select class="filter-select">
                                <option value="all">Tất cả thời gian</option>
                                <option value="month3">3 tháng qua</option>
                                <option value="month6">6 tháng qua</option>
                                <option value="year1">1 năm qua</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <form action="{{ route('lichsudatve') }}" method="GET">
                                <input type="hidden" name="name" id="name"
                                    value="{{ $name ?? old('name') }}" />
                                <input type="hidden" name="phone" id="phone"
                                    value="{{ $phone ?? old('phone') }}" />
                                <input type="hidden" name="email" id="email"
                                    value="{{ $email ?? old('email') }}" />
                                <input type="text" name="booking_code" id="booking_code" class="search-input"
                                    placeholder="Tìm kiếm theo mã đặt chỗ (mã vé)....."
                                    value="{{ $booking_code ? $booking_code : '' }}" />
                                <button class="filter-button" type="submit">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>
                    <div class="history-list">
                        @if ($histories->isEmpty() && isset($booking_code))
                            <div class="no-bookings">
                                <div class="no-bookings-icon">📅</div>
                                <p style="margin: auto; font-size: 1.1rem;">Không tìm thấy lịch sử đặt vé với mã
                                    "{{ $booking_code }}".</p>
                            </div>
                        @else
                            @foreach ($histories as $history)
                                <div class="history-item">
                                    <div class="history-header">
                                        <div class="booking-id">Mã đặt chỗ: {{ $history->booking_code }}</div>
                                        <div class="booking-date">Ngày đặt: {{ $history->created_at }}</div>
                                        @if ($history->status == 'hoàn thành')
                                            <div class="booking-status status-completed">Đã hoàn thành</div>
                                        @elseif ($history->status == 'xử lý')
                                            <div class="booking-status status-upcoming">Đang xử lý</div>
                                        @elseif ($history->status == 'hủy')
                                            <div class="booking-status status-cancelled">Đã hủy</div>
                                        @endif
                                    </div>
                                    <div class="history-content">
                                        <div class="flight-info-container">
                                            <div class="flight-date">
                                                <div class="date-number">
                                                    {{ $history->departureTime ? number_format($history->departureTime->format('d')) : 'N/A' }}
                                                </div>
                                                <div class="date-month">
                                                    Tháng
                                                    {{ $history->departureTime ? number_format($history->departureTime->format('m')) : 'N/A' }}
                                                </div>
                                            </div>
                                            <div class="flight-details">
                                                <div class="flight-route">
                                                    <div class="airport-code">
                                                        {{ $history->flight->departure ?? 'N/A' }}</div>
                                                    <div class="flight-arrow">→</div>
                                                    <div class="airport-code">
                                                        {{ $history->flight->destination ?? 'N/A' }}</div>
                                                </div>
                                                <div class="flight-times">
                                                    <div class="departure-time">
                                                        {{ $history->flightStartTime ?? 'N/A' }}</div>
                                                    <div class="flight-duration">{{ $history->duration ?? 'N/A' }}
                                                    </div>
                                                    <div class="arrival-time">{{ $history->flightEndTime ?? 'N/A' }}
                                                    </div>
                                                </div>
                                                <div class="airport-names">
                                                    {{ $history->flight->departure ?? 'N/A' }}
                                                    ({{ $history->flight->departure_airport ?? 'N/A' }})
                                                    →
                                                    {{ $history->flight->destination ?? 'N/A' }}
                                                    ({{ $history->flight->destination_airport ?? 'N/A' }})
                                                </div>
                                                <div class="airline-info">
                                                    <div class="airline-logo">
                                                        {{ $history->flight->airline->logo ?? 'N/A' }}</div>
                                                    <div class="airline-name">
                                                        {{ $history->flight->airline->name ?? 'N/A' }}</div>
                                                    <div class="flight-number">
                                                        {{ $history->flight->flight_code ?? 'N/A' }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="history-footer">
                                        <div class="price-info">
                                            <div>{{ number_format($history->total_price ?? 0, 0, ',', '.') }} VNĐ</div>
                                            <div class="price-detail">
                                                {{ $history->passenger_count ?? 0 }} hành khách
                                                ({{ $history->adult_count ?? 0 }} người lớn,
                                                {{ $history->child_count ?? 0 }} trẻ em,
                                                {{ $history->infant_count ?? 0 }} trẻ sơ sinh)
                                            </div>
                                        </div>
                                        <div class="action-buttons">
                                            <a href="#" class="action-btn primary-btn">Xem Chi Tiết</a>
                                            <form action="{{ route('huyve', $history->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Bạn xác nhận muốn hủy vé 🤨')"
                                                    class="action-btn danger-btn" type="submit">Hủy Vé</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
        @endif
    </section>

    <footer>
        <div class="container">
            <div class="copyright">
                <p>&copy; 2025 SkyJet. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script>
        // Javascript hiển thị lịch sử đặt vé sau khi nhấn tìm kiếm từ form
        const searchForm = document.querySelector('#search-history');
        const resultSection = document.getElementById('result');

        searchForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của form
            // Lấy giá trị từ form
            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;

            // Validate dữ liệu nhập vào
            if (name.trim() === '' || phone.trim() === '' || email.trim() === '') {
                alert('Vui lòng nhập đầy đủ thông tin!!');
                return;
            }

            // Thực hiện gửi form
            searchForm.submit();

            // Hiển thị phần kết quả 
            resultSection.style.display = 'block';

            // Cuộn trang tới phần kết quả sau khi gửi form
            window.scrollTo({
                top: resultSection.offsetTop,
                behavior: 'smooth'
            });
        })
    </script>
</body>

</html>
