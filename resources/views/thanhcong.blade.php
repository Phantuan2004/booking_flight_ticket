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

        .confirmation-box {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .confirmation-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #003580;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .flight-info {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .flight-info-container {
            display: flex;
            gap: 15px;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
            flex: 1;
            min-width: 300px;
            background: #f8f9fa;
        }

        .flight-date {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 15px;
            background: #2c3e50;
            color: white;
            border-radius: 8px;
            min-width: 100px;
        }

        .date-day {
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: bold;
            color: white;
            margin-top: 10px;
        }

        .date-number {
            font-size: 24px;
            font-weight: bold;
            line-height: 1;
            margin-top: 20px;
        }

        .date-month {
            font-size: 14px;
            margin-top: 5px;
        }

        .flight-details {
            flex: 1;
        }

        .flight-route {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .airport-code {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .flight-arrow {
            color: #3498db;
            font-size: 1.2rem;
        }

        .flight-times {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #666;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .flight-duration {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
            font-size: 0.9rem;
        }

        .airline-logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .airline-logo img {
            width: 45px;
            height: 45px;
            object-fit: contain;
        }

        .airline-info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 10px;
        }

        .airline-name {
            font-weight: 500;
            color: #2c3e50;
        }

        .flight-number {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #666;
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
    {{-- Scroll to top --}}
    @include('components.scroll-to-top')

    {{-- Header --}}
    @include('components.header')

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

                @if (isset($flight))
                    <div class="flight-info-container">
                        <div class="flight-date">
                            <div class="date-number">{{ $departureDay }}</div>
                            <div class="date-month">Tháng {{ $departureMonth }}</div>
                            <div class="date-day">{{ $departureDayOfWeek }}</div>
                        </div>
                        <div class="flight-details">
                            <div class="flight-route">
                                <div class="airport-code">{{ $flight->departure }}</div>
                                <div class="flight-arrow">→</div>
                                <div class="airport-code">{{ $flight->destination }}</div>
                            </div>
                            <div class="flight-times">
                                <div class="departure-time">{{ $flightStartTime }}</div>
                                <div class="flight-arrow">-</div>
                                <div class="arrival-time">{{ $flightEndTime }}</div>
                            </div>
                            <div class="flight-number">Chuyến bay: <p style="font-weight: bold; margin-left: 5px;">
                                    {{ $flight->flight_code }}</p>
                            </div>
                            <div class="airline-info">
                                <div class="airline-logo">
                                    <img src="{{ asset('storage/airline_logos/' . $flight->airline->logo) }}"
                                        alt="Airline Logo" />
                                    <div class="airline-name">{{ $flight->airline->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="confirmation-box">
                        <h2 class="confirmation-title">Chi Tiết Chuyến Bay</h2>
                        <div class="flight-info">
                            <div class="flight-info-container">
                                <div class="flight-date">
                                    <div class="date-number">{{ $outboundDepartureDay }}</div>
                                    <div class="date-month">Tháng {{ $outboundDepartureMonth }}</div>
                                    <div class="date-day">{{ $outboundDayOfWeek }}</div>
                                </div>
                                <div class="flight-details">
                                    <div class="flight-route">
                                        <div class="airport-code">{{ $outboundFlight->departure }}</div>
                                        <div class="flight-arrow">→</div>
                                        <div class="airport-code">{{ $outboundFlight->destination }}</div>
                                    </div>
                                    <div class="airport-names">
                                        Chuyến bay: {{ $outboundFlight->flight_code }}
                                    </div>
                                    <div class="flight-times">
                                        <div class="departure-time">{{ $outboundFlightStartTime }}</div>
                                        <div class="flight-duration">-</div>
                                        <div class="arrival-time">{{ $outboundFlightEndTime }}</div>
                                    </div>
                                    <div class="airline-info">
                                        <div class="airline-logo">
                                            <img src="{{ asset('storage/airline_logos/' . $outboundFlight->airline->logo) }}"
                                                alt="Airline Logo" />
                                        </div>
                                        <div class="flight-number">{{ $outboundFlight->airline->name }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="flight-info-container">
                                <div class="flight-date">
                                    <div class="date-number">{{ $returnDepartureDay }}</div>
                                    <div class="date-month">Tháng {{ $returnDepartureMonth }}</div>
                                    <div class="date-day">{{ $returnDayOfWeek }}</div>
                                </div>
                                <div class="flight-details">
                                    <div class="flight-route">
                                        <div class="airport-code">{{ $returnFlight->departure }}</div>
                                        <div class="flight-arrow">→</div>
                                        <div class="airport-code">{{ $returnFlight->destination }}</div>
                                    </div>
                                    <div class="airport-names">
                                        Chuyến bay: {{ $returnFlight->flight_code }}
                                    </div>
                                    <div class="flight-times">
                                        <div class="departure-time">{{ $returnFlightStartTime }}</div>
                                        <div class="flight-duration">-</div>
                                        <div class="arrival-time">{{ $returnFlightEndTime }}</div>
                                    </div>
                                    <div class="airline-info">
                                        <div class="airline-logo">
                                            <img src="{{ asset('storage/airline_logos/' . $returnFlight->airline->logo) }}"
                                                alt="Airline Logo" />
                                        </div>
                                        <div class="flight-number">{{ $returnFlight->airline->name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="passenger-summary">
                    <div class="passenger-count">
                        Hành khách (
                        {{ $adultsCount }} người lớn,
                        {{ $childrensCount }} trẻ em,
                        {{ $infantsCount }} em bé
                        )
                    </div>


                    @if (!empty($adultsSession))
                        @foreach ($adultsSession as $index => $adult)
                            <div class="passenger-info">
                                {{ $index }}. {{ $adult['last_name'] ?? 'Lỗi dữ liệu' }}
                                {{ $adult['first_name'] ?? 'Lỗi dữ liệu' }}
                            </div>
                        @endforeach

                    @endif

                    @if (!empty($childrensSession))
                        @foreach ($childrensSession as $index => $child)
                            <div class="passenger-info">
                                {{ count($adultsSession) + $index }}.
                                {{ $child['last_name'] ?? 'Lỗi dữ liệu' }}
                                {{ $child['first_name'] ?? 'Lỗi dữ liệu' }}
                            </div>
                        @endforeach
                    @endif

                    @if (!empty($infantsSession))
                        @foreach ($infantsSession as $index => $infant)
                            <div class="passenger-info">
                                {{ count($adultsSession) + count($childrensSession) + $index }}.
                                {{ $infant['last_name'] ?? 'Lỗi dữ liệu' }}
                                {{ $infant['first_name'] ?? 'Lỗi dữ liệu' }}
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
                        <div class="price-title">Người lớn (x{{ is_array($adults) ? count($adults) : 0 }})
                        </div>
                        <div class="price-value">
                            {{ number_format($adult_price, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="payment-details">
                        <div class="price-title">Trẻ em (x{{ is_array($childrens) ? count($childrens) : 0 }})</div>
                        <div class="price-value">{{ number_format($child_price, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="payment-details">
                        <div class="price-title">Em bé (x{{ is_array($infants) ? count($infants) : 0 }})</div>
                        <div class="price-value">{{ number_format($infant_price, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="payment-details">
                        <div>Thuế & Phí</div>
                        <div>{{ number_format(50000, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="payment-details">
                        <div>Phí dịch vụ</div>
                        <div>{{ number_format(20000, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="total-amount">
                        <div>Tổng cộng</div>
                        <div>
                            {{ number_format($total_price, 0, ',', '.') }} VNĐ</div>
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
