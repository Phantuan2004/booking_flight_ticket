<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Đặt vé khứ hồi</title>
    <script src="https://kit.fontawesome.com/9046a62732.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/roundtrip.css') }}">
</head>

<body>
    {{-- Scroll to top --}}
    @include('components.scroll-to-top')

    {{-- Header --}}
    @include('components.header')

    <div class="page-title">
        <div class="container">
            <h1>Kết quả tìm kiếm</h1>
        </div>
    </div>

    <div class="container">
        <div class="steps-container">
            <div class="booking-steps">
                <div class="step completed">
                    <div class="step-number">1</div>
                    <div class="step-text">Tìm Chuyến Bay</div>
                </div>
                <div class="step-divider"></div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <div class="step-text">Chọn Chuyến Bay</div>
                </div>
                <div class="step-divider"></div>
                <div class="step">
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

        <div class="booking-content">
            <div class="flight-selection">
                <div class="filter-panel">
                    <form action="{{ route('flight-search-roundtrip') }}" method="get">
                        <h2 class="filter-title">Lọc Kết Quả</h2>
                        <div class="filter-form">
                            <div class="filter-group">
                                <label>Hãng Hàng Không</label>
                                <select>
                                    <option>Tất cả hãng</option>
                                    @foreach ($airlines as $airline)
                                        <option value="{{ $airline->id }}">{{ $airline->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="filter-group">
                                <label>Giá</label>
                                <select>
                                    <option>Sắp xếp theo giá</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Từ thấp
                                        đến cao</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Từ cao
                                        đến thấp</option>
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
                        <button class="filter-btn" type="submit">Áp Dụng</button>
                    </form>
                </div>


                <div class="flight-selection-container">
                    <!-- Chuyến Đi -->
                    <div class="container-1">
                        <div class="flight-selection-header">
                            <div>
                                <div class="flight-selection-title">
                                    Chuyến Đi
                                </div>
                                <div class="flight-selection-subtitle">
                                    {{ $departure }} → {{ $destination }}, {{ $departure_time }}
                                </div>
                            </div>
                        </div>

                        <div class="flight-list">
                            @foreach ($outboundFlights as $trip)
                                <div class="flight-card">
                                    <div class="airline-logo">
                                        <img src="{{ asset('storage/airline_logos/' . $trip->airline->logo) }}"
                                            alt="Airline Logo" />
                                    </div>
                                    <div class="flight-code">{{ $trip->flight_code }}</div>
                                    <div class="flight-time">{{ $trip->flight_trip }}</div>
                                    <div><button type="button"
                                            onclick="toggleDetails({{ $trip->id }}, 'outbound')"
                                            class="info-button" aria-label="Toggle flight details">
                                            <i class="fa-solid fa-square-plus"
                                                style="color: #74C0FC; font-size: 18px;"></i>
                                        </button></div>
                                    <div class="price">{{ number_format($trip->price, 0, ',', ',') }}đ
                                    </div>
                                    <button type="button"
                                        onclick="selectFlight(
                                        {{ $trip->id }},
                                        'outbound',
                                        this,
                                        '{{ $trip->flight_code }}',
                                        '{{ $trip->airline->name }}',
                                        '{{ $trip->departure }}',
                                        '{{ $trip->destination }}',
                                        '{{ $trip->departure_time }}',
                                        {{ $trip->price }}
                                    )"
                                        class="select-btn">Chọn</button>
                                </div>

                                <!-- Thêm phần chi tiết ẩn ngay sau mỗi flight-card -->
                                <div id="details-{{ $trip->id }}" class="flight-details-container"
                                    style="display: none;">
                                    <div class="flight-details-content">
                                        <table class="details-table">
                                            <tr>
                                                <th colspan="2">Chi tiết chuyến bay</th>
                                            </tr>
                                            <tr>
                                                <td>Mã chuyến bay:</td>
                                                <td>{{ $trip->flight_code ?? 'VN' . rand(1000, 9999) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ngày bay:</td>
                                                <td>
                                                    @if ($trip->departure_time instanceof \DateTime)
                                                        {{ $trip->departure_time->format('d/m/Y') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($trip->departure_time)->format('d/m/Y') }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Giờ bay:</td>
                                                <td>
                                                    @if ($trip->flight_trip instanceof \DateTime)
                                                        {{ $trip->flight_trip->format('H:i') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($trip->flight_trip)->format('H:i') }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Giờ đến: (dự kiến)</td>
                                                <td>
                                                    @if ($trip->flight_end instanceof \DateTime)
                                                        {{ $trip->flight_end->format('H:i') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($trip->flight_end)->format('H:i') }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hãng bay: </td>
                                                <td>{{ $trip->airline->name ?? 'Vietnam Airlines' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Loại máy bay:</td>
                                                <td>{{ $trip->aircraft_type ?? 'Airbus A' . rand(300, 380) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Hạng vé:</td>
                                                <td>{{ ucfirst($trip->seat_class) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Hành lý xách tay:</td>
                                                <td>{{ $trip->seat_class === 'thương gia' ? '12kg' : '7kg' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Hành lý ký gửi:</td>
                                                <td>{{ $trip->seat_class === 'thương gia' ? '40kg' : '20kg' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Chuyến Về -->
                    <div class="container-2">
                        <div class="flight-selection-header">
                            <div>
                                <div class="flight-selection-title">
                                    Chuyến Về
                                </div>
                                <div class="flight-selection-subtitle">
                                    {{ $destination }} → {{ $departure }}, {{ $return_time }}
                                </div>
                            </div>
                        </div>

                        <div class="flight-list">
                            @foreach ($returnFlights as $return)
                                <div class="flight-card">
                                    <div class="airline-logo">
                                        <img src="{{ asset('storage/airline_logos/' . $return->airline->logo) }}"
                                            alt="Airline Logo" />
                                    </div>
                                    <div class="flight-code">{{ $return->flight_code }}</div>
                                    <div class="flight-time">{{ $return->flight_start }}</div>
                                    <div><button type="button" onclick="toggleDetails({{ $return->id }}, 'return')"
                                            class="info-button" aria-label="Toggle flight details">
                                            <i class="fa-solid fa-square-plus"
                                                style="color: #74C0FC; font-size: 18px;"></i>
                                        </button></div>
                                    <div class="price">{{ number_format($return->price, 0, ',', ',') }}đ</div>
                                    <button type="button"
                                        onclick="selectFlight(
        {{ $return->id }},
        'return',
        this,
        '{{ $return->flight_code }}',
        '{{ $return->airline->name }}',
        '{{ $return->departure }}',
        '{{ $return->destination }}',
        '{{ $return->departure_time }}',
        {{ $return->price }}
    )"
                                        class="select-btn">Chọn</button>
                                </div>

                                <!-- Thêm phần chi tiết ẩn ngay sau mỗi flight-card -->
                                <div id="details-{{ $return->id }}" class="flight-details-container"
                                    style="display: none;">
                                    <div class="flight-details-content">
                                        <table class="details-table">
                                            <tr>
                                                <th colspan="2">Chi tiết chuyến bay</th>
                                            </tr>
                                            <tr>
                                                <td>Mã chuyến bay:</td>
                                                <td>{{ $return->flight_code ?? 'VN' . rand(1000, 9999) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Ngày bay:</td>
                                                <td>
                                                    @if ($return->departure_time instanceof \DateTime)
                                                        {{ $return->departure_time->format('d/m/Y') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($return->departure_time)->format('d/m/Y') }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Giờ bay:</td>
                                                <td>
                                                    @if ($return->flight_start instanceof \DateTime)
                                                        {{ $return->flight_start->format('H:i') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($return->flight_start)->format('H:i') }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Giờ đến: (dự kiến)</td>
                                                <td>
                                                    @if ($return->flight_end instanceof \DateTime)
                                                        {{ $return->flight_end->format('H:i') }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($return->flight_end)->format('H:i') }}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hãng bay: </td>
                                                <td>{{ $return->airline->name ?? 'Vietnam Airlines' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Loại máy bay:</td>
                                                <td>{{ $return->aircraft_type ?? 'Airbus A' . rand(300, 380) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hạng vé:</td>
                                                <td>{{ ucfirst($return->seat_class) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Hành lý xách tay:</td>
                                                <td>{{ $return->seat_class === 'thương gia' ? '12kg' : '7kg' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Hành lý ký gửi:</td>
                                                <td>{{ $return->seat_class === 'thương gia' ? '40kg' : '20kg' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <form action="{{ route('confirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="outbound_flight_id" id="outbound_flight_id"
                        value="{{ $trip->id }}">
                    <input type="hidden" name="outbound_flight_code" id="outbound_flight_code"
                        value="{{ $trip->flight_code }}">
                    <input type="hidden" name="outbound_airline" id="outbound_airline"
                        value="{{ $trip->airline->name }}">
                    <input type="hidden" name="outbound_departure" id="outbound_departure"
                        value="{{ $trip->departure }}">
                    <input type="hidden" name="outbound_destination" id="outbound_destination"
                        value="{{ $trip->destination }}">
                    <input type="hidden" name="outbound_departure_time" id="outbound_departure_time"
                        value="{{ $trip->departure_time }}">
                    <input type="hidden" name="outbound_price" id="outbound_price" value="{{ $trip->price }}">
                    <input type="hidden" name="return_flight_id" id="return_flight_id"
                        value="{{ $return->id }}">
                    <input type="hidden" name="return_flight_code" id="return_flight_code"
                        value="{{ $return->flight_code }}">
                    <input type="hidden" name="return_airline" id="return_airline"
                        value="{{ $return->airline->name }}">
                    <input type="hidden" name="return_departure" id="return_departure"
                        value="{{ $return->departure }}">
                    <input type="hidden" name="return_destination" id="return_destination"
                        value="{{ $return->destination }}">
                    <input type="hidden" name="return_departure_time" id="return_departure_time"
                        value="{{ $return->departure_time }}">
                    <input type="hidden" name="return_price" id="return_price" value="{{ $return->price }}">
                    <input type="hidden" name="adults" value="{{ $adults }}">
                    <input type="hidden" name="childrens" value="{{ $childrens }}">
                    <input type="hidden" name="infants" value="{{ $infants }}">

                    <button type="submit" class="next-step-btn" id="submitBtn" disabled>
                        TIẾP TỤC VỚI CHUYẾN BAY ĐÃ CHỌN
                    </button>
                </form>
            </div>

            <div class="search-form">
                <h2 class="search-title">Tìm Kiếm Chuyến Bay</h2>

                <div class="search-radios">
                    <div class="search-radio">
                        <button onclick="showForm('oneway')" name="tripType">
                            Một chiều
                        </button>
                    </div>
                    <div class="search-radio">
                        <button onclick="showForm('roundtrip')" name="tripType">
                            Khứ hồi
                        </button>
                    </div>
                </div>

                <div id="oneway-form" class="form-container active">
                    <form action="{{ route('flight-search-oneway') }}" method="GET">
                        <div class="search-group">
                            <label>Điểm đi</label>
                            <input type="text" name="departure" placeholder="Chọn thành phố hoặc sân bay"
                                value="{{ old('departure') }}">
                            </input>
                        </div>

                        <div class="search-group">
                            <label>Điểm đến</label>
                            <input type="text" name="destination" placeholder="Chọn thành phố hoặc sân bay"
                                value="{{ old('destination') }}">
                            </input>
                        </div>

                        <div class="search-group">
                            <label>Ngày đi</label>
                            <input type="date" name="departure_time" min="{{ date('Y-m-d') }}"
                                value="{{ old('departure_time') }}" />
                        </div>

                        <div class="search-group">
                            <label>Hành khách</label>
                            <div class="passenger-row">
                                <span>Người lớn</span>
                                <div class="passenger-count">
                                    <div class="count-btn" onclick="decrementPassenger('adult')">-</div>
                                    <div class="count-value" id="adult-count">2</div>
                                    <div class="count-btn" onclick="incrementPassenger('adult')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Trẻ em (2-12 tuổi)</span>
                                <div class="passenger-count">
                                    <div class="count-btn" onclick="decrementPassenger('child')">-</div>
                                    <div class="count-value" id="child-count">1</div>
                                    <div class="count-btn" onclick="incrementPassenger('child')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Em bé (< 2 tuổi)</span>
                                        <div class="passenger-count">
                                            <div class="count-btn" onclick="decrementPassenger('infant')">-</div>
                                            <div class="count-value" id="infant-count">0</div>
                                            <div class="count-btn" onclick="incrementPassenger('infant')">+</div>
                                        </div>
                            </div>
                        </div>
                        <button class="search-btn">TÌM KIẾM</button>
                    </form>
                </div>

                <div id="roundtrip-form" class="form-container">
                    <form action="{{ route('flight-search-roundtrip') }}" method="GET">
                        <div class="search-group">
                            <label>Điểm đi</label>
                            <input type="text" name="departure" placeholder="Chọn thành phố hoặc sân bay"
                                value="{{ old('departure') }}">
                            </input>
                        </div>

                        <div class="search-group">
                            <label>Điểm đến</label>
                            <input type="text" name="destination" placeholder="Chọn thành phố hoặc sân bay"
                                value="{{ old('destination') }}">
                            </input>
                        </div>

                        <div class="search-group">
                            <label>Ngày đi</label>
                            <input type="date" name="departure_time" min="{{ date('Y-m-d') }}"
                                value="{{ old('departure_time') }}" />
                        </div>

                        <div class="search-group">
                            <label>Ngày về</label>
                            <input type="date" name="return_time" min="{{ date('Y-m-d') }}"
                                value="{{ old('return_time') }}" />
                        </div>

                        <div class="search-group">
                            <label>Hành khách</label>
                            <div class="passenger-row">
                                <span>Người lớn</span>
                                <div class="passenger-count">
                                    <div class="count-btn" onclick="decrementPassenger('adult', 'roundtrip')">-</div>
                                    <div class="count-value" id="adult-count-roundtrip">1</div>
                                    <div class="count-btn" onclick="incrementPassenger('adult', 'roundtrip')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Trẻ em (2-12 tuổi)</span>
                                <div class="passenger-count">
                                    <div class="count-btn" onclick="decrementPassenger('child', 'roundtrip')">-</div>
                                    <div class="count-value" id="child-count-roundtrip">0</div>
                                    <div class="count-btn" onclick="incrementPassenger('child', 'roundtrip')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Em bé (< 2 tuổi)</span>
                                        <div class="passenger-count">
                                            <div class="count-btn"
                                                onclick="decrementPassenger('infant', 'roundtrip')">-</div>
                                            <div class="count-value" id="infant-count-roundtrip">0</div>
                                            <div class="count-btn"
                                                onclick="incrementPassenger('infant', 'roundtrip')">+</div>
                                        </div>
                            </div>
                        </div>
                        <input type="hidden" name="adults" id="adults-input-roundtrip" value="1">
                        <input type="hidden" name="childrens" id="childrens-input-roundtrip" value="0">
                        <input type="hidden" name="infants" id="infants-input-roundtrip" value="0">
                        <button class="search-btn">TÌM KIẾM</button>
                    </form>
                </div>
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

    <script src="{{ asset('js/roundtrip.js') }}"></script>
</body>

</html>
