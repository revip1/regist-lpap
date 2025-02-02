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
    </style>
</head>
<body>
    <!-- Header atas -->
    <div class="header-top text-center">
        <span>(021) 5797 4568 | info@lpap.com</span>
    </div>

    <!-- Header bawah -->
    <div class="header-bottom text-center">
        <div class="container d-flex justify-content-between align-items-center">
        <h1>@yield('header-title', 'LPAP')</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('programs.index') }}">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tickets.index') }}">Tiket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user_details.index') }}">Regist LPAP</a>
                </li>
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
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 mt-4">
        <small>&copy; {{ date('Y') }} LPAP. All Rights Reserved.</small>
    </footer>
</body>
</html>