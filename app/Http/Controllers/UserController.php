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
        $adults = (int) $request->input('adults', 0);
        $childrens = (int) $request->input('childrens', 0);
        $infants = (int) $request->input('infants', 0);

        if ($infants > $adults) {
            return redirect()->back()->withErrors(['error' => 'Số em bé không thể lớn hơn số người lớn!']);
        }
        $passengers = $adults + $childrens;

        session([
            'search_data' => [
                'departure' => $departure,
                'destination' => $destination,
                'departure_time' => $departure_time,
                'adults' => $adults,
                'childrens' => $childrens,
                'infants' => $infants,
                'passengers' => $passengers
            ]
        ]);

        $query = Flight::query()
            ->where('departure', 'like', "%$departure%")
            ->where('destination', 'like', "%$destination%")
            ->whereDate('departure_time', $departure_time)
            ->where('available_seats', '>=', $passengers);

        $sort = $request->input('sort');
        if ($sort == 'asc') {
            $query->orderBy('price_economy', 'asc')
                ->orderBy('price_business', 'asc');
        } elseif ($sort == 'desc') {
            $query->orderBy('price_economy', 'desc')
                ->orderBy('price_business', 'desc');
        }

        $flights = $query->get();

        foreach ($flights as $flight) {
            if ($flight->seat_class == 'phổ thông') {
                $flight->formatted_price = number_format($flight->price_economy, 0, ',', '.') . ' VNĐ';
            } else {
                $flight->formatted_price = number_format($flight->price_business, 0, ',', '.') . ' VNĐ';
            }
        }

        // Thông báo nếu chưa nhập đủ các trường
        if (empty($departure) || empty($destination) || empty($departure_time)) {
            flash()->error('Vui lòng nhập đầy đủ các trường');
            return redirect()->route('index')->withInput();
        }

        // Hiện thông báo nếu không có chuyến bay nào
        if ($flights->isEmpty()) {
            flash()->error('Không tìm thấy chuyến bay phù hợp');
            return redirect()->route('index')->withInput();
        }

        return view('datve_motchieu', compact('flights', 'adults', 'childrens', 'infants', 'passengers'));
    }
    // Phương thức tìm kiếm chuyến bay khứ hồi
    public function search_flights_roundtrip(Request $request)
    {
        // dd($request->all());
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

        // Thông báo nếu chưa nhập đủ các trường
        if (empty($departure) || empty($destination) || empty($departure_time) || empty($return_time)) {
            flash()->error('Vui lòng nhập đầy đủ các trường');
            return redirect()->route('index')->withInput();
        }

        // Hiện thông báo nếu không có chuyến bay nào
        if ($outboundFlights->isEmpty() || $returnFlights->isEmpty()) {
            flash()->error('Không tìm thấy chuyến bay phù hợp');
            return redirect()->route('index')->withInput();
        }

        // Định dạng hiển thị giá tiền cho chuyến đi
        foreach ($outboundFlights as $flight) {
            if ($flight->seat_class == 'phổ thông') {
                $flight->price = $flight->price_economy;
            } else {
                $flight->price = $flight->price_business;
            }
            $flight->formatted_price = number_format($flight->price, 0, ',', '.') . ' VNĐ';
        }

        // Định dạng hiển thị giá tiền cho chuyến về
        foreach ($returnFlights as $flight) {
            if ($flight->seat_class == 'phổ thông') {
                $flight->price = $flight->price_economy;
            } else {
                $flight->price = $flight->price_business;
            }
            $flight->formatted_price = number_format($flight->price, 0, ',', '.') . ' VNĐ';
        }

        // Hiển thị thời gian chuyến bay
        foreach ($outboundFlights as $flight) {
            $flight->flight_start = Carbon::parse($flight->flight_start)->format('H:i');
            $flight->flight_end = Carbon::parse($flight->flight_end)->format('H:i');
        }

        foreach ($returnFlights as $flight) {
            $flight->flight_start = Carbon::parse($flight->flight_start)->format('H:i');
            $flight->flight_end = Carbon::parse($flight->flight_end)->format('H:i');
        }

        // Lọc chuyến bay
        $airlines = Airline::all();
        // Áp dụng sắp xếp dựa giá 
        $sort = $request->input('sort');
        if ($sort == 'asc') {
            $outboundFlights->orderBy('price_economy', 'asc')
                ->orderBy('price_business', 'asc');
        } elseif ($sort == 'desc') {
            $outboundFlights->orderBy('price_economy', 'desc')
                ->orderBy('price_business', 'desc');
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
                'infants' => $infants,
                'outboundFlights' => $outboundFlights,
                'returnFlights' => $returnFlights,
            ]
        ]);

        return view('datve_khuhoi', compact('flights', 'airlines', 'sort', 'departure', 'destination', 'departure_time', 'return_time', 'outboundFlights', 'returnFlights', 'adults', 'childrens', 'infants'));
    }


    // Hàm xử lý giá tiền 
    public function xulygia($flight, $adults, $childrens, $infants)
    {
        $adult_price = $flight->seat_class == 'phổ thông' ? $flight->price_economy : $flight->price_business * $adults;
        $child_price = $adult_price * 0.2 * $childrens;
        $infant_price = $adult_price * 0 * $infants;
        $tax_fee = $flight->seat_class == 'phổ thông' ? 50000 : 150000;
        $service_fee = $flight->seat_class == 'phổ thông' ? 20000 : 60000;
        $total_price = $adult_price + $child_price + $infant_price + $tax_fee + $service_fee;

        return compact('adult_price', 'child_price', 'infant_price', 'tax_fee', 'service_fee', 'total_price');
    }

    // Hàm xử lý thời gian bay
    public function xulythoigianbay($departureFlight, $returnFlight = null)
    {
        // Xử lý thời gian bay chuyến bay
        $departureTime = Carbon::parse($departureFlight->departure_time);
        $flightStart = Carbon::parse($departureFlight->flight_start);
        $flightEnd = Carbon::parse($departureFlight->flight_end);

        $duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');
        $flightStartTime = $flightStart->format('H:i');
        $flightEndTime = $flightEnd->format('H:i');
        $departureDate = $departureTime->format('d/m/Y');
        $departureMonth = $departureTime->format('m');
        $departureYear = $departureTime->format('Y');
        $departureDay = $departureTime->format('d');
        $departureDayOfWeek = $departureTime->locale('vi')->isoFormat('dddd');

        $data = [
            'duration' => $duration,
            'flightStartTime' => $flightStartTime,
            'flightEndTime' => $flightEndTime,
            'departureDate' => $departureDate,
            'departureMonth' => $departureMonth,
            'departureYear' => $departureYear,
            'departureDay' => $departureDay,
            'departureDayOfWeek' => $departureDayOfWeek,
        ];

        // Xử lý thời gian bay chuyến về (khứ hồi)
        if ($returnFlight) {
            $returnTime = Carbon::parse($returnFlight->departure_time);
            $returnStart = Carbon::parse($returnFlight->flight_start);
            $returnEnd = Carbon::parse($returnFlight->flight_end);

            $returnDuration = $returnStart->diff($returnEnd)->format('%h giờ %i phút');
            $returnStartTime = $returnStart->format('H:i');
            $returnEndTime = $returnEnd->format('H:i');
            $returnDate = $returnTime->format('d/m/Y');
            $returnMonth = $returnTime->format('m');
            $returnYear = $returnTime->format('Y');
            $returnDay = $returnTime->format('d');
            $returnDayOfWeek = $returnTime->locale('vi')->isoFormat('dddd');

            $data = array_merge($data, [
                'returnDuration' => $returnDuration,
                'returnStartTime' => $returnStartTime,
                'returnEndTime' => $returnEndTime,
                'returnDate' => $returnDate,
                'returnMonth' => $returnMonth,
                'returnYear' => $returnYear,
                'returnDay' => $returnDay,
                'returnDayOfWeek' => $returnDayOfWeek,
            ]);
        }

        return $data;
    }

    // Hiển thị giao diện trang xác nhận
    public function xacnhan(Request $request)
    {
        // dd($request->all());
        if ($request->has('flight_id')) {
            // Xử lý khi chuyến bay là chuyến bay 1 chiều
            $flight = Flight::find($request->input('flight_id'));

            // Lấy dữ liệu từ form - đảm bảo lấy đúng định dạng mảng
            $adults = $request->input('adults', []);
            $childrens = $request->input('childrens', []);
            $infants = $request->input('infants', []);
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
                'adults' => is_array($adults) ? $adults : [],
                'childrens' => is_array($childrens) ? $childrens : [],
                'infants' => is_array($infants) ? $infants : [],
                'full_name' => is_array($full_name) ? implode(' ', $full_name) : strval($full_name),
                'phone' => is_array($phone) ? implode(' ', $phone) : strval($phone),
                'email' => is_array($email) ? implode(' ', $email) : strval($email),
                'address' => is_array($address) ? implode(' ', $address) : strval($address)
            ]);

            $gia = $this->xulygia($flight, $adults, $childrens, $infants);
            $thoigian = $this->xulythoigianbay($flight);

            return view('xacnhan', array_merge(compact('flight', 'adults', 'childrens', 'infants', 'full_name', 'phone', 'email', 'address'), $gia, $thoigian));
        } else {
            // Xử lý khi chuyến bay là chuyến bay khứ hồi
            $outboundFlightId = $request->input('outbound_flight_id');
            $returnFlightId = $request->input('return_flight_id');

            // Tìm thông tin chuyến bay
            $outboundFlight = Flight::find($outboundFlightId);
            $returnFlight = Flight::find($returnFlightId);

            // Lấy thông tin hành khách
            $adults = (int) $request->input('adults', 0);
            $childrens = (int) $request->input('childrens', 0);
            $infants = (int) $request->input('infants', 0);

            // Lưu thông tin vào session
            session([
                'adults' => $adults,
                'childrens' => $childrens,
                'infants' => $infants,
                'outbound_flight' => $outboundFlight,
                'return_flight' => $returnFlight,
            ]);

            // Xử lý giá tiền
            $outboundPrices = $this->xulygia($outboundFlight, $adults, $childrens, $infants);
            $returnPrices = $this->xulygia($returnFlight, $adults, $childrens, $infants);
            $totalPrice = $outboundPrices['total_price'] + $returnPrices['total_price'];

            // Xử lý thời gian bay
            $dataTime = $this->xulythoigianbay($outboundFlight, $returnFlight);

            return view('xacnhan', array_merge(
                compact('outboundFlight', 'returnFlight', 'adults', 'childrens', 'infants', 'totalPrice'),
                $dataTime,
                [
                    'outboundPrices' => $outboundPrices,
                    'returnPrices' => $returnPrices
                ]
            ));
        }
    }

    // Hiển thị giao diện trang thanh toán
    public function thanhtoan(Request $request)
    {
        // Kiểm tra xem có flight_id không
        if ($request->has('flight_id')) {
            $flight = Flight::with('airline')->find($request->input('flight_id'));

            if (!$flight) {
                return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
            }

            $adultsSession = $request->input('adults');
            // Kiểm tra nếu là chuỗi JSON, giải mã nó
            if (is_string($adultsSession)) {
                $adultsSession = json_decode($adultsSession, true) ?? [];
            }
            // Nếu không phải là mảng, lấy từ session
            if (!is_array($adultsSession)) {
                $adultsSession = session('adults', []);
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

            $infantsSession = $request->input('infants');
            // Kiểm tra nếu là chuỗi JSON, giải mã nó
            if (is_string($infantsSession)) {
                $infantsSession = json_decode($infantsSession, true) ?? [];
            }
            // Nếu không phải là mảng, lấy từ session
            if (!is_array($infantsSession)) {
                $infantsSession = session('infants', []);
            }

            // Đảm bảo các biến là mảng trước khi đếm
            $adults = is_array($adultsSession) ? count($adultsSession) : 0;
            $childrens = is_array($childrensSession) ? count($childrensSession) : 0;
            $infants = is_array($infantsSession) ? count($infantsSession) : 0;

            // Lưu thông tin vào session
            session([
                'adults' => $adults,
                'childrens' => $childrens,
                'infants' => $infants,
                'outbound_flight' => $flight,
                'return_flight' => $flight,
            ]);

            // Xử lý thông tin khách hàng
            $full_name = trim($request->input('full_name', session('full_name', '')));
            $phone = trim($request->input('phone', session('phone', '')));
            $email = trim($request->input('email', session('email', '')));
            $address = trim($request->input('address', session('address', '')));

            // Xử lý giá tiền
            $adult_price = $flight->seat_class == 'phổ thông' ? $flight->price_economy : $flight->price_business * $adults;
            $child_price = $adult_price * 0.2 * $childrens;
            $infant_price = $adult_price * 0 * $infants;
            $tax_fee = $flight->seat_class == 'phổ thông' ? 50000 : 100000;
            $service_fee = $flight->seat_class == 'phổ thông' ? 20000 : 40000;
            $total_price = $adult_price + $child_price + $infant_price + $tax_fee + $service_fee;

            // Xử lý thời gian bay
            $departureTime = Carbon::parse($flight->departure_time);
            $flightStart = Carbon::parse($flight->flight_start);
            $flightEnd = Carbon::parse($flight->flight_end);

            // Lấy giờ và phút dưới dạng chuỗi định dạng sẵn
            $flightStartTime = $flightStart->format('H:i');
            $flightEndTime = $flightEnd->format('H:i');
            $departureDate = $departureTime->format('d/m/Y');
            $departureDay = $departureTime->format('d');
            $departureMonth = $departureTime->format('m');
            $departureYear = $departureTime->format('Y');
            $departureDayOfWeek = $departureTime->locale('vi')->isoFormat('dddd');

            // Tính thời gian bay
            $duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');

            // Truyền dữ liệu sang view
            return view('thanhtoan', compact(
                'flight',
                'adults',
                'childrens',
                'infants',
                'adultsSession',
                'childrensSession',
                'infantsSession',
                'full_name',
                'phone',
                'email',
                'address',
                'adult_price',
                'child_price',
                'infant_price',
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
                'departureDay',
                'departureMonth',
                'departureYear',
                'departureDayOfWeek',
            ));
        } else {
            // Xử lý khi chuyến bay là chuyến bay khứ hồi
            $outboundFlightId = $request->input('outbound_flight_id');
            $returnFlightId = $request->input('return_flight_id');

            // Tìm thông tin chuyến bay
            $outboundFlight = Flight::with('airline')->find($outboundFlightId);
            $returnFlight = Flight::with('airline')->find($returnFlightId);

            // Kiểm tra xem cả hai chuyến bay có tồn tại không
            if (!$outboundFlight || !$returnFlight) {
                return redirect()->back()->withErrors(['error' => 'Một hoặc cả hai chuyến bay không tồn tại!']);
            }

            // Lấy thông tin hành khách
            $adultsSession = $request->input('adults');
            // Kiểm tra nếu là chuỗi JSON, giải mã nó
            if (is_string($adultsSession)) {
                $adultsSession = json_decode($adultsSession, true) ?? [];
            }
            // Nếu không phải là mảng, lấy từ session
            if (!is_array($adultsSession)) {
                $adultsSession = session('adults', []);
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

            $infantsSession = $request->input('infants');
            // Kiểm tra nếu là chuỗi JSON, giải mã nó
            if (is_string($infantsSession)) {
                $infantsSession = json_decode($infantsSession, true) ?? [];
            }
            // Nếu không phải là mảng, lấy từ session
            if (!is_array($infantsSession)) {
                $infantsSession = session('infants', []);
            }

            // Đảm bảo các biến là mảng trước khi đếm
            $adults = is_array($adultsSession) ? count($adultsSession) : 0;
            $childrens = is_array($childrensSession) ? count($childrensSession) : 0;
            $infants = is_array($infantsSession) ? count($infantsSession) : 0;

            session([
                'adults' => $adults,
                'childrens' => $childrens,
                'infants' => $infants,
                'outbound_flight' => $outboundFlight,
                'return_flight' => $returnFlight,
            ]);

            // Xử lý thông tin khách hàng
            $full_name = trim($request->input('full_name', session('full_name', '')));
            $phone = trim($request->input('phone', session('phone', '')));
            $email = trim($request->input('email', session('email', '')));
            $address = trim($request->input('address', session('address', '')));

            // Xử lý giá tiền cho chuyến đi
            $outboundAdultPrice = $outboundFlight->seat_class == 'phổ thông'
                ? $outboundFlight->price_economy * $adults
                : $outboundFlight->price_business * $adults;
            $outboundChildPrice = $outboundAdultPrice * 0.3 * $childrens;
            $outboundInfantPrice = $outboundAdultPrice * 0 * $infants;
            $outboundTaxFee = $outboundFlight->seat_class == 'phổ thông' ? 50000 : 100000;
            $outboundServiceFee = $outboundFlight->seat_class == 'phổ thông' ? 20000 : 40000;
            $outboundTotalPrice = $outboundAdultPrice + $outboundChildPrice + $outboundInfantPrice + $outboundTaxFee + $outboundServiceFee;

            // Xử lý giá tiền cho chuyến về
            $returnAdultPrice = $returnFlight->seat_class == 'phổ thông'
                ? $returnFlight->price_economy * $adults
                : $returnFlight->price_business * $adults;
            $returnChildPrice = $returnAdultPrice * 0.3 * $childrens;
            $returnInfantPrice = $returnAdultPrice * 0 * $infants;
            $returnTaxFee = $returnFlight->seat_class == 'phổ thông' ? 50000 : 100000;
            $returnServiceFee = $returnFlight->seat_class == 'phổ thông' ? 20000 : 40000;
            $returnTotalPrice = $returnAdultPrice + $returnChildPrice + $returnInfantPrice + $returnTaxFee + $returnServiceFee;

            // Tổng giá tiền
            $totalPrice = $outboundTotalPrice + $returnTotalPrice;

            // Xử lý thời gian bay cho chuyến đi
            $outboundDepartureTime = Carbon::parse($outboundFlight->departure_time);
            $outboundFlightStart = Carbon::parse($outboundFlight->flight_start);
            $outboundFlightEnd = Carbon::parse($outboundFlight->flight_end);
            $outboundFlightStartTime = $outboundFlightStart->format('H:i');
            $outboundFlightEndTime = $outboundFlightEnd->format('H:i');
            $outboundDepartureDate = $outboundDepartureTime->format('d/m/Y');
            $outboundDepartureMonth = $outboundDepartureTime->format('m');
            $outboundDepartureYear = $outboundDepartureTime->format('Y');
            $outboundDepartureDay = $outboundDepartureTime->format('d');
            $outboundDuration = $outboundFlightStart->diff($outboundFlightEnd)->format('%h giờ %i phút');
            $outboundDayOfWeek = $outboundDepartureTime->locale('vi')->isoFormat('dddd');

            // Xử lý thời gian bay cho chuyến về
            $returnDepartureTime = Carbon::parse($returnFlight->departure_time);
            $returnFlightStart = Carbon::parse($returnFlight->flight_start);
            $returnFlightEnd = Carbon::parse($returnFlight->flight_end);
            $returnFlightStartTime = $returnFlightStart->format('H:i');
            $returnFlightEndTime = $returnFlightEnd->format('H:i');
            $returnDepartureDate = $returnDepartureTime->format('d/m/Y');
            $returnDepartureMonth = $returnDepartureTime->format('m');
            $returnDepartureYear = $returnDepartureTime->format('Y');
            $returnDepartureDay = $returnDepartureTime->format('d');
            $returnDuration = $returnFlightStart->diff($returnFlightEnd)->format('%h giờ %i phút');
            $returnDayOfWeek = $returnDepartureTime->locale('vi')->isoFormat('dddd');

            // Truyền dữ liệu sang view
            return view('thanhtoan', compact(
                'outboundFlight',
                'returnFlight',
                'adults',
                'childrens',
                'infants',
                'adultsSession',
                'childrensSession',
                'infantsSession',
                'full_name',
                'phone',
                'email',
                'address',
                'outboundAdultPrice',
                'outboundChildPrice',
                'outboundInfantPrice',
                'outboundTaxFee',
                'outboundServiceFee',
                'outboundTotalPrice',
                'returnAdultPrice',
                'returnChildPrice',
                'returnInfantPrice',
                'returnTaxFee',
                'returnServiceFee',
                'returnTotalPrice',
                'totalPrice',
                'outboundFlightStartTime',
                'outboundFlightEndTime',
                'outboundDepartureDate',
                'outboundDuration',
                'returnFlightStartTime',
                'returnFlightEndTime',
                'returnDepartureDate',
                'returnDuration',
                'outboundDepartureTime',
                'outboundDepartureMonth',
                'outboundDepartureYear',
                'outboundDepartureDay',
                'outboundDayOfWeek',
                'returnDepartureMonth',
                'returnDepartureYear',
                'returnDepartureDay',
                'returnDayOfWeek',
            ));
        }
    }



    public function thanhcong(Request $request)
    {
        // dd($request->all());
        if ($request->has('flight_id')) {
            $flight = Flight::find($request->input('flight_id'));

            if (!$flight) {
                return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
            }

            // Handle passenger data
            $adultsSession = $request->input('adults');
            if (is_string($adultsSession)) {
                $adultsSession = json_decode($adultsSession, true) ?? [];
            }
            if (!is_array($adultsSession)) {
                $adultsSession = session('adults', []);
            }

            $childrensSession = $request->input('childrens');
            if (is_string($childrensSession)) {
                $childrensSession = json_decode($childrensSession, true) ?? [];
            }
            if (!is_array($childrensSession)) {
                $childrensSession = session('childrens', []);
            }

            $infantsSession = $request->input('infants');
            if (is_string($infantsSession)) {
                $infantsSession = json_decode($infantsSession, true) ?? [];
            }
            if (!is_array($infantsSession)) {
                $infantsSession = session('infants', []);
            }

            // Calculate passenger counts
            $adults = is_array($adultsSession) ? count($adultsSession) : 0;
            $childrens = is_array($childrensSession) ? count($childrensSession) : 0;
            $infants = is_array($infantsSession) ? count($infantsSession) : 0;
            $total_passengers = $adults + $childrens + $infants;

            $booking_code = "SK_" . random_int(00000, 99999);

            // Customer information
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

            $flightStartTime = $flightStart->format('H:i');
            $flightEndTime = $flightEnd->format('H:i');
            $departureDate = $departureTime->format('d/m/Y');
            $departureDay = $departureTime->format('d');
            $departureMonth = $departureTime->format('m');
            $departureYear = $departureTime->format('Y');
            $departureDayOfWeek = $departureTime->locale('vi')->isoFormat('dddd');
            $duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');

            // Calculate prices
            $adult_price = $flight->seat_class == 'phổ thông' ? $flight->price_economy * $adults : $flight->price_business * $adults;
            $child_price = $adult_price * 0.2 * $childrens;
            $infant_price = $adult_price * 0 * $infants;
            $tax_fee = $flight->seat_class == 'phổ thông' ? 50000 : 100000;
            $service_fee = $flight->seat_class == 'phổ thông' ? 20000 : 40000;
            $total_price = $adult_price + $child_price + $infant_price + $tax_fee + $service_fee;

            // Prepare booking data
            if (Auth::check()) {
                $user = Auth::user();
                $data = [
                    'booking_code' => $booking_code,
                    'user_id' => $user->id,
                    'name' => $full_name,
                    'phone' => $phone,
                    'email' => $email,
                    'adult_count' => $adults, // Integer
                    'child_count' => $childrens, // Integer
                    'infant_count' => $infants, // Integer
                    'address' => $address,
                    'flight_id' => $flight->id,
                    'total_price' => $total_price,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            } else {
                $data = [
                    'booking_code' => $booking_code,
                    'user_id' => null,
                    'flight_id' => $flight->id,
                    'name' => $full_name,
                    'phone' => $phone,
                    'email' => $email,
                    'adult_count' => $adults, // Integer
                    'child_count' => $childrens, // Integer
                    'infant_count' => $infants, // Integer
                    'address' => $address,
                    'total_price' => $total_price,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            // Create booking
            Booking::create($data);

            // Handle guest data for non-authenticated users
            if (!Auth::check()) {
                $guest = Guest::updateOrCreate(
                    ['phone' => $phone],
                    [
                        'name' => $full_name,
                        'email' => $email,
                        'address' => $address,
                        'last_booking_date' => now()
                    ]
                );

                if ($guest->wasRecentlyCreated) {
                    $guest->booking_count = 1;
                } else {
                    $guest->increment('booking_count');
                }

                $guest->save();
            }

            // Update available seats
            if ($flight->available_seats >= $total_passengers) {
                $flight->decrement('available_seats', $total_passengers);
            } else {
                return redirect()->back()->withErrors(['error' => 'Số ghế không đủ!']);
            }

            // Send confirmation email
            Mail::to($email)->send(new BookingConfirm([
                'name' => $full_name,
                'childrens' => $childrens,
                'adults' => $adults,
                'infants' => $infants,
                'booking_code' => $booking_code,
                'flight_code' => $flight->flight_code,
                'departure' => $flight->departure,
                'destination' => $flight->destination,
                'flightStartTime' => $flightStartTime,
                'flightEndTime' => $flightEndTime,
                'departureDate' => $departureDate,
                'duration' => $duration,
                'total_price' => $total_price,
                'adultsCount' => $adults,
                'childrensCount' => $childrens,
                'infantsCount' => $infants,
                'full_name' => $full_name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'adult_price' => $adult_price,
                'child_price' => $child_price,
                'infant_price' => $infant_price,
                'adultsSession' => $adultsSession,
                'childrensSession' => $childrensSession,
                'infantsSession' => $infantsSession,
                'departureDay' => $departureDay,
                'departureMonth' => $departureMonth,
                'departureYear' => $departureYear,
                'departureDayOfWeek' => $departureDayOfWeek,
            ]));

            return view('thanhcong', compact(
                'flight',
                'adults',
                'infants',
                'childrens',
                'total_passengers',
                'booking_code',
                'departure',
                'destination',
                'flightStartTime',
                'flightEndTime',
                'departureDate',
                'duration',
                'flightStart',
                'flightEnd',
                'departureTime',
                'departureDay',
                'departureMonth',
                'departureYear',
                'departureDayOfWeek',
                'full_name',
                'phone',
                'email',
                'address',
                'adult_price',
                'child_price',
                'infant_price',
                'tax_fee',
                'service_fee',
                'total_price',
                'adultsSession',
                'childrensSession',
                'infantsSession'
            ));
        } else {
            // Xử lý khi chuyến bay là chuyến bay khứ hồi
            $outboundFlightId = $request->input('outbound_flight_id');
            $returnFlightId = $request->input('return_flight_id');

            // Tìm thông tin chuyến bay
            $outboundFlight = Flight::find($outboundFlightId);
            $returnFlight = Flight::find($returnFlightId);

            // Kiểm tra xem cả hai chuyến bay có tồn tại không
            if (!$outboundFlight || !$returnFlight) {
                return redirect()->back()->withErrors(['error' => 'Một hoặc cả hai chuyến bay không tồn tại!']);
            }

            $adultsSession = $request->input('adults');
            // Kiểm tra nếu là chuỗi JSON, giải mã nó
            if (is_string($adultsSession)) {
                $adultsSession = json_decode($adultsSession, true) ?? [];
            }
            // Nếu không phải là mảng, lấy từ session
            if (!is_array($adultsSession)) {
                $adultsSession = session('adults', []);
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

            $infantsSession = $request->input('infants');
            // Kiểm tra nếu là chuỗi JSON, giải mã nó
            if (is_string($infantsSession)) {
                $infantsSession = json_decode($infantsSession, true) ?? [];
            }
            // Nếu không phải là mảng, lấy từ session
            if (!is_array($infantsSession)) {
                $infantsSession = session('infants', []);
            }

            // Đảm bảo các biến là mảng trước khi đếm
            $adults = is_array($adultsSession) ? count($adultsSession) : 0; // Default to 1
            $childrens = is_array($childrensSession) ? count($childrensSession) : 0;
            $infants = is_array($infantsSession) ? count($infantsSession) : 0;;

            $total_passengers = $adults + $childrens + $infants;

            $booking_code_outbound = "SK_" . random_int(00000, 99999);
            $booking_code_return = "SK_" . random_int(00000, 99999);

            $full_name = $request->input('full_name') ?? session('full_name', '');
            $phone = $request->input('phone') ?? session('phone', '');
            $email = $request->input('email') ?? session('email', '');
            $address = $request->input('address') ?? session('address', '');

            $full_name = is_array($full_name) ? implode(' ', array_filter((array)$full_name, 'is_string')) : (string)$full_name;
            $phone = is_array($phone) ? implode(' ', array_filter((array)$phone, 'is_string')) : (string)$phone;
            $email = is_array($email) ? implode(' ', array_filter((array)$email, 'is_string')) : (string)$email;
            $address = is_array($address) ? implode(' ', array_filter((array)$address, 'is_string')) : (string)$address;

            // Xử lý thời gian bay cho chuyến đi
            $outboundDepartureTime = Carbon::parse($outboundFlight->departure_time);
            $outboundFlightStart = Carbon::parse($outboundFlight->flight_start);
            $outboundFlightEnd = Carbon::parse($outboundFlight->flight_end);
            $outboundFlightStartTime = $outboundFlightStart->format('H:i');
            $outboundFlightEndTime = $outboundFlightEnd->format('H:i');
            $outboundDepartureDate = $outboundDepartureTime->format('d/m/Y');
            $outboundDepartureDay = $outboundDepartureTime->format('d');
            $outboundDepartureMonth = $outboundDepartureTime->format('m');
            $outboundDepartureYear = $outboundDepartureTime->format('Y');
            $outboundDuration = $outboundFlightStart->diff($outboundFlightEnd)->format('%h giờ %i phút');
            $outboundDayOfWeek = $outboundDepartureTime->locale('vi')->isoFormat('dddd');

            // Xử lý thời gian bay cho chuyến về
            $returnDepartureTime = Carbon::parse($returnFlight->departure_time);
            $returnFlightStart = Carbon::parse($returnFlight->flight_start);
            $returnFlightEnd = Carbon::parse($returnFlight->flight_end);
            $returnFlightStartTime = $returnFlightStart->format('H:i');
            $returnFlightEndTime = $returnFlightEnd->format('H:i');
            $returnDepartureDate = $returnDepartureTime->format('d/m/Y');
            $returnDepartureDay = $returnDepartureTime->format('d');
            $returnDepartureMonth = $returnDepartureTime->format('m');
            $returnDepartureYear = $returnDepartureTime->format('Y');
            $returnDuration = $returnFlightStart->diff($returnFlightEnd)->format('%h giờ %i phút');
            $returnDayOfWeek = $returnDepartureTime->locale('vi')->isoFormat('dddd');

            // Xử lý giá tiền cho chuyến đi
            $outboundAdultPrice = $outboundFlight->seat_class == 'phổ thông'
                ? $outboundFlight->price_economy * $adults
                : $outboundFlight->price_business * $adults;
            $outboundChildPrice = $outboundAdultPrice * 0.3 * $childrens;
            $outboundInfantPrice = $outboundAdultPrice * 0 * $infants;
            $outboundTaxFee = $outboundFlight->seat_class == 'phổ thông' ? 50000 : 100000;
            $outboundServiceFee = $outboundFlight->seat_class == 'phổ thông' ? 20000 : 40000;
            $outboundTotalPrice = $outboundAdultPrice + $outboundChildPrice + $outboundInfantPrice + $outboundTaxFee + $outboundServiceFee;

            // Xử lý giá tiền cho chuyến về
            $returnAdultPrice = $returnFlight->seat_class == 'phổ thông'
                ? $returnFlight->price_economy * $adults
                : $returnFlight->price_business * $adults;
            $returnChildPrice = $returnAdultPrice * 0.3 * $childrens;
            $returnInfantPrice = $returnAdultPrice * 0 * $infants;
            $returnTaxFee = $returnFlight->seat_class == 'phổ thông' ? 50000 : 100000;
            $returnServiceFee = $returnFlight->seat_class == 'phổ thông' ? 20000 : 40000;
            $returnTotalPrice = $returnAdultPrice + $returnChildPrice + $returnInfantPrice + $returnTaxFee + $returnServiceFee;

            // Tổng giá tiền
            $totalPrice = $outboundTotalPrice + $returnTotalPrice;

            // Check người dùng có tài khoản
            if (Auth::check()) {
                $user = Auth::user();
                // Tạo booking cho chuyến đi
                $outboundData = [
                    'booking_code' => $booking_code_outbound,
                    'user_id' => $user->id,
                    'name' => $full_name,
                    'phone' => $phone,
                    'email' => $email,
                    'adult_count' => $adults,
                    'child_count' => $childrens,
                    'infant_count' => $infants,
                    'address' => $address,
                    'flight_id' => $outboundFlight->id,
                    'total_price' => $outboundTotalPrice,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                // Tạo booking cho chuyến về
                $returnData = [
                    'booking_code' => $booking_code_return,
                    'user_id' => $user->id,
                    'name' => $full_name,
                    'phone' => $phone,
                    'email' => $email,
                    'adult_count' => $adults,
                    'child_count' => $childrens,
                    'infant_count' => $infants,
                    'address' => $address,
                    'flight_id' => $returnFlight->id,
                    'total_price' => $returnTotalPrice,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            } else {
                // Tạo booking cho chuyến đi
                $outboundData = [
                    'booking_code' => $booking_code_outbound,
                    'user_id' => null,
                    'name' => $full_name,
                    'phone' => $phone,
                    'email' => $email,
                    'adult_count' => $adults,
                    'child_count' => $childrens,
                    'infant_count' => $infants,
                    'address' => $address,
                    'flight_id' => $outboundFlight->id,
                    'total_price' => $outboundTotalPrice,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                // Tạo booking cho chuyến về
                $returnData = [
                    'booking_code' => $booking_code_return,
                    'user_id' => null,
                    'name' => $full_name,
                    'phone' => $phone,
                    'email' => $email,
                    'adult_count' => $adults,
                    'child_count' => $childrens,
                    'infant_count' => $infants,
                    'address' => $address,
                    'flight_id' => $returnFlight->id,
                    'total_price' => $returnTotalPrice,
                    'created_at' => now(),
                    'updated_at' => now()
                ];
            }

            // Tạo booking cho cả hai chuyến bay
            Booking::create($outboundData);
            Booking::create($returnData);

            if (!Auth::check()) {
                $guest = Guest::updateOrCreate(
                    ['phone' => $phone],
                    [
                        'name' => $full_name,
                        'email' => $email,
                        'address' => $address,
                    ]
                );

                if ($guest->wasRecentlyCreated) {
                    $guest->booking_count = 1;
                } else {
                    $guest->increment('booking_count');
                }

                $guest->save();
            }

            // Trừ số ghế cho cả hai chuyến bay
            if ($outboundFlight->available_seats >= $total_passengers && $returnFlight->available_seats >= $total_passengers) {
                $outboundFlight->decrement('available_seats', $total_passengers);
                $returnFlight->decrement('available_seats', $total_passengers);
            } else {
                return redirect()->back()->withErrors(['error' => 'Số ghế không đủ cho một hoặc cả hai chuyến bay!']);
            }

            // Gửi email xác nhận đặt vé
            Mail::to($email)->send(new BookingConfirm([
                'name' => $full_name,
                'childrens' => $childrens,
                'adults' => $adults,
                'infants' => $infants,
                'booking_code_outbound' => $booking_code_outbound,
                'outbound_flight_code' => $outboundFlight->flight_code,
                'return_flight_code' => $returnFlight->flight_code,
                'outbound_departure' => $outboundFlight->departure,
                'outbound_destination' => $outboundFlight->destination,
                'booking_code_return' => $booking_code_return,
                'return_departure' => $returnFlight->departure,
                'return_destination' => $returnFlight->destination,
                'outbound_flight_start_time' => $outboundFlightStartTime,
                'outbound_flight_end_time' => $outboundFlightEndTime,
                'return_flight_start_time' => $returnFlightStartTime,
                'return_flight_end_time' => $returnFlightEndTime,
                'outbound_departure_date' => $outboundDepartureDate,
                'return_departure_date' => $returnDepartureDate,
                'outbound_duration' => $outboundDuration,
                'return_duration' => $returnDuration,
                'total_price' => $totalPrice,
                'adults_count' => $adults,
                'childrens_count' => $childrens,
                'infants_count' => $infants,
                'full_name' => $full_name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'outbound_adult_price' => $outboundAdultPrice,
                'outbound_child_price' => $outboundChildPrice,
                'outbound_infant_price' => $outboundInfantPrice,
                'return_adult_price' => $returnAdultPrice,
                'return_child_price' => $returnChildPrice,
                'return_infant_price' => $returnInfantPrice,
                'outbound_tax_fee' => $outboundTaxFee,
                'outbound_service_fee' => $outboundServiceFee,
                'return_tax_fee' => $returnTaxFee,
                'return_service_fee' => $returnServiceFee,
                'adults_session' => $adultsSession,
                'childrens_session' => $childrensSession,
                'infants_session' => $infantsSession,
                'outbound_departure_day' => $outboundDepartureDay,
                'outbound_departure_month' => $outboundDepartureMonth,
                'outbound_departure_year' => $outboundDepartureYear,
                'outbound_day_of_week' => $outboundDayOfWeek,
                'return_departure_day' => $returnDepartureDay,
                'return_departure_month' => $returnDepartureMonth,
                'return_departure_year' => $returnDepartureYear,
                'return_day_of_week' => $returnDayOfWeek,
            ]));

            return view('thanhcong', compact(
                'outboundFlight',
                'returnFlight',
                'adults',
                'childrens',
                'infants',
                'total_passengers',
                'booking_code_outbound',
                'booking_code_return',
                'outboundFlightStartTime',
                'outboundFlightEndTime',
                'outboundDepartureDate',
                'outboundDuration',
                'returnFlightStartTime',
                'returnFlightEndTime',
                'returnDepartureDate',
                'returnDuration',
                'outboundDepartureTime',
                'returnDepartureTime',
                'outboundDepartureDay',
                'outboundDepartureMonth',
                'outboundDepartureYear',
                'outboundDayOfWeek',
                'returnDepartureDay',
                'returnDepartureMonth',
                'returnDepartureYear',
                'returnDayOfWeek',
                'full_name',
                'phone',
                'email',
                'address',
                'outboundAdultPrice',
                'outboundChildPrice',
                'outboundInfantPrice',
                'outboundTaxFee',
                'outboundServiceFee',
                'outboundTotalPrice',
                'returnAdultPrice',
                'returnChildPrice',
                'returnInfantPrice',
                'returnTaxFee',
                'returnServiceFee',
                'returnTotalPrice',
                'totalPrice',
                'adultsSession',
                'childrensSession',
                'infantsSession'
            ));
        }
    }

    // Hiển thị giao diện trang liên hẹ
    public function lienhe()
    {
        return view('lienhe');
    }

    // Hiển thị trang lịch sử đặt vé
    public function lichsudatve(Request $request)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $booking_code = $request->input('booking_code');

        // Nếu không có đầu vào nào, trả về collection rỗng
        if (!$name && !$phone && !$email && !$booking_code) {
            $histories = collect(); // Collection rỗng
        } else {
            $histories = Booking::query()
                ->when($name, function ($query, $name) {
                    return $query->where('name', 'like', "%$name%");
                })
                ->when($phone, function ($query, $phone) {
                    return $query->orWhere('phone', 'like', "%$phone%");
                })
                ->when($email, function ($query, $email) {
                    return $query->orWhere('email', 'like', "%$email%");
                })
                ->with('flight.airline')
                ->get();

            // Nếu có booking_code, lọc theo booking_code
            if ($booking_code) {
                $histories = $histories->filter(function ($history) use ($booking_code) {
                    return stripos($history->booking_code, $booking_code) !== false;
                });
            }

            foreach ($histories as $history) {
                $flight = Flight::find($history->flight_id);
                if ($flight) {
                    $departureTime = Carbon::parse($flight->departure_time);
                    $flightStart = Carbon::parse($flight->flight_start);
                    $flightEnd = Carbon::parse($flight->flight_end);

                    $history->departureTime = $departureTime;
                    $history->flightStartTime = $flightStart->format('H:i');
                    $history->flightEndTime = $flightEnd->format('H:i');
                    $history->departureDate = $departureTime->format('d/m/Y');
                    $history->duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');
                    $history->departureDay = $departureTime->format('d');
                    $history->departureMonth = $departureTime->format('m');
                    $history->departureYear = $departureTime->format('Y');
                    $history->departureDayOfWeek = $departureTime->locale('vi')->isoFormat('dddd');
                }

                // Định dạng dữ liệu khách hàng
                $history->adult_count = $history->adult_count ?? 0;
                $history->child_count = $history->child_count ?? 0;
                $history->infant_count = $history->infant_count ?? 0;
                $history->total_price = $history->total_price ?? 0;
                $history->passenger_count = $history->adult_count + $history->child_count + $history->infant_count ?? 0;
            }
        }

        // Hủy vé dựa vào đổi trạng thái status
        foreach ($histories as $history) {
            if ($history->status == 0) {
                $history->status = 1; // Đã hủy
                $history->save();
            }
        }

        return view('lichsudatve', compact('histories', 'booking_code', 'name', 'phone', 'email'));
    }

    // Chức năng hủy vé
    public function huyve(Request $request, Booking $id)
    {
        // Khi hủy thì sẽ thay đổi trạng thái vé bay sang "hủy"
        $id->update([
            'status' => 'hủy'
        ]);
        $request->session()->flash('success', 'Hủy vé thành công');

        // Cập nhật lại số ghế khi hủy vé
        $flight = Flight::find($id->flight_id);
        if ($flight) {
            $flight->increment('available_seats', $id->adult_count + $id->child_count + $id->infant_count);
        }

        return redirect()->back();
    }
}