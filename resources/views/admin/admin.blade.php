<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Quản lý Vé Máy Bay</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }

        body {
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            height: 100vh;
            position: fixed;
        }

        .logo {
            text-align: center;
            padding: 10px 20px;
            margin-bottom: 30px;
        }

        .logo img {
            height: 60px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s;
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: var(--secondary-color);
            padding-left: 25px;
        }

        .sidebar-menu i {
            margin-right: 10px;
        }

        /* Main content styles */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header h2 {
            color: var(--dark-color);
        }

        .user-info {
            display: flex;
            align-items: center;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .logout-btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            margin-left: 15px;
            cursor: pointer;
        }

        /* Dashboard cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            z-index: -2;
        }

        .card h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .card p {
            font-size: 24px;
            font-weight: bold;
            color: var(--secondary-color);
        }

        /* Table styles */
        .data-table {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }

        .data-table h3 {
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: var(--light-color);
            color: var(--dark-color);
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .action-buttons a {
            display: inline-block;
            padding: 6px 12px;
            margin-right: 5px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
        }

        .edit-btn {
            background-color: var(--secondary-color);
        }

        .delete-btn {
            background-color: var(--accent-color);
        }

        /* Form styles */
        .form-controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-box {
            display: flex;
        }

        .search-box input {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
            width: 300px;
        }

        .search-box button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
        }

        .add-btn {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 12px;
            margin: 0 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-decoration: none;
            color: var(--dark-color);
        }

        .pagination a.active {
            background-color: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-danger {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .modal-header {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-close {
            filter: brightness(0) invert(1);
        }
    </style>

    @viteReactRefresh
    @vite('resources/js/app.jsx')
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h1>SkyTicket</h1>
        </div>
        <ul class="sidebar-menu">
            <li><a href="#" class="active">Tổng quan</a></li>
            <li><a href="#">Quản lý chuyến bay</a></li>
            <li><a href="#">Quản lý vé</a></li>
            <li><a href="#">Quản lý khách hàng</a></li>
            <li><a href="#">Quản lý khuyến mãi</a></li>
            <li><a href="#">Báo cáo & Thống kê</a></li>
            <li><a href="#">Cài đặt hệ thống</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h2>Bảng điều khiển</h2>
            <div class="user-info">
                <img src="/api/placeholder/40/40" alt="Admin">
                <span>Admin</span>
                <button class="logout-btn">Đăng xuất</button>
            </div>
        </div>



        <!-- Dashboard Cards -->
        <div class="dashboard-cards">
            <div class="card">
                <h3>Tổng chuyến bay</h3>
                <p>{{$totalFlights}}</p>
            </div>
            <div class="card">
                <h3>Vé đã bán</h3>
                <p>{{$totalBookings}}</p>
            </div>
            <div class="card">
                <h3>Tổng doanh thu</h3>
                <p>{{$totalRevenue}}</p>
            </div>
            <div class="card">
                <h3>Khách hàng mới</h3>
                <p>12</p>
            </div>
        </div>

        <div class="data-table">
            <h3>Danh sách chuyến bay</h3>
            <div class="form-controls">
                <div class="search-box">
                    <input type="text" placeholder="Tìm kiếm chuyến bay...">
                    <button>Tìm</button>
                </div>
                <button class="add-btn" type="button" data-bs-toggle="modal" data-bs-target="#addFlightModal">+ Thêm chuyến bay</button>
                <!-- Bootstrap Modal -->
                <div class="modal fade" id="addFlightModal" tabindex="-1" aria-labelledby="addFlightModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addFlightModalLabel">Thêm chuyến bay mới</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addFlightForm" action="{{ route('add-flight') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="flight-code" class="form-label">Mã chuyến bay</label>
                                        <p class="form-control" style="background-color: beige">Tự động tạo (VD: VN_12345)</p>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="departure" class="form-label">Điểm đi</label>
                                            <input type="text" name="departure" class="form-control" id="departure" value="{{ old('departure') }}">
                                            @error('departure')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="destination" class="form-label">Điểm đến</label>
                                            <input type="text" name="destination" class="form-control" id="destination" value="{{ old('destination') }}">
                                            @error('destination')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="airline_id" class="form-label">Hãng bay</label>
                                            <select class="form-select" name="airline_id" id="airline_id">
                                                <option value="" selected disabled>Chọn hãng bay</option>
                                                @foreach($airlines as $airline)
                                                    <option value="{{ $airline->id }}" {{ old('airline_id') == $airline->id ? 'selected' : '' }}>
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
                                            <input type="date" name="departure_time" class="form-control" id="departure_time" value="{{ old('departure_time') }}">
                                            @error('departure_time')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="flight_start" class="form-label">Giờ bay</label>
                                            <input type="time" name="flight_start" class="form-control" id="flight_start" value="{{ old('flight_start') }}">
                                            @error('flight_start')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="flight_end" class="form-label">Giờ đến dự kiến</label>
                                            <input type="time" name="flight_end" class="form-control" id="flight_end" value="{{ old('flight_end') }}">
                                            @error('flight_end')
                                            <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="economy-seats" class="form-label">Số ghế hạng phổ thông</label>
                                            <input type="number" name="seats" class="form-control" id="economy-seats" min="0" value="{{ old('seats') }}">
                                            @error('seats')
                                            <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{--                                        <div class="col-md-6">--}}
                                        {{--                                            <label for="business-seats" class="form-label">Số ghế hạng thương gia</label>--}}
                                        {{--                                            <input type="number" class="form-control" id="business-seats" min="0">--}}
                                        {{--                                        </div>--}}
                                    </div>

                                    <div class="mb-3">
                                        <label for="base-price" class="form-label">Giá vé phổ thông (VND)</label>
                                        <div class="input-group">
                                            <input type="text" name="price" class="form-control" id="base-price" min="0" step="10000" placeholder="Ví dụ: 1200000" value="{{ old('price') }}">
                                            <span class="input-group-text">VND</span>
                                            @error('price')
                                            <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{--                                    <div class="mb-3">--}}
                                    {{--                                        <label for="base-price" class="form-label">Giá vé thương gia (VND)</label>--}}
                                    {{--                                        <div class="input-group">--}}
                                    {{--                                            <input type="number" class="form-control" id="base-price" min="0" step="10000" placeholder="Ví dụ: 1200000">--}}
                                    {{--                                            <span class="input-group-text">VND</span>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}

                                    <div class="mb-3">
                                        <label for="notes" class="form-label">Ghi chú</label>
                                        <textarea class="form-control" id="notes" rows="3"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <table>
                <thead>
                <tr>
                    <th>Hãng bay</th>
                    <th>Mã chuyến</th>
                    <th>Từ</th>
                    <th>Đến</th>
                    <th>Ngày bay</th>
                    <th>Thời gian bay</th>
                    <th>Thời gian hạ cánh </th>
                    <th>Gía vé</th>
                    <th>Tổng ghế</th>
                    <th>Ghế có sẵn</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($flights as $flight)
                    <tr>
                        <td>{{$flight->airline->name}}</td>
                        <td>{{$flight->flight_code}}</td>
                        <td>{{$flight->departure}}</td>
                        <td>{{$flight->destination}}</td>
                        <td>{{$flight->departure_time}}</td>
                        <td>{{$flight->flight_start}}</td>
                        <td>{{$flight->flight_end}}</td>
                        <td>{{$flight->price}}0 VNĐ</td>
                        <td>{{$flight->seats}}</td>
                        <td>{{$flight->available_seats}}</td>
                        <td>{{$flight->status}}</td>
                        <td class="action-buttons">
                            <button type="button" class="btn btn-primary edit-flight-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editFlightModal"
                                    data-id="{{$flight->id}}"
                                    data-flight-code="{{$flight->flight_code}}"
                                    data-departure="{{$flight->departure}}"
                                    data-destination="{{$flight->destination}}"
                                    data-departure-time="{{ \Carbon\Carbon::parse($flight->departure_time)->format('Y-m-d') }}"
                                    data-flight-start="{{ \Carbon\Carbon::parse($flight->flight_start)->format('H:i') }}"
                                    data-flight-end="{{ \Carbon\Carbon::parse($flight->flight_end)->format('H:i') }}"
                                    data-seats="{{$flight->seats}}"
                                    data-price="{{$flight->price}}"
                                    data-airline-id="{{$flight->airline_id}}">Sửa</button>

                            <form action="{{route('delete-flight', $flight->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit" onclick="return confirm('Xác nhận xóa bỏ??')">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <!-- Modal duy nhất -->
                <div class="modal fade" id="editFlightModal" tabindex="-1" aria-labelledby="editFlightModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editFlightModalLabel">Cập nhật chuyến bay</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editFlightForm" method="POST" action="">
                                    @csrf
                                    @method('PUT')
                                    <!-- Input ẩn để lưu flight ID -->
                                    <input type="hidden" name="flight_id" id="flight_id">

                                    <div class="mb-3">
                                        <label for="flight-code" class="form-label">Mã chuyến bay</label>
                                        <input type="text" name="flight_code" class="form-control" id="flight-code" readonly style="background-color: beige">
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="departure" class="form-label">Điểm đi</label>
                                            <input type="text" name="departure" class="form-control" id="departure">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="destination" class="form-label">Điểm đến</label>
                                            <input type="text" name="destination" class="form-control" id="destination">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="airline_id" class="form-label">Hãng bay</label>
                                            <select class="form-select" name="airline_id" id="airline_id">
                                                <option value="" selected disabled>Chọn hãng bay</option>
                                                @foreach($airlines as $airline)
                                                    <option value="{{ $airline->id }}">{{ $airline->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="departure_time" class="form-label">Ngày bay</label>
                                            <input type="date" name="departure_time" class="form-control" id="departure_time">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="flight_start" class="form-label">Giờ bay</label>
                                            <input type="time" name="flight_start" class="form-control" id="flight_start">
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="flight_end" class="form-label">Giờ đến dự kiến</label>
                                            <input type="time" name="flight_end" class="form-control" id="flight_end">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="seats" class="form-label">Số ghế hạng phổ thông</label>
                                            <input type="number" name="seats" class="form-control" id="seats" min="0">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Giá vé phổ thông (VND)</label>
                                        <div class="input-group">
                                            <input type="text" name="price" class="form-control" id="price" min="0" step="10000">
                                            <span class="input-group-text">VND</span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                                <button type="submit" form="editFlightForm" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>

                </tbody>
            </table>
            <div class="pagination">
                {{ $flights->appends(['page_flights' => request('page_flights')])->links('pagination::bootstrap-4') }}
            </div>
        </div>

        <!-- Bảng quản lý chuyến bay -->
        <div class="data-table">
            <h3>Vé đã bán gần đây</h3>
            <div class="form-controls">
                <div class="search-box">
                    <input type="text" placeholder="Tìm kiếm vé...">
                    <button>Tìm</button>
                </div>
            </div>
            <table>
                <thead>
                <tr>
                    <th>Mã vé</th>
                    <th>Chuyến bay</th>
                    <th>Account</th>
                    <th>Người đặt</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Ngày đặt</th>
                    <th>Giá vé</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{$booking->booking_code}}</td>
                        <td>{{$booking->flight->flight_code}}</td>
                        <td>{{$booking->user ? 'Yes' : 'No' }}</td>
                        <td>{{$booking->name}}</td>
                        <td>{{$booking->phone}}</td>
                        <td>{{$booking->email}}</td>
                        <td>{{$booking->created_at}}</td>
                        <td>{{$booking->total_price}}</td>
                        <td>{{$booking->status}}</td>
                        <td class="action-buttons">
                            <form action="{{route('cancel-booking', $booking->id)}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Xác nhận hủy vé??')">Hủy vé</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $bookings->appends(['page_bookings' => request('page_bookings')])->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
</body>
<!-- Bootstrap JS and Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let inputs = document.querySelectorAll("input, select");

        inputs.forEach(input => {
            input.addEventListener("blur", function () {
                if (input.value.trim() === "") {
                    input.classList.add("is-invalid");
                    showError(input, "Trường này không được để trống");
                } else {
                    input.classList.remove("is-invalid");
                    hideError(input);
                }
            });
        });

        function showError(input, message) {
            let errorDiv = input.nextElementSibling;
            if (!errorDiv || !errorDiv.classList.contains("invalid-feedback")) {
                errorDiv = document.createElement("div");
                errorDiv.classList.add("invalid-feedback");
                input.parentNode.appendChild(errorDiv);
            }
            errorDiv.textContent = message;
        }

        function hideError(input) {
            let errorDiv = input.nextElementSibling;
            if (errorDiv && errorDiv.classList.contains("invalid-feedback")) {
                errorDiv.textContent = "";
            }
        }
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editModal = document.getElementById('editFlightModal');

        editModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; // Nút đã kích hoạt modal

            // Lấy dữ liệu từ data attributes
            const flightId = button.getAttribute('data-id');
            const flightCode = button.getAttribute('data-flight-code');
            const departure = button.getAttribute('data-departure');
            const destination = button.getAttribute('data-destination');
            const departureTime = button.getAttribute('data-departure-time');
            const flightStart = button.getAttribute('data-flight-start');
            const flightEnd = button.getAttribute('data-flight-end');
            const seats = button.getAttribute('data-seats');
            const price = button.getAttribute('data-price');
            const airlineId = button.getAttribute('data-airline-id');

            // Cập nhật action của form
            document.getElementById('editFlightForm').action =
                '{{ route("edit-flight", ":id") }}'.replace(':id', flightId);

            // Điền dữ liệu vào các trường
            document.getElementById('flight_id').value = flightId || '';
            document.getElementById('flight-code').value = flightCode || '';
            document.getElementById('departure').value = departure || '';
            document.getElementById('destination').value = destination || '';
            document.getElementById('departure_time').value = departureTime || '';
            document.getElementById('flight_start').value = flightStart || '';
            document.getElementById('flight_end').value = flightEnd || '';
            document.getElementById('seats').value = seats || '';
            document.getElementById('price').value = price || '';
            document.getElementById('airline_id').value = airlineId || '';
        });
    });
</script>
</html>
