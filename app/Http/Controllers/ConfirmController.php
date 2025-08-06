<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Services\FlightPrice;
use App\Services\FlightTime;
use Illuminate\Http\Request;

class ConfirmController extends Controller
{

    protected $commonPrice;
    protected $commonTime;

    public function __construct(FlightPrice $commonPrice, FlightTime $commonTime) {
        $this->commonPrice = $commonPrice;
        $this->commonTime = $commonTime;
    }

    public function confirm(Request $request)
    {
        // dd($request->all());

        // Xử lý khi chuyến bay là chuyến bay 1 chiều
        if ($request->has('flight_id')) {
            $flight = Flight::find($request->input('flight_id'));

            // Hàm chuyển mảng thành chuổi
            function flattenInput($input) {
            return is_array($input)
                ? implode(' ', array_filter($input, 'is_string'))
                : (string) $input;
            }

            $adults = $request->input('adults', []);
            $childrens = $request->input('childrens', []);
            $infants = $request->input('infants', []);
            $full_name = flattenInput($request->input('full_name', ''));
            $phone = flattenInput($request->input('phone', ''));
            $email = flattenInput($request->input('email', ''));
            $address = flattenInput($request->input('address', ''));

            session([
                'adults' => is_array($adults) ? $adults : [],
                'childrens' => is_array($childrens) ? $childrens : [],
                'infants' => is_array($infants) ? $infants : [],
                'full_name' => is_array($full_name) ? implode(' ', $full_name) : strval($full_name),
                'phone' => is_array($phone) ? implode(' ', $phone) : strval($phone),
                'email' => is_array($email) ? implode(' ', $email) : strval($email),
                'address' => is_array($address) ? implode(' ', $address) : strval($address)
            ]);

            $price = $this->commonPrice->flightPrice($flight, $adults, $childrens, $infants);
            $time = $this->commonTime->flightTime($flight);

            return view('xacnhan', array_merge(compact('flight', 'adults', 'childrens', 'infants', 'full_name', 'phone', 'email', 'address'), $price, $time));
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
            $outboundPrices = $this->commonPrice->flightPrice($outboundFlight, $adults, $childrens, $infants);
            $returnPrices = $this->commonPrice->flightPrice($returnFlight, $adults, $childrens, $infants);
            $totalPrice = $outboundPrices['total_price'] + $returnPrices['total_price'];

            // Xử lý thời gian bay
            $dataTime = $this->commonTime->flightTime($outboundFlight, $returnFlight);

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
}
