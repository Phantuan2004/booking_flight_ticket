
        function toggleDetails(flightId) {
            const detailsSection = document.getElementById('details-' + flightId);
            const buttons = document.querySelectorAll('.toggle-details-btn');

            // Tìm button đã được click
            let clickedButton;
            buttons.forEach(button => {
                if (button.getAttribute('onclick').includes(flightId)) {
                    clickedButton = button;
                }
            });

            if (detailsSection.style.display === 'none') {
                detailsSection.style.display = 'block';
                clickedButton.textContent = 'Ẩn chi tiết';
            } else {
                detailsSection.style.display = 'none';
                clickedButton.textContent = 'Hiển thị chi tiết';
            }
        }

        // Giới hạn số lượng hành khách
        const MAX_ADULTS = 9;
        const MAX_CHILDREN = 9;
        const MAX_INFANTS = 9;
        const MIN_PASSENGERS = 0;
        const MAX_TOTAL_PASSENGERS = 9;

        // Hàm hiển thị thông báo
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.className = 'notification';
            notification.textContent = message;
            document.body.appendChild(notification);
            notification.style.display = 'block';

            setTimeout(() => {
                notification.style.display = 'none';
                notification.remove();
            }, 3000);
        }

        // Hàm kiểm tra tổng số hành khách
        function checkTotalPassengers(formType) {
            const suffix = formType === 'roundtrip' ? '-roundtrip' : '-oneway';
            const adultCount = parseInt(document.getElementById(`adults-input${suffix}`).value);
            const childCount = parseInt(document.getElementById(`childrens-input${suffix}`).value);
            const infantCount = parseInt(document.getElementById(`infants-input${suffix}`).value);
            const total = adultCount + childCount + infantCount;

            if (total > MAX_TOTAL_PASSENGERS) {
                showNotification('Tổng số hành khách không được vượt quá 9 người!');
                return false;
            }
            return true;
        }

        // Hàm tăng số lượng hành khách
        function incrementPassenger(type, formType) {
            const suffix = formType === 'roundtrip' ? '-roundtrip' : '-oneway';
            const countElement = document.getElementById(`${type}-count${suffix}`);
            const inputElement = document.getElementById(`${type}s-input${suffix}`);
            let count = parseInt(countElement.textContent);
            const maxLimit = type === 'adult' ? MAX_ADULTS : (type === 'child' ? MAX_CHILDREN : MAX_INFANTS);

            if (count < maxLimit) {
                if (type === 'infant') {
                    const adultCount = parseInt(document.getElementById(`adults-input${suffix}`).value);
                    if (count < adultCount) {
                        count++;
                    } else {
                        showNotification('Số em bé không được vượt quá số người lớn!');
                        return;
                    }
                } else {
                    count++;
                }

                // Kiểm tra tổng số hành khách trước khi cập nhật
                const newTotal = count +
                    parseInt(document.getElementById(`childrens-input${suffix}`).value) +
                    parseInt(document.getElementById(`infants-input${suffix}`).value);

                if (newTotal > MAX_TOTAL_PASSENGERS) {
                    showNotification('Tổng số hành khách không được vượt quá 9 người!');
                    return;
                }

                countElement.textContent = count;
                inputElement.value = count;
            } else {
                showNotification(
                    `Số lượng ${type === 'adult' ? 'người lớn' : (type === 'child' ? 'trẻ em' : 'em bé')} không được vượt quá ${maxLimit}!`
                );
            }
        }

        // Hàm giảm số lượng hành khách
        function decrementPassenger(type, formType) {
            const suffix = formType === 'roundtrip' ? '-roundtrip' : '-oneway';
            const countElement = document.getElementById(`${type}-count${suffix}`);
            const inputElement = document.getElementById(`${type}s-input${suffix}`);
            let count = parseInt(countElement.textContent);

            if (count > MIN_PASSENGERS) {
                if (type === 'adult') {
                    const infantCount = parseInt(document.getElementById(`infants-input${suffix}`).value);
                    if (count > infantCount) {
                        count--;
                    } else {
                        showNotification('Số người lớn không được ít hơn số em bé!');
                        return;
                    }
                } else {
                    count--;
                }

                countElement.textContent = count;
                inputElement.value = count;
            }
        }

        function showForm(formType) {
            // Ẩn tất cả các form
            document.querySelectorAll('.form-container').forEach(form => {
                form.classList.remove('active');
            });

            // Hiển thị form được chọn
            const selectedForm = document.getElementById(formType + '-form');
            if (selectedForm) {
                selectedForm.classList.add('active');
            }

            // Cập nhật trạng thái radio buttons
            document.querySelectorAll('.search-radio input[type="radio"]').forEach(radio => {
                radio.checked = radio.value === formType;
            });
        }

        // Khởi tạo form mặc định khi trang được tải
        document.addEventListener('DOMContentLoaded', function() {
            showForm('oneway');
        });

        // khi click vào button sẽ đổi màu button và giữ nguyên
        document.querySelectorAll('.search-radio button').forEach(button => {
            button.addEventListener('click', function() {
                // Xóa màu của tất cả các button
                document.querySelectorAll('.search-radio button').forEach(btn => {
                    btn.style.backgroundColor = '#e0e0e0';
                    btn.style.color = 'black';
                });

                // Đổi màu button được click
                this.style.backgroundColor = '#003580';
                this.style.color = 'white';
            });
        });

        // Khởi tạo màu cho button mặc định
        document.addEventListener('DOMContentLoaded', function() {
            const defaultButton = document.querySelector('.search-radio button');
            if (defaultButton) {
                defaultButton.style.backgroundColor = '#003580';
                defaultButton.style.color = 'white';
            }
        });
