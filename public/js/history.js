// Javascript hiển thị lịch sử đặt vé sau khi nhấn tìm kiếm từ form
        const searchForm = document.querySelector('#search-history');
        const resultSection = document.getElementById('result');

        searchForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của form
            // Lấy giá trị từ form
            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const email = document.getElementById('email').value;

            // Validate dữ liệu nhập vào
            if (name.trim() === '' || phone.trim() === '' || email.trim() === '') {
                alert('Vui lòng nhập đầy đủ thông tin!!');
                return;
            }

            // Thực hiện gửi form
            searchForm.submit();

            // Hiển thị phần kết quả 
            resultSection.style.display = 'block';

            // Cuộn trang tới phần kết quả sau khi gửi form
            window.scrollTo({
                top: resultSection.offsetTop,
                behavior: 'smooth'
            });
        })