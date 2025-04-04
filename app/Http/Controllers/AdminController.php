<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function admin() {
        // Hiển thị danh sách chuyến bay và tổng số
        $flights = Flight::with('airline')->paginate(5, ["*"], 'page_flights');
        // Hiển thị hãng bay
        $airlines = Airline::all();
        $totalFlights = $flights->count();
        // Hiển thị vé đã bán và tổng số
        $bookings = Booking::with('flight')->paginate(5, ["*"], 'page_bookings');
        // Lấy tất cả trạng thái vé
        $statusAll = Booking::select('status')->get();
        $totalBookings = $bookings->count();
        // Tổng doanh thu
        $totalRevenue = $bookings->sum('total_price');
        return view('admin/admin', compact('flights', 'airlines', 'bookings', 'statusAll', 'totalFlights', 'totalBookings', 'totalRevenue'));
    }

    // Thêm mới chuyến bay
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'airline_id' => ['required'],
            'departure' => ['required'],
            'destination' => ['required'],
            'departure_time' => ['required'],
            'flight_start' => ['required'],
            'flight_end' => ['required'],
            'seats' => ['required'],
            'price' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $flight_code = 'VN_' . rand(10000, 99999);
        Flight::create([
            'airline_id' => $request->airline_id,
            'flight_code' => $flight_code,
            'departure' => $request->departure,
            'destination' => $request->destination,
            'departure_time' => $request->departure_time,
            'flight_start' => $request->flight_start,
            'flight_end' => $request->flight_end,
            'seats' => $request->seats,
            'price' => $request->price,
            'available_seats' => $request->seats
        ]);

        return redirect()->route('admin')->with('message', 'Thêm chuyến bay thành công!!');
    }

    // Sửa chuyến bay
    public function update(Request $request, $id)
    {
        $flight = Flight::findOrFail($id);

        $validated = $request->validate([
            'flight_code' => 'required',
            'departure' => 'required',
            'destination' => 'required',
            'departure_time' => 'required|date',
            'flight_start' => 'required',
            'flight_end' => 'required',
            'seats' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'airline_id' => 'required|exists:airlines,id',
        ]);

        $flight->update($validated);

        return redirect()->back()->with('success', 'Sửa chuyến bay thành công!');
    }

    // Xóa chuyến bay
    public function delete(Request $request, Flight $id) {
        $id->delete();
        $request->session()->flash('success', 'Xóa chuyến bay thành công');
        return redirect()->back();
    }

    // Hủy vé đã bán
    public function cancel(Request $request, Booking $id) {
        // Khi hủy thì sẽ thay đổi trạng thái vé bay sang "hủy"
        $id->update([
            'status' => 'hủy'
        ]);
        $request->session()->flash('success', 'Hủy vé thành công');

        // Cập nhật lại số ghế khi hủy vé
        $flight = Flight::find($id->flight_id);
        if ($flight) {
            $flight->increment('available_seats', 1);
        }

        return redirect()->back();
    }
}
