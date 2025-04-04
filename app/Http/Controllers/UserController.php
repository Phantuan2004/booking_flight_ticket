<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Booking;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Hiển thị giao diện trang chủ
    public function index() {
        // Hiển thị 3 chuyến bay ngẫu nhiên ra trang chủ
        $flights = Flight::all()->random(3);
        return view('index', compact('flights'));
    }

    // Phưởng thức tìm kiếm chuyến bay và giao diện kết quả tìm kiếm trang đặt vé
    public function search_flights(Request $request) {
        $departure = $request->input('departure');
        $destination = $request->input('destination');
        $departure_time = $request->input('departure_time');
        $passengers = (int) $request->input('passengers', 0);
        $childrens = (int) $request->input('childrens', 0);

        $flights = Flight::query()
            ->where('departure', 'like', "%$departure%")
            ->where('destination', 'like', "%$destination%")
            ->whereDate('departure_time', $departure_time)
            ->where('available_seats', '>=', $passengers)
            ->get();

        // Lưu thông tin vào session
        session([
            'search_data' => [
                'departure' => $departure,
                'destination' => $destination,
                'departure_time' => $departure_time,
                'passengers' => $passengers,
                'childrens' => $childrens
            ]
        ]);

        return view('datve', compact('flights', 'passengers', 'childrens'));
    }

    // Hiển thị giao diện trang xác nhận
    public function xacnhan(Request $request) {
        $flight = Flight::find($request->input('flight_id'));

        if (!$flight) {
            return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
        }

        // Lấy dữ liệu từ form - đảm bảo lấy đúng định dạng mảng
        $passengers = $request->input('passengers', []);
        $childrens = $request->input('childrens', []);
        $full_name = $request->input('full_name', '');
        $phone = $request->input('phone', '');
        $email = $request->input('email', '');

        $full_name = is_array($full_name) ? implode(' ', array_filter((array)$full_name, 'is_string')) : (string)$full_name;
        $phone = is_array($phone) ? implode(' ', array_filter((array)$phone, 'is_string')) : (string)$phone;
        $email = is_array($email) ? implode(' ', array_filter((array)$email, 'is_string')) : (string)$email;

        // Lưu thông tin vào session đúng cách
        session([
            'passengers' => is_array($passengers) ? $passengers : [],
            'childrens' => is_array($childrens) ? $childrens : [],
            'full_name' => is_array($full_name) ? implode(' ', $full_name) : strval($full_name),
            'phone' => is_array($phone) ? implode(' ', $phone) : strval($phone),
            'email' => is_array($email) ? implode(' ', $email) : strval($email),
        ]);

        // Xử lý thời gian bay
        $departureTime = Carbon::parse($flight->departure_time);
        $flightStart = Carbon::parse($flight->flight_start);
        $flightEnd = Carbon::parse($flight->flight_end);
        $hour = $flightStart->hour;
        $minute = $flightStart->minute;
        $hourArrival = $flightEnd->hour;
        $minuteArrival = $flightEnd->minute;
        $day = $departureTime->day;
        $month = $departureTime->month;
        $year = $departureTime->year;

        return view('xacnhan', compact(
            'flight', 'passengers', 'childrens', 'full_name', 'phone', 'email',
            'hour', 'hourArrival', 'minute', 'minuteArrival', 'day', 'month', 'year'
        ));
    }

    // Hiển thị giao diện trang thanh toán
    public function thanhtoan(Request $request) {
        $flight = Flight::find($request->input('flight_id'));

        if (!$flight) {
            return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
        }

        $passengers = $request->input('passengers') ?? session('passengers', []);
        $childrens = $request->input('childrens') ?? session('childrens', []);
        $full_name = $request->input('full_name') ?? session('full_name', '');
        $phone = $request->input('phone') ?? session('phone', '');
        $email = $request->input('email') ?? session('email', '');

        $full_name = is_array($full_name) ? implode(' ', array_filter((array)$full_name, 'is_string')) : (string)$full_name;
        $phone = is_array($phone) ? implode(' ', array_filter((array)$phone, 'is_string')) : (string)$phone;
        $email = is_array($email) ? implode(' ', array_filter((array)$email, 'is_string')) : (string)$email;

        $departureTime = Carbon::parse($flight->departure_time);
        $arrivalTime = Carbon::parse($flight->arrival_time);
        $hour = $departureTime->hour;
        $minute = $departureTime->minute;
        $hourArrival = $arrivalTime->hour;
        $minuteArrival = $arrivalTime->minute;
        $day = $departureTime->day;
        $month = $departureTime->month;
        $year = $departureTime->year;

        return view('thanhtoan', compact(
            'flight', 'passengers', 'childrens', 'full_name', 'phone', 'email',
            'hour', 'hourArrival', 'minute', 'minuteArrival', 'day', 'month', 'year'
        ));
    }


    public function thanhcong(Request $request) {
        $flight = Flight::find($request->input('flight_id'));

        if (!$flight) {
            return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
        }

        $passenger_count = $request->input('passenger_count', 0);
        $children_count = $request->input('children_count', 0);
        $total_passengers = $passenger_count + $children_count;

        $passengers = json_decode($request->input('passengers_data', '[]'), true) ?? [];
        $childrens = json_decode($request->input('childrens_data', '[]'), true) ?? [];

        $booking_code = "SK_" . rand(10000, 99999);

        $full_name = $request->input('full_name') ?? session('full_name', '');
        $phone = $request->input('phone') ?? session('phone', '');
        $email = $request->input('email') ?? session('email', '');

        $full_name = is_array($full_name) ? implode(' ', array_filter((array)$full_name, 'is_string')) : (string)$full_name;
        $phone = is_array($phone) ? implode(' ', array_filter((array)$phone, 'is_string')) : (string)$phone;
        $email = is_array($email) ? implode(' ', array_filter((array)$email, 'is_string')) : (string)$email;

        $departureTime = Carbon::parse($flight->departure_time);
        $arrivalTime = Carbon::parse($flight->arrival_time);
        $hour = $departureTime->hour;
        $minute = $departureTime->minute;
        $hourArrival = $arrivalTime->hour;
        $minuteArrival = $arrivalTime->minute;
        $day = $departureTime->day;
        $month = $departureTime->month;
        $year = $departureTime->year;

        // Tổng giá
        $totalPrice = $flight->price * (is_array($passengers) ? count($passengers) : 0) + $flight->price * (is_array($childrens) ? count($childrens) : 0) + 50.0 + 20.0;

        // Check người dùng có tài khoản
        if (auth()->check()) {
            $user = auth()->user();
            $data = [
                'booking_code' => $booking_code,
                'user_id' => $user->id,
                'name' => $full_name,
                'phone' => $phone,
                'email' => $email,
                'flight_id' => $flight->id,
                'total_price' => $totalPrice,
                'created_at' => now(),
                'updated_at' => now()
            ];
        } else {
            // Nếu không có tài khoản thì lưu thông tin người dùng vào bảng bookings
            $data = [
                'booking_code' => $booking_code,
                'user_id' => null,
                'flight_id' => $flight->id,
                'name' => $full_name,
                'phone' => $phone,
                'email' => $email,
                'total_price' => $totalPrice,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Booking::create($data);

        // Trừ số ghế trên database tương ứng với tổng số hành khách đặt vé bay
        $flight->available_seats -= $total_passengers;
        $flight->save();

        return view('thanhcong', compact(
            'flight', 'passengers', 'childrens', 'total_passengers', 'booking_code',
            'hour', 'hourArrival', 'minute', 'minuteArrival', 'day', 'month', 'year',
            'full_name', 'phone', 'email'
        ));
    }

    // Hiển thị giao diện trang liên hẹ
    public function lienhe() {
        return view('lienhe');
    }

    // Hiển thị danh sách chuyến bay
    public function flights() {
        $flights = Flight::all();
        return view('index', compact('flights'));
    }

    // Hiển thị chi tiết chuyến bay
    public function flight_detail(Flight $id) {
        $show = Flight::query()->find($id);
        return view('index', compact('show'));
    }

    // Hiển thị kết quả tìm kiếm
    public function search(Request $request) {
        $search = $request->search;
        $flights = Flight::query()->where('name', 'like', "%$search%")->get();
        return view('index', compact('flights'));
    }

    // Hiển thị hãng bay
    public function airlines() {
        $airlines = Airline::all();
        return view('index', compact('airlines'));
    }

    // Thêm chuyến bay vào lựa chọn
    public function add_flight(Request $request) {
        $flight = Flight::query()->find($request->flight_id);
        $user = auth()->user();
        $user->flights()->attach($flight);
        return redirect()->back();
    }
}
