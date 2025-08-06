<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Lịch Sử Đặt Vé</title>
    <link rel="stylesheet" href="{{ asset('css/history.css') }}" />
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

    <script src="{{ asset('js/history.js') }}"></script>
</body>

</html>
