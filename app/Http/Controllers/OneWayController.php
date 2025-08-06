<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

class OneWayController extends Controller
{
    public function queryOneWay(Request $request)
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

        // Lưu thống tin tìm kiếm vào session
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

        // dd(session()->all());

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
}
