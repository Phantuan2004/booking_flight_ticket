<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Đặt vé khứ hồi</title>
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
        }

        .flight-selection-title {
            font-size: 20px;
            color: #003580;
        }

        .flight-selection-subtitle {
            font-size: 16px;
            color: #666;
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
            margin-bottom: 30px;
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

        .flight-card.selected {
            border: 2px solid #003580;
            background-color: #f0f7ff;
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

        .selected .select-btn {
            background-color: #28a745;
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

        .next-step-container {
            text-align: center;
            margin: 30px 0;
        }

        .next-step-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
        }

        .next-step-btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
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
        <div class="trip-summary">
            <div class="trip-info">
                <div class="trip-route">{{ $departure }} - {{ $destination }}</div>
                <div class="trip-dates">
                    <div class="date-box">
                        <div class="date-label">Ngày đi</div>
                        <div class="date-value">{{ $departure_time }}</div>
                    </div>
                    <div class="date-box">
                        <div class="date-label">Ngày về</div>
                        <div class="date-value">{{ $return_time }}</div>
                    </div>
                </div>
            </div>
            <div class="passenger-info">
                @if ($adults > 0 && $children > 0 && $infants > 0)
                    {{ $adults }} người lớn, {{ $children }} trẻ em, {{ $infants }} em bé
                @elseif ($adults > 0 && $children > 0 && $infants == 0)
                    {{ $adults }} người lớn, {{ $children }} trẻ em
                @elseif ($adults > 0 && $infants > 0 && $children == 0)
                    {{ $adults }} người lớn, {{ $infants }} em bé
                @elseif ($adults > 0 && $children == 0 && $infants == 0)
                    {{ $adults }} người lớn
                @else
                    Không có hành khách nào.
                @endif
            </div>
        </div>

        <div class="booking-content">
            <div class="flight-selection">
                <div class="filter-panel">
                    <h2 class="filter-title">Lọc Kết Quả</h2>
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
                        <div class="filter-group">
                            <label>Giá</label>
                            <select>
                                <option>Tất cả giá</option>
                                <option>Dưới 1.000.000</option>
                                <option>1.000.000 - 2.000.000</option>
                                <option>Trên 2.000.000</option>
                            </select>
                        </div>
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
                    <button class="filter-btn">Áp Dụng</button>
                </div>

                <form action="" method="post">
                    <div class="flight-selection-header">
                        <div>
                            <div class="flight-selection-title">Chuyến Đi</div>
                            <div class="flight-selection-subtitle">
                                {{ $departure }} → {{ $destination }}, {{ $departure_time }}
                            </div>
                        </div>
                    </div>

                    <!-- Chuyến Đi -->
                    <div class="flight-list">
                        @foreach ($outboundFlights as $trip)
                            <div class="flight-card">
                                <div class="airline-logo">{{ $trip->airline->logo }}</div>
                                <div class="flight-info">
                                    <div class="flight-time">
                                        <div class="time">{{ $trip->flight_start }}</div>
                                        <div class="duration">2h 10m</div>
                                        <div class="time">{{ $trip->flight_end }}</div>
                                    </div>
                                    <div class="flight-route">
                                        {{ $trip->departure }} - {{ $trip->destination }}
                                    </div>
                                    <div class="airline-name">{{ $trip->airline->name }}</div>
                                </div>
                                <div class="flight-details">
                                    <div class="price">{{ number_format($trip->price) }} VNĐ</div>
                                    <button class="select-btn">Chọn</button>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Chuyến Về -->
                    <div class="flight-selection-header">
                        <div>
                            <div class="flight-selection-title">Chuyến Về</div>
                            <div class="flight-selection-subtitle">
                                {{ $destination }} → {{ $departure }}, {{ $return_time }}
                            </div>
                        </div>
                    </div>

                    <div class="flight-list">
                        @foreach ($returnFlights as $return)
                            <div class="flight-card">
                                <div class="airline-logo">{{ $return->airline->logo }}</div>
                                <div class="flight-info">
                                    <div class="flight-time">
                                        <div class="time">{{ $return->flight_start }}</div>
                                        <div class="duration">2h 15m</div>
                                        <div class="time">{{ $return->flight_end }}</div>
                                    </div>
                                    <div class="flight-route">
                                        {{ $return->departure }} - {{ $return->destination }}
                                    </div>
                                    <div class="airline-name">{{ $return->airline->name }}</div>
                                </div>
                                <div class="flight-details">
                                    <div class="price">{{ number_format($return->price) }} VNĐ</div>
                                    <button class="select-btn">Chọn</button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </form>
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

        <div class="next-step-container">
            <button class="next-step-btn">TIẾP TỤC VỚI CHUYẾN BAY ĐÃ CHỌN</button>
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
        // Simple script to show interaction (not required for the design)
        document.addEventListener('DOMContentLoaded', function() {
            // Get all select buttons
            const selectButtons = document.querySelectorAll('.select-btn');

            // Add click event to each button
            selectButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Find the parent flight card
                    const flightCard = this.closest('.flight-card');

                    // Toggle selected class
                    if (flightCard.classList.contains('selected')) {
                        flightCard.classList.remove('selected');
                        this.textContent = 'Chọn';
                    } else {
                        // If in same flight list, deselect others
                        const flightList = flightCard.closest('.flight-list');
                        const otherSelectedCards = flightList.querySelectorAll(
                            '.flight-card.selected');
                        otherSelectedCards.forEach(card => {
                            card.classList.remove('selected');
                            card.querySelector('.select-btn').textContent = 'Chọn';
                        });

                        // Select this one
                        flightCard.classList.add('selected');
                        this.textContent = 'Đã Chọn';
                    }
                });
            });
        });
    </script>
</body>

</html>
