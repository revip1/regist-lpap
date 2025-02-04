<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPAP</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
        }
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

        .content {
            flex: 1;
        }
        .footer {
            background-color: #3f51b5;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    

    <!-- Header bawah -->
    <div class="header-bottom">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="https://lpap.widyatama.ac.id/wp-content/uploads/elementor/thumbs/logo-lpap-qmsat9cj6s4dat1eiydqz30ppipq6y65puh6wzi30k.png" 
                 alt="LPAP Logo" height="50">
            <nav>
                <ul class="nav">
                    @if(Auth::check() && (Auth::user()->role == 'user' || Auth::user()->role == 'company'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user_details.create') }}">Registrasi LPAP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tickets.create') }}">Tiket</a>
                        </li>
                        @if(Auth::user()->role == 'company')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('programs.create')}}">Program</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('programs.index') }}">Program</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('batches.index')}}">Batch</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tickets.index') }}">Tiket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user_details.index') }}">Registrasi LPAP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacts">Contact</a>
                        </li>
                    @endif
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link text-white p-0">Logout</button>
                            </form>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endguest
                </ul>
            </nav>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="breadcrumb-container">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>'; " aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@yield('breadcrumb', 'Dashboard')</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Konten Utama -->
    <div class="container mt-4 content">
        @yield('content')
    </div>

    
    <footer class="footer bg-#3f51b5 text-white py-2">
        <div class="container">
            <div class="row">
                <!-- Bagian Social Media -->
                <div class="col-md-4 text-center">
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
                    <p class="mb-1"><strong>Customer Care:</strong> +62 812 3456 7890</p>
                    <p><strong>Email:</strong> support@lpap.com</p>
                </div>
            </div>
    </footer>
    <div class="text-center py-3" style="background-color: #ff9800;">
        <p class="mb-0 text-dark">&copy; {{ date('Y') }} LPAP. All Rights Reserved.</p>
    </div>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    
</body>
</html>
