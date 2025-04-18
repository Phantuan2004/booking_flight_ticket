<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Nhập Thông Tin Hành Khách</title>
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

        .confirmation-content {
            display: flex;
            gap: 20px;
            margin: 30px 0;
        }

        .passenger-details {
            flex: 2;
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

        .passenger-form {
            margin-top: 15px;
        }

        .form-title {
            font-size: 16px;
            color: #003580;
            margin-bottom: 15px;
        }

        .passenger-card {
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .passenger-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .passenger-header h3 {
            font-size: 16px;
            color: #003580;
        }

        .passenger-type {
            color: #666;
            font-size: 14px;
            background-color: #f0f8ff;
            padding: 4px 8px;
            border-radius: 4px;
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

        .contact-form {
            margin-top: 20px;
        }

        .required-field::after {
            content: " *";
            color: #f44336;
        }

        .form-note {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .payment-options {
            margin-top: 20px;
        }

        .payment-method {
            margin-bottom: 15px;
        }

        .payment-label {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
            cursor: pointer;
        }

        .payment-label input {
            margin-right: 10px;
        }

        .payment-cards {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            margin-left: 25px;
        }

        .card-icon {
            width: 40px;
            height: 30px;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            border: 1px solid #ddd;
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

        .terms-checkbox {
            margin-top: 20px;
            display: flex;
            align-items: flex-start;
        }

        .terms-checkbox input {
            margin-right: 10px;
            margin-top: 3px;
        }

        .terms-text {
            font-size: 14px;
            color: #666;
        }

        .terms-text a {
            color: #003580;
            text-decoration: none;
        }

        .continue-btn {
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
            margin-top: 10px;
            font-size: 16px;
        }

        .buttons-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
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
            .confirmation-content {
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
                        <li><a href="{{ route('datve_khuhoi') }}">Đặt Vé</a></li>
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
            <h1>Nhập Thông Tin Hành Khách</h1>
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
            <div class="step active">
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
        <form action="{{ route('thanhtoan') }}" method="POST">
            @csrf
            <input type="hidden" name="flight_id" value="{{ $flight->id }}">
            <input type="hidden" name="departure" value="{{ $flight->departure }}">
            <input type="hidden" name="destination" value="{{ $flight->destination }}">
            <input type="hidden" name="departure_time" value="{{ $flight->departure_time }}">
            <input type="hidden" name="price" value="{{ $flight->price }}">
            <input type="hidden" name="adults" value="{{ json_encode($adults) }}">
            <input type="hidden" name="childrens" value="{{ json_encode($childrens) }}">
            <input type="hidden" name="infants" value="{{ json_encode($infants) }}">

            <div class="confirmation-content">
                <div class="passenger-details">
                    <div class="confirmation-box">
                        <h2 class="confirmation-title">Chi Tiết Chuyến Bay</h2>
                        <div class="flight-info-container">
                            <div class="flight-date">
                                <div class="date-number">{{ $departureTime->format('d') }}</div>
                                <div class="date-month">Tháng {{ $departureTime->format('m') }}</div>
                            </div>
                            <div class="flight-details">
                                <div class="flight-route">
                                    <div class="airport-code">{{ $flight->departure }}</div>
                                    <div class="flight-arrow">→</div>
                                    <div class="airport-code">{{ $flight->destination }}</div>
                                </div>
                                <div class="flight-times">
                                    <div class="departure-time">{{ $flightStart->format('H:i') }}</div>
                                    <div class="flight-duration">{{ $duration }}</div>
                                    <div class="arrival-time">{{ $flightEnd->format('H:i') }}</div>
                                </div>
                                <div class="airport-names">
                                    {{ $flight->departure }} - {{ $flight->destination }}
                                </div>
                                <div class="airline-info">
                                    <div class="airline-logo">{{ $flight->logo }}</div>
                                    <div class="airline-name">{{ $flight->airline->name }}</div>
                                    <div class="flight-number">{{ $flight->flight_code }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="confirmation-box">
                        <h2 class="confirmation-title">Thông Tin Hành Khách</h2>
                        <div class="passenger-form">
                            <p class="form-title">
                                Vui lòng nhập thông tin cho tất cả hành khách
                            </p>

                            @for ($i = 1; $i <= $adults; $i++)
                                <div class="passenger-card">
                                    <div class="passenger-header">
                                        <h3>Hành khách {{ $i }}</h3>
                                        <div class="passenger-type">Người lớn</div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="required-field">Họ</label>
                                            <input name="adults[{{ $i }}][last_name]" type="text"
                                                placeholder="Ví dụ: Nguyễn" />
                                        </div>
                                        <div class="form-group">
                                            <label class="required-field">Tên đệm & tên</label>
                                            <input name="adults[{{ $i }}][first_name]" type="text"
                                                placeholder="Ví dụ: Văn A" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="required-field">Ngày sinh</label>
                                            <input name="adults[{{ $i }}][birth_date]" type="date" />
                                        </div>
                                        <div class="form-group">
                                            <label class="required-field">Giới tính</label>
                                            <select name="adults[{{ $i }}][gender]">
                                                <option value="">Chọn giới tính</option>
                                                <option value="male">Nam</option>
                                                <option value="female">Nữ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endfor

                            @for ($i = 1; $i <= $childrens; $i++)
                                <div class="passenger-card">
                                    <div class="passenger-header">
                                        <h3>Trẻ em {{ $i }}</h3>
                                        <div class="passenger-type">Trẻ em</div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="required-field">Họ</label>
                                            <input name="childrens[{{ $i }}][last_name]" type="text"
                                                placeholder="Ví dụ: Nguyễn" />
                                        </div>
                                        <div class="form-group">
                                            <label class="required-field">Tên đệm & tên</label>
                                            <input name="childrens[{{ $i }}][first_name]" type="text"
                                                placeholder="Ví dụ: Văn A" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="required-field">Ngày sinh</label>
                                            <input name="childrens[{{ $i }}][birth_date]"
                                                type="date" />
                                        </div>
                                        <div class="form-group">
                                            <label class="required-field">Giới tính</label>
                                            <select name="childrens[{{ $i }}][gender]">
                                                <option value="">Chọn giới tính</option>
                                                <option value="male">Nam</option>
                                                <option value="female">Nữ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endfor

                            @for ($i = 1; $i <= $infants; $i++)
                                <div class="passenger-card">
                                    <div class="passenger-header">
                                        <h3>Em bé {{ $i }}</h3>
                                        <div class="passenger-type">Em bé </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="required-field">Họ</label>
                                            <input name="infants[{{ $i }}][last_name]" type="text"
                                                placeholder="Ví dụ: Nguyễn" />
                                        </div>
                                        <div class="form-group">
                                            <label class="required-field">Tên đệm & tên</label>
                                            <input name="infants[{{ $i }}][first_name]" type="text"
                                                placeholder="Ví dụ: Văn A" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="required-field">Ngày sinh</label>
                                            <input name="infants[{{ $i }}][birth_date]" type="date" />
                                        </div>
                                        <div class="form-group">
                                            <label class="required-field">Giới tính</label>
                                            <select name="infants[{{ $i }}][gender]">
                                                <option value="">Chọn giới tính</option>
                                                <option value="male">Nam</option>
                                                <option value="female">Nữ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="confirmation-box">
                        <h2 class="confirmation-title">Thông Tin Liên Hệ</h2>
                        <div class="contact-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Họ và tên</label>
                                    <input name="full_name" id="full_name" type="text"
                                        placeholder="Nhập họ và tên người liên hệ" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Số điện thoại</label>
                                    <input name="phone" id="phone" type="tel"
                                        placeholder="Nhập số điện thoại" />
                                </div>
                                <div class="form-group">
                                    <label class="required-field">Email</label>
                                    <input name="email" id="email" type="email"
                                        placeholder="Nhập địa chỉ email" />
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Địa chỉ</label>
                                    <input name="address" id="address" type="text"
                                        placeholder="Nơi ở hiện tại" />
                                </div>
                            </div>
                            <div class="form-note">
                                Thông tin liên hệ sẽ được sử dụng để gửi thông tin vé và liên
                                lạc trong trường hợp cần thiết
                            </div>
                        </div>
                    </div>

                    <div class="confirmation-box">
                        <h2 class="confirmation-title">Phương Thức Thanh Toán</h2>
                        <div class="payment-options">
                            <div class="payment-method">
                                <label class="payment-label">
                                    <input type="radio" name="payment" value="credit" checked />
                                    Thanh toán bằng thẻ tín dụng/ghi nợ
                                </label>
                                <div class="payment-cards">
                                    <div class="card-icon">VISA</div>
                                    <div class="card-icon">MC</div>
                                    <div class="card-icon">JCB</div>
                                </div>
                            </div>
                            <div class="payment-method">
                                <label class="payment-label">
                                    <input type="radio" name="payment" value="bank" />
                                    Thanh toán qua ngân hàng trực tuyến
                                </label>
                            </div>
                            <div class="payment-method">
                                <label class="payment-label">
                                    <input type="radio" name="payment" value="ewallet" />
                                    Thanh toán qua ví điện tử (Momo, ZaloPay, VNPay)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="price-summary">
                    <h2 class="summary-title">Tổng Kết Đặt Vé</h2>
                    <div class="price-row">
                        <div class="price-title">{{ $flight->departure }} - {{ $flight->destination }}</div>
                        <div class="price-value">{{ $departureDate }}</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">{{ $flight->airline->name }} ({{ $flight->flight_number }})</div>
                        <div class="price-value">{{ $flightStartTime }} -
                            {{ $flightEndTime }}</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Người lớn (x{{ $adults }})</div>
                        <div class="price-value">{{ number_format($adult_price, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Trẻ em (x{{ $childrens }})</div>
                        <div class="price-value">{{ number_format($child_price, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Trẻ em (x{{ $infants }})</div>
                        <div class="price-value">{{ number_format($infant_price, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Thuế & Phí</div>
                        <div class="price-value">{{ number_format(50000, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Phí dịch vụ</div>
                        <div class="price-value">{{ number_format(20000, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="total-row">
                        <div>Tổng cộng</div>
                        <div>{{ number_format($total_price, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="terms-checkbox">
                        <input type="checkbox" id="terms" name="terms" required />
                        <label for="terms" class="terms-text">
                            Tôi đã đọc và đồng ý với
                            <a href="#">Điều khoản và Điều kiện</a> của SkyJet, bao gồm các
                            chính sách về hoàn vé và đổi vé.
                        </label>
                    </div>
                    <div class="buttons-container">
                        <button class="continue-btn" type="submit">TIẾP TỤC</button>
                        <a href="javascript:history.back()"><button class="back-btn" type="button">QUAY
                                LẠI</button></a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <footer>
        <div class="container">
            <div class="copyright">
                <p>&copy; 2025 SkyJet. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <script>
        // Hiển thị thông báo khi chưa nhập thông tin đầy đủ mà đã submit
        document.querySelector('form').addEventListener('submit', function(event) {
            // Kiểm tra giá trị các trường thông tin hành khách
            const passengerInputs = document.querySelectorAll('.passenger-card input');
            let allPassengerFilled = true;
            passengerInputs.forEach(input => {
                if (!input.value) {
                    allPassengerFilled = false;
                }
            });
            if (!allPassengerFilled) {
                event.preventDefault();
                alert('Vui lòng điền đầy đủ thông tin hành khách.');
                return;
            }

            // Kiểm tra giá trị các trường thông tin liên hệ
            const contactInputs = document.querySelectorAll('.contact-form input');
            let allContactFilled = true;
            contactInputs.forEach(input => {
                if (!input.value) {
                    allContactFilled = false;
                }
            });
            if (!allContactFilled) {
                event.preventDefault();
                alert('Vui lòng điền đầy đủ thông tin liên hệ.');
                return;
            }
        })
    </script>
</body>

</html>
