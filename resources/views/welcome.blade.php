<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPAP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header-top {
            background-color: #ff9800;
            color: white;
            padding: 10px 0;
        }
        .header-bottom {
            background-color: #3f51b5;
            color: white;
            padding: 15px 0;
        }
        .header-bottom h1 {
            font-size: 24px;
            margin: 0;
        }
        .breadcrumb-container {
            background-color: #f8f9fa;
            padding: 10px 20px;
        }
        .nav-link {
            color: white !important;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
        .main-menu {
            margin-top: 30px;
        }
        .menu-card {
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .menu-card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .hero {
            background-image: url('/mnt/data/image.png');
            background-size: cover;
            background-position: center;
            height: 32.6vh; /* Change to 100vh */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: black;
            text-align: center;
            position: relative;
        }
        .hero-content {
            z-index: 2;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .features {
            display: flex;
            justify-content: space-around;
            margin-top: 20px; /* Adjust margin */
            text-align: center;
            flex-wrap: wrap; /* Allow wrapping */
            max-height: calc(100vh - 100px); /* Adjust based on header height */
            overflow: hidden; /* Prevent overflow */
        }

        .feature {
            max-width: 300px;
        }

        .feature img {
            max-width: 100%;
            height: 30vh
        }

        footer {
            background-color: #3f51b5;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <!-- Header atas -->
    <div class="header-top text-center">
        <span>(021) 5797 4568 | info@lpap.com</span>
    </div>

    <!-- Header bawah -->
    <div class="header-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="mb-0">LPAP</h1>
            <!-- Navigation -->
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('programs.index') }}">Program</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tickets.index') }}">Tiket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user_details.index') }}">Registrasi LPAP</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>LPAP</h1>
            <p>Lembaga Pengembangan & Aplikasi Pengetahuan</p>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container features">
        <div class="feature">
            <img src="https://images.unsplash.com/photo-1517456793572-1d8efd6dc135?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Career Development">
            <h3>Career Development</h3>
            <p>Kembangkan karirmu untuk menghadapi tantangan di masa depan.</p>
        </div>
        <div class="feature">
            <img src="https://images.unsplash.com/photo-1517456793572-1d8efd6dc135?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Expert Instruction">
            <h3>Expert Instruction</h3>
            <p>Temukan instruktur terbaik untuk pengembangan karirmu.</p>
        </div>
        <div class="feature">
            <img src="https://images.unsplash.com/photo-1517456793572-1d8efd6dc135?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Networking Opportunities">
            <h3>Networking Opportunities</h3>
            <p>Temukan peluang melalui jejaring antar ekspertis.</p>
        </div>
    </div>


    <!-- Footer -->
    <footer class="text-center py-3 mt-4">
        <small>&copy; {{ date('Y') }} LPAP. All Rights Reserved.</small>
    </footer>
</body>
</html>
