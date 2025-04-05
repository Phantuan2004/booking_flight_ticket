<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Thanh Toán Đặt Vé</title>
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

        .payment-content {
            display: flex;
            gap: 20px;
            margin: 30px 0;
        }

        .payment-details {
            flex: 2;
        }

        .payment-box,
        .review-box {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .payment-title,
        .review-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #003580;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .payment-method-selection {
            margin-bottom: 20px;
        }

        .method-tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .method-tab {
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            color: #666;
            border-bottom: 3px solid transparent;
        }

        .method-tab.active {
            color: #003580;
            border-bottom-color: #003580;
            font-weight: bold;
        }

        .card-form {
            padding: 10px 0;
        }

        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #003580;
            outline: none;
        }

        .card-icons {
            display: flex;
            gap: 10px;
            margin-bottom: 15px;
        }

        .card-icon {
            width: 50px;
            height: 35px;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            border: 1px solid #ddd;
            font-size: 12px;
        }

        .card-icon.active {
            border-color: #003580;
            background-color: #f0f8ff;
        }

        .security-info {
            display: flex;
            align-items: center;
            margin-top: 15px;
            padding: 15px;
            background-color: #f9f9f9;
            border-radius: 4px;
            font-size: 14px;
            color: #666;
        }

        .security-icon {
            margin-right: 10px;
            color: #4caf50;
            font-weight: bold;
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

        .contact-info {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }

        .price-summary {
            flex: 1;
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            align-self: flex-start;
            position: sticky;
            top: 20px;
        }

        .summary-title {
            font-size: 18px;
            margin-bottom: 15px;
            color: #003580;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .price-title {
            color: #666;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }

        .payment-notice {
            margin-top: 20px;
            font-size: 14px;
            color: #666;
            padding: 10px;
            background-color: #fff8e1;
            border-radius: 4px;
            border-left: 4px solid #ffc107;
        }

        .confirm-btn {
            background-color: #f0ad4e;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            margin-top: 20px;
            font-size: 16px;
        }

        .back-btn {
            background-color: transparent;
            color: #003580;
            border: 1px solid #003580;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            margin-top: 15px;
            font-size: 16px;
        }

        .required-field::after {
            content: " *";
            color: #f44336;
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
            .payment-content {
                flex-direction: column;
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

            .form-row {
                flex-direction: column;
                gap: 10px;
            }
        }

        /* Countdown Timer */
        .timer-container {
            background-color: #fff8e1;
            border-radius: 4px;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            border: 1px solid #ffe0b2;
        }

        .timer-text {
            font-size: 14px;
            color: #ff6d00;
            margin-bottom: 5px;
        }

        .timer {
            font-size: 24px;
            font-weight: bold;
            color: #ff6d00;
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
            <h1>Thanh Toán Đặt Vé</h1>
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
            <div class="step active">
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
        <div class="timer-container">
            <div class="timer-text">Thời gian hoàn tất thanh toán</div>
            <div class="timer">14:59</div>
        </div>

        <div class="payment-content">
            <div class="payment-details">
                <div class="payment-box">
                    <h2 class="payment-title">Thông Tin Thanh Toán</h2>
                    <div class="payment-method-selection">
                        <div class="method-tabs">
                            <div class="method-tab active">Thẻ tín dụng/ghi nợ</div>
                            <div class="method-tab">Internet Banking</div>
                            <div class="method-tab">Ví điện tử</div>
                        </div>

                        <div class="card-form">
                            <div class="card-icons">
                                <div class="card-icon active">VISA</div>
                                <div class="card-icon">MC</div>
                                <div class="card-icon">JCB</div>
                                <div class="card-icon">AMEX</div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Số thẻ</label>
                                    <input type="text" placeholder="XXXX XXXX XXXX XXXX" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Tên chủ thẻ</label>
                                    <input type="text" placeholder="Tên in trên thẻ" />
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Ngày hết hạn</label>
                                    <div class="form-row" style="margin-bottom: 0">
                                        <select>
                                            <option value="">Tháng</option>
                                            <option value="01">01</option>
                                            <option value="02">02</option>
                                            <option value="03">03</option>
                                            <option value="04">04</option>
                                            <option value="05">05</option>
                                            <option value="06">06</option>
                                            <option value="07">07</option>
                                            <option value="08">08</option>
                                            <option value="09">09</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                        <select>
                                            <option value="">Năm</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="required-field">Mã CVV/CVC</label>
                                    <input type="text" placeholder="XXX" />
                                </div>
                            </div>

                            <div class="security-info">
                                <div class="security-icon">🔒</div>
                                <div>
                                    Thông tin thanh toán được bảo mật bằng công nghệ mã hóa SSL
                                    256-bit.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review-box">
                    <h2 class="review-title">Xác Nhận Thông Tin Đặt Vé</h2>
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
                        <div class="passenger-count">
                            Hành khách (
                            {{ (is_array($passengers) ? count($passengers) : 0) + (is_array($childrens) ? count($childrens) : 0) }}
                            )
                        </div>
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
                </div>
            </div>

            <div class="price-summary">
                <h2 class="summary-title">Tổng Kết Thanh Toán</h2>
                <div class="price-row">
                    <div class="price-title">{{ $flight->departure }} - {{ $flight->destination }}</div>
                    <div class="price-value">{{ $day }}-{{ $month }}-{{ $year }}</div>
                </div>
                <div class="price-row">
                    <div class="price-title">{{ $flight->airline->name }} ({{ $flight->flight_code }})</div>
                    <div class="price-value">{{ $hour }}:{{ $minute }} -
                        {{ $hourArrival }}:{{ $minuteArrival }}</div>
                </div>
                <div class="price-row">
                    <div class="price-title">Người lớn (x{{ is_array($passengers) ? count($passengers) : 0 }})</div>
                    <div class="price-value">{{ $flight->price * is_array($passengers) ? count($passengers) : 0 }}0
                        VNĐ</div>
                </div>
                <div class="price-row">
                    <div class="price-title">Trẻ em (x{{ is_array($childrens) ? count($childrens) : 0 }})</div>
                    <div class="price-value">{{ $flight->price * is_array($childrens) ? count($childrens) : 0 }}0 VNĐ
                    </div>
                </div>
                <div class="price-row">
                    <div class="price-title">Thuế & Phí</div>
                    <div class="price-value">50.000 VNĐ</div>
                </div>
                <div class="price-row">
                    <div class="price-title">Phí dịch vụ</div>
                    <div class="price-value">20.000 VNĐ</div>
                </div>
                <div class="total-row">
                    <div>Tổng cộng</div>
                    <div>
                        {{ $flight->price * (is_array($passengers) ? count($passengers) : 0) + $flight->price * (is_array($childrens) ? count($childrens) : 0) + 50.0 + 20.0 }}0
                        VNĐ</div>
                </div>

                <div class="payment-notice">
                    Lưu ý: Vé máy bay sẽ được gửi qua email sau khi thanh toán hoàn tất.
                    Vui lòng kiểm tra email của bạn và hộp thư spam.
                </div>

                <form action="{{ route('thanhcong') }}" method="POST">
                    @csrf
                    <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                    <input type="hidden" name="departure" value="{{ $flight->departure }}">
                    <input type="hidden" name="destination" value="{{ $flight->destination }}">
                    <input type="hidden" name="departure_time" value="{{ $flight->departure_time }}">
                    <input type="hidden" name="arrival_time" value="{{ $flight->arrival_time }}">
                    <input type="hidden" name="price" value="{{ $flight->price }}">
                    <input type="hidden" name="totalPrice"
                        value="{{ $flight->price * (is_array($passengers) ? count($passengers) : 0) + $flight->price * (is_array($childrens) ? count($childrens) : 0) + 50.0 + 20.0 }}">
                    <input type="hidden" name="passenger_count"
                        value="{{ is_array($passengers) ? count($passengers) : 0 }}">
                    <input type="hidden" name="children_count"
                        value="{{ is_array($childrens) ? count($childrens) : 0 }}">
                    <input type="hidden" name="passengers_data" value="{{ json_encode($passengers) }}">
                    <input type="hidden" name="childrens_data" value="{{ json_encode($childrens) }}">
                    <input type="hidden" name="full_name" value="{{ $full_name }}">
                    <input type="hidden" name="phone" value="{{ $phone }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="address" value="{{ $address }}">
                    <button class="confirm-btn" type="submit">XÁC NHẬN THANH TOÁN</button>
                </form>
                <button class="back-btn">QUAY LẠI</button>
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
</body>

</html>
