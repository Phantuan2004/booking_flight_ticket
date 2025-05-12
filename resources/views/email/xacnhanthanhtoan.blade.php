<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkyJet - Đặt Vé Thành Công - Yêu Cầu Thanh Toán</title>
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
                            <h2 style="margin: 0; font-size: 20px; color: white;">Đặt Vé Thành Công - Yêu Cầu Thanh Toán
                            </h2>
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
                                            Cảm ơn bạn đã đặt vé với SkyJet. Đơn đặt vé của bạn đã được xác nhận.<br>
                                            <strong style="color: #e74c3c; font-size: 18px;">Vui lòng thanh toán để hoàn
                                                tất đặt vé.</strong>
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
                                                    <strong style="font-size: 16px; color: #003580;">Mã đặt
                                                        chỗ:</strong> <span
                                                        style="font-size: 1.2rem; color:#555">{{ $booking_code }}</span>
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
                                                    {{ $adultsCount }} người lớn,
                                                    {{ $childrensCount }} trẻ em,
                                                    {{ $infantsCount }} trẻ sơ sinh
                                                    )
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-size: 14px; color: #666; padding-bottom: 5px;">
                                                    <!-- Passenger list will be populated here dynamically -->
                                                </td>
                                            </tr>
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
                                                                Người lớn (x{{ $adultsCount }})</td>
                                                            <td
                                                                style="font-size: 14px; color: #666; text-align: right; padding-bottom: 5px;">
                                                                {{ number_format($adult_price, 0, ',', '.') }} VNĐ</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 14px; color: #666; padding-bottom: 5px;">
                                                                Trẻ em (x{{ $childrensCount }})</td>
                                                            <td
                                                                style="font-size: 14px; color: #666; text-align: right; padding-bottom: 5px;">
                                                                {{ number_format($child_price, 0, ',', '.') }} VNĐ</td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="font-size: 14px; color: #666; padding-bottom: 5px;">
                                                                Trẻ sơ sinh (x{{ $infantsCount }})</td>
                                                            <td
                                                                style="font-size: 14px; color: #666; text-align: right; padding-bottom: 5px;">
                                                                {{ number_format($infant_price, 0, ',', '.') }} VNĐ
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

                    <!-- Payment Options Title -->
                    <tr>
                        <td align="center" style="padding: 30px 30px 0 30px;">
                            <h2 style="color: #003580; margin-bottom: 15px; font-size: 20px;">Phương Thức Thanh Toán
                            </h2>
                            <p style="color: #e74c3c; font-weight: bold; margin-top: 0; margin-bottom: 20px;">Vui lòng
                                thanh toán trong vòng 24h sau khi đặt vé</p>
                        </td>
                    </tr>

                    <!-- Payment Options -->
                    <tr>
                        <td style="padding: 0 30px;">
                            <!-- Bank Transfer Option -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="margin-bottom: 20px; border: 1px solid #eee; border-radius: 8px;">
                                <tr>
                                    <td
                                        style="padding: 15px; background-color: #f9f9f9; border-bottom: 1px solid #eee; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                        <h3 style="margin: 0; color: #003580; font-size: 18px;">Chuyển khoản ngân hàng
                                        </h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="50%" valign="top" style="padding-right: 10px;">
                                                    <p style="margin: 0 0 10px 0; font-weight: bold; color: #003580;">
                                                        Hà Nội:</p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Ngân hàng:</strong> MB bank
                                                    </p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Chủ tài khoản:</strong> SKYJET VIỆT NAM
                                                    </p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Số tài khoản:</strong> 1234567890
                                                    </p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Chi nhánh:</strong> Hà Nội
                                                    </p>
                                                </td>
                                                <td width="50%" valign="top" style="padding-left: 10px;">
                                                    <p style="margin: 0 0 10px 0; font-weight: bold; color: #003580;">
                                                        TP.HCM:</p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Ngân hàng:</strong> MB bank
                                                    </p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Chủ tài khoản:</strong> SKYJET VIỆT NAM
                                                    </p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Số tài khoản:</strong> 0987654321
                                                    </p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Chi nhánh:</strong> Hồ Chí Minh
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px; border-top: 1px solid #eee;">
                                        <p style="margin: 0 0 10px 0; font-weight: bold; color: #003580;">Nội dung
                                            chuyển khoản:</p>
                                        <div
                                            style="background-color: #f5f5f5; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
                                            <p style="margin: 0; font-size: 14px; word-break: break-all;">
                                                SKYJET-{{ $flight_code }}
                                                {{ $departureDay }}/{{ $departureMonth }}/{{ $departureYear }} -
                                                {{ $full_name }}</p>
                                        </div>
                                        <p style="margin: 0; font-size: 13px; color: #777; font-style: italic;">Vui
                                            lòng ghi đúng nội dung chuyển khoản này để hệ thống xác nhận thanh toán của
                                            bạn.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center" style="padding: 15px; border-top: 1px solid #eee;">
                                        <a href="https://img.vietqr.io/image/MB-0398694446-print.png" target="_blank"
                                            style="display: inline-block; text-decoration: none; padding: 10px 25px; background-color: #003580; color: white; border-radius: 4px; font-weight: bold; font-size: 14px;">Xem
                                            QR Code</a>
                                    </td>
                                </tr>
                            </table>

                            <!-- MoMo Option -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="margin-bottom: 20px; border: 1px solid #eee; border-radius: 8px;">
                                <tr>
                                    <td
                                        style="padding: 15px; background-color: #f9f9f9; border-bottom: 1px solid #eee; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                        <h3 style="margin: 0; color: #a50064; font-size: 18px;">Ví điện tử MoMo</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="70%" valign="top">
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Số điện thoại:</strong> 0987654321
                                                    </p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Tên tài khoản:</strong> SKYJET VIỆT NAM
                                                    </p>
                                                    <p style="margin: 0 0 10px 0; font-size: 14px; color: #666;">
                                                        <strong>Số tiền:</strong>
                                                        {{ number_format($total_price, 0, ',', '.') }} VNĐ
                                                    </p>
                                                    <p style="margin: 0 0 10px 0; font-weight: bold; color: #003580;">
                                                        Nội dung chuyển khoản:</p>
                                                    <div
                                                        style="background-color: #f5f5f5; padding: 10px; border-radius: 5px;">
                                                        <p style="margin: 0; font-size: 14px; word-break: break-all;">
                                                            SKYJET-{{ $flight_code }}
                                                            {{ $departureDay }}/{{ $departureMonth }}/{{ $departureYear }}
                                                            - {{ $full_name }}</p>
                                                    </div>
                                                </td>
                                                <td width="30%" align="center" valign="top">
                                                    <img src="https://img.vietqr.io/image/MB-0398694446-print.png"
                                                        alt="MoMo QR Code" width="100"
                                                        style="display: block; margin: 0 auto;">
                                                    <p style="margin: 5px 0 0 0; font-size: 12px; color: #777;">Quét mã
                                                        để thanh toán</p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Office Payment Option -->
                            <table width="100%" border="0" cellspacing="0" cellpadding="0"
                                style="margin-bottom: 20px; border: 1px solid #eee; border-radius: 8px;">
                                <tr>
                                    <td
                                        style="padding: 15px; background-color: #f9f9f9; border-bottom: 1px solid #eee; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                        <h3 style="margin: 0; color: #003580; font-size: 18px;">Thanh toán tại văn
                                            phòng</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="50%" valign="top" style="padding-right: 10px;">
                                                    <p style="margin: 0 0 10px 0; font-weight: bold; color: #003580;">
                                                        Văn phòng Hà Nội:</p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">Tầng 5,
                                                        Tòa nhà ABC, 123 Nguyễn Chí Thanh, Đống Đa, Hà Nội</p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Giờ làm việc:</strong> 8:00 - 17:30 (T2 - T6), 8:00 -
                                                        12:00 (T7)
                                                    </p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Hotline:</strong> 024.1234.5678
                                                    </p>
                                                </td>
                                                <td width="50%" valign="top" style="padding-left: 10px;">
                                                    <p style="margin: 0 0 10px 0; font-weight: bold; color: #003580;">
                                                        Văn phòng TP.HCM:</p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">Tầng 3,
                                                        Tòa nhà XYZ, 456 Cách Mạng Tháng 8, Quận 3, TP.HCM</p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Giờ làm việc:</strong> 8:00 - 17:30 (T2 - T6), 8:00 -
                                                        12:00 (T7)
                                                    </p>
                                                    <p style="margin: 0 0 5px 0; font-size: 14px; color: #666;">
                                                        <strong>Hotline:</strong> 028.1234.5678
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 15px; border-top: 1px solid #eee;">
                                        <p style="margin: 0; font-size: 13px; color: #777;">Vui lòng mang theo
                                            CMND/CCCD khi đến thanh toán tại quầy. Đơn đặt vé sẽ được giữ trong vòng 24
                                            giờ kể từ thời điểm đặt.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- <!-- Confirm Payment Button -->
                    <tr>
                        <td align="center" style="padding: 15px 30px 30px 30px;">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td align="center" bgcolor="#4CAF50" style="border-radius: 4px;">
                                        <a href="{{ route('xacnhanthanhtoan', ['booking_id' => $booking_id]) }}"
                                            target="_blank"
                                            style="font-size: 16px; font-weight: bold; color: white; text-decoration: none; display: inline-block; padding: 12px 30px;">Xác
                                            Nhận Đã Thanh Toán</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> --}}

                    <!-- Payment Instructions -->
                    <tr>
                        <td align="center" style="padding: 0 30px 30px 30px;">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f0f8ff"
                                style="border-radius: 8px;">
                                <tr>
                                    <td style="padding: 20px;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td style="font-size: 18px; color: #003580; padding-bottom: 15px;">
                                                    Hướng dẫn thanh toán
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom: 10px; color: #555;">
                                                    <table width="100%" border="0" cellspacing="0"
                                                        cellpadding="0">
                                                        <tr>
                                                            <td width="25" valign="top"
                                                                style="color: #4caf50; font-weight: bold;">1.</td>
                                                            <td style="line-height: 1.6;">Chọn một trong các phương
                                                                thức thanh toán trên</td>
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
                                                                style="color: #4caf50; font-weight: bold;">2.</td>
                                                            <td style="line-height: 1.6;">Hoàn tất thanh toán với số
                                                                tiền chính xác và nội dung chuyển khoản như hướng dẫn
                                                            </td>
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
                                                                style="color: #4caf50; font-weight: bold;">3.</td>
                                                            <td style="line-height: 1.6;">Sau khi thanh toán, bạn có
                                                                thể nhấn vào nút "Xác Nhận Đã Thanh Toán" hoặc gửi biên
                                                                lai về email: <strong>booking@skyjet.vn</strong></td>
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
                                                                style="color: #4caf50; font-weight: bold;">4.</td>
                                                            <td style="line-height: 1.6;">Sau khi xác nhận thanh toán
                                                                thành công, chúng tôi sẽ gửi vé điện tử qua email của
                                                                bạn</td>
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

                    <!-- Note -->
                    <tr>
                        <td align="center" style="padding: 0 30px 30px 30px;">
                            <p style="margin: 0; font-size: 14px; color: #e74c3c; font-weight: bold;">
                                Lưu ý: Vui lòng thanh toán trong vòng 24 giờ để đảm bảo giữ chỗ cho chuyến bay của bạn
                            </p>
                            <p style="margin: 10px 0 0 0; font-size: 14px; color: #666; font-style: italic;">
                                Nếu bạn cần hỗ trợ thêm, vui lòng liên hệ với bộ phận hỗ trợ khách hàng của chúng tôi
                                qua số hotline: 1900 1234
                            </p>
