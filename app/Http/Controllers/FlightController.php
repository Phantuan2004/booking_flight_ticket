<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    // Hiển thị danh sách chuyến bay
    public function index()
    {
        $flights = Flight::all();
        return view('index', compact('flights'));
    }

    // Thêm mới chuyến bay
    public function create()
    {

    }

    // Xử lý thêm mới chuyến bay
    public function store(Request $request)
    {
        $data = $request->all();
        Flight::create($data);
        return redirect()->route('admin')->with('message', 'Thêm chuyến bay thành công!');
    }

    // Chi tiết chuyến bay
    public function show(Flight $flight)
    {
        $show = Flight::query()->find($flight);
        return view('index', compact('show'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flight $flight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flight $flight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flight $flight)
    {
        //
    }
}
