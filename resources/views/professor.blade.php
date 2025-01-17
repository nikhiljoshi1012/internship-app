<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Navbar Styling */
        .navbar-custom {
            background-color: #2c3e50;
            padding: 15px 10px;
        }

        .navbar-custom .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ecf0f1;
            transition: color 0.3s ease;
        }

        .navbar-custom .navbar-brand:hover {
            color: #1abc9c;
        }

        .logout-btn {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 6px 12px;
            font-size: 0.9rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c0392b;
        }

        /* Dashboard Background */
        body {
            background: linear-gradient(to right, #bdc3c7, #2c3e50);
            color: #34495e;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Tile Container */
        .tile-container {
            margin-top: 50px;
        }

        /* Tile Styling */
        .tile {
            background-color: white;
            border-radius: 12px;
            text-align: center;
            padding: 40px 20px;
            margin-bottom: 30px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .tile:hover {
            transform: translateY(-5px);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.15);
        }

        .tile h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2c3e50;
        }

        .tile i {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #1abc9c;
            transition: color 0.3s ease;
        }

        .tile:hover i {
            color: #16a085;
        }

        /* Tile Borders */
        .tile-a {
            border-top: 5px solid #1abc9c;
        }

        .tile-b {
            border-top: 5px solid #3498db;
        }

        .tile-attendance {
            border-top: 5px solid #e74c3c;
        }

        .tile-manage {
            border-top: 5px solid #9b59b6;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .tile {
                padding: 30px 15px;
            }

            .tile h3 {
                font-size: 1.2rem;
            }

            .tile i {
                font-size: 2.5rem;
            }

            .navbar-custom .navbar-brand {
                font-size: 1.25rem;
            }

            .logout-btn {
                font-size: 0.8rem;
                padding: 5px 10px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-home"></i> Professor Dashboard
            </a>
            <div class="ml-auto d-flex align-items-center">
                <span class="text-white mr-3">
                    Welcome, <strong>{{ Auth::user()->name }}</strong>
                </span>
                <form action="{{ route('logout') }}" method="POST" class="mb-0">
                    @csrf
                    <button type="submit" class="btn logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Dashboard Section -->
    <div class="container tile-container">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('professor.attendance', ['division' => 'A']) }}" class="text-decoration-none">
                    <div class="tile tile-a">
                        <i class="fas fa-user-check"></i>
                        <h3>Mark Attendance for Division A</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('professor.attendance', ['division' => 'B']) }}" class="text-decoration-none">
                    <div class="tile tile-b">
                        <i class="fas fa-users"></i>
                        <h3>Mark Attendance for Division B</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('professor.overallAttendance') }}" class="text-decoration-none">
                    <div class="tile tile-attendance">
                        <i class="fas fa-chart-bar"></i>
                        <h3>View Overall Monthly Attendance</h3>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mt-4">
                <a href="{{ route('professor.manage-students') }}" class="text-decoration-none">
                    <div class="tile tile-manage">
                        <i class="fas fa-user-cog"></i>
                        <h3>Manage Students List</h3>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- JS Files -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>