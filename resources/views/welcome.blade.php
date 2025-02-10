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
        .nav {
          padding: 0px !important;
        }
        .nav-link {
            color: white !important;
            font-size: 14px !important;
        }
        .nav-item.logout {
          padding-top: 6.5px;
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

        .hero-content p {
          font-size: 15px;
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
            /* max-height: calc(100vh - 100px); /* Adjust based on header height */ */
            overflow: hidden; /* Prevent overflow */
        }

        .feature {
            max-width: 300px;
        }

        .feature img {
            max-width: 100%;
            height: 30vh
        }

        .feature div p {
          font-size: 13.5px;
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

    <!-- Header bawah -->
    <div class="header-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="https://lpap.widyatama.ac.id/wp-content/uploads/elementor/thumbs/logo-lpap-qmsat9cj6s4dat1eiydqz30ppipq6y65puh6wzi30k.png"
             alt="LPAP Logo"
             height="50">
            <!-- Navigation -->
            <nav>
                <ul class="nav">

                    <!-- Authentication Links -->
                    @auth
                        <li class="nav-item">
                            <!-- <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a> -->
                            <a class="nav-link" href="../">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user_details.create')}}">Registrasi Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacts">Contact</a>
                        </li>
                        <li class="nav-item logout">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-white p-0">Logout</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="./">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user_details.create')}}">Registrasi Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacts">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                    </ul>
                </nav>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h2>LPAP</h2>
            <p>Lembaga Pengembangan & Aplikasi Pengetahuan</p>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container features">
        <div class="feature">
            <img src="https://images.unsplash.com/photo-1517456793572-1d8efd6dc135?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Career Development">
            <div class="mt-2">
              <h5>Career Development</h5>
              <p>Kembangkan karirmu untuk menghadapi tantangan di masa depan.</p>
            </div>
        </div>
        <div class="feature mt-3">
            <img src="https://images.unsplash.com/photo-1517456793572-1d8efd6dc135?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Expert Instruction">
            <div class="mt-2">
              <h5>Expert Instruction</h5>
              <p>Temukan instruktur terbaik untuk pengembangan karirmu.</p>
            </div>
        </div>
        <div class="feature mt-3">
            <img src="https://images.unsplash.com/photo-1517456793572-1d8efd6dc135?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Networking Opportunities">
            <div class="mt-2">
              <h5>Networking Opportunities</h5>
              <p>Temukan peluang melalui jejaring antar ekspertis.</p>
            </div>
        </div>
    </div>


    <footer class="footer bg-#3f51b5 text-white py-2">
        <div class="container">
            <div class="row">
                <!-- Bagian Social Media -->
                <div class="col-md-4 text-center mt-2">
                    <h5 class="fw-bold">FOLLOW US</h5>
                    <div>
                        <a href="#" class="text-white fs-4 me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white fs-4 me-3"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white fs-4 me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white fs-4"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                 <!-- Bagian Kontak -->
                 <div class="col-md-4">
                    <h5 class="fw-bold">GET IN TOUCH</h5>
                    <p class="mb-1"><strong>Customer Care:</strong> <a href="telp:+0812 34567890" style="color: #fff; text-decoration: none">+62 812 3456 7890</a></p>
                    <p><strong>Email:</strong> <a href="mailto:support@lpap.com" style="color: #fff; text-decoration: none">support@lpap.com</a></p>
                </div>
            </div>
    </footer>
    <div class="text-center py-2" style="background-color: #ff9800;">
        <p class="mb-0 text-dark">&copy; {{ date('Y') }} LPAP. All Rights Reserved.</p>
    </div>
</body>
</html>
