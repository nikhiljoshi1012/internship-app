<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .tile {
            height: 200px;
            transition: transform 0.3s;
        }
        .tile:hover {
            transform: translateY(-5px);
        }
        .navbar-custom {
            background-color: #2c3e50;
        }
        .logout-btn {
            background-color: #e74c3c;
            border: none;
        }
        .logout-btn:hover {
            background-color: #c0392b;
        }
        .welcome-section {
            background: linear-gradient(rgba(44, 62, 80, 0.9), rgba(44, 62, 80, 0.9)), url('/images/background.jpg');
            background-size: cover;
            color: white;
            padding: 100px 0;
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-home"></i> Home
            </a>
            <div class="ms-auto d-flex align-items-center">
                @if(auth()->check())
                    <span class="text-white me-3">
                        Welcome, {{ auth()->user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm logout-btn text-white">
                            Sign Out
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-sm me-2">Login</a>
                    <a href="{{ route('signup') }}" class="btn btn-success btn-sm">Sign Up</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Welcome to Attendance Management System</h2>
        
        @auth
            @if(Auth::user()->role === 'professor')
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-clipboard-check fa-3x mb-3 text-primary"></i>
                                <h4>Mark Attendance</h4>
                                <p>Quick and easy attendance marking for your classes</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-danger text-center">
                    Access denied. This dashboard is for professors only.
                </div>
            @endif
        @else
            <div class="welcome-section">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="col-md-8">
                            <h1 class="display-4 mb-4">Welcome to Attendance Management System</h1>
                            <p class="lead mb-4">Streamline your attendance tracking process with our easy-to-use platform.</p>
                            <div class="mt-4">
                                <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-3">Login</a>
                                <a href="{{ route('signup') }}" class="btn btn-success btn-lg">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
</body>
</html>