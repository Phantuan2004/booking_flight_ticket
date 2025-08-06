<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Hoàn Tất Đặt Vé</title>
    <link rel="stylesheet" href="{{ asset('css/success.css') }}" />
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
                @if (isset($flight))
                    <div class="booking-id">
                        <strong>Mã đặt chỗ:</strong> {{ $booking_code }}
                    </div>
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
                    <div class="booking-id">
                        <strong>Mã đặt chỗ:</strong> chuyến đi: {{ $booking_code_outbound }} -
                        chuyến về:
                        {{ $booking_code_outbound }} - {{ $booking_code_return }}
                    </div>
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
                        Hành khách @if (isset($flight))   
                            {{ $adults }} người lớn,
                            {{ $childrens }} trẻ em,
                            {{ $infants }} em bé
                        @else
                            {{ $adults_count }} người lớn,
                            {{ $childrens_count }} trẻ em,
                            {{ $infants_count }} em bé
                        @endif
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


                @if (isset($flight))
                    <div class="payment-summary">
                        <div class="payment-title">Chi tiết thanh toán:</div>
                        <div class="payment-details">
                            <div class="price-title">Người lớn (x{{ is_array($adults) ? count($adults) : $adults }})
                            </div>
                            <div class="price-value">
                                {{ number_format($priceData['adult_price'], 0, ',', '.') }} VNĐ</div>
                        </div>
                        <div class="payment-details">
                            <div class="price-title">Trẻ em (x{{ is_array($childrens) ? count($childrens) : $childrens }})
                            </div>
                            <div class="price-value">{{ number_format($priceData['child_price'], 0, ',', '.') }} VNĐ</div>
                        </div>
                        <div class="payment-details">
                            <div class="price-title">Em bé (x{{ is_array($infants) ? count($infants) : $infants }})</div>
                            <div class="price-value">{{ number_format($priceData['infant_price'], 0, ',', '.') }} VNĐ</div>
                        </div>
                        <div class="payment-details">
                            <div>Thuế & Phí</div>
                            <div>{{ number_format($priceData['tax_fee'], 0, ',', '.') }} VNĐ</div>
                        </div>
                        <div class="payment-details">
                            <div>Phí dịch vụ</div>
                            <div>{{ number_format($priceData['service_fee'], 0, ',', '.') }} VNĐ</div>
                        </div>
                        <div class="total-amount">
                            <div>Tổng cộng</div>
                            <div>
                                {{ number_format($totalPrice, 0, ',', '.') }} VNĐ</div>
                        </div>
                    </div>
                @else
                    <div class="payment-summary">
                        <div class="payment-title">Chi tiết thanh toán:</div>
                        <table class="table table-striped" border="1">
                            <thead>
                                <tr>
                                    <th>Tên chuyến bay</th>
                                    <th>Người lớn</th>
                                    <th>Trẻ em</th>
                                    <th>Em bé</th>
                                    <th>Thuế & Phí</th>
                                    <th>Phí dịch vụ</th>
                                    <th>Tổng cộng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Chuyến bay đi</td>
                                    <td>{{ is_array($adults_count) ? count($adults_count) : $adults_count }} x {{ number_format($outboundPriceData['adult_price'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ is_array($childrens_count) ? count($childrens_count) : $childrens_count }} x {{ number_format($outboundPriceData['child_price'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ is_array($infants_count) ? count($infants_count) : $infants_count }} x {{ number_format($outboundPriceData['infant_price'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($outboundPriceData['tax_fee'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($outboundPriceData['service_fee'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($outboundTotalPrice, 0, ',', '.') }} VNĐ</td>
                                </tr>
                                <tr>
                                    <td>Chuyến bay về</td>
                                    <td>{{ is_array($adults_count) ? count($adults_count) : $adults_count }} x {{ number_format($returnPriceData['adult_price'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ is_array($childrens_count) ? count($childrens_count) : $childrens_count }} x {{ number_format($returnPriceData['child_price'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ is_array($infants_count) ? count($infants_count) : $infants_count }} x {{ number_format($returnPriceData['infant_price'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($returnPriceData['tax_fee'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($returnPriceData['service_fee'], 0, ',', '.') }} VNĐ</td>
                                    <td>{{ number_format($returnTotalPrice, 0, ',', '.') }} VNĐ</td>
                                </tr>
                                <tr>
                                    <td colspan="6">Tổng cộng:</td>
                                    <td>{{ number_format($outboundTotalPrice + $returnTotalPrice, 0, ',', '.') }} VNĐ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
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
