
        // JavaScript để quản lý các phương thức thanh toán
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy tất cả các tab phương thức thanh toán
            const methodTabs = document.querySelectorAll('.method-tab');

            // Lấy tất cả các form thanh toán
            const bankTransferForm = document.getElementById('bank-transfer-form');
            const momoForm = document.getElementById('momo-form');
            const counterPaymentForm = document.getElementById('counter-payment-form');

            // Thêm sự kiện click cho mỗi tab
            methodTabs.forEach(function(tab, index) {
                tab.addEventListener('click', function() {
                    // Xóa active class từ tất cả các tab
                    methodTabs.forEach(t => t.classList.remove('active'));

                    // Thêm active class cho tab được click
                    this.classList.add('active');

                    // Ẩn tất cả các form
                    bankTransferForm.style.display = 'none';
                    momoForm.style.display = 'none';
                    counterPaymentForm.style.display = 'none';

                    // Hiển thị form tương ứng với tab được chọn
                    if (index === 0) {
                        bankTransferForm.style.display = 'block';
                    } else if (index === 1) {
                        momoForm.style.display = 'block';
                    } else if (index === 2) {
                        counterPaymentForm.style.display = 'block';
                    }
                });
            });

            // Xử lý hiển thị tên file khi upload biên lai
            const fileInput = document.getElementById('receipt-upload');
            const fileNameDisplay = document.querySelector('.file-name');
            const removeFileButton = document.querySelector('.remove-file');
            if (fileInput && fileNameDisplay) {
                fileInput.addEventListener('change', function() {
                    if (this.files.length > 0) {
                        fileNameDisplay.textContent = this.files[0].name;
                        removeFileButton.style.display = 'block';
                    } else {
                        fileNameDisplay.textContent = 'Chưa có tệp nào được chọn';
                        removeFileButton.style.display = 'none';
                    }
                });
            }

            // Xử lý xóa tệp
            if (removeFileButton) {
                removeFileButton.addEventListener('click', function() {
                    fileInput.value = '';
                    fileNameDisplay.textContent = 'Chưa có tệp nào được chọn!';
                    removeFileButton.style.display = 'none';
                })
            }

            // Xử lý đếm ngược thời gian thanh toán
            const timerElement = document.querySelector('.timer');

            if (timerElement) {
                let timeInSeconds = 10 * 60; // 10 phút = 600 giây

                function updateTimer() {
                    const minutes = Math.floor(timeInSeconds / 60);
                    const seconds = timeInSeconds % 60;

                    // Hiển thị thời gian dạng MM:SS
                    timerElement.textContent =
                        `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                    // Giảm thời gian
                    timeInSeconds--;

                    // Nếu hết thời gian
                    if (timeInSeconds < 0) {
                        clearInterval(timerInterval);
                        timerElement.textContent = '00:00';
                        alert('Thời gian giữ vé đã hết. Vui lòng đặt vé lại.');
                        // Có thể thêm code để quay về trang đặt vé
                    }
                }

                // Cập nhật timer mỗi giây
                updateTimer(); // Gọi ngay lập tức để cập nhật hiển thị ban đầu
                const timerInterval = setInterval(updateTimer, 1000);
            }
        });

        // Khởi tạo fancybox
        Fancybox.bind("[data-fancybox='gallery']");

        function copyToClipboard(button) {
            const input = button.previousElementSibling;
            input.select();
            document.execCommand('copy');

            // Thay đổi text của button
            const originalText = button.textContent;
            button.textContent = 'Đã copy!';
            button.style.backgroundColor = '#28a745';

            // Đổi lại sau 2 giây
            setTimeout(() => {
                button.textContent = originalText;
                button.style.backgroundColor = '#003580';
            }, 2000);
        }
