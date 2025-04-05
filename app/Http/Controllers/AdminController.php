<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function admin()
    {
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
        // Hiển thị người dùng
        $users = User::where('role', 'user')->paginate(5, ["*"], 'page_users');
        // Hiển thị người dùng vãng lai
        $guestUsers = Guest::query()->paginate(5, ["*"], 'page_guests');
        return view('admin/admin', compact('flights', 'airlines', 'bookings', 'statusAll', 'totalFlights', 'totalBookings', 'totalRevenue', 'users', 'guestUsers'));
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
    public function delete(Request $request, Flight $id)
    {
        $id->delete();
        $request->session()->flash('success', 'Xóa chuyến bay thành công');
        return redirect()->back();
    }

    // ** Chức năng quản lý người dùng
    public function addUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed'],
            'role' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin')->with('message', 'Thêm người dùng thành công!!');
    }
    public function editUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed',
            'role' => 'required',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        }

        $user->update($validated);

        return redirect()->back()->with('success', 'Sửa người dùng thành công!');
    }

    public function searchFlight(Request $request)
    {
        $query = Flight::query();

        if ($request->has('departure') && $request->departure != '') {
            $query->where('departure', 'like', '%' . $request->departure . '%');
        }
        if ($request->has('destination') && $request->destination != '') {
            $query->where('destination', 'like', '%' . $request->destination . '%');
        }
        if ($request->has('departure_time') && $request->departure_time != '') {
            $query->whereDate('departure_time', '=', date('Y-m-d', strtotime($request->departure_time)));
        }

        $flights = $query->with('airline')->paginate(5, ["*"], 'page_flights');

        return view('admin/admin', compact('flights'));
    }

    //* Các chức năng hủy, xóa dữ liệu
    // Hủy vé
    public function cancel(Request $request, Booking $id)
    {
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

    // Xóa tài khoản người dùng
    public function deleteUser(Request $request, User $id)
    {
        $id->delete();
        $request->session()->flash('success', 'Xóa người dùng thành công');
        return redirect()->back();
    }
}
