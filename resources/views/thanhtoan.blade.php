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

    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
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
                        <div class="price-value">{{ number_format($priceData['adult_price'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Trẻ em (x{{ $childrens }})</div>
                        <div class="price-value">{{ number_format($priceData['child_price'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Em bé (x{{ $infants }})</div>
                        <div class="price-value">{{ number_format($priceData['infant_price'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Thuế & Phí</div>
                        <div class="price-value">{{ number_format($priceData['tax_fee'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Phí dịch vụ</div>
                        <div class="price-value">{{ number_format($priceData['service_fee'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="total-row">
                        <div>Tổng cộng</div>
                        <div>{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</div>
                    </div>

                    <div class="payment-notice">
                        Lưu ý: Vé máy bay sẽ được gửi qua email sau khi chúng tôi xác nhận rằng bạn đã thanh toán hoàn
                        tất.
                        Vui lòng kiểm tra email của bạn và hộp thư spam trong vòng 5 phút.
                    </div>

                    <form action="{{ route('success') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Thông tin chuyến bay -->
                        <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                        <input type="hidden" name="departure" value="{{ $flight->departure }}">
                        <input type="hidden" name="destination" value="{{ $flight->destination }}">

                        <input type="hidden" name="departure_time" value="{{ $flight->departure_time }}">
                        <!-- Thông tin hành khách -->
                        <input type="hidden" name="adults" value="{{ json_encode($adultsSession) }}">
                        <input type="hidden" name="childrens" value="{{ json_encode($childrensSession) }}">
                        <input type="hidden" name="infants" value="{{ json_encode($infantsSession) }}">

                        <!-- Thông tin liên hệ -->
                        <input type="hidden" name="full_name" value="{{ htmlspecialchars($full_name) }}">
                        <input type="hidden" name="phone" value="{{ htmlspecialchars($phone) }}">
                        <input type="hidden" name="email" value="{{ htmlspecialchars($email) }}">
                        <input type="hidden" name="address" value="{{ htmlspecialchars($address) }}">

                        <!-- Thông tin thanh toán -->
                        <input type="hidden" name="adult_price" value="{{ $priceData['adult_price'] }}">
                        <input type="hidden" name="child_price" value="{{ $priceData['child_price'] }}">
                        <input type="hidden" name="infant_price" value="{{ $priceData['infant_price'] }}">
                        <input type="hidden" name="tax_fee" value="{{ $priceData['tax_fee'] }}">
                        <input type="hidden" name="service_fee" value="{{ $priceData['service_fee'] }}">
                        <input type="hidden" name="total_price" value="{{ $totalPrice }}">

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
                        <div class="price-value">{{ number_format($outboundPriceData['adult_price'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Trẻ em (x{{ $childrens }})</div>
                        <div class="price-value">{{ number_format($outboundPriceData['child_price'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Em bé (x{{ $infants }})</div>
                        <div class="price-value">{{ number_format($outboundPriceData['infant_price'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Thuế & Phí</div>
                        <div class="price-value">{{ number_format($outboundPriceData['tax_fee'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Phí dịch vụ</div>
                        <div class="price-value">{{ number_format($outboundPriceData['service_fee'], 0, ',', '.') }} VNĐ</div>
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
                        <div class="price-value">{{ number_format($returnPriceData['adult_price'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Trẻ em (x{{ $childrens }})</div>
                        <div class="price-value">{{ number_format($returnPriceData['child_price'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Em bé (x{{ $infants }})</div>
                        <div class="price-value">{{ number_format($returnPriceData['infant_price'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Thuế & Phí</div>
                        <div class="price-value">{{ number_format($returnPriceData['tax_fee'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="price-row">
                        <div class="price-title">Phí dịch vụ</div>
                        <div class="price-value">{{ number_format($returnPriceData['service_fee'], 0, ',', '.') }} VNĐ</div>
                    </div>
                    <div class="total-row">
                        <div>Tổng cộng</div>
                        <div>{{ number_format($totalPrice, 0, ',', '.') }} VNĐ</div>
                    </div>

                    <div class="payment-notice">
                        Lưu ý: Vé máy bay sẽ được gửi qua email sau khi thanh toán hoàn tất.
                        Vui lòng kiểm tra email của bạn và hộp thư spam.
                    </div>

                    <form action="{{ route('success') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Thông tin chuyến bay đi -->
                        <input type="hidden" name="outbound_flight_id" value="{{ $outboundFlight->id }}">
                        <input type="hidden" name="outbound_departure" value="{{ $outboundFlight->departure }}">
                        <input type="hidden" name="outbound_destination"
                            value="{{ $outboundFlight->destination }}">
                        <input type="hidden" name="outbound_departure_time"
                            value="{{ $outboundFlight->departure_time }}">
                        <input type="hidden" name="outbound_price_economy"
                            value="{{ $outboundFlight->price_economy }}">
                        <input type="hidden" name="outbound_price_business"
                            value="{{ $outboundFlight->price_business }}">

                        <!-- Thông tin chuyến bay về -->
                        <input type="hidden" name="return_flight_id" value="{{ $returnFlight->id }}">
                        <input type="hidden" name="return_departure" value="{{ $returnFlight->departure }}">
                        <input type="hidden" name="return_destination" value="{{ $returnFlight->destination }}">
                        <input type="hidden" name="return_departure_time"
                            value="{{ $returnFlight->departure_time }}">
                        <input type="hidden" name="return_price_economy"
                            value="{{ $returnFlight->price_economy }}">
                        <input type="hidden" name="return_price_business"
                            value="{{ $returnFlight->price_business }}">

                        <!-- Thông tin hành khách -->
                        <!-- Thông tin hành khách -->
                        <input type="hidden" name="adults" value="{{ json_encode($adultsSession) }}">
                        <input type="hidden" name="childrens" value="{{ json_encode($childrensSession) }}">
                        <input type="hidden" name="infants" value="{{ json_encode($infantsSession) }}">

                        <!-- Thông tin liên hệ -->
                        <input type="hidden" name="full_name" value="{{ htmlspecialchars($full_name) }}">
                        <input type="hidden" name="phone" value="{{ htmlspecialchars($phone) }}">
                        <input type="hidden" name="email" value="{{ htmlspecialchars($email) }}">
                        <input type="hidden" name="address" value="{{ htmlspecialchars($address) }}">

                        <!-- Thông tin thanh toán chuyến đi -->
                        <input type="hidden" name="outboundAdultPrice" value="{{ $outboundPriceData['adult_price'] }}">
                        <input type="hidden" name="outboundChildPrice" value="{{ $outboundPriceData['child_price'] }}">
                        <input type="hidden" name="outboundInfantPrice" value="{{ $outboundPriceData['infant_price'] }}">
                        <input type="hidden" name="outboundTaxFee" value="{{ $outboundPriceData['tax_fee'] }}">
                        <input type="hidden" name="outboundServiceFee" value="{{ $outboundPriceData['service_fee'] }}">
                        <input type="hidden" name="outboundTotalPrice" value="{{ $outboundTotalPrice }}">

                        <!-- Thông tin thanh toán chuyến về -->
                        <input type="hidden" name="returnAdultPrice" value="{{ $returnPriceData['adult_price'] }}">
                        <input type="hidden" name="returnChildPrice" value="{{ $returnPriceData['child_price'] }}">
                        <input type="hidden" name="returnInfantPrice" value="{{ $returnPriceData['infant_price'] }}">
                        <input type="hidden" name="returnTaxFee" value="{{ $returnPriceData['tax_fee'] }}">
                        <input type="hidden" name="returnServiceFee" value="{{ $returnPriceData['service_fee'] }}">
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

    <script src="{{ asset('js/payment.js') }}"></script>
</body>

</html>
