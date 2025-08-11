<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SkyJet - Tìm kiếm chuyến bay</title>
    <link rel="stylesheet" href="{{ asset('css/oneway.css') }}">
</head>

<body>
    {{-- Scroll to top --}}
    @include('components.scroll-to-top')

    {{-- Header --}}
    @include('components.header')

    <div class="page-title">
        <div class="container">
            <h1>Kết Quả Tìm Kiếm Chuyến Bay</h1>
        </div>
    </div>

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

    <div class="container">
        <div class="booking-content">
            <div class="flight-selection">
                <div class="filter-panel">
                    <h2 class="filter-title">Lọc Kết Quả</h2>

                    <div class="filter-group">
                        <form action="{{ route('flight-search-oneway') }}" method="GET">
                            <!-- Giữ tất cả các tham số tìm kiếm khác -->
                            <input type="hidden" name="departure" value="{{ request('departure') }}">
                            <input type="hidden" name="destination" value="{{ request('destination') }}">
                            <input type="hidden" name="departure_time" value="{{ request('departure_time') }}">
                            <input type="hidden" name="adults" value="{{ request('adults') }}">
                            <input type="hidden" name="childrens" value="{{ request('childrens') }}">
                            <input type="hidden" name="infants" value="{{ request('infants') }}">

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
                                <!-- Other filter fields -->
                                <div class="filter-group">
                                    <label>Giá</label>
                                    <select name="sort">
                                        <option value="">Tất cả</option>
                                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Tăng
                                            dần</option>
                                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>
                                            Giảm dần</option>
                                    </select>
                                </div>
                                <!-- Other filter fields -->
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
                            <button type="submit" class="filter-btn">Áp Dụng</button>
                        </form>
                    </div>
                </div>

                <div class="flight-list">
                    @if ($flights->isEmpty())
                        <h2 style="text-align: center; color: red;">Không tìm thấy chuyến bay phù hợp, vui lòng chọn
                            chuyến bay khác!</h2>
                    @else
                        @foreach ($flights as $flight)
                            <div class="flight-card">
                                <div class="airline-logo">
                                    <img
                                        src="{{ asset('storage/airline_logos/' . $flight->airline->logo) }}"
                                        alt="Airline Logo" width="70px" height="70px"
                                    />
                                </div>
                                <div class="flight-code">{{ $flight->flight_code }}</div>
                                <div class="flight-time">{{ $flight->flight_start }}</div>
                                <div class="airline-name">{{ $flight->airline->name }}</div>
                                <!-- Thêm nút hiển thị chi tiết -->
                                <button class="toggle-details-btn" onclick="toggleDetails({{ $flight->id }})">
                                    Hiển thị chi tiết
                                </button>

                                <div class="flight-details">
                                    <div class="price">
                                        @if ($flight->seat_class == 'phổ thông')
                                            {{ number_format($flight->price_economy, 0, ',', '.') }} VNĐ
                                        @else
                                            {{ number_format($flight->price_business, 0, ',', '.') }} VNĐ
                                        @endif
                                    </div>
                                    <form action="{{ route('confirm') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="flight_id" value="{{ $flight->id }}">
                                        <input type="hidden" name="departure" value="{{ $flight->departure }}">
                                        <input type="hidden" name="destination" value="{{ $flight->destination }}">
                                        <input type="hidden" name="departure_time"
                                            value="{{ $flight->departure_time }}">
                                        <input type="hidden" name="price"
                                            value="@if ($flight->seat_class === 'phổ thông') {{ $flight->price_economy }} @else {{ $flight->price_business }} @endif">
                                        <input type="hidden" name="adults" value="{{ $adults }}">
                                        <input type="hidden" name="childrens" value="{{ $childrens }}">
                                        <input type="hidden" name="infants" value="{{ $infants }}">
                                        @if ($flight->seat_class === 'phổ thông')
                                            <button class="select-btn" type="submit">Chọn vé phổ thông</button>
                                        @elseif ($flight->seat_class === 'thương gia')
                                            <button class="select-btn" type="submit">Chọn vé thương gia</button>
                                        @endif
                                    </form>
                                </div>
                            </div>

                            <!-- Thêm phần chi tiết ẩn ngay sau mỗi flight-card -->
                            <div id="details-{{ $flight->id }}" class="flight-details-container"
                                style="display: none;">
                                <div class="flight-details-content">
                                    <table class="details-table">
                                        <tr>
                                            <th colspan="2">Chi tiết chuyến bay</th>
                                        </tr>
                                        <tr>
                                            <td>Mã chuyến bay:</td>
                                            <td>{{ $flight->flight_code ?? 'VN' . rand(1000, 9999) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Ngày bay:</td>
                                            <td>
                                                @if ($flight->departure_time instanceof \DateTime)
                                                    {{ $flight->departure_time->format('d/m/Y') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($flight->departure_time)->format('d/m/Y') }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Giờ bay:</td>
                                            <td>
                                                @if ($flight->flight_start instanceof \DateTime)
                                                    {{ $flight->flight_start->format('H:i') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($flight->flight_start)->format('H:i') }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Giờ đến: (dự kiến)</td>
                                            <td>
                                                @if ($flight->flight_end instanceof \DateTime)
                                                    {{ $flight->flight_end->format('H:i') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($flight->flight_end)->format('H:i') }}
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hãng bay: </td>
                                            <td>{{ $flight->airline->name ?? 'Vietnam Airlines' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Loại máy bay:</td>
                                            <td>{{ $flight->aircraft_type ?? 'Airbus A' . rand(300, 380) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hạng vé:</td>
                                            <td>{{ ucfirst($flight->seat_class) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hành lý xách tay:</td>
                                            <td>{{ $flight->seat_class === 'thương gia' ? '12kg' : '7kg' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Hành lý ký gửi:</td>
                                            <td>{{ $flight->seat_class === 'thương gia' ? '40kg' : '20kg' }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
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
                                    <div class="count-btn" onclick="decrementPassenger('adult', 'oneway')">-</div>
                                    <div class="count-value" id="adult-count-oneway">1</div>
                                    <div class="count-btn" onclick="incrementPassenger('adult', 'oneway')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Trẻ em (2-12 tuổi)</span>
                                <div class="passenger-count">
                                    <div class="count-btn" onclick="decrementPassenger('child', 'oneway')">-</div>
                                    <div class="count-value" id="child-count-oneway">0</div>
                                    <div class="count-btn" onclick="incrementPassenger('child', 'oneway')">+</div>
                                </div>
                            </div>
                            <div class="passenger-row">
                                <span>Em bé (< 2 tuổi)</span>
                                        <div class="passenger-count">
                                            <div class="count-btn" onclick="decrementPassenger('infant', 'oneway')">-
                                            </div>
                                            <div class="count-value" id="infant-count-oneway">0</div>
                                            <div class="count-btn" onclick="incrementPassenger('infant', 'oneway')">+
                                            </div>
                                        </div>
                            </div>
                        </div>
                        <input type="hidden" name="adults" id="adults-input-oneway" value="1">
                        <input type="hidden" name="childrens" id="childrens-input-oneway" value="0">
                        <input type="hidden" name="infants" id="infants-input-oneway" value="0">
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

    <script src="{{ asset('js/oneway.js') }}"></script>
</body>

</html>
