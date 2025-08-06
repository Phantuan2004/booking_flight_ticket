function showForm(formType) {
            // Ẩn tất cả các form
            document.querySelectorAll('.form-container').forEach(form => {
                form.classList.remove('active');
            });

            // Hiển thị form được chọn
            document.getElementById(formType + '-form').classList.add('active');

            // Cập nhật trạng thái active cho tab
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Tìm tab đang được click và thêm class active
            event.target.classList.add('active');
        }