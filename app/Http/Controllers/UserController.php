<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirm;
use App\Models\Airline;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Guest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // Hiển thị giao diện trang chủ
    public function index()
    {
        $flights = Flight::all();
        return view('index', compact('flights'));
    }

    // Phưởng thức tìm kiếm chuyến bay một chiều
    public function search_flights_oneway(Request $request)
    {
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

        // Định dạng hiển thị giá tiền
        foreach ($flights as $flight) {
            $flight->formatted_price = number_format($flight->price, 0, ',', '.') . ' VNĐ';
        }
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

        return view('datve_motchieu', compact('flights', 'passengers', 'childrens'));
    }

    // Phương thức tìm kiếm chuyến bay khứ hồi
    public function search_flights_roundtrip(Request $request)
    {
        $flights = Flight::all();
        $departure = $request->input('departure');
        $destination = $request->input('destination');
        $departure_time = $request->input('departure_time');
        $return_time = $request->input('return_time');
        $adults = (int) $request->input('adults', 0);
        $childrens = (int) $request->input('childrens', 0);
        $infants = (int) $request->input('infants', 0);
        $total_passengers = $adults + $childrens + $infants;

        $outboundFlights = Flight::query()
            ->where('departure', 'like', "%$departure%")
            ->where('destination', 'like', "%$destination%")
            ->whereDate('departure_time', $departure_time)
            ->where('available_seats', '>=', $total_passengers)
            ->get();

        $returnFlights = Flight::query()
            ->where('departure', 'like', "%$destination%")
            ->where('destination', 'like', "%$departure%")
            ->whereDate('departure_time', $return_time)
            ->where('available_seats', '>=', $total_passengers)
            ->get();

        // Định dạng hiển thị giá tiền
        foreach ($outboundFlights as $flight) {
            $flight->formatted_price = number_format($flight->price, 0, ',', '.') . ' VNĐ';
        }
        foreach ($returnFlights as $flight) {
            $flight->formatted_price = number_format($flight->price, 0, ',', '.') . ' VNĐ';
        }

        // Lưu thông tin vào session
        session([
            'search_data' => [
                'departure' => $departure,
                'destination' => $destination,
                'departure_time' => $departure_time,
                'return_time' => $return_time,
                'adults' => $adults,
                'childrens' => $childrens,
                'infants' => $infants
            ]
        ]);
        return view('datve_khuhoi', compact('flights', 'outboundFlights', 'returnFlights', 'adults', 'childrens', 'infants'));
    }

    // Hiển thị giao diện trang xác nhận
    public function xacnhan(Request $request)
    {
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
        $address = $request->input('address', '');

        $full_name = is_array($full_name) ? implode(' ', array_filter((array)$full_name, 'is_string')) : (string)$full_name;
        $phone = is_array($phone) ? implode(' ', array_filter((array)$phone, 'is_string')) : (string)$phone;
        $email = is_array($email) ? implode(' ', array_filter((array)$email, 'is_string')) : (string)$email;
        $address = is_array($address) ? implode(' ', array_filter((array)$address, 'is_string')) : (string)$address;

        // Lưu thông tin vào session đúng cách
        session([
            'passengers' => is_array($passengers) ? $passengers : [],
            'childrens' => is_array($childrens) ? $childrens : [],
            'full_name' => is_array($full_name) ? implode(' ', $full_name) : strval($full_name),
            'phone' => is_array($phone) ? implode(' ', $phone) : strval($phone),
            'email' => is_array($email) ? implode(' ', $email) : strval($email),
            'address' => is_array($address) ? implode(' ', $address) : strval($address)
        ]);

        // Xử lý giá tiền
        $adult_price = $flight->price * $passengers;
        $child_price = $flight->price * $childrens * 0.5;
        $tax_fee = 50000;
        $service_fee = 20000;
        $total_price = $adult_price + $child_price + $tax_fee + $service_fee;

        // Xử lý thời gian bay
        $departureTime = Carbon::parse($flight->departure_time);
        $flightStart = Carbon::parse($flight->flight_start);
        $flightEnd = Carbon::parse($flight->flight_end);

        // Lấy giờ và phút dưới dạng chuỗi định dạng sẵn
        $flightStartTime = $flightStart->format('H:i');  // Ví dụ: 14:30
        $flightEndTime = $flightEnd->format('H:i');      // Ví dụ: 16:40
        $departureDate = $departureTime->format('d/m/Y'); // Ví dụ: 05/04/2024

        // Tính thời gian bay
        $duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');

        return view('xacnhan', compact(
            'flight',
            'passengers',
            'childrens',
            'full_name',
            'phone',
            'email',
            'address',
            'adult_price',
            'child_price',
            'tax_fee',
            'service_fee',
            'total_price',
            'flightStartTime',
            'flightEndTime',
            'departureDate',
            'duration',
            'flightStart',
            'flightEnd',
            'departureTime',
        ));
    }

    // Hiển thị giao diện trang thanh toán
    public function thanhtoan(Request $request)
    {
        $flight = Flight::find($request->input('flight_id'));

        if (!$flight) {
            return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
        }


        $passengersSession = $request->input('passengers');
        // Kiểm tra nếu là chuỗi JSON, giải mã nó
        if (is_string($passengersSession)) {
            $passengersSession = json_decode($passengersSession, true) ?? [];
        }
        // Nếu không phải là mảng, lấy từ session
        if (!is_array($passengersSession)) {
            $passengersSession = session('passengers', []);
        }

        $childrensSession = $request->input('childrens');

        // Kiểm tra nếu là chuỗi JSON, giải mã nó
        if (is_string($childrensSession)) {
            $childrensSession = json_decode($childrensSession, true) ?? [];
        }

        // Nếu không phải là mảng, lấy từ session
        if (!is_array($childrensSession)) {
            $childrensSession = session('childrens', []);
        }

        $passengers = count($passengersSession);
        $childrens = count($childrensSession);

        // Xử lý thông tin khách hàng
        $full_name = trim($request->input('full_name', session('full_name', '')));
        $phone = trim($request->input('phone', session('phone', '')));
        $email = trim($request->input('email', session('email', '')));
        $address = trim($request->input('address', session('address', '')));

        // Xử lý giá vé
        $adult_price = $flight->price * $passengers;
        $child_price = $childrens > 0 ? ($flight->price * $childrens * 0.5) : 0;
        $tax_fee = 50000;
        $service_fee = 20000;
        $total_price = $adult_price + $child_price + $tax_fee + $service_fee;

        // Xử lý giá tiền
        $adult_price = $flight->price * $passengers;
        $child_price = $flight->price * $childrens * 0.5;
        $tax_fee = 50000;
        $service_fee = 20000;
        $total_price = $adult_price + $child_price + $tax_fee + $service_fee;

        // Xử lý thời gian bay
        $departureTime = Carbon::parse($flight->departure_time);
        $flightStart = Carbon::parse($flight->flight_start);
        $flightEnd = Carbon::parse($flight->flight_end);

        // Lấy giờ và phút dưới dạng chuỗi định dạng sẵn
        $flightStartTime = $flightStart->format('H:i');  // Ví dụ: 14:30
        $flightEndTime = $flightEnd->format('H:i');      // Ví dụ: 16:40
        $departureDate = $departureTime->format('d/m/Y'); // Ví dụ: 05/04/2024

        // Tính thời gian bay
        $duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');

        // Truyền dữ liệu sang view
        return view('thanhtoan', compact(
            'flight',
            'passengers',
            'childrens',
            'passengersSession',
            'childrensSession',
            'full_name',
            'phone',
            'email',
            'address',
            'adult_price',
            'child_price',
            'tax_fee',
            'service_fee',
            'total_price',
            'flightStartTime',
            'flightEndTime',
            'departureDate',
            'duration',
            'flightStart',
            'flightEnd',
            'departureTime',
        ));
    }



    public function thanhcong(Request $request)
    {
        $flight = Flight::find($request->input('flight_id'));

        if (!$flight) {
            return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
        }

        $passengersSession = $request->input('passengers_data');
        // Kiểm tra nếu là chuỗi JSON, giải mã nó
        if (is_string($passengersSession)) {
            $passengersSession = json_decode($passengersSession, true) ?? [];
        }
        // Nếu không phải là mảng, lấy từ session
        if (!is_array($passengersSession)) {
            $passengersSession = session('passengers_data', []);
        }

        $childrensSession = $request->input('childrens_data');

        // Kiểm tra nếu là chuỗi JSON, giải mã nó
        if (is_string($childrensSession)) {
            $childrensSession = json_decode($childrensSession, true) ?? [];
        }

        // Nếu không phải là mảng, lấy từ session
        if (!is_array($childrensSession)) {
            $childrensSession = session('childrens_data', []);
        }

        $passengerCount = count($passengersSession);
        $childrenCount = count($childrensSession);

        $passenger_count = (int) $request->input('passengers_data', 0);
        $children_count = (int) $request->input('childrens_data', 0);
        $total_passengers = $passenger_count + $children_count;

        $passengers = json_decode($request->input('passengers_data', '[]'), true) ?? [];
        $childrens = json_decode($request->input('childrens_data', '[]'), true) ?? [];

        $booking_code = "SK_" . rand(10000, 99999);

        $full_name = $request->input('full_name') ?? session('full_name', '');
        $phone = $request->input('phone') ?? session('phone', '');
        $email = $request->input('email') ?? session('email', '');
        $address = $request->input('address') ?? session('address', '');

        $full_name = is_array($full_name) ? implode(' ', array_filter((array)$full_name, 'is_string')) : (string)$full_name;
        $phone = is_array($phone) ? implode(' ', array_filter((array)$phone, 'is_string')) : (string)$phone;
        $email = is_array($email) ? implode(' ', array_filter((array)$email, 'is_string')) : (string)$email;
        $address = is_array($address) ? implode(' ', array_filter((array)$address, 'is_string')) : (string)$address;

        // Xử lý thời gian bay
        $departureTime = Carbon::parse($flight->departure_time);
        $flightStart = Carbon::parse($flight->flight_start);
        $flightEnd = Carbon::parse($flight->flight_end);

        // Lấy giờ và phút dưới dạng chuỗi định dạng sẵn
        $flightStartTime = $flightStart->format('H:i');  // Ví dụ: 14:30
        $flightEndTime = $flightEnd->format('H:i');      // Ví dụ: 16:40
        $departureDate = $departureTime->format('d/m/Y'); // Ví dụ: 05/04/2024

        // Tính thời gian bay
        $duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');

        // Xử lý giá vé
        $adult_price = $flight->price * $passengerCount;
        $child_price = $childrenCount > 0 ? ($flight->price * $childrenCount * 0.5) : 0;
        $tax_fee = 50000;
        $service_fee = 20000;
        $total_price = $adult_price + $child_price + $tax_fee + $service_fee;

        // Check người dùng có tài khoản
        if (Auth::check()) {
            $user = Auth::user();
            $data = [
                'booking_code' => $booking_code,
                'user_id' => $user->id,
                'name' => $full_name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'flight_id' => $flight->id,
                'total_price' => $total_price,
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
                'address' => $address,
                'total_price' => $total_price,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Booking::create($data);

        if (!Auth::check()) {
            $guest = Guest::updateOrCreate(
                ['phone' => $phone], // Kiểm tra nếu số điện thoại đã tồn tại
                [
                    'name' => $full_name,
                    'email' => $email,
                    'address' => $address,
                    'last_booking_date' => now()
                ]
            );

            // Nếu bản ghi vừa tạo mới (chưa có booking_count), thì đặt booking_count = 1
            if ($guest->wasRecentlyCreated) {
                $guest->booking_count = 1;
            } else {
                $guest->increment('booking_count'); // Nếu đã tồn tại thì tăng booking_count
            }

            $guest->save(); // Lưu lại bản ghi
        }

        // Trừ số ghế trên database tương ứng với tổng số hành khách đặt vé bay
        if ($flight->available_seats >= $total_passengers) {
            $flight->decrement('available_seats', $total_passengers);
        } else {
            return redirect()->back()->withErrors(['error' => 'Số ghế không đủ!']);
        }

        // Gửi email xác nhận đặt vé
        Mail::to($email)->send(new BookingConfirm([
            'name' => $full_name,
            'childrens' => $childrens,
            'booking_code' => $booking_code,
            'flight_code' => $flight->flight_code,
            'departure' => $flight->departure,
            'destination' => $flight->destination,
            'flightStartTime' => $flightStartTime,
            'flightEndTime' => $flightEndTime,
            'departureDate' => $departureDate,
            'duration' => $duration,
            'total_price' => $total_price,
            'passengerCount' => $passengerCount,
            'childrenCount' => $childrenCount,
            'full_name' => $full_name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'adult_price' => $adult_price,
            'child_price' => $child_price,
        ]));

        return view('thanhcong', compact(
            'flight',
            'passengers',
            'childrens',
            'passenger_count',
            'children_count',
            'passengerCount',
            'childrenCount',
            'total_passengers',
            'booking_code',
            'flightStartTime',
            'flightEndTime',
            'departureDate',
            'duration',
            'flightStart',
            'flightEnd',
            'departureTime',
            'full_name',
            'phone',
            'email',
            'address',
            'adult_price',
            'child_price',
            'tax_fee',
            'service_fee',
            'total_price',
            'passengersSession',
            'childrensSession',
        ));
    }

    // Hiển thị giao diện trang liên hẹ
    public function lienhe()
    {
        return view('lienhe');
    }

    // Hiển thị danh sách chuyến bay
    public function flights()
    {
        $flights = Flight::all();
        return view('index', compact('flights'));
    }

    // Hiển thị chi tiết chuyến bay
    public function flight_detail(Flight $id)
    {
        $show = Flight::query()->find($id);
        return view('index', compact('show'));
    }

    // Hiển thị kết quả tìm kiếm
    public function search(Request $request)
    {
        $search = $request->search;
        $flights = Flight::query()->where('name', 'like', "%$search%")->get();
        return view('index', compact('flights'));
    }

    // Hiển thị hãng bay
    public function airlines()
    {
        $airlines = Airline::all();
        return view('index', compact('airlines'));
    }
}
