<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Airline;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RoundTripController extends Controller
{
    public function queryRoundTrip(Request $request)
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
}
