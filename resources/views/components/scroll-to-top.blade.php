<style>
    /* Scroll to top */
    #scrollToTopBtn {
        display: none;
        position: fixed;
        bottom: 20px;
        right: 30px;
        cursor: pointer;
        border: none;
        outline: none;
        border-radius: 4px;
        width: 50px;
        height: 40px;
        background-color: transparent;
        background-image: url('/images/icons/icon-scroll.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* Hoạt ảnh animation chạy mãi mãi bằng cách sử dụng infinite*/
        animation: up-down 1.8s infinite;
        outline: none;
    }

    @keyframes up-down {
        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(10px);
        }

        100% {
            transform: translateY(0);
        }
    }

    #scrollToTopBtn i {
        font-size: 1rem;
        font-weight: 600;
        align-content: center;
    }

    #scrollToTopBtn:active {
        user-select: none;
    }
</style>

<div id="scrollToTopBtn" class="scroll-to-top-btn"></div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");

        // Hiển thị nút khi cuộn xuống
        window.addEventListener("scroll", function() {
            if (window.pageYOffset > 20) {
                // Nếu cuộn xuống hơn 300px
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        });

        // Xử lý sự kiện khi nhấn vào nút
        scrollToTopBtn.addEventListener("click", function() {
            window.scrollTo({
                top: 0,
                behavior: "smooth", // Cuộn mượt mà
            });
        });
    });
</script>
