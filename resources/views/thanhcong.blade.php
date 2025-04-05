<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Hoàn Tất Đặt Vé</title>
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

        .step.active .step-number {
            background-color: #003580;
        }

        .step.active .step-text {
            color: #003580;
            font-weight: bold;
        }

        .step.completed .step-number {
            background-color: #4caf50;
        }

        .step-divider {
            width: 50px;
            height: 1px;
            background-color: #ddd;
            margin: 0 15px;
        }

        .confirmation-container {
            margin: 50px auto;
            max-width: 800px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .success-icon {
            text-align: center;
            margin-bottom: 20px;
        }

        .success-icon svg {
            width: 80px;
            height: 80px;
            fill: #4caf50;
        }

        .confirmation-title {
            text-align: center;
            font-size: 24px;
            color: #003580;
            margin-bottom: 20px;
        }

        .confirmation-message {
            text-align: center;
            color: #666;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .booking-details {
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .booking-id {
            font-size: 18px;
            color: #003580;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .flight-info-container {
            display: flex;
            gap: 15px;
            padding: 15px 0;
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
            margin-top: 10px;
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

        .passenger-summary {
            margin: 15px 0;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .passenger-count {
            font-size: 14px;
            color: #003580;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .passenger-info {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .payment-summary {
            margin-top: 15px;
        }

        .payment-title {
            font-size: 16px;
            color: #003580;
            margin-bottom: 10px;
        }

        .payment-details {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        .total-amount {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            font-size: 16px;
        }

        .contact-info {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        .next-steps {
            background-color: #f0f8ff;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
        }

        .next-steps-title {
            font-size: 18px;
            color: #003580;
            margin-bottom: 15px;
        }

        .next-steps-list {
            list-style-type: none;
        }

        .next-steps-list li {
            position: relative;
            padding-left: 25px;
            margin-bottom: 10px;
            color: #555;
            line-height: 1.6;
        }

        .next-steps-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #4caf50;
            font-weight: bold;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .primary-btn,
        .secondary-btn {
            padding: 12px 20px;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
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

        .email-note {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
            font-style: italic;
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
            .confirmation-container {
                padding: 20px;
                margin: 20px;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            nav ul {
                margin-top: 15px;
            }

            .step-text {
                display: none;
            }

            .step-divider {
                width: 20px;
            }

            .button-group {
                flex-direction: column;
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
                        <li><a href="{{ route('datve') }}">Đặt Vé</a></li>
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
            <h1>Hoàn Tất Đặt Vé</h1>
        </div>
    </div>

    <div class="steps-container">
        <div class="booking-steps">
            <div class="step completed">
                <div class="step-number">1</div>
                <div class="step-text">Tìm Chuyến Bay</div>
            </div>
            <div class="step-divider"></div>
            <div class="step completed">
                <div class="step-number">2</div>
                <div class="step-text">Chọn Chuyến Bay</div>
            </div>
            <div class="step-divider"></div>
            <div class="step completed">
                <div class="step-number">3</div>
                <div class="step-text">Thông Tin Hành Khách</div>
            </div>
            <div class="step-divider"></div>
            <div class="step completed">
                <div class="step-number">4</div>
                <div class="step-text">Thanh Toán</div>
            </div>
            <div class="step-divider"></div>
            <div class="step active">
                <div class="step-number">5</div>
                <div class="step-text">Hoàn Tất</div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="confirmation-container">
            <div class="success-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path
                        d="M256 48C141.1 48 48 141.1 48 256s93.1 208 208 208 208-93.1 208-208S370.9 48 256 48zm-32.1 281.7c-2.4 2.4-5.8 3.8-9.4 3.8-3.5 0-6.9-1.4-9.4-3.8l-56-56c-5.2-5.2-5.2-13.6 0-18.8 5.2-5.2 13.6-5.2 18.8 0l46.6 46.6 97.8-97.8c5.2-5.2 13.6-5.2 18.8 0 5.2 5.2 5.2 13.6 0 18.8l-107.2 107.2z" />
                </svg>
            </div>
            <h1 class="confirmation-title">Đặt Vé Thành Công!</h1>
            <p class="confirmation-message">
                Cảm ơn bạn đã đặt vé với SkyJet. Thông tin đặt vé đã được gửi đến
                email của bạn.<br />
                Vui lòng kiểm tra email và lưu giữ thông tin này để sử dụng khi làm
                thủ tục bay.
            </p>

            <div class="booking-details">
                <div class="booking-id">
                    <strong>Mã đặt chỗ:</strong> {{ $booking_code }}
                </div>

                <div class="flight-info-container">
                    <div class="flight-date">
                        <div class="date-number">{{ $day }}</div>
                        <div class="date-month">Tháng {{ $month }}</div>
                    </div>
                    <div class="flight-details">
                        <div class="flight-route">
                            <div class="airport-code">{{ $flight->departure }}</div>
                            <div class="flight-arrow">→</div>
                            <div class="airport-code">{{ $flight->destination }}</div>
                        </div>
                        <div class="flight-times">
                            <div class="departure-time">{{ $hour }}:{{ $minute }}</div>
                            <div class="flight-duration">2h 10m</div>
                            <div class="arrival-time">{{ $hourArrival }}:{{ $minuteArrival }}</div>
                        </div>
                        <div class="airport-names">
                            {{ $flight->departure }} → {{ $flight->destination }}
                        </div>
                        <div class="airline-info">
                            <div class="airline-logo">{{ $flight->airline->logo }}</div>
                            <div class="airline-name">{{ $flight->airline->name }}</div>
                            <div class="flight-number">{{ $flight->flight_code }}</div>
                        </div>
                    </div>
                </div>

                <div class="passenger-summary">
                    <div class="passenger-count">Hành khách ({{ $total_passengers }})</div>
                    @if (is_array($passengers) || is_object($passengers))
                        @foreach ($passengers as $index => $passenger)
                            <div class="passenger-info">
                                {{ $index }}. {{ $passenger['last_name'] ?? 'Lỗi dữ liệu' }}
                                {{ $passenger['first_name'] ?? 'Lỗi dữ liệu' }}
                            </div>
                        @endforeach
                    @else
                        <div>Không có dữ liệu hành khách.</div>
                    @endif

                    @if (is_array($childrens) || is_object($childrens))
                        @foreach ($childrens as $index => $child)
                            <div class="passenger-info">
                                {{ count($passengers) + $index }}. {{ $child['last_name'] ?? 'Lỗi dữ liệu' }}
                                {{ $child['first_name'] ?? 'Lỗi dữ liệu' }}
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="contact-info">
                    <div><strong>Thông tin liên hệ:</strong></div>
                    <div>{{ $full_name }}</div>
                    <div>Điện thoại: {{ $phone }}</div>
                    <div>Email: {{ $email }}</div>
                    <div>Địa chỉ: {{ $address }}</div>
                </div>

                <div class="payment-summary">
                    <div class="payment-title">Chi tiết thanh toán:</div>
                    <div class="payment-details">
                        <div class="price-title">Người lớn (x{{ is_array($passengers) ? count($passengers) : 0 }})
                        </div>
                        <div class="price-value">
                            {{ $flight->price * (is_array($passengers) ? count($passengers) : 0) }}0 VNĐ</div>
                    </div>
                    <div class="payment-details">
                        <div class="price-title">Trẻ em (x{{ is_array($childrens) ? count($childrens) : 0 }})</div>
                        <div class="price-value">{{ $flight->price * (is_array($childrens) ? count($childrens) : 0) }}0
                            VNĐ</div>
                    </div>
                    <div class="payment-details">
                        <div>Thuế & Phí</div>
                        <div>50.000 VNĐ</div>
                    </div>
                    <div class="payment-details">
                        <div>Phí dịch vụ</div>
                        <div>20.000 VNĐ</div>
                    </div>
                    <div class="total-amount">
                        <div>Tổng cộng</div>
                        <div>
                            {{ $flight->price * (is_array($passengers) ? count($passengers) : 0) + $flight->price * (is_array($childrens) ? count($childrens) : 0) + 50.0 + 20.0 }}0
                            VNĐ</div>
                    </div>
                </div>
            </div>

            <div class="next-steps">
                <h3 class="next-steps-title">Các bước tiếp theo</h3>
                <ul class="next-steps-list">
                    <li>Kiểm tra email của bạn để xem thông tin vé đầy đủ</li>
                    <li>
                        Hãy đến sân bay trước giờ khởi hành ít nhất 2 giờ đối với chuyến
                        bay nội địa
                    </li>
                    <li>
                        Mang theo giấy tờ tùy thân hợp lệ (CMND/CCCD/Hộ chiếu) để làm thủ
                        tục check-in
                    </li>
                    <li>
                        Bạn có thể check-in trực tuyến trước 24 giờ so với giờ khởi hành
                    </li>
                </ul>
            </div>

            <div class="button-group">
                <a href="{{ route('index') }}" class="secondary-btn">Về Trang Chủ</a>
            </div>

            <p class="email-note">
                Nếu bạn không nhận được email, vui lòng kiểm tra thư mục spam hoặc
                liên hệ với bộ phận hỗ trợ của chúng tôi.
            </p>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="copyright">
                <p>&copy; 2025 SkyJet. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>
</body>

</html>
