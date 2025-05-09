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
        $adults = (int) $request->input('adults', 0);
        $childrens = (int) $request->input('childrens', 0);
        $infants = (int) $request->input('infants', 0);

        // Validate number of infants
        if ($infants > $adults) {
            return redirect()->back()->withErrors(['error' => 'Số em bé không thể lớn hơn số người lớn!']);
        }
        $passengers = $adults + $childrens;

        // Save search data to session
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

        // Build the query
        $query = Flight::query()
            ->where('departure', 'like', "%$departure%")
            ->where('destination', 'like', "%$destination%")
            ->whereDate('departure_time', $departure_time)
            ->where('available_seats', '>=', $passengers);

        // Áp dụng sắp xếp dựa trên tham số yêu cầu
        $sort = $request->input('sort');
        if ($sort == 'asc') {
            $query->orderBy('price_economy', 'asc')
                ->orderBy('price_business', 'asc');
        } elseif ($sort == 'desc') {
            $query->orderBy('price_economy', 'desc')
                ->orderBy('price_business', 'desc');
        }

        // Get flights after sorting
        $flights = $query->get();

        // Format prices
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



    // Hiển thị giao diện trang xác nhận
    public function xacnhan(Request $request)
    {
        if ($request->has('flight_id')) {
            // Xử lý khi chuyến bay là chuyến bay 1 chiều
            $flight = Flight::find($request->input('flight_id'));

            if (!$flight) {
                return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
            }

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

            // Xử lý giá tiền
            $adult_price = $flight->seat_class == 'phổ thông' ? $flight->price_economy : $flight->price_business * $adults;
            $child_price = $adult_price * 0.2;
            $infant_price = $adult_price * 0;
            $tax_fee = $flight->seat_class == 'phổ thông' ? 50000 : 100000;
            $service_fee = $flight->seat_class == 'phổ thông' ? 20000 : 40000;
            $total_price = $adult_price + $child_price + $infant_price + $tax_fee + $service_fee;

            // Xử lý thời gian bay
            $departureTime = Carbon::parse($flight->departure_time);
            $flightStart = Carbon::parse($flight->flight_start);
            $flightEnd = Carbon::parse($flight->flight_end);

            // Lấy giờ và phút dưới dạng chuỗi định dạng sẵn
            $flightStartTime = $flightStart->format('H:i');  // Ví dụ: 14:30
            $flightEndTime = $flightEnd->format('H:i');      // Ví dụ: 16:40
            $departureDate = $departureTime->format('d/m/Y'); // Ví dụ: 05/04/2024
            $departureMonth = $departureTime->format('m');
            $departureYear = $departureTime->format('Y');
            $departureDay = $departureTime->format('d');
            $departureDayOfWeek = $departureTime->locale('vi')->isoFormat('dddd');

            // Tính thời gian bay
            $duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');

            return view('xacnhan', compact(
                'flight',
                'adults',
                'childrens',
                'infants',
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
                'departureMonth',
                'departureYear',
                'departureDay',
                'departureDayOfWeek',
            ));
        } else {
            // Xử lý khi chuyến bay là chuyến bay khứ hồi

            // Lấy ID của hai chuyến bay
            $outboundFlightId = $request->input('outbound_flight_id');
            $returnFlightId = $request->input('return_flight_id');

            // Tìm thông tin chuyến bay
            $outboundFlight = Flight::find($outboundFlightId);
            $returnFlight = Flight::find($returnFlightId);

            // Kiểm tra xem cả hai chuyến bay có tồn tại không
            if (!$outboundFlight || !$returnFlight) {
                return redirect()->back()->withErrors(['error' => 'Một hoặc cả hai chuyến bay không tồn tại!']);
            }

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
            // Trả về view xacnhan với dữ liệu
            return view('xacnhan', compact(
                'outboundFlight',
                'returnFlight',
                'adults',
                'childrens',
                'infants',
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
                'returnDepartureTime',
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

            $adults = count($adultsSession);
            $childrens = count($childrensSession);
            $infants = count($infantsSession);

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

            $adults = count($adultsSession);
            $childrens = count($childrensSession);
            $infants = count($infantsSession);

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
        if ($request->has('flight_id')) {
            $flight = Flight::find($request->input('flight_id'));

            if (!$flight) {
                return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
            }

            $adultsSession = $request->input('adults_data');
            // Kiểm tra nếu là chuỗi JSON, giải mã nó
            if (is_string($adultsSession)) {
                $adultsSession = json_decode($adultsSession, true) ?? [];
            }
            // Nếu không phải là mảng, lấy từ session
            if (!is_array($adultsSession)) {
                $adultsSession = session('adults_data', []);
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

            $infantsSession = $request->input('infants_data');
            // Kiểm tra nếu là chuỗi JSON, giải mã nó
            if (is_string($infantsSession)) {
                $infantsSession = json_decode($infantsSession, true) ?? [];
            }
            // Nếu không phải là mảng, lấy từ session
            if (!is_array($infantsSession)) {
                $infantsSession = session('infants_data', []);
            }

            $adultsCount = count($adultsSession);
            $childrensCount = count($childrensSession);
            $infantsCount = count($infantsSession);

            $adults_count = (int) $request->input('adults_data', 0);
            $children_count = (int) $request->input('childrens_data', 0);
            $infants_count = (int) $request->input('infants_data', 0);
            $total_passengers = $adults_count + $children_count + $infants_count;

            $adults = json_decode($request->input('adults_data', '[]'), true) ?? [];
            $childrens = json_decode($request->input('childrens_data', '[]'), true) ?? [];
            $infants = json_decode($request->input('infants_data', '[]'), true) ?? [];

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
            $departureDay = $departureTime->format('d');
            $departureMonth = $departureTime->format('m');
            $departureYear = $departureTime->format('Y');
            $departureDayOfWeek = $departureTime->locale('vi')->isoFormat('dddd');

            // Tính thời gian bay
            $duration = $flightStart->diff($flightEnd)->format('%h giờ %i phút');

            // Xử lý giá tiền
            $adult_price = $flight->seat_class == 'phổ thông' ? $flight->price_economy : $flight->price_business * $adults;
            $child_price = $adult_price * 0.2;
            $infant_price = $adult_price * 0;
            $tax_fee = $flight->seat_class == 'phổ thông' ? 50000 : 100000;
            $service_fee = $flight->seat_class == 'phổ thông' ? 20000 : 40000;
            $total_price = $adult_price + $child_price + $infant_price + $tax_fee + $service_fee;

            // Check người dùng có tài khoản
            if (Auth::check()) {
                $user = Auth::user();
                $data = [
                    'booking_code' => $booking_code,
                    'user_id' => $user->id,
                    'name' => $full_name,
                    'phone' => $phone,
                    'email' => $email,
                    'adult_count' => $adultsCount,
                    'child_count' => $childrensCount,
                    'infant_count' => 0,
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
                    'adult_count' => $adultsCount,
                    'child_count' => $childrensCount,
                    'infant_count' => 0,
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
                'adultsCount' => $adultsCount,
                'childrensCount' => $childrensCount,
                'infantsCount' => $infantsCount,
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
                'adults_count',
                'children_count',
                'infants_count',
                'adultsCount',
                'childrensCount',
                'infantsCount',
                'total_passengers',
                'booking_code',
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
                'infantsSession',
            ));
        } else {
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