<header>
    <div class="container">
        <div class="header-content">
            <a class="logo-a" href="{{ route('index') }}">
                <div class="logo">Sky<span>Jet</span></div>
            </a>
            <nav>
                <ul>
                    <li><a href="{{ route('index') }}">Trang Chủ</a></li>
                    <li><a href="{{ route('datve_khuhoi') }}">Đặt Vé</a></li>
                    <li><a href="#">Khuyến Mãi</a></li>
                    <li><a href="#">Lịch Bay</a></li>
                    <li><a href="{{ route('contact') }}">Liên Hệ</a></li>
                    <li><a href="{{ route('history') }}">Xem lại lịch sử</a></li>
                </ul>
            </nav>
        </div>
    </div>
</header>

<style>
    header {
        background-color: #003580;
        color: white;
        padding: 20px 0;
    }

    .container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo-a {
        text-decoration: none;
    }

    .logo {
        font-size: 28px;
        font-weight: bold;
        color: #ffffff
    }

    .logo span {
        color: #ffd700;
    }

    nav ul {
        display: flex;
        list-style: none;
    }

    nav ul li {
        margin-left: 20px;
    }

    nav ul li a {
        color: white;
        text-decoration: none;
        transition: color 0.3s;
    }

    nav ul li a:hover {
        color: #ffd700;
    }
</style>
