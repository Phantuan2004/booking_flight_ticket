<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liên Hệ - SkyJet</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .page-header {
            background-color: #003580;
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .page-header h1 {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .breadcrumb {
            display: flex;
            justify-content: center;
            list-style: none;
        }

        .breadcrumb li {
            margin: 0 5px;
        }

        .breadcrumb li a {
            color: #ffd700;
            text-decoration: none;
        }

        .breadcrumb li:last-child {
            color: rgba(255, 255, 255, 0.7);
        }

        .contact-section {
            padding: 60px 0;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .contact-info {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .contact-info h2 {
            color: #003580;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .info-icon {
            min-width: 50px;
            height: 50px;
            background-color: #eef6ff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #003580;
            font-size: 20px;
        }

        .info-content h3 {
            font-size: 18px;
            margin-bottom: 5px;
            color: #333;
        }

        .info-content p,
        .info-content a {
            color: #666;
            line-height: 1.6;
            text-decoration: none;
            transition: color 0.3s;
        }

        .info-content a:hover {
            color: #003580;
        }

        .social-media {
            margin-top: 30px;
        }

        .social-media h3 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        .social-icons {
            display: flex;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            background-color: #003580;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .social-icon:hover {
            background-color: #002050;
        }

        .contact-form {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 30px;
        }

        .contact-form h2 {
            color: #003580;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background-color: #003580;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
        }

        .submit-btn:hover {
            background-color: #002050;
        }

        .map-section {
            padding: 0 0 60px 0;
        }

        .map-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .map-header {
            padding: 20px;
            background-color: #003580;
            color: white;
        }

        .map-header h2 {
            font-size: 24px;
        }

        .map-content {
            height: 400px;
            background-color: #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: #777;
        }

        .office-locations {
            padding: 60px 0;
            background-color: #f9f9f9;
        }

        .locations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .location-card {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .location-image {
            height: 200px;
            background-size: cover;
            background-position: center;
        }

        .location-details {
            padding: 20px;
        }

        .location-title {
            font-size: 20px;
            color: #003580;
            margin-bottom: 10px;
        }

        .location-address {
            color: #666;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .location-contact {
            color: #666;
            line-height: 1.6;
        }

        .faq-section {
            padding: 60px 0;
        }

        .faq-section h2 {
            text-align: center;
            color: #003580;
            margin-bottom: 40px;
            font-size: 28px;
        }

        .faq-item {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 15px;
            overflow: hidden;
        }

        .faq-question {
            padding: 20px;
            background-color: #f9f9f9;
            color: #003580;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            padding: 20px;
            color: #666;
            line-height: 1.6;
            border-top: 1px solid #eee;
        }

        footer {
            background-color: #003580;
            color: white;
            padding: 40px 0;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
        }

        .footer-column h3 {
            margin-bottom: 20px;
            font-size: 18px;
            color: #ffd700;
        }

        .footer-column ul {
            list-style: none;
        }

        .footer-column ul li {
            margin-bottom: 10px;
        }

        .footer-column ul li a {
            color: #ddd;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-column ul li a:hover {
            color: white;
        }

        .copyright {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: #ddd;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                text-align: center;
            }

            nav ul {
                margin-top: 20px;
            }

            .page-header h1 {
                font-size: 28px;
            }

            .contact-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    {{-- Scroll to top --}}
    @include('components.scroll-to-top')

    {{-- Header --}}
    @include('components.header')

    <section class="page-header">
        <div class="container">
            <h1>Liên Hệ Với Chúng Tôi</h1>
            <ul class="breadcrumb">
                <li><a href="#">Trang Chủ</a></li>
                <li>Liên Hệ</li>
            </ul>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-container">
                <div class="contact-info">
                    <h2>Thông Tin Liên Hệ</h2>

                    <div class="info-item">
                        <div class="info-icon">📍</div>
                        <div class="info-content">
                            <h3>Địa Chỉ</h3>
                            <p>123 Nguyễn Huệ, Quận 1, TP. Hồ Chí Minh</p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">📞</div>
                        <div class="info-content">
                            <h3>Điện Thoại</h3>
                            <p><a href="tel:19001234">Hotline: 1900 1234</a></p>
                            <p><a href="tel:0987654321">CSKH: 0987 654 321</a></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">✉️</div>
                        <div class="info-content">
                            <h3>Email</h3>
                            <p><a href="mailto:info@skyjet.vn">info@skyjet.vn</a></p>
                            <p><a href="mailto:support@skyjet.vn">support@skyjet.vn</a></p>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-icon">🕒</div>
                        <div class="info-content">
                            <h3>Giờ Làm Việc</h3>
                            <p>Thứ 2 - Thứ 6: 8:00 - 20:00</p>
                            <p>Thứ 7 - Chủ Nhật: 8:00 - 18:00</p>
                        </div>
                    </div>

                    <div class="social-media">
                        <h3>Theo Dõi Chúng Tôi</h3>
                        <div class="social-icons">
                            <a href="#" class="social-icon">f</a>
                            <a href="#" class="social-icon">in</a>
                            <a href="#" class="social-icon">𝕏</a>
                            <a href="#" class="social-icon">yt</a>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <h2>Gửi Tin Nhắn Cho Chúng Tôi</h2>
                    <form>
                        <div class="form-group">
                            <label for="name">Họ và Tên *</label>
                            <input type="text" id="name" required />
                        </div>

                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" required />
                        </div>

                        <div class="form-group">
                            <label for="phone">Số Điện Thoại</label>
                            <input type="tel" id="phone" />
                        </div>

                        <div class="form-group">
                            <label for="topic">Chủ Đề</label>
                            <select id="topic">
                                <option value="">-- Chọn Chủ Đề --</option>
                                <option value="booking">Đặt Vé</option>
                                <option value="refund">Hoàn Vé</option>
                                <option value="schedule">Lịch Bay</option>
                                <option value="complaint">Khiếu Nại</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Tin Nhắn *</label>
                            <textarea id="message" required></textarea>
                        </div>

                        <button type="submit" class="submit-btn">GỬI TIN NHẮN</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <div class="map-container">
                <div class="map-header">
                    <h2>Vị Trí Của Chúng Tôi</h2>
                </div>
                <div class="map-content">[Bản đồ sẽ được hiển thị tại đây]</div>
            </div>
        </div>
    </section>

    <section class="office-locations">
        <div class="container">
            <h2 class="section-title">Văn Phòng SkyJet</h2>
            <div class="locations-grid">
                <div class="location-card">
                    <div class="location-image" style="background-image: url('/api/placeholder/400/200')"></div>
                    <div class="location-details">
                        <div class="location-title">Trụ Sở Chính - TP.HCM</div>
                        <div class="location-address">
                            123 Nguyễn Huệ, Quận 1, TP. Hồ Chí Minh
                        </div>
                        <div class="location-contact">
                            <p>Phone: 1900 1234</p>
                            <p>Email: hcm@skyjet.vn</p>
                        </div>
                    </div>
                </div>
                <div class="location-card">
                    <div class="location-image" style="background-image: url('/api/placeholder/400/200')"></div>
                    <div class="location-details">
                        <div class="location-title">Văn Phòng Hà Nội</div>
                        <div class="location-address">
                            45 Tràng Tiền, Quận Hoàn Kiếm, Hà Nội
                        </div>
                        <div class="location-contact">
                            <p>Phone: 1900 4321</p>
                            <p>Email: hanoi@skyjet.vn</p>
                        </div>
                    </div>
                </div>
                <div class="location-card">
                    <div class="location-image" style="background-image: url('/api/placeholder/400/200')"></div>
                    <div class="location-details">
                        <div class="location-title">Văn Phòng Đà Nẵng</div>
                        <div class="location-address">
                            78 Bạch Đằng, Quận Hải Châu, Đà Nẵng
                        </div>
                        <div class="location-contact">
                            <p>Phone: 1900 5678</p>
                            <p>Email: danang@skyjet.vn</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-section">
        <div class="container">
            <h2>Câu Hỏi Thường Gặp</h2>

            <div class="faq-item">
                <div class="faq-question">
                    Làm thế nào để tôi có thể thay đổi thông tin đặt vé?
                    <span>+</span>
                </div>
                <div class="faq-answer">
                    Để thay đổi thông tin đặt vé, bạn có thể đăng nhập vào tài khoản
                    SkyJet của mình, chọn chuyến bay cần thay đổi và nhấp vào "Quản lý
                    đặt chỗ". Hoặc bạn có thể gọi đến Hotline 1900 1234 để được hỗ trợ
                    trực tiếp từ nhân viên chăm sóc khách hàng của chúng tôi.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    Chính sách hoàn vé của SkyJet như thế nào?
                    <span>+</span>
                </div>
                <div class="faq-answer">
                    Chính sách hoàn vé của SkyJet phụ thuộc vào loại vé bạn đã mua. Đối
                    với vé Eco, bạn có thể hoàn vé với phí 20% giá vé trước 24 giờ khởi
                    hành. Đối với vé Flex, bạn có thể hoàn vé miễn phí trước 48 giờ khởi
                    hành. Đối với vé Premium, bạn có thể hoàn vé miễn phí bất cứ lúc nào
                    trước giờ khởi hành.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    Tôi cần mang những giấy tờ gì khi đi máy bay?
                    <span>+</span>
                </div>
                <div class="faq-answer">
                    Đối với chuyến bay nội địa, bạn cần mang theo CMND/CCCD hoặc hộ
                    chiếu còn hiệu lực. Đối với chuyến bay quốc tế, bạn cần mang theo hộ
                    chiếu còn hiệu lực ít nhất 6 tháng tính từ ngày khởi hành và thị
                    thực (nếu quốc gia đến yêu cầu).
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    Làm thế nào để nhận được hỗ trợ nhanh chóng khi có vấn đề khẩn cấp?
                    <span>+</span>
                </div>
                <div class="faq-answer">
                    Trong trường hợp khẩn cấp, bạn có thể gọi đến Hotline hỗ trợ khẩn
                    cấp 24/7 của chúng tôi theo số 1900 9876. Ngoài ra, bạn cũng có thể
                    gửi email đến emergency@skyjet.vn với tiêu đề "KHẨN CẤP" để nhận
                    được phản hồi nhanh nhất.
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>SkyJet</h3>
                    <ul>
                        <li><a href="#">Về Chúng Tôi</a></li>
                        <li><a href="#">Điều Khoản Sử Dụng</a></li>
                        <li><a href="#">Chính Sách Bảo Mật</a></li>
                        <li><a href="#">Chính Sách Hoàn Vé</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Đối Tác</h3>
                    <ul>
                        <li><a href="#">Các Hãng Hàng Không</a></li>
                        <li><a href="#">Khách Sạn Đối Tác</a></li>
                        <li><a href="#">Dịch Vụ Thuê Xe</a></li>
                        <li><a href="#">Bảo Hiểm Du Lịch</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Thanh Toán</h3>
                    <ul>
                        <li><a href="#">Visa / Mastercard</a></li>
                        <li><a href="#">Internet Banking</a></li>
                        <li><a href="#">Ví Điện Tử</a></li>
                        <li><a href="#">Trả Góp</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Liên Hệ</h3>
                    <ul>
                        <li><a href="#">Hotline: 1900 1234</a></li>
                        <li><a href="#">Email: support@skyjet.vn</a></li>
                        <li><a href="#">Địa Chỉ: 123 Nguyễn Huệ, Q.1, TP.HCM</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 SkyJet. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>
</body>

</html>
