<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Thanh Toán Đặt Vé</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>

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

        /* Styles cho phần phương thức thanh toán */
        .payment-method-selection {
            margin-bottom: 20px;
        }

        .method-tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .method-tab {
            padding: 12px 20px;
            cursor: pointer;
            font-size: 14px;
            color: #666;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }

        .method-tab:hover {
            color: #003580;
        }

        .method-tab.active {
            color: #003580;
            border-bottom-color: #003580;
            font-weight: bold;
        }

        .card-form {
            padding: 15px 0;
        }

        /* Styles cho phương thức chuyển khoản */
        .bank-info {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }

        .bank-info h3 {
            color: #003580;
            font-size: 16px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .bank-detail {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ddd;
            display: flex;
            gap: 10px;
        }

        .bank-detail:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .bank-detail p {
            margin-bottom: 6px;
            line-height: 1.5;
            font-size: 14px;
        }

        .qr-code-container-hanoi,
        .qr-code-container-hochiminh {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .qr-code-container-hanoi {
            margin: -40px -50px 20px 0;
        }

        .qr-code-container-hochiminh {
            margin: -35px -50px 10px 0;
        }

        .qr-guide-hanoi,
        .qr-guide-hochiminh {
            font-size: 9px;
            color: #666;
        }

        .hint-text {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
            font-style: italic;
        }

        input[readonly] {
            background-color: #f5f5f5;
            cursor: default;
        }

        /* Styles cho phương thức Ví MoMo */
        .qr-code-container {
            text-align: center;
            margin: 20px 0;
        }

        .qr-code-box {
            width: 150px;
            height: 150px;
            margin: 0 auto;
            border: 1px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            overflow: hidden;
            background-color: #fff;
        }

        .qr-guide {
            font-size: 14px;
            color: #666;
            margin-top: 10px;
        }

        /* Styles cho phương thức thanh toán tại quầy */
        .office-locations {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }

        .office-locations h3 {
            color: #003580;
            font-size: 16px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .office-detail {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed #ddd;
        }

        .office-detail:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .office-detail p {
            margin-bottom: 6px;
            line-height: 1.5;
            font-size: 14px;
        }

        /* Styles chung cho form */
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
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #003580;
            outline: none;
            box-shadow: 0 0 0 3px rgba(0, 53, 128, 0.1);
        }

        .required-field::after {
            content: " *";
            color: #f44336;
        }

        /* Upload biên lai */
        .file-upload {
            position: relative;
        }

        .file-upload input[type="file"] {
            position: absolute;
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            z-index: -1;
        }

        .upload-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #003580;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }

        .upload-button:hover {
            background-color: #002660;
        }

        .file-name {
            font-size: 14px;
            color: #666;
            vertical-align: middle;
            font-weight: bold;
        }

        .remove-file {
            border: none;
            background-color: #00388c;
            color: white;
            cursor: pointer;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Styles cho thông báo bảo mật */
        .security-info {
            display: flex;
            align-items: flex-start;
            margin-top: 20px;
            padding: 15px;
            border-radius: 4px;
            font-size: 14px;
            color: #666;
            line-height: 1.5;
        }

        .security-info.warning {
            background-color: #fff8e1;
            border-left: 4px solid #ffc107;
        }

        .security-info.info {
            background-color: #e3f2fd;
            border-left: 4px solid #2196f3;
        }

        .security-info.success {
            background-color: #f1f8e9;
            border-left: 4px solid #8bc34a;
        }

        .security-icon {
            margin-right: 10px;
            font-size: 18px;
            margin-top: 1px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .method-tabs {
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 5px;
            }

            .method-tab {
                padding: 10px 15px;
                font-size: 13px;
            }

            .form-row {
                flex-direction: column;
                gap: 10px;
            }

            .bank-info,
            .office-locations {
                padding: 15px;
            }
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

        .transfer-content {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        .transfer-input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f8f9fa;
            color: #003580;
            font-weight: 500;
        }

        .copy-btn {
            padding: 10px 20px;
            background-color: #003580;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .copy-btn:hover {
            background-color: #002660;
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
                            <div class="method-tab active">Chuyển khoản</div>
                            <div class="method-tab">Ví MoMo</div>
                            <div class="method-tab">Thanh toán tại quầy</div>
                        </div>

                        <!-- Form Chuyển khoản (hiển thị mặc định) -->
                        <div class="card-form" id="bank-transfer-form">
                            <div class="bank-info">
                                <h3>Thông tin tài khoản ngân hàng Hà Nội</h3>
                                <div class="bank-detail">
                                    <div class="thongtinbank-hanoi">
                                        <p><strong>Ngân hàng:</strong> MB bank</p>
                                        <p><strong>Tên tài khoản:</strong> CÔNG TY TNHH SKYJET VIỆT NAM</p>
                                        <p><strong>Chủ tài khoản:</strong>SKYJET VIỆT NAM</p>
                                        <p><strong>Số tài khoản:</strong> 1234567890</p>
                                        <p><strong>Chi nhánh:</strong> Hà Nội</p>
                                    </div>
                                    <div class="qr-code-container-hanoi">
                                        <div class="qr-guide-hanoi">Mở app ngân hàng để quét mã qrcode</div>
                                        <div class="qr-code-box">
                                            <a href="https://img.vietqr.io/image/MB-0398694446-print.png"
                                                data-fancybox="gallery">
                                                <img style="width: 150px; height: auto; cursor: pointer;"
                                                    src="https://img.vietqr.io/image/MB-0398694446-print.png"
                                                    alt="Mã QR ngân hàng MB bank" width="150">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <h3>Thông tin tài khoản ngân hàng TP.HCM</h3>
                                <div class="bank-detail">
                                    <div class="thongtinbank-hochiminh">
                                        <p><strong>Ngân hàng:</strong> MB bank</p>
                                        <p><strong>Tên tài khoản:</strong> CÔNG TY TNHH SKYJET VIỆT NAM</p>
                                        <p><strong>Chủ tài khoản:</strong> SKYJET VIỆT NAM</p>
                                        <p><strong>Số tài khoản:</strong> 0987654321</p>
                                        <p><strong>Chi nhánh:</strong> Hồ Chí Minh</p>
                                    </div>
                                    <div class="qr-code-container-hochiminh">
                                        <div class="qr-guide-hochiminh">Mở app ngân hàng để quét mã qrcode</div>
                                        <div class="qr-code-box">
                                            <a href="https://img.vietqr.io/image/MB-0398694446-print.png"
                                                data-fancybox="gallery">
                                                <img style="width: 150px; height: auto; cursor: pointer;"
                                                    src="https://img.vietqr.io/image/MB-0398694446-print.png"
                                                    alt="Mã QR ngân hàng MB bank" width="150">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Nội dung chuyển khoản</label>
                                    @if (isset($flight))
                                        {{-- Chuyến bay một chiều --}}
                                        <div class="transfer-content">
                                            <input type="text" class="transfer-input"
                                                value="SKYJET-{{ $flight->flight_code }} {{ $departureDay }}/{{ $departureMonth }}/{{ $departureYear }} - {{ $full_name }}"
                                                readonly>
                                            <button class="copy-btn" onclick="copyToClipboard(this)">Copy</button>
                                        </div>
                                    @else
                                        {{-- Chuyến bay khứ hồi --}}
                                        <div class="transfer-content">
                                            <input type="text" class="transfer-input"
                                                value="SKYJET-{{ $outboundFlight->flight_code }} {{ $outboundDepartureDay }}/{{ $outboundDepartureMonth }}/{{ $outboundDepartureYear }} - {{ $returnFlight->flight_code }} {{ $returnDepartureDay }}/{{ $returnDepartureMonth }}/{{ $returnDepartureYear }} - {{ $full_name }}"
                                                readonly>
                                            <button class="copy-btn" onclick="copyToClipboard(this)">Copy</button>
                                        </div>
                                    @endif
                                    <div class="hint-text">Vui lòng sử dụng đúng nội dung chuyển khoản này để hệ thống
                                        có thể xác nhận thanh toán của bạn.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Người chuyển khoản</label>
                                    <input type="text" placeholder="Nhập họ tên người chuyển khoản">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group file-upload">
                                    <label>Tải lên biên lai chuyển khoản (nếu có)</label>
                                    <input type="file" id="receipt-upload">
                                    <label for="receipt-upload" class="upload-button" style="color: #eee">Chọn
                                        tệp</label>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span class="file-name">Chưa có tệp nào được chọn</span>
                                        <button class="remove-file" style="display: none;">Xóa</button>
                                    </div>
                                </div>
                            </div>

                            <div class="security-info warning">
                                <div class="security-icon">ℹ️</div>
                                <div>Sau khi chuyển khoản thành công, vui lòng chụp ảnh biên lai và tải lên hoặc gửi về
                                    email: <strong>booking@skyjet.vn</strong></div>
                            </div>
                        </div>

                        <!-- Form Ví MoMo -->
                        <div class="card-form" id="momo-form" style="display: none;">
                            <div class="qr-code-container">
                                <div class="qr-code-box">
                                    <a href="{{ asset('images/qr/qr-code-momo.jpg') }}" data-fancybox="gallery">
                                        <img style="width: 150px; height: auto; cursor: pointer;"
                                            src="{{ asset('images/qr/qr-code-momo.jpg') }}"
                                            alt="Mã QR ngân hàng MB bank" width="150">
                                    </a>
                                </div>
                                <p class="qr-guide">Quét mã QR để thanh toán qua ví MoMo</p>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Nội dung chuyển khoản</label>
                                    @if (isset($flight))
                                        {{-- Chuyến bay một chiều --}}
                                        <div class="transfer-content">
                                            <input type="text" class="transfer-input"
                                                value="SKYJET-{{ $flight->flight_code }} {{ $departureDay }}/{{ $departureMonth }}/{{ $departureYear }} - {{ $full_name }}"
                                                readonly>
                                            <button class="copy-btn" onclick="copyToClipboard(this)">Copy</button>
                                        </div>
                                    @else
                                        {{-- Chuyến bay khứ hồi --}}
                                        <div class="transfer-content">
                                            <input type="text" class="transfer-input"
                                                value="SKYJET-{{ $outboundFlight->flight_code }} {{ $outboundDepartureDay }}/{{ $outboundDepartureMonth }}/{{ $outboundDepartureYear }} - {{ $returnFlight->flight_code }} {{ $returnDepartureDay }}/{{ $returnDepartureMonth }}/{{ $returnDepartureYear }} - {{ $full_name }}"
                                                readonly>
                                            <button class="copy-btn" onclick="copyToClipboard(this)">Copy</button>
                                        </div>
                                    @endif
                                    <div class="hint-text">Vui lòng sử dụng đúng nội dung chuyển khoản này để hệ thống
                                        có thể xác nhận thanh toán của bạn.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Số điện thoại đăng ký MoMo</label>
                                    <input type="tel" placeholder="Nhập số điện thoại MoMo của bạn">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Họ tên người thanh toán</label>
                                    <input type="text" placeholder="Nhập họ tên người thanh toán">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group file-upload">
                                    <label>Tải lên biên lai chuyển khoản (nếu có)</label>
                                    <input type="file" id="receipt-upload">
                                    <label for="receipt-upload" class="upload-button" style="color: #eee">Chọn
                                        tệp</label>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        <span class="file-name">Chưa có tệp nào được chọn</span>
                                        <button class="remove-file" style="display: none;">Xóa</button>
                                    </div>
                                </div>
                            </div>

                            <div class="security-info info">
                                <div class="security-icon">ℹ️</div>
                                <div>Vui lòng giữ lại biên lai giao dịch sau khi thanh toán thành công. Hệ thống sẽ tự
                                    động cập nhật trong vòng 5 phút sau khi thanh toán.</div>
                            </div>
                        </div>

                        <!-- Form Thanh toán tại quầy -->
                        <div class="card-form" id="counter-payment-form" style="display: none;">
                            <div class="office-locations">
                                <h3>Địa điểm thanh toán</h3>
                                <div class="office-detail">
                                    <p><strong>Văn phòng Hà Nội:</strong> Tầng 5, Tòa nhà ABC, 123 Nguyễn Chí Thanh,
                                        Đống Đa, Hà Nội</p>
                                    <p><strong>Giờ làm việc:</strong> 8:00 - 17:30 (Thứ Hai - Thứ Sáu), 8:00 - 12:00
                                        (Thứ Bảy)</p>
                                    <p><strong>Hotline:</strong> 024.1234.5678</p>
                                </div>
                                <div class="office-detail">
                                    <p><strong>Văn phòng TP.HCM:</strong> Tầng 3, Tòa nhà XYZ, 456 Cách Mạng Tháng 8,
                                        Quận 3, TP.HCM</p>
                                    <p><strong>Giờ làm việc:</strong> 8:00 - 17:30 (Thứ Hai - Thứ Sáu), 8:00 - 12:00
                                        (Thứ Bảy)</p>
                                    <p><strong>Hotline:</strong> 028.1234.5678</p>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Dự kiến ngày đến thanh toán</label>
                                    <input type="date" min="{{ date('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="required-field">Văn phòng thanh toán</label>
                                    <select>
                                        <option value="">-- Chọn văn phòng --</option>
                                        <option value="hanoi">Văn phòng Hà Nội</option>
                                        <option value="hcmc">Văn phòng TP.HCM</option>
                                    </select>
                                </div>
                            </div>

                            <div class="security-info success">
                                <div class="security-icon">ℹ️</div>
                                <div>Quý khách vui lòng mang theo CMND/CCCD khi đến thanh toán tại quầy. Vé sẽ được giữ
                                    trong vòng 24 giờ kể từ thời điểm đặt.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review-box">
                    <h2 class="review-title">Xác Nhận Thông Tin Đặt Vé</h2>
                    @if (isset($flight))
                        {{-- Chuyến bay một chiều --}}
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
                                <div class="flight-number">Chuyến bay: <p
                                        style="font-weight: bold; margin-left: 5px;">{{ $flight->flight_code }}</p>
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
                        {{-- Chuyến bay khứ hồi --}}
                        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                            {{-- Chuyến đi --}}
                            <div class="flight-info-container" style="flex: 1;">
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
                                    <div class="flight-times">
                                        <div class="departure-time">{{ $outboundFlightStartTime }}</div>
                                        <div class="flight-arrow">-</div>
                                        <div class="arrival-time">{{ $outboundFlightEndTime }}</div>
                                    </div>
                                    <div class="flight-number">Chuyến bay: <p
                                            style="font-weight: bold; margin-left: 5px;">
                                            {{ $outboundFlight->flight_code }}</p>
                                    </div>
                                    <div class="airline-info">
                                        <div class="airline-logo">
                                            <img src="{{ asset('storage/airline_logos/' . $outboundFlight->airline->logo) }}"
                                                alt="Airline Logo" />
                                            <div class="airline-name">{{ $outboundFlight->airline->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Chuyến về --}}
                            <div class="flight-info-container" style="flex: 1;">
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
                                    <div class="flight-times">
                                        <div class="departure-time">{{ $returnFlightStartTime }}</div>
                                        <div class="flight-arrow">-</div>
                                        <div class="arrival-time">{{ $returnFlightEndTime }}</div>
                                    </div>
                                    <div class="flight-number">Chuyến bay: <p
                                            style="font-weight: bold; margin-left: 5px;">
                                            {{ $returnFlight->flight_code }}</p>
                                    </div>
                                    <div class="airline-info">
                                        <div class="airline-logo">
                                            <img src="{{ asset('storage/airline_logos/' . $returnFlight->airline->logo) }}"
                                                alt="Airline Logo" />
                                            <div class="airline-name">{{ $returnFlight->airline->name }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="passenger-summary">
                        <div class="passenger-count">
                            Hành khách (
                            {{ $adults }} người lớn,
                            {{ $childrens }} trẻ em,
                            {{ $infants }} em bé
                            )
                        </div>

                        @if (!empty($adultsSession))
                            @foreach ($adultsSession as $index => $passenger)
                                <div class="passenger-info">
                                    {{ $index }}. {{ $passenger['last_name'] ?? 'Lỗi dữ liệu' }}
                                    {{ $passenger['first_name'] ?? 'Lỗi dữ liệu' }}
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
                </div>
            </div>

            @if (isset($flight))
                <div class="price-summary">
                    <h2 class="summary-title">Tổng Kết Thanh Toán</h2>
                    <div class="price-row">
                        <div class="price-title">{{ $flight->departure }} -
                            {{ $flight->destination }}</div>
                        <div class="price-value">{{ $departureDate }}</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">{{ $flight->airline->name }} ({{ $flight->flight_code }})</div>
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
                        <div class="price-title">Em bé (x{{ $infants }})</div>
                        <div class="price-value">{{ number_format($infant_price, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Thuế & Phí</div>
                        <div class="price-value">{{ number_format($tax_fee, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Phí dịch vụ</div>
                        <div class="price-value">{{ number_format($service_fee, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="total-row">
                        <div>Tổng cộng</div>
                        <div>{{ number_format($total_price, 0, ',', '.') }} VNĐ</div>
                    </div>

                    <div class="payment-notice">
                        Lưu ý: Vé máy bay sẽ được gửi qua email sau khi chúng tôi xác nhận rằng bạn đã thanh toán hoàn
                        tất.
                        Vui lòng kiểm tra email của bạn và hộp thư spam trong vòng 5 phút.
                    </div>

                    <form action="{{ route('thanhcong') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Thông tin chuyến bay -->
                        <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                        <input type="hidden" name="departure" value="{{ $flight->departure }}">
                        <input type="hidden" name="destination" value="{{ $flight->destination }}">
                        <input type="hidden" name="departure_time" value="{{ $flight->departure_time }}">
                        <input type="hidden" name="price" value="{{ $flight->price }}">

                        <!-- Thông tin hành khách -->
                        <input type="hidden" name="adults_data"
                            value="{{ htmlspecialchars(json_encode($adultsSession)) }}">
                        <input type="hidden" name="childrens_data"
                            value="{{ htmlspecialchars(json_encode($childrensSession)) }}">
                        <input type="hidden" name="infants_data"
                            value="{{ htmlspecialchars(json_encode($infantsSession)) }}">

                        <!-- Thông tin liên hệ -->
                        <input type="hidden" name="full_name" value="{{ htmlspecialchars($full_name) }}">
                        <input type="hidden" name="phone" value="{{ htmlspecialchars($phone) }}">
                        <input type="hidden" name="email" value="{{ htmlspecialchars($email) }}">
                        <input type="hidden" name="address" value="{{ htmlspecialchars($address) }}">

                        <!-- Thông tin thanh toán -->
                        <input type="hidden" name="adult_price" value="{{ $adult_price }}">
                        <input type="hidden" name="child_price" value="{{ $child_price }}">
                        <input type="hidden" name="infant_price" value="{{ $infant_price }}">
                        <input type="hidden" name="tax_fee" value="{{ $tax_fee }}">
                        <input type="hidden" name="service_fee" value="{{ $service_fee }}">
                        <input type="hidden" name="total_price" value="{{ $total_price }}">

                        <!-- Nút xác nhận -->
                        <button class="confirm-btn" type="submit">HOÀN TẤT THANH TOÁN</button>
                    </form>
                    <button class="back-btn">QUAY LẠI</button>
                </div>
            @else
                <div class="price-summary">
                    <h2 class="summary-title">Tổng Kết Thanh Toán</h2>
                    <div class="price-row">
                        <div class="price-title">{{ $outboundFlight->departure }} -
                            {{ $outboundFlight->destination }}</div>
                        <div class="price-value">{{ $outboundDepartureDate }}</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">{{ $outboundFlight->airline->name }}
                            ({{ $outboundFlight->flight_code }})</div>
                        <div class="price-value">{{ $outboundFlightStartTime }} -
                            {{ $outboundFlightEndTime }}</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Người lớn (x{{ $adults }})</div>
                        <div class="price-value">{{ number_format($outboundAdultPrice, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Trẻ em (x{{ $childrens }})</div>
                        <div class="price-value">{{ number_format($outboundChildPrice, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Em bé (x{{ $infants }})</div>
                        <div class="price-value">{{ number_format($outboundInfantPrice, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Thuế & Phí</div>
                        <div class="price-value">{{ number_format($outboundTaxFee, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Phí dịch vụ</div>
                        <div class="price-value">{{ number_format($outboundServiceFee, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <hr style="border: 1px solid #eee; margin: 20px 0;">
                    <div class="price-row">
                        <div class="price-title">Chuyến về: {{ $returnFlight->departure }} -
                            {{ $returnFlight->destination }}</div>
                        <div class="price-value">{{ $returnDepartureDate }}</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">{{ $returnFlight->airline->name }}
                            ({{ $returnFlight->flight_code }})</div>
                        <div class="price-value">{{ $returnFlightStartTime }} -
                            {{ $returnFlightEndTime }}</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Người lớn (x{{ $adults }})</div>
                        <div class="price-value">{{ number_format($returnAdultPrice, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Trẻ em (x{{ $childrens }})</div>
                        <div class="price-value">{{ number_format($returnChildPrice, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Em bé (x{{ $infants }})</div>
                        <div class="price-value">{{ number_format($returnInfantPrice, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Thuế & Phí</div>
                        <div class="price-value">{{ number_format($returnTaxFee, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Phí dịch vụ</div>
                        <div class="price-value">{{ number_format($returnServiceFee, 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="total-row">
                        <div>Tổng cộng</div>
                        <div>{{ number_format($outboundTotalPrice + $returnTotalPrice, 0, ',', '.') }} VNĐ</div>
                    </div>

                    <div class="payment-notice">
                        Lưu ý: Vé máy bay sẽ được gửi qua email sau khi thanh toán hoàn tất.
                        Vui lòng kiểm tra email của bạn và hộp thư spam.
                    </div>

                    <form action="{{ route('thanhcong') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Thông tin chuyến bay đi -->
                        <input type="hidden" name="flight_id" value="{{ $outboundFlight->id }}">
                        <input type="hidden" name="departure" value="{{ $outboundFlight->departure }}">
                        <input type="hidden" name="destination" value="{{ $outboundFlight->destination }}">
                        <input type="hidden" name="departure_time" value="{{ $outboundFlight->departure_time }}">
                        <input type="hidden" name="price" value="{{ $outboundFlight->price }}">

                        <!-- Thông tin chuyến bay về -->
                        <input type="hidden" name="return_flight_id" value="{{ $returnFlight->id }}">
                        <input type="hidden" name="return_departure" value="{{ $returnFlight->departure }}">
                        <input type="hidden" name="return_destination" value="{{ $returnFlight->destination }}">
                        <input type="hidden" name="return_departure_time"
                            value="{{ $returnFlight->departure_time }}">
                        <input type="hidden" name="return_price" value="{{ $returnFlight->price }}">

                        <!-- Thông tin hành khách -->
                        <input type="hidden" name="adults_data"
                            value="{{ htmlspecialchars(json_encode($adultsSession)) }}">
                        <input type="hidden" name="childrens_data"
                            value="{{ htmlspecialchars(json_encode($childrensSession)) }}">
                        <input type="hidden" name="infants_data"
                            value="{{ htmlspecialchars(json_encode($infantsSession)) }}">

                        <!-- Thông tin liên hệ -->
                        <input type="hidden" name="full_name" value="{{ htmlspecialchars($full_name) }}">
                        <input type="hidden" name="phone" value="{{ htmlspecialchars($phone) }}">
                        <input type="hidden" name="email" value="{{ htmlspecialchars($email) }}">
                        <input type="hidden" name="address" value="{{ htmlspecialchars($address) }}">

                        <!-- Thông tin thanh toán chuyến đi -->
                        <input type="hidden" name="outboundAdultPrice" value="{{ $outboundAdultPrice }}">
                        <input type="hidden" name="outboundChildPrice" value="{{ $outboundChildPrice }}">
                        <input type="hidden" name="outboundInfantPrice" value="{{ $outboundInfantPrice }}">
                        <input type="hidden" name="outboundTaxFee" value="{{ $outboundTaxFee }}">
                        <input type="hidden" name="outboundServiceFee" value="{{ $outboundServiceFee }}">
                        <input type="hidden" name="outboundTotalPrice" value="{{ $outboundTotalPrice }}">

                        <!-- Thông tin thanh toán chuyến về -->
                        <input type="hidden" name="returnAdultPrice" value="{{ $returnAdultPrice }}">
                        <input type="hidden" name="returnChildPrice" value="{{ $returnChildPrice }}">
                        <input type="hidden" name="returnInfantPrice" value="{{ $returnInfantPrice }}">
                        <input type="hidden" name="returnTaxFee" value="{{ $returnTaxFee }}">
                        <input type="hidden" name="returnServiceFee" value="{{ $returnServiceFee }}">
                        <input type="hidden" name="returnTotalPrice" value="{{ $returnTotalPrice }}">

                        <!-- Nút xác nhận -->
                        <button class="confirm-btn" type="submit">HOÀN TẤT THANH TOÁN</button>
                    </form>
                    <button class="back-btn">QUAY LẠI</button>
                </div>
            @endif
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
        // JavaScript để quản lý các phương thức thanh toán
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các tab phương thức thanh toán
            const methodTabs = document.querySelectorAll('.method-tab');

            // Lấy tất cả các form thanh toán
            const bankTransferForm = document.getElementById('bank-transfer-form');
            const momoForm = document.getElementById('momo-form');
            const counterPaymentForm = document.getElementById('counter-payment-form');

            // Thêm sự kiện click cho mỗi tab
            methodTabs.forEach(function(tab, index) {
                tab.addEventListener('click', function() {
                    // Xóa active class từ tất cả các tab
                    methodTabs.forEach(t => t.classList.remove('active'));

                    // Thêm active class cho tab được click
                    this.classList.add('active');

                    // Ẩn tất cả các form
                    bankTransferForm.style.display = 'none';
                    momoForm.style.display = 'none';
                    counterPaymentForm.style.display = 'none';

                    // Hiển thị form tương ứng với tab được chọn
                    if (index === 0) {
                        bankTransferForm.style.display = 'block';
                    } else if (index === 1) {
                        momoForm.style.display = 'block';
                    } else if (index === 2) {
                        counterPaymentForm.style.display = 'block';
                    }
                });
            });

            // Xử lý hiển thị tên file khi upload biên lai
            const fileInput = document.getElementById('receipt-upload');
            const fileNameDisplay = document.querySelector('.file-name');
            const removeFileButton = document.querySelector('.remove-file');
            if (fileInput && fileNameDisplay) {
                fileInput.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        fileNameDisplay.textContent = this.files[0].name;
                        removeFileButton.style.display = 'block';
                    } else {
                        fileNameDisplay.textContent = 'Chưa có tệp nào được chọn';
                        removeFileButton.style.display = 'none';
                    }
                });
            }

            // Xử lý xóa tệp
            if (removeFileButton) {
                removeFileButton.addEventListener('click', function() {
                    fileInput.value = '';
                    fileNameDisplay.textContent = 'Chưa có tệp nào được chọn!';
                    removeFileButton.style.display = 'none';
                })
            }

            // Xử lý đếm ngược thời gian thanh toán
            const timerElement = document.querySelector('.timer');

            if (timerElement) {
                let timeInSeconds = 10 * 60; // 10 phút = 600 giây

                function updateTimer() {
                    const minutes = Math.floor(timeInSeconds / 60);
                    const seconds = timeInSeconds % 60;

                    // Hiển thị thời gian dạng MM:SS
                    timerElement.textContent =
                        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                    // Giảm thời gian
                    timeInSeconds--;

                    // Nếu hết thời gian
                    if (timeInSeconds < 0) {
                        clearInterval(timerInterval);
                        timerElement.textContent = '00:00';
                        alert('Thời gian giữ vé đã hết. Vui lòng đặt vé lại.');
                        // Có thể thêm code để quay về trang đặt vé
                    }
                }

                // Cập nhật timer mỗi giây
                updateTimer(); // Gọi ngay lập tức để cập nhật hiển thị ban đầu
                const timerInterval = setInterval(updateTimer, 1000);
            }
        });
    </script>

    <script>
        // Khởi tạo fancybox
        Fancybox.bind("[data-fancybox='gallery']");
    </script>

    <script>
        function copyToClipboard(button) {
            const input = button.previousElementSibling;
            input.select();
            document.execCommand('copy');

            // Thay đổi text của button
            const originalText = button.textContent;
            button.textContent = 'Đã copy!';
            button.style.backgroundColor = '#28a745';

            // Đổi lại sau 2 giây
            setTimeout(() => {
                button.textContent = originalText;
                button.style.backgroundColor = '#003580';
            }, 2000);
        }
    </script>
</body>

</html>
