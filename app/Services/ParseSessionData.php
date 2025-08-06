<?php 

namespace App\Services;

class ParseSessionData {
    public function parseSessionData($request, $key) {
        $data = $request->input($key);
        // Kiểm tra nếu là chuỗi JSON, giải mã nó
        if (is_string($data)) {
            $data = json_decode($data, true) ?? [];
        }
        // Nếu không phải là mảng, lấy từ session
         if (!is_array($data)) {
            $data = session($key, []);
            if (!is_array($data)) {
                $data = [];
            }
        }
        return $data;
    }
}