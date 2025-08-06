<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Flight;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoriesController extends Controller
{
        public function history(Request $request)
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
