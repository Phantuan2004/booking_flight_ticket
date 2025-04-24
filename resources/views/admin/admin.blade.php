<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - SkyTicket</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
        }

        .sidebar {
            width: 220px;
            background-color: var(--primary-color);
            color: white;
            position: fixed;
            height: 100vh;
            padding-top: 20px;
            height: 100%;
        }

        .sidebar .logo {
            text-align: center;
            margin-bottom: 25px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu a {
            display: block;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            transition: all 0.2s;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--secondary-color);
            padding-left: 20px;
        }

        .sidebar-menu i {
            margin-right: 8px;
        }

        .main-content {
            margin-left: 220px;
            padding: 15px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info span {
            margin-right: 15px;
            font-size: 1rem;
            color: var(--primary-color);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .user-info img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .logout-btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 4px;
            margin-left: 12px;
            cursor: pointer;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .card {
            background-color: white;
            border-radius: 6px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card p {
            font-size: 1.19rem;
            margin: 0;
            color: var(--secondary-color);
        }

        .data-table {
            width: 1270px;
            background-color: white;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
        }

        .data-table h3 {
            color: var(--primary-color);
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #eee;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: var(--light-color);
        }

        .action-buttons a,
        .action-buttons button {
            padding: 4px 8px;
            margin-right: 3px;
            border-radius: 4px;
            font-size: 0.85rem;
        }

        .search-box {
            display: flex;
            margin-bottom: 15px;
        }

        .search-box input {
            padding: 6px 12px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
            width: 250px;
        }

        .search-box button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 0 4px 4px 0;
        }

        .add-btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .tabs {
            display: flex;
            margin-bottom: 15px;
            border-bottom: 2px solid #ddd;
        }

        .tab-button {
            position: relative;
            padding: 8px 15px;
            background: none;
            border: none;
            cursor: pointer;
            opacity: 0.7;
        }

        .tab-button.active {
            opacity: 1;
            font-weight: bold;
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--secondary-color);
        }

        .tab-content {
            display: none;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }

        .tab-content.active {
            display: block;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .sidebar-menu span {
                display: none;
            }

            .sidebar .logo h1 {
                font-size: 1rem;
            }

            .main-content {
                margin-left: 60px;
            }
        }
    </style>
    @viteReactRefresh
    @vite('resources/js/app.jsx')
</head>

<body>
    {{-- Scroll to top --}}
    @include('components.scroll-to-top')

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <a href="{{ route('admin') }}" class="text-white text-decoration-none">
                    <h1>SkyTicket</h1>
                </a>
            </div>
            <ul class="sidebar-menu ps-0">
                <li><a href="#" class="active"><i class="bi bi-speedometer2"></i> <span>Tổng quan</span></a></li>
                <li><a href="#airlines"><i class="bi bi-airplane-engines"></i> <span>Hãng bay</span></a></li>
                <li><a href="#flights"><i class="bi bi-airplane"></i> <span>Chuyến bay</span></a></li>
                <li><a href="#management-tickets"><i class="bi bi-ticket-perforated"></i> <span>Vé bay</span></a></li>
                <li><a href="#customers"><i class="bi bi-people"></i> <span>Khách hàng</span></a></li>
                <li><a href="#"><i class="bi bi-percent"></i> <span>Khuyến mãi</span></a></li>
                <li><a href="#"><i class="bi bi-bar-chart"></i> <span>Báo cáo</span></a></li>
                <li><a href="#"><i class="bi bi-gear"></i> <span>Cài đặt</span></a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h2 class="m-0">Bảng điều khiển</h2>
                <div class="user-info">
                    <span>Chào mừng tới trang quản trị SkyJet!!</span>
                    <img src="{{ asset('images/logo/admin-logo.jpg') }}" alt="Admin">
                    <button class="logout-btn">Đăng xuất</button>
                </div>
            </div>

            <!-- Dashboard Cards -->
            <div class="dashboard-cards">
                <div class="card">
                    <h5>Số vé trung bình mỗi chuyến bay</h5>
                    <p class="mb-0">{{ $averageBookings }} vé</p>
                </div>
                <div class="card">
                    <h5>Chuyến bay sắp tới</h5>
                    <p class="mb-0">{{ $upcomingFlights }} chuyến bay</p>
                </div>
                <div class="card">
                    <h5>Chuyến bay có doanh thu cao nhất</h5>
                    <p class="fs-4 mb-0">{{ $highestRevenueFlight->flight_code ?? 'N/A' }}</p>
                    <small>{{ number_format($highestRevenueFlight->bookings_sum_total_price ?? 0, 0, ',', '.') }}
                        VNĐ</small>
                </div>
                <div class="card">
                    <h5>Tỉ lệ đặt vé thành công </h5>
                    <p class="mb-0">{{ $successfulBookings }}%</p>
                </div>
                <div class="card">
                    <h5>Tổng doanh thu</h5>
                    <p class="mb-0">{{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</p>
                </div>
            </div>

            <!-- Airlines Management -->
            <div class="data-table">
                <div id="airlines" class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="m-0">Danh sách hãng bay </h3>
                    <button class="add-btn" type="button" data-bs-toggle="modal" data-bs-target="#addAirlineModal">
                        <i class="bi bi-plus"></i> Thêm hãng bay
                    </button>
                </div>

                <div class="search-box mb-3">
                    <form class="search-flight" action="{{ route('search-airline-admin') }}" method="get">
                        <input type="text" name="{{ $airline_code ?? '' }}" placeholder="Mã hoặc tên hãng bay">
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã hãng bay</th>
                                <th>Hãng bay</th>
                                <th>Logo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $airlineToDisplay = $searchAirline ?? $airlines;
                            @endphp

                            @foreach ($airlineToDisplay as $airline)
                                <tr>
                                    <td>{{ $airline->airline_code }}</td>
                                    <td>{{ $airline->name }}</td>
                                    <td><img src="{{ asset('storage/airline_logos/' . $airline->logo) }}"
                                            alt="{{ $airline->name }}" style="width: 100px; height: 60px;"></td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-sm btn-primary me-1 edit-airline-btn"
                                                data-bs-toggle="modal" data-bs-target="#editAirlineModal"
                                                data-id="{{ $airline->id }}" data-name="{{ $airline->name }}"
                                                data-logo="{{ $airline->logo }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('delete-airline', $airline->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa hãng bay này?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Flight Management -->
            <div class="data-table">
                <div id="flights" class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="m-0">Danh sách chuyến bay</h3>
                    <button class="add-btn" type="button" data-bs-toggle="modal" data-bs-target="#addFlightModal">
                        <i class="bi bi-plus"></i> Thêm chuyến bay
                    </button>
                </div>

                <div class="search-box mb-3">
                    <form class="search-flight" action="{{ route('search-flight-admin') }}" method="get">
                        <input type="text" name="departure" placeholder="Điểm xuất phát">
                        <input type="text" name="destination" placeholder="Điểm đến">
                        <input type="date" name="departure_time" placeholder="Ngày bay">
                        <select name="airline_id" style="width:200px; height: 38px">
                            <option value="">Chọn hãng bay</option>
                            @foreach ($airlines as $airline)
                                <option value="{{ $airline->id }}">{{ $airline->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Hãng bay</th>
                                <th>Mã chuyến</th>
                                <th>Từ/Đến</th>
                                <th>Ngày bay</th>
                                <th>Giờ bay/đến</th>
                                <th>Hạng vé</th>
                                <th>Ghế trống</th>
                                <th>Giá vé</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $flightToDisplay = $searchFlight ?? $flights;
                            @endphp

                            @foreach ($flightToDisplay as $flight)
                                <tr>
                                    <td>{{ $flight->airline->name }}</td>
                                    <td>{{ $flight->flight_code }}</td>
                                    <td>{{ $flight->departure }} → {{ $flight->destination }}</td>
                                    <td>{{ $flight->departure_time }}</td>
                                    <td>{{ $flight->flight_start }} - {{ $flight->flight_end }}</td>
                                    <td>{{ $flight->seat_class }}</td>
                                    <td>{{ $flight->available_seats }}</td>
                                    <td class="text-end">
                                        @if ($flight->seat_class == 'phổ thông')
                                            {{ number_format($flight->price_economy, 0, ',', '.') }} đ
                                        @elseif ($flight->seat_class == 'thương gia')
                                            {{ number_format($flight->price_business, 0, ',', '.') }} đ
                                        @endif
                                    </td>
                                    <td>{{ $flight->status }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal"
                                                data-bs-target="#editFlightModal" data-id="{{ $flight->id }}"
                                                data-flight-code="{{ $flight->flight_code }}"
                                                data-departure="{{ $flight->departure }}"
                                                data-destination="{{ $flight->destination }}"
                                                data-departure-time="{{ \Carbon\Carbon::parse($flight->departure_time)->format('Y-m-d') }}"
                                                data-flight-start="{{ \Carbon\Carbon::parse($flight->flight_start)->format('H:i') }}"
                                                data-flight-end="{{ \Carbon\Carbon::parse($flight->flight_end)->format('H:i') }}"
                                                data-seat_economy="{{ $flight->seat_economy }}"
                                                data-seat_business="{{ $flight->seat_business }}"
                                                data-price-economy="{{ $flight->price_economy }}"
                                                data-price-business="{{ $flight->price_business }}"
                                                data-airline-id="{{ $flight->airline_id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('delete-flight', $flight->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-sm btn-danger" type="submit"
                                                    onclick="deleteFlight({{ $flight->id }})"
                                                    data-id="{{ $flight->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination justify-content-center">
                    {{ $flights->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Booking Management -->
            <div class="data-table">
                <div id="management-tickets" class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="m-0">Quản lý vé</h3>
                </div>

                <div class="search-box mb-3">
                    <input type="text" placeholder="Tìm kiếm khách hàng...">
                    <button><i class="bi bi-search"></i></button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Mã vé</th>
                                <th>Chuyến bay</th>
                                <th>Khách hàng</th>
                                <th>Liên hệ</th>
                                <th>Ngày đặt</th>
                                <th>Giá vé</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->booking_code }}</td>
                                    <td>{{ $booking->flight->flight_code }}</td>
                                    <td>{{ $booking->name }} <span
                                            class="badge bg-secondary">{{ $booking->user ? 'Account' : 'Guest' }}</span>
                                    </td>
                                    <td>
                                        <div style="font-weight: 600; color: rgb(124, 124, 124);">
                                            Phone: {{ $booking->phone }}</div>

                                        <div style="font-weight: 600; color: rgb(124, 124, 124);">Email:
                                            {{ $booking->email }}</div>
                                    </td>
                                    <td>{{ $booking->created_at }}</td>
                                    <td class="text-end">{{ number_format($booking->total_price, 0, ',', '.') }} VNĐ
                                    </td>
                                    <td>{{ $booking->status }}</td>
                                    <td>
                                        <form action="{{ route('cancel-booking', $booking->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Xác nhận hủy vé?')">
                                                <i class="bi bi-x-circle"></i> Hủy
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination justify-content-center">
                    {{ $bookings->links('pagination::bootstrap-4') }}
                </div>
            </div>

            <!-- Management Client -->
            <div class="data-table">
                <div class="tabs">
                    <button class="tab-button active" onclick="openTab('customers')">Quản lý tài khoản </button>
                    <button class="tab-button" onclick="openTab('guests')">Quản lý khách vãng lai (guest) </button>
                </div>

                <!-- Tab nội dung 1: Thông tin khách hàng -->
                <div id="customers" class="tab-content active">
                    <h3>Quản lý tài khoản </h3>
                    <div class="search-box mb-3">
                        <input type="text" placeholder="Tìm kiếm khách hàng...">
                        <button><i class="bi bi-search"></i></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Mã khách hàng </th>
                                    <th>Tên </th>
                                    <th>Liên hệ </th>
                                    <th>Địa chỉ</th>
                                    <th>Ngày đăng ký</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->user_code }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            <div style="font-weight: 600; color: rgb(124, 124, 124);">
                                                Phone: {{ $user->phone }}</div>

                                            <div style="font-weight: 600; color: rgb(124, 124, 124);">Email:
                                                {{ $user->email }}</div>
                                        </td>
                                        <td>{{ $user->address }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>{{ $user->status }}</td>
                                        <td>

                                            <form action="{{ route('delete-user', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Xác nhận hủy tài khoản?')">
                                                    <i class="bi bi-x-circle"></i> Hủy
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination justify-content-center">
                        {{ $users->links('pagination::bootstrap-4') }}
                    </div>
                </div>

                <!-- Tab nội dung 2: Quản lý khách vãng lai -->
                <div id="guests" class="tab-content">
                    <h3>Quản lý thông tin khách vãng lai </h3>
                    <div class="search-box mb-3">
                        <input type="text" placeholder="Tìm kiếm khách hàng...">
                        <button><i class="bi bi-search"></i></button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tên </th>
                                    <th>Liên hệ </th>
                                    <th>Địa chỉ</th>
                                    <th>Số lần đặt vé</th>
                                    <th>Ngày đặt gần đây</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guestUsers as $guest)
                                    <tr>
                                        <td>{{ $guest->name }} <span
                                                class="badge bg-secondary">{{ $guest->user ? 'Account' : 'Guest' }}</span>
                                        </td>
                                        <td>{{ $guest->phone }}<br>{{ $guest->email }}</td>
                                        <td>{{ $guest->address }}</td>
                                        <td>{{ $guest->booking_count }}</td>
                                        <td>{{ $guest->created_at }}</td>
                                        <td>
                                            <form action="{{ route('cancel-booking', $guest->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Xác nhận hủy vé?')">
                                                    <i class="bi bi-x-circle"></i> Hủy
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination justify-content-center">
                        {{ $guestUsers->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Airline Modal -->
    <div class="modal fade" id="addAirlineModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm hãng bay mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addAirlineForm" action="{{ route('add-airline') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tên hãng bay</label>
                            <input type="text" name="name" class="form-control" id="name"
                                placeholder="VD: Vietnam Airlines" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control" id="logo" required>
                            @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Airline Modal -->
    <div class="modal fade" id="editAirlineModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập nhật hãng bay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAirlineForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Tên hãng bay</label>
                            <input type="text" name="name" id="editAirlineName" class="form-control" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            <div class="mb-2">
                                <img id="editAirlineLogoPreview" src="" alt="Current Logo"
                                    style="max-width: 100px; max-height: 60px;">
                            </div>
                            <input type="file" name="logo" class="form-control">
                            <small class="text-muted">Để trống nếu không muốn thay đổi logo</small>
                            @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Flight Modal -->
    <div class="modal fade" id="addFlightModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm chuyến bay mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addFlightForm" action="{{ route('add-flight') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Mã chuyến bay</label>
                            <p class="form-control bg-light">Tự động tạo (VD: VN_12345)</p>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="departure" class="form-label">Điểm đi</label>
                                <input type="text" name="departure" class="form-control" id="departure"
                                    value="{{ old('departure') }}" required>
                                @error('departure')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="destination" class="form-label">Điểm đến</label>
                                <input type="text" name="destination" class="form-control" id="destination"
                                    value="{{ old('destination') }}" required>
                                @error('destination')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="airline_id" class="form-label">Hãng bay</label>
                                <select class="form-select" name="airline_id" id="airline_id" required>
                                    <option value="" selected disabled>Chọn hãng bay</option>
                                    @foreach ($airlines as $airline)
                                        <option value="{{ $airline->id }}"
                                            {{ old('airline_id') == $airline->id ? 'selected' : '' }}>
                                            {{ $airline->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('airline_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="departure_time" class="form-label">Ngày bay</label>
                                <input type="date" name="departure_time" class="form-control" id="departure_time"
                                    value="{{ old('departure_time') }}" min="{{ date('Y-m-d') }}" required>
                                @error('departure_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="flight_start" class="form-label">Giờ bay</label>
                                <input type="time" name="flight_start" class="form-control" id="flight_start"
                                    value="{{ old('flight_start') }}" min="00:00" max="23:59" required>
                                @error('flight_start')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="flight_end" class="form-label">Giờ đến</label>
                                <input type="time" name="flight_end" class="form-control" id="flight_end"
                                    value="{{ old('flight_end') }}" required>
                                @error('flight_end')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hạng vé</label>
                            <select class="form-select" name="seat_class" id="seat_class" required>
                                <option value="" selected disabled>Chọn hạng vé</option>
                                <option value="phổ thông" {{ old('seat_class') == 'phổ thông' ? 'selected' : '' }}>
                                    Phổ
                                    thông</option>
                                <option value="thương gia" {{ old('seat_class') == 'thương gia' ? 'selected' : '' }}>
                                    Thương gia</option>
                            </select>
                        </div>

                        {{--  Thông tin vé phổ thông --}}
                        <div id="economy" class="row mb-3" style="display: none">
                            <div class="col-md-6">
                                <label for="seats" class="form-label">Số ghế</label>
                                <input type="number" name="seat_economy" class="form-control" id="seat_economy"
                                    min="0" value="{{ old('seat_economy') }}" required>
                                @error('seat_economy')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá vé phổ thông (VND)</label>
                                <input type="text" name="price_economy" class="form-control" id="price_economy"
                                    placeholder="Ví dụ: 1200000" value="{{ old('price_economy') }}" required>
                                @error('price_economy')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Thông tin vé thương gia --}}
                        <div id="business" class="row mb-3" style="display: none">
                            <div class="col-md-6">
                                <label for="seats" class="form-label">Số ghế</label>
                                <input type="number" name="seat_business" class="form-control" id="seat_business"
                                    min="0" value="{{ old('seat_business') }}" required>
                                @error('seat_business')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá vé thương gia (VND)</label>
                                <input type="text" name="price_business" class="form-control" id="price_business"
                                    placeholder="Ví dụ: 2400000" value="{{ old('price_business') }}" required>
                                @error('price_business')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Ghi chú</label>
                            <textarea class="form-control" id="notes" rows="2"></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Flight Modal -->
    <div class="modal fade" id="editFlightModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập nhật chuyến bay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editFlightForm" method="POST" action="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="flight_id" id="flight_id">

                        <div class="mb-3">
                            <label class="form-label">Mã chuyến bay</label>
                            <input type="text" name="flight_code" class="form-control bg-light" id="flight-code"
                                readonly>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="departure" class="form-label">Điểm đi</label>
                                <input type="text" name="departure" class="form-control" id="departure" required>
                            </div>
                            <div class="col-md-6">
                                <label for="destination" class="form-label">Điểm đến</label>
                                <input type="text" name="destination" class="form-control" id="destination"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="airline_id" class="form-label">Hãng bay</label>
                                <select class="form-select" name="airline_id" id="airline_id" required>
                                    <option value="">Chọn hãng bay</option>
                                    @foreach ($airlines as $airline)
                                        <option value="{{ $airline->id }}">{{ $airline->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="departure_time" class="form-label">Ngày bay</label>
                                <input type="date" name="departure_time" class="form-control" id="departure_time"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="flight_start" class="form-label">Giờ bay</label>
                                <input type="time" name="flight_start" class="form-control" id="flight_start"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="flight_end" class="form-label">Giờ đến</label>
                                <input type="time" name="flight_end" class="form-control" id="flight_end"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="seats" class="form-label">Số ghế</label>
                                <input type="number" name="seats" class="form-control" id="seats"
                                    min="0" required>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá vé (VND)</label>
                                <input type="text" name="price" class="form-control" id="price" required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit modal functionality
            const editModal = document.getElementById('editFlightModal');
            if (editModal) {
                editModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget; // Button that triggered the modal

                    // Extract info from data-* attributes
                    const flightId = button.getAttribute('data-id');
                    const flightCode = button.getAttribute('data-flight-code');
                    const departure = button.getAttribute('data-departure');
                    const destination = button.getAttribute('data-destination');
                    const departureTime = button.getAttribute('data-departure-time');
                    const flightStart = button.getAttribute('data-flight-start');
                    const flightEnd = button.getAttribute('data-flight-end');
                    const seats = button.getAttribute('data-seats');
                    const seat_economy = button.getAttribute('data-seat-economy');
                    const seat_business = button.getAttribute('data-seat-business');
                    const price = button.getAttribute('data-price');
                    const airlineId = button.getAttribute('data-airline-id');

                    // Update the modal's content
                    const modalForm = document.getElementById('editFlightForm');
                    modalForm.action = '{{ route('edit-flight', ':id') }}'.replace(':id', flightId);

                    // Fill form fields
                    modalForm.querySelector('#flight_id').value = flightId;
                    modalForm.querySelector('#flight-code').value = flightCode;
                    modalForm.querySelector('#departure').value = departure;
                    modalForm.querySelector('#destination').value = destination;
                    modalForm.querySelector('#departure_time').value = departureTime;
                    modalForm.querySelector('#flight_start').value = flightStart;
                    modalForm.querySelector('#flight_end').value = flightEnd;
                    modalForm.querySelector('#seats').value = seats;
                    modalForm.querySelector('#seat_economy').value = seat_economy;
                    modalForm.querySelector('#seat_business').value = seat_business;
                    modalForm.querySelector('#price').value = price;
                    modalForm.querySelector('#airline_id').value = airlineId;
                });
            }

            // Form validation
            const inputs = document.querySelectorAll("input, select");
            inputs.forEach(input => {
                input.addEventListener("blur", function() {
                    if (input.value.trim() === "" && input.hasAttribute('required')) {
                        input.classList.add("is-invalid");
                        const errorDiv = input.nextElementSibling?.classList.contains(
                                "invalid-feedback") ?
                            input.nextElementSibling :
                            document.createElement("div");

                        if (!input.nextElementSibling?.classList.contains("invalid-feedback")) {
                            errorDiv.classList.add("invalid-feedback");
                            input.parentNode.appendChild(errorDiv);
                        }
                        errorDiv.textContent = "Trường này không được để trống";
                    } else {
                        input.classList.remove("is-invalid");
                        if (input.nextElementSibling?.classList.contains("invalid-feedback")) {
                            input.nextElementSibling.textContent = "";
                        }
                    }

                    // Số ghế phổ thông và thương gia không được lớn hơn tổng số ghế, và tổng hai loại ghế phải bằng tổng số ghế
                });
            });
        });
    </script>

    <script>
        function openTab(tabName) {
            // Ẩn tất cả tab content
            var tabContents = document.getElementsByClassName("tab-content");
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove("active");
            }

            // Bỏ active khỏi tất cả các tab button
            var tabButtons = document.getElementsByClassName("tab-button");
            for (var i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove("active");
            }

            // Hiển thị tab được chọn và active button tương ứng
            document.getElementById(tabName).classList.add("active");
            event.currentTarget.classList.add("active");
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let seatClassSelect = document.getElementById("seat_class");
            let economyDiv = document.getElementById("economy");
            let businessDiv = document.getElementById("business");
            let economyInputs = economyDiv.querySelectorAll("input");
            let businessInputs = businessDiv.querySelectorAll("input");

            function toggleSeatClass() {
                let selectedClass = seatClassSelect.value;

                if (selectedClass === "phổ thông") {
                    economyDiv.style.display = "flex";
                    businessDiv.style.display = "none";
                    enableInputs(economyInputs);
                    disableInputs(businessInputs);
                } else if (selectedClass === "thương gia") {
                    economyDiv.style.display = "none";
                    businessDiv.style.display = "flex";
                    enableInputs(businessInputs);
                    disableInputs(economyInputs);
                } else {
                    economyDiv.style.display = "none";
                    businessDiv.style.display = "none";
                    disableInputs(economyInputs);
                    disableInputs(businessInputs);
                }
            }

            function disableInputs(inputs) {
                inputs.forEach(input => input.setAttribute("disabled", "disabled"));
            }

            function enableInputs(inputs) {
                inputs.forEach(input => input.removeAttribute("disabled"));
            }

            // Gọi khi tải trang để giữ trạng thái đúng
            toggleSeatClass();

            // Bắt sự kiện khi chọn hạng vé
            seatClassSelect.addEventListener("change", toggleSeatClass);
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-airline-btn');
            const form = document.getElementById('editAirlineForm');
            const nameInput = document.getElementById('editAirlineName');
            const logoPreview = document.getElementById('editAirlineLogoPreview');

            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const name = this.dataset.name;
                    const logo = this.dataset.logo;

                    // Set form action
                    form.action = `/admin/update-airline/${id}`;

                    // Set input value
                    nameInput.value = name;

                    // Set logo preview
                    if (logo) {
                        logoPreview.src = `{{ asset('storage/airline_logos') }}/${logo}`;
                        logoPreview.style.display = 'block';
                    } else {
                        logoPreview.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>
