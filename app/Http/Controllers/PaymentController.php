<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Services\FlightPrice;
use App\Services\FlightTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    protected $commonPrice;
    protected $commonTime;

    public function __construct(FlightPrice $commonPrice, FlightTime $commonTime) {
        $this->commonPrice = $commonPrice;
        $this->commonTime = $commonTime;
    }
    public function payment(Request $request)
    {
        // dd($request->all());

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
            $pricing = $this->commonPrice->flightPrice($flight, $adults, $childrens, $infants);
            $adult_price = $pricing['adult_price'];
            $child_price = $pricing['child_price'];
            $infant_price = $pricing['infant_price'];
            $tax_fee = $pricing['tax_fee'];
            $service_fee = $pricing['service_fee'];

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

}
