<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\BookingConfirm;
use App\Models\Booking;
use App\Models\Flight;
use App\Models\Guest;
use App\Services\FlightPrice;
use App\Services\FlightTime;
use App\Services\ParseSessionData;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SuccessController extends Controller
{
    protected $commonPrice;
    protected $commonTime;
    protected $commonSessionData;

    public function __construct(FlightPrice $commonPrice, FlightTime $commonTime, ParseSessionData $commonSessionData) {
        $this->commonPrice = $commonPrice;
        $this->commonTime = $commonTime;
        $this->commonSessionData = $commonSessionData;
    }

    public function success(Request $request)
    {
        // dd($request->all());
        if ($request->has('flight_id')) {
        $flight = Flight::find($request->input('flight_id'));

        if (!$flight) {
            return redirect()->back()->withErrors(['error' => 'Chuyến bay không tồn tại!']);
        }

       // Lấy thông tin hành khách
        $adultsSession = $this->commonSessionData->parseSessionData($request, 'adults');
        $childrensSession = $this->commonSessionData->parseSessionData($request, 'childrens');
        $infantsSession = $this->commonSessionData->parseSessionData($request, 'infants');

        // Tính số lượng hành khách
        $adults = count($adultsSession);
        $childrens = count($childrensSession);
        $infants = count($infantsSession);
        $total_passengers = $adults + $childrens + $infants;

        $booking_code = "SK_" . random_int(00000, 99999);

        // Lấy thông tin liên hệ từ form hoặc session
        $full_name = $request->input('full_name') ?? session('full_name', '');
        $phone = $request->input('phone') ?? session('phone', '');
        $email = $request->input('email') ?? session('email', '');
        $address = $request->input('address') ?? session('address', '');

        // Xử lý giá tiền
        $priceData = $this->commonPrice->flightPrice($flight, $adults, $childrens, $infants);
        $totalPrice = $priceData['adult_price'] + $priceData['child_price'] + $priceData['infant_price'] + $priceData['tax_fee'] + $priceData['service_fee'];

        // Xử lý thời gian bay
        $flightTimeData = $this->commonTime->flightTime($flight);
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

        // Kiểm tra người dùng có tài khoản hay không
        if (Auth::check()) {
            $user = Auth::user();
            $data = [
                'booking_code' => $booking_code,
                'user_id' => $user->id,
                'name' => $full_name,
                'phone' => $phone,
                'email' => $email,
                'adult_count' => $adults,
                'child_count' => $childrens,
                'infant_count' => $infants,
                'address' => $address,
                'flight_id' => $flight->id,
                'total_price' => $totalPrice,
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
                'adult_count' => $adults,
                'child_count' => $childrens,
                'infant_count' => $infants,
                'address' => $address,
                'total_price' => $totalPrice,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Lưu booking
        Booking::create($data);

        // Cập nhật guest nếu không đăng nhập
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

        // Trừ số ghế
        if ($flight->available_seats >= $total_passengers) {
            $flight->decrement('available_seats', $total_passengers);
        } else {
            return redirect()->back()->withErrors(['error' => 'Số ghế không đủ!']);
        }

        // Gửi mail xác nhận
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
            'priceData' => $priceData,
            'totalPrice' => $totalPrice,
            'adultCount' => $adults,
            'childCount' => $childrens,
            'infantCount' => $infants,
            'full_name' => $full_name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address,
            'adultsSession' => $adultsSession,
            'childrensSession' => $childrensSession,
            'infantsSession' => $infantsSession,
            'departureDay' => $departureDay,
            'departureMonth' => $departureMonth,
            'departureYear' => $departureYear,
            'departureDayOfWeek' => $departureDayOfWeek,
        ]));

        // Truyền dữ liệu sang view, trong view có thể dùng foreach để hiển thị từng hành khách
        return view('thanhcong', compact(
            'flight',
            'adults',
            'infants',
            'childrens',
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
            'priceData',
            'totalPrice',
            'adultsSession',
            'childrensSession',
            'infantsSession'
        ));
        } else {

            // dd($request->all());
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

            // Lấy thông tin hành khách 
            $adultsSession = $this->commonSessionData->parseSessionData($request, 'adults');
            $childrensSession = $this->commonSessionData->parseSessionData($request, 'childrens');
            $infantsSession = $this->commonSessionData->parseSessionData($request, 'infants');

            // Tính số lượng hành khách
            $adults_count = count($adultsSession);
            $childrens_count = count($childrensSession);
            $infants_count = count($infantsSession);
            $total_passengers = $adults_count + $childrens_count + $infants_count;

            $booking_code_outbound = "SK_" . random_int(00000, 99999);
            $booking_code_return = "SK_" . random_int(00000, 99999);

            // Lấy thông tin liên hệ từ form hoặc session
            $full_name = $request->input('full_name') ?? session('full_name', '');
            $phone = $request->input('phone') ?? session('phone', '');
            $email = $request->input('email') ?? session('email', '');
            $address = $request->input('address') ?? session('address', '');

            // Xử lý giá tiền cho chuyến đi
            $outboundPriceData = $this->commonPrice->flightPrice($outboundFlight, $adults_count, $childrens_count, $infants_count);
            $outboundTotalPrice = $outboundPriceData['adult_price'] + $outboundPriceData['child_price'] + $outboundPriceData['infant_price'] + $outboundPriceData['tax_fee'] + $outboundPriceData['service_fee'];

            // Xử lý giá tiền cho chuyến về
            $returnPriceData = $this->commonPrice->flightPrice($returnFlight, $adults_count, $childrens_count, $infants_count);
            $returnTotalPrice = $returnPriceData['adult_price'] + $returnPriceData['child_price'] + $returnPriceData['infant_price'] + $returnPriceData['tax_fee'] + $returnPriceData['service_fee'];

            $totalPrice = $outboundTotalPrice + $returnTotalPrice;

            // Lấy dữ liệu thời gian bay cho chuyến đi và chuyến về
            $flightTime = $this->commonTime->flightTime($outboundFlight, $returnFlight);
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

                'returnTime' => $returnTime,
                'returnStart' => $returnFlightStart,
                'returnEnd' => $returnFlightEnd,
                'returnDuration' => $returnDuration,
                'returnStartTime' => $returnFlightStartTime,
                'returnEndTime' => $returnFlightEndTime,
                'returnDate' => $returnDepartureDate,
                'returnMonth' => $returnDepartureMonth,
                'returnYear' => $returnDepartureYear,
                'returnDay' => $returnDepartureDay,
                'returnDayOfWeek' => $returnDayOfWeek,
            ] = $flightTime;

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
                    'adult_count' => $adults_count,
                    'child_count' => $childrens_count,
                    'infant_count' => $infants_count,
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
                    'adult_count' => $adults_count,
                    'child_count' => $childrens_count,
                    'infant_count' => $infants_count,
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
                    'adult_count' => $adults_count,
                    'child_count' => $childrens_count,
                    'infant_count' => $infants_count,
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
                    'adult_count' => $adults_count,
                    'child_count' => $childrens_count,
                    'infant_count' => $infants_count,
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
                'childrens' => $childrens_count,
                'adults' => $adults_count,
                'infants' => $infants_count,
                'booking_code_outbound' => $booking_code_outbound,
                'outbound_flight_code' => $outboundFlight->flight_code,
                'return_flight_code' => $returnFlight->flight_code,
                'outbound_departure' => $outboundFlight->departure,
                'outbound_destination' => $outboundFlight->destination,
                'booking_code_return' => $booking_code_return,
                'return_departure' => $returnFlight->departure,
                'return_destination' => $returnFlight->destination,
                'return_duration' => $returnDuration,
                'total_price' => $totalPrice,
                'adults_count' => $adults_count,
                'childrens_count' => $childrens_count,
                'infants_count' => $infants_count,
                'full_name' => $full_name,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'outboundPriceData' => $outboundPriceData,
                'returnPriceData' => $returnPriceData,
                'outboundTotalPrice' => $outboundTotalPrice,
                'returnTotalPrice' => $returnTotalPrice,
                'totalPrice' => $totalPrice,
                'adultsSession' => $adultsSession,
                'childrensSession' => $childrensSession,
                'infantsSession' => $infantsSession,
                'outboundFlightStartTime' => $outboundFlightStartTime,
                'outboundFlightEndTime' => $outboundFlightEndTime,
                'outboundDepartureDate' => $outboundDepartureDate,
                'outboundDuration' => $outboundDuration,
                'returnFlightStartTime' => $returnFlightStartTime,
                'returnFlightEndTime' => $returnFlightEndTime,
                'returnDepartureDate' => $returnDepartureDate,
                'returnDuration' => $returnDuration,
                'outboundDepartureTime' => $outboundDepartureTime,
                'outboundDepartureMonth' => $outboundDepartureMonth,
                'outboundDepartureYear' => $outboundDepartureYear,
                'outboundDepartureDay' => $outboundDepartureDay,
                'outboundDayOfWeek' => $outboundDayOfWeek,
                'returnDepartureMonth' => $returnDepartureMonth,
                'returnDepartureYear' => $returnDepartureYear,
                'returnDepartureDay' => $returnDepartureDay,
                'returnDayOfWeek' => $returnDayOfWeek,
            ]));

            return view('thanhcong', compact(
                'outboundFlight',
                'returnFlight',
                'adults_count',
                'childrens_count',
                'infants_count',
                'total_passengers',
                'booking_code_outbound',
                'booking_code_return',
                'totalPrice',
                'full_name',
                'phone',
                'email',
                'address',
                'outboundPriceData',
                'returnPriceData',
                'outboundTotalPrice',
                'returnTotalPrice',
                'totalPrice',
                'adultsSession',
                'childrensSession',
                'infantsSession',
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
