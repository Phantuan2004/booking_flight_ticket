<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Services\FlightPrice;
use App\Services\FlightTime;
use App\Services\ParseSessionData;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $commonPrice;
    protected $commonTime;
    protected $commonSessionData;

    public function __construct(FlightPrice $commonPrice, FlightTime $commonTime, ParseSessionData $commonSessionData) {
        $this->commonPrice = $commonPrice;
        $this->commonTime = $commonTime;
        $this->commonSessionData = $commonSessionData;
    }

    public function payment(Request $request)
    {
        // dd(session()->all());

        // Kiểm tra xem có flight_id không
        if ($request->has('flight_id')) {
            $flight = Flight::with('airline')->find($request->input('flight_id'));

            if (!$flight) {
                return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
            }

            // Lấy thông tin hành khách
            $adultsSession = $this->commonSessionData->parseSessionData($request, 'adults');
            $childrensSession = $this->commonSessionData->parseSessionData($request, 'childrens');
            $infantsSession = $this->commonSessionData->parseSessionData($request, 'infants');

            // Xử lý thông tin khách hàng
            $full_name = trim($request->input('full_name', session('full_name', '')));
            $phone = trim($request->input('phone', session('phone', '')));
            $email = trim($request->input('email', session('email', '')));
            $address = trim($request->input('address', session('address', '')));

            // Xử lý giá tiền
            $adults = count($adultsSession);
            $childrens = count($childrensSession);
            $infants = count($infantsSession);
            
            $priceData = $this->commonPrice->flightPrice($flight, $adults, $childrens, $infants);
            $totalPrice = $priceData['adult_price'] + $priceData['child_price'] + $priceData['infant_price'] + $priceData['tax_fee'] + $priceData['service_fee'];

            // Xử lý thời gian bay
            $flightTimeData = $this->commonTime->flightTime($flight);
            // Đặt biến riêng cho chuyến bay 1 chiều
            [
                'departureTime' => $departureTime,
                'flightStart' => $flightStart,
                'flightEnd' => $flightEnd,
                'flightStartTime' => $flightStartTime,
                'flightEndTime' => $flightEndTime,
                'departureDate' => $departureDate,
                'departureMonth' => $departureMonth,
                'departureYear' => $departureYear,
                'departureDay' => $departureDay,
                'departureDayOfWeek' => $departureDayOfWeek,
                'duration' => $duration,
            ] = $flightTimeData;

            // Truyền dữ liệu sang view
           return view('thanhtoan', compact([
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
                'priceData',
                'totalPrice',
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
            ]));

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
            $adultsSession = $this->commonSessionData->parseSessionData($request, 'adults');
            $childrensSession = $this->commonSessionData->parseSessionData($request, 'childrens');
            $infantsSession = $this->commonSessionData->parseSessionData($request, 'infants');

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
            $outboundPriceData = $this->commonPrice->flightPrice($outboundFlight, $adults, $childrens, $infants);
            $outboundTotalPrice = $outboundPriceData['adult_price'] + $outboundPriceData['child_price'] + $outboundPriceData['infant_price'] + $outboundPriceData['tax_fee'] + $outboundPriceData['service_fee'];

            // Xử lý giá tiền cho chuyến về
            $returnPriceData = $this->commonPrice->flightPrice($returnFlight, $adults, $childrens, $infants);
            $returnTotalPrice = $returnPriceData['adult_price'] + $returnPriceData['child_price'] + $returnPriceData['infant_price'] + $returnPriceData['tax_fee'] + $returnPriceData['service_fee'];

            // Tổng giá tiền
            $totalPrice = $outboundTotalPrice + $returnTotalPrice;

            // Lấy dữ liệu thời gian bay cho chuyến đi và chuyến về
            $outboundTime = $this->commonTime->flightTime($outboundFlight);
            $returnTime = $this->commonTime->flightTime($returnFlight);

            // Đặt biến riêng cho chuyến đi
            [
                'departureTime' => $outboundDepartureTime,
                'flightStart' => $outboundFlightStart,
                'flightEnd' => $outboundFlightEnd,
                'flightStartTime' => $outboundFlightStartTime,
                'flightEndTime' => $outboundFlightEndTime,
                'departureDate' => $outboundDepartureDate,
                'departureMonth' => $outboundDepartureMonth,
                'departureYear' => $outboundDepartureYear,
                'departureDay' => $outboundDepartureDay,
                'duration' => $outboundDuration,
                'departureDayOfWeek' => $outboundDayOfWeek,
            ] = $outboundTime;

            // Đặt biến riêng cho chuyến về
            [
                'departureTime' => $returnDepartureTime,
                'flightStart' => $returnFlightStart,
                'flightEnd' => $returnFlightEnd,
                'flightStartTime' => $returnFlightStartTime,
                'flightEndTime' => $returnFlightEndTime,
                'departureDate' => $returnDepartureDate,
                'departureMonth' => $returnDepartureMonth,
                'departureYear' => $returnDepartureYear,
                'departureDay' => $returnDepartureDay,
                'duration' => $returnDuration,
                'departureDayOfWeek' => $returnDayOfWeek,
            ] = $returnTime;

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
