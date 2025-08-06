<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liên Hệ - SkyJet</title>
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
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
