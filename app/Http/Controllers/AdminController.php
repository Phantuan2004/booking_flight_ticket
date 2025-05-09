<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Flight;
use App\Models\Airline;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function admin(Request $request)
    {
        // Hiển thị danh sách hãng bay
        $airlines = Airline::all();

        // Hiển thị danh sách chuyến bay và tổng số
        $flights = Flight::with('airline')->orderBy('id', 'desc')->paginate(5, ["*"], 'page_flights');
        Flight::where('departure_time', '<', now())
            ->where('status', '!=', 'hủy bỏ') // Không cập nhật chuyến bay bị hủy
            ->update(['status' => 'hoàn thành']);

        // Hiển thị hãng bay
        $airlines = Airline::all();
        // Tổng chuyến bay sắp tới
        $upcomingFlights = Flight::where('departure_time', '>', now())->count();
        // Hiển thị vé đã bán và tổng số
        $bookings = Booking::with('flight')->paginate(5, ["*"], 'page_bookings');
        // Lấy tất cả trạng thái vé
        $statusAll = Booking::select('status')->get();
        $totalBookings = $bookings->count();
        // Tỉ lệ đặt vé thành công
        $successfulBookings = $totalBookings > 0 ? round(($totalBookings / Flight::count()) * 100, 2) : 0;
        // Số vé trung bình mỗi chuyến bay
        $averageBookings = $totalBookings > 0 ? round($totalBookings / Flight::count(), 2) : 0;
        // Tháng có doanh thu cao nhất
        $highestRevenueFlight = Flight::with('bookings')
            ->whereMonth('departure_time', now()->month)
            ->withSum('bookings', 'total_price')
            ->orderByDesc('bookings_sum_total_price')
            ->first();

        // Tổng doanh thu
        $totalRevenue = $bookings->sum('total_price');
        // Hiển thị người dùng
        $users = User::where('role', 'user')->paginate(5, ["*"], 'page_users');
        // Hiển thị người dùng vãng lai
        $guestUsers = Guest::query()->paginate(5, ["*"], 'page_guests');
        // Tổng số khách hàng
        $totalUsers = User::where('role', 'user')->count();
        $totalGuests = Guest::count();
        $totalCustomers = $totalUsers + $totalGuests;

        return view('admin/admin', compact('flights', 'airlines', 'bookings', 'averageBookings', 'statusAll', 'successfulBookings', 'upcomingFlights', 'highestRevenueFlight', 'totalBookings', 'totalRevenue', 'users', 'guestUsers', 'totalCustomers', 'totalUsers', 'totalGuests'));
    }
    public function addAirline(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $logoFile = $request->file('logo');
        $logoAirline = $request->name . '_' . time() . '.' . $logoFile->getClientOriginalExtension();
        $logoFile->storeAs('airline_logos', $logoAirline, 'public');
        $airline_code = 'AIR_' . rand(100, 999);

        Airline::create([
            'airline_code' => $airline_code,
            'name' => $request->name,
            'logo' => $logoAirline,
        ]);

        flash()->success('Thêm hãng bay thành công');

        return redirect()->route('admin');
    }

    public function editAirline(Request $request, $id)
    {
        $airline = Airline::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'name' => $request->name,
        ];

        if ($request->hasFile('logo')) {
            // Xóa logo cũ nếu tồn tại
            if ($airline->logo && Storage::exists('public/airline_logos/' . $airline->logo)) {
                Storage::delete('public/airline_logos/' . $airline->logo);
            }

            $logoFile = $request->file('logo');
            $logoAirline = $request->name . '_' . time() . '.' . $logoFile->getClientOriginalExtension();
            $logoFile->storeAs('airline_logos', $logoAirline, 'public');
            $data['logo'] = $logoAirline;
        }

        try {
            $airline->update($data);
            return redirect()->route('admin')->with('success', 'Cập nhật hãng bay thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi cập nhật hãng bay');
        }
    }

    public function deleteAirline(Request $request, $id)
    {
        $airline = Airline::findOrFail($id);
        $airline->delete();

        flash()->success('Xóa hãng bay thành công');
        return redirect()->route('admin');
    }

    public function search_flight_admin(Request $request)
    {
        // Tìm kiếm chuyến bay
        $query = Flight::query()
            ->where('departure', 'like', '%' . $request->departure . '%')
            ->where('destination', 'like', '%' . $request->destination . '%')
            ->where('departure_time', 'like', '%' . $request->departure_time . '%')
            ->where('airline_id', 'like', '%' . $request->airline_id . '%');

        $searchFlight = $query->with('airline')->paginate(5, ["*"], 'page_flights');
        if ($searchFlight->isEmpty()) {
            $request->session()->flash('error', 'Không tìm thấy chuyến bay phù hợp');
        } else {
            $request->session()->flash('success', 'Tìm kiếm thành công');
        }

        $airlines = Airline::all();

        return view('admin/admin', [
            'searchFlight' => $searchFlight,
            'flights' => Flight::with('airline')->paginate(5, ["*"], 'page_flights'),
            'airlines' => $airlines,
            'bookings' => Booking::with('flight')->paginate(5, ["*"], 'page_bookings'),
            'statusAll' => Booking::select('status')->get(),
            'totalBookings' => Booking::count(),
            'successfulBookings' => Booking::count() > 0 ? round((Booking::count() / Flight::count()) * 100, 2) : 0,
            'averageBookings' => Booking::count() > 0 ? round(Booking::count() / Flight::count(), 2) : 0,
            'highestRevenueFlight' => Flight::with('bookings')
                ->whereMonth('departure_time', now()->month)
                ->withSum('bookings', 'total_price')
                ->orderByDesc('bookings_sum_total_price')
                ->first(),
            'totalRevenue' => Booking::sum('total_price'),
            'users' => User::where('role', 'user')->paginate(5, ["*"], 'page_users'),
            'guestUsers' => Guest::query()->paginate(5, ["*"], 'page_guests'),
            'totalUsers' => User::where('role', 'user')->count(),
            'totalGuests' => Guest::count(),
            'totalCustomers' => User::where('role', 'user')->count() + Guest::count(),
            'upcomingFlights' => Flight::where('departure_time', '>', now())->count(),
        ]);
    }

    // Thêm mới chuyến bay
    public function store(Request $request)
    {
        // Tìm chuyến bay dựa vào ID (có thể null nếu là chuyến bay mới)
        $flight = Flight::find($request->flight_id);

        // Kiểm tra và validate dữ liệu
        $validator = Validator::make($request->all(), [
            'airline_id' => ['required'],
            'departure' => ['required'],
            'destination' => ['required'],
            'departure_time' => ['required'],
            'flight_start' => ['required'],
            'flight_end' => ['required'],
            'seat_class' => ['required', 'in:phổ thông,thương gia'],
            'seat_economy' => [$request->seat_class == 'phổ thông' ? 'required' : 'nullable', 'integer', 'min:0'],
            'seat_business' => [$request->seat_class == 'thương gia' ? 'required' : 'nullable', 'integer', 'min:0'],
            'price_economy' => [$request->seat_class == 'phổ thông' ? 'required' : 'nullable', 'numeric', 'min:0'],
            'price_business' => [$request->seat_class == 'thương gia' ? 'required' : 'nullable', 'numeric', 'min:0'],
        ]);

        // Nếu validate thất bại, trả về lỗi
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Sinh mã chuyến bay ngẫu nhiên
        $flight_code = 'VN_' . rand(10000, 99999);

        // Tạo mới chuyến bay
        Flight::create([
            'airline_id' => $request->airline_id,
            'flight_code' => $flight_code,
            'departure' => $request->departure,
            'destination' => $request->destination,
            'departure_time' => $request->departure_time,
            'flight_start' => $request->flight_start,
            'flight_end' => $request->flight_end,
            'seat_class' => $request->seat_class,
            'seat_economy' => $request->seat_class == 'phổ thông' ? $request->seat_economy : null,
            'seat_business' => $request->seat_class == 'thương gia' ? $request->seat_business : null,
            'price_economy' => $request->seat_class == 'phổ thông' ? $request->price_economy : null,
            'price_business' => $request->seat_class == 'thương gia' ? $request->price_business : null,
            'seats' => ($request->seat_economy ?? 0) + ($request->seat_business ?? 0),
            'available_seats' => ($request->seat_economy ?? 0) + ($request->seat_business ?? 0),
        ]);

        flash()->success('Thêm chuyến bay thành công');
        return redirect()->route('admin');
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

    public function searchAirline(Request $request)
    {
        $keyword = $request->keyword;

        $airlines = Airline::where('name', 'like', "%{keyword}%")->take(5)->get();

        $output = '<ul class="list-group">';
        foreach ($airlines as $airline) {
            $output .= '<li class="list-group-item">' . $airline->name . '</li>';
        }
        $output .= '<ul>';

        return response($output);
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
