<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - LPAP</title>
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
        .contact-container {
            margin-top: 30px;
        }
        footer {
            background-color: #3f51b5;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 50px;
        }
        .nav-link {
            color: white !important;
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
            <img src="https://lpap.widyatama.ac.id/wp-content/uploads/elementor/thumbs/logo-lpap-qmsat9cj6s4dat1eiydqz30ppipq6y65puh6wzi30k.png" 
             alt="LPAP Logo" 
             height="50">
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
            <li class="nav-item">
                <a class="nav-link" href="contacts">Contact</a>
            </li>

            <!-- Authentication Links -->
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

    <!-- Contact Section -->
    <div class="container contact-container">
        <div class="row">
            <div class="col-md-6">
                <h2>Contact Information</h2>
                <p>Feel free to reach out to us using the following contact details:</p>
                <ul>
                    <li><strong>Phone:</strong> (022)7275855</li>
                    <li><strong>Email:</strong> info@lpap.com</li>
                    <li><strong>Address:</strong> Jl. Example No. 123, Bandung</li>
                </ul>
            </div>
            <div class="col-md-6">
                <h2>Send Us a Message</h2>
                <form action="/send-message" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>

        <!-- Optional Map Section -->
        <div class="row mt-5">
            <div class="col-12">
                <h2>Our Location</h2>
                <div style="width: 100%; height: 400px;">
                    <iframe 
                        src="https://maps.google.com/maps?q=widyatama&t=&z=13&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-3 mt-4">
        <small>&copy; {{ date('Y') }} LPAP. All Rights Reserved.</small>
    </footer>
</body>
</html>
