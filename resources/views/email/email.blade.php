<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyJet - Xác Nhận Đặt Vé</title>
</head>

<body
    style="margin: 0; padding: 0; background-color: #f5f5f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6;">
    <!-- Header -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#003580">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left" style="padding: 0 20px;">
                            <h1 style="margin: 0; font-size: 24px; color: white;">Sky<span
                                    style="color: #ffd700;">Jet</span></h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Page Title -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#003580">
        <tr>
            <td align="center" style="padding: 10px 0;">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" style="padding: 0 20px;">
                            <h2 style="margin: 0; font-size: 20px; color: white;">Xác Nhận Đặt Vé</h2>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Main Content -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" style="padding: 30px 0;">
                <table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff"
                    style="border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                    <!-- Success Message -->
                    <tr>
                        <td align="center" style="padding: 30px 30px 0 30px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" style="padding-bottom: 20px;">
                                        <img src="https://sv1.anhsieuviet.com/2025/04/08/images.jpg" alt="Success"
                                            width="80" height="80" style="display: block;">
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-bottom: 15px;">
                                        <h1 style="margin: 0; font-size: 24px; color: #003580;">Đặt Vé Thành Công!</h1>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding-bottom: 30px;">
                                        <p style="margin: 0; font-size: 16px; color: #666;">
                                            Cảm ơn bạn đã đặt vé với SkyJet. Dưới đây là thông tin chi tiết về chuyến
                                            bay của bạn.<br>
                                            Vui lòng lưu giữ thông tin này để sử dụng khi làm thủ tục bay.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Booking Details -->
                    <tr>
                        <td align="center" style="padding: 0 30px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="border: 1px solid #eee; border-radius: 8px;">
                                <!-- Booking ID -->
                                <tr>
                                    <td style="padding: 15px; border-bottom: 1px solid #eee;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <strong style="font-size: 18px; color: #003580;">Mã đặt
                                                        chỗ:</strong> {{ $booking_code }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Flight Info -->
                                <tr>
                                    <td style="padding: 15px; border-bottom: 1px solid #eee;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="80" valign="top"
                                                    style="border-right: 1px solid #eee; padding-right: 15px;">
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0">
                                                        <tr>
                                                            <td align="center"
                                                                style="font-size: 24px; font-weight: bold; color: #003580;">
                                                                {{ $departureDate }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td valign="top" style="padding-left: 15px;">
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0">
                                                        <tr>
                                                            <td style="padding-bottom: 10px;">
                                                                <table width="100%" border="0" cellspacing="0"
                                                                    cellpadding="0">
                                                                    <tr>
                                                                        <td
                                                                            style="font-size: 18px; font-weight: bold;">
                                                                            {{ $departure }}</td>
                                                                        <td
                                                                            style="font-size: 18px; color: #666; text-align: center;">
                                                                            →</td>
                                                                        <td
                                                                            style="font-size: 18px; font-weight: bold;">
                                                                            {{ $destination }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding-bottom: 5px;">
                                                                <table width="100%" border="0" cellspacing="0"
                                                                    cellpadding="0">
                                                                    <tr>
                                                                        <td style="font-size: 14px; color: #666;">
                                                                            {{ $flightStartTime }}</td>
                                                                        <td
                                                                            style="font-size: 14px; color: #666; text-align: center; border-left: 1px solid #ddd; border-right: 1px solid #ddd; padding: 0 10px;">
                                                                            {{ $duration }}</td>
                                                                        <td
                                                                            style="font-size: 14px; color: #666; text-align: right;">
                                                                            {{ $flightEndTime }}</td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Passenger Info -->
                                <tr>
                                    <td style="padding: 15px; border-bottom: 1px solid #eee;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td
                                                    style="font-size: 14px; color: #003580; font-weight: bold; padding-bottom: 10px;">
                                                    Hành khách (
                                                    {{ $passengerCount }} người lớn,
                                                    {{ $childrenCount }} trẻ em
                                                    )
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; color: #666; padding-bottom: 5px;">
                                                    @if (!empty($passengersSession))
                                                        @foreach ($passengersSession as $index => $passenger)
                                                            <div>
                                                                {{ $index }}.
                                                                {{ $passenger['last_name'] ?? 'Lỗi dữ liệu' }}
                                                                {{ $passenger['first_name'] ?? 'Lỗi dữ liệu' }}
                                                            </div>
                                                        @endforeach

                                                    @endif

                                                    @if (!empty($childrensSession))
                                                        @foreach ($childrensSession as $index => $child)
                                                            <div>
                                                                {{ count($passengersSession) + $index }}.
                                                                {{ $child['last_name'] ?? 'Lỗi dữ liệu' }}
                                                                {{ $child['first_name'] ?? 'Lỗi dữ liệu' }}
                                                            </div>
                                                        @endforeach

                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Contact Info -->
                                <tr>
                                    <td style="padding: 15px; border-bottom: 1px solid #eee;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="padding-bottom: 5px;">
                                                    <strong>Thông tin liên hệ:</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; color: #666; padding-bottom: 3px;">
                                                    <div>{{ $full_name }}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; color: #666; padding-bottom: 3px;">
                                                    <div>Điện thoại: {{ $phone }}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; color: #666;">
                                                    <div>Email: {{ $email }}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; color: #666;">
                                                    <div>Địa chỉ: {{ $address }}</div>
                                                </td>
                                        </table>
                                    </td>
                                </tr>

                                <!-- Payment Info -->
                                <tr>
                                    <td style="padding: 15px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="font-size: 16px; color: #003580; padding-bottom: 10px;">
                                                    Chi tiết thanh toán:
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0">
                                                        <tr>
                                                            <td
                                                                style="font-size: 14px; color: #666; padding-bottom: 5px;">
                                                                Người lớn (x{{ $passengerCount }})</td>
                                                            <td
                                                                style="font-size: 14px; color: #666; text-align: right; padding-bottom: 5px;">
                                                                {{ number_format($adult_price, 0, ',', '.') }} VNĐ
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 14px; color: #666; padding-bottom: 5px;">
                                                                Trẻ em
                                                                (x{{ is_array($childrens) ? count($childrens) : 0 }})
                                                            </td>
                                                            <td
                                                                style="font-size: 14px; color: #666; text-align: right; padding-bottom: 5px;">
                                                                {{ number_format($child_price, 0, ',', '.') }} VNĐ
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 14px; color: #666; padding-bottom: 5px;">
                                                                Thuế & Phí</td>
                                                            <td
                                                                style="font-size: 14px; color: #666; text-align: right; padding-bottom: 5px;">
                                                                {{ number_format(50000, 0, ',', '.') }} VNĐ</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 14px; color: #666; padding-bottom: 10px;">
                                                                Phí dịch vụ</td>
                                                            <td
                                                                style="font-size: 14px; color: #666; text-align: right; padding-bottom: 10px;">
                                                                {{ number_format(20000, 0, ',', '.') }} VNĐ</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 16px; font-weight: bold; padding-top: 10px; border-top: 1px solid #eee;">
                                                                Tổng cộng</td>
                                                            <td
                                                                style="font-size: 16px; font-weight: bold; text-align: right; padding-top: 10px; border-top: 1px solid #eee;">
                                                                {{ number_format($total_price, 0, ',', '.') }} VNĐ</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Next Steps -->
                    <tr>
                        <td align="center" style="padding: 30px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f0f8ff"
                                style="border-radius: 8px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="font-size: 18px; color: #003580; padding-bottom: 15px;">
                                                    Các bước tiếp theo
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 10px; color: #555;">
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0">
                                                        <tr>
                                                            <td width="25" valign="top"
                                                                style="color: #4caf50; font-weight: bold;">✓</td>
                                                            <td style="line-height: 1.6;">Kiểm tra email của bạn để xem
                                                                thông tin vé đầy đủ</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 10px; color: #555;">
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0">
                                                        <tr>
                                                            <td width="25" valign="top"
                                                                style="color: #4caf50; font-weight: bold;">✓</td>
                                                            <td style="line-height: 1.6;">Hãy đến sân bay trước giờ
                                                                khởi hành ít nhất 2 giờ đối với chuyến bay nội địa</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 10px; color: #555;">
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0">
                                                        <tr>
                                                            <td width="25" valign="top"
                                                                style="color: #4caf50; font-weight: bold;">✓</td>
                                                            <td style="line-height: 1.6;">Mang theo giấy tờ tùy thân
                                                                hợp lệ (CMND/CCCD/Hộ chiếu) để làm thủ tục check-in</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="color: #555;">
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0">
                                                        <tr>
                                                            <td width="25" valign="top"
                                                                style="color: #4caf50; font-weight: bold;">✓</td>
                                                            <td style="line-height: 1.6;">Bạn có thể check-in trực
                                                                tuyến trước 24 giờ so với giờ khởi hành</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td align="center" style="padding: 0 30px 30px 30px;">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" bgcolor="#003580" style="border-radius: 4px;">
                                        <a href="#" target="_blank"
                                            style="font-size: 16px; font-weight: bold; color: white; text-decoration: none; display: inline-block; padding: 12px 30px;">Kiểm
                                            Tra Chuyến Bay</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Note -->
                    <tr>
                        <td align="center" style="padding: 0 30px 30px 30px;">
                            <p style="margin: 0; font-size: 14px; color: #666; font-style: italic;">
                                Nếu bạn cần hỗ trợ thêm, vui lòng liên hệ với bộ phận hỗ trợ khách hàng của chúng tôi
                                qua số hotline: 1900 1234
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#003580">
        <tr>
            <td align="center" style="padding: 20px 0;">
                <table width="600" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center" style="padding: 0 20px; color: #ddd; font-size: 14px;">
                            <p style="margin: 0;">&copy; 2025 SkyJet. Tất cả quyền được bảo lưu.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
