
        let selectedOutbound = null;
        let selectedReturn = null;

        function selectFlight(flightId, type, button, flightCode, airline, departure, destination, departureTime, price) {
            // Bỏ chọn các button cùng loại
            const container = type === 'outbound' ? 'container-1' : 'container-2';
            const otherButtons = document.querySelectorAll(`.${container} .select-btn`);
            otherButtons.forEach(btn => {
                if (btn !== button) {
                    btn.textContent = 'Chọn';
                    btn.classList.remove('selected');
                }
            });

            // Xử lý button được click
            if (button.classList.contains('selected')) {
                button.textContent = 'Chọn';
                button.classList.remove('selected');
                if (type === 'outbound') {
                    selectedOutbound = null;
                    document.getElementById('outbound_flight_id').value = '';
                    document.getElementById('outbound_flight_code').value = '';
                    document.getElementById('outbound_airline').value = '';
                    document.getElementById('outbound_departure').value = '';
                    document.getElementById('outbound_destination').value = '';
                    document.getElementById('outbound_departure_time').value = '';
                    document.getElementById('outbound_price').value = '';
                } else {
                    selectedReturn = null;
                    document.getElementById('return_flight_id').value = '';
                    document.getElementById('return_flight_code').value = '';
                    document.getElementById('return_airline').value = '';
                    document.getElementById('return_departure').value = '';
                    document.getElementById('return_destination').value = '';
                    document.getElementById('return_departure_time').value = '';
                    document.getElementById('return_price').value = '';
                }
            } else {
                button.textContent = 'Đã chọn';
                button.classList.add('selected');
                if (type === 'outbound') {
                    selectedOutbound = flightId;
                    document.getElementById('outbound_flight_id').value = flightId;
                    document.getElementById('outbound_flight_code').value = flightCode;
                    document.getElementById('outbound_airline').value = airline;
                    document.getElementById('outbound_departure').value = departure;
                    document.getElementById('outbound_destination').value = destination;
                    document.getElementById('outbound_departure_time').value = departureTime;
                    document.getElementById('outbound_price').value = price;
                } else {
                    selectedReturn = flightId;
                    document.getElementById('return_flight_id').value = flightId;
                    document.getElementById('return_flight_code').value = flightCode;
                    document.getElementById('return_airline').value = airline;
                    document.getElementById('return_departure').value = departure;
                    document.getElementById('return_destination').value = destination;
                    document.getElementById('return_departure_time').value = departureTime;
                    document.getElementById('return_price').value = price;
                }
            }

            // Kiểm tra và cập nhật trạng thái nút submit
            const submitBtn = document.getElementById('submitBtn');
            if (selectedOutbound && selectedReturn) {
                submitBtn.disabled = false;
                submitBtn.style.backgroundColor = '#28a745';
                submitBtn.style.cursor = 'pointer';
            } else {
                submitBtn.disabled = true;
                submitBtn.style.backgroundColor = '#ccc';
                submitBtn.style.cursor = 'not-allowed';
            }
        }

        function toggleDetails(flightId, type) {
            const detailsSection = document.getElementById('details-' + flightId);
            const clickedButton = document.querySelector(`button[onclick*="${flightId}"]`);
            const icon = clickedButton.querySelector('i');

            // Đóng tất cả details của section khác
            const otherType = type === 'outbound' ? 'return' : 'outbound';
            const otherContainer = document.querySelector(`.container-${otherType === 'outbound' ? '1' : '2'}`);
            if (otherContainer) {
                const otherDetails = otherContainer.querySelectorAll('.flight-details-container');
                const otherIcons = otherContainer.querySelectorAll('.info-button i');

                otherDetails.forEach(detail => {
                    detail.style.display = 'none';
                });

                otherIcons.forEach(i => {
                    i.className = 'fa-solid fa-square-plus';
                });
            }

            // Toggle details hiện tại
            if (detailsSection.style.display === 'none') {
                detailsSection.style.display = 'block';
                icon.className = 'fa-solid fa-square-minus';
            } else {
                detailsSection.style.display = 'none';
                icon.className = 'fa-solid fa-square-plus';
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