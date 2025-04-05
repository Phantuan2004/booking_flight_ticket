<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    // Lấy danh sách người dùng vãng lai
    public function getUserGuest()
    {
        $guestUsers = Guest::all();
        return redirect()->route('admin', compact('guestUsers'));
    }

    // Xóa người dùng vãng lai
    public function deleteUserGuest($id)
    {
        $guestUser = Guest::find($id);
        if ($guestUser) {
            $guestUser->delete();
            return redirect()->route('admin')->with('success', 'Xóa người dùng thành công');
        } else {
            return redirect()->route('admin')->with('error', 'Người dùng không tồn tại');
        }
    }
}
