<!-- filepath: /d:/GIT/internship-app/resources/views/monthly_attendance.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Attendance</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        /* General Styling */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #f0f4c3, #bbdefb);
            margin: 0;
            padding: 0;
        }

        /* Navbar Styling */
        .navbar-custom {
            background-color: #1976d2;
            padding: 15px 10px;
        }

        .navbar-custom .navbar-brand {
            font-size: 1.5rem;
            color: #fff;
            font-weight: bold;
        }

        .navbar-custom .navbar-brand:hover {
            color: #bbdefb;
        }

        .logout-btn {
            background-color: #d32f2f;
            border: none;
            padding: 5px 10px;
            font-size: 0.9rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #b71c1c;
        }

        /* Card Styles */
        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 30px;
        }

        .card-header {
            background-color: #bbdefb;
            border-bottom: 1px solid #e3f2fd;
            padding: 20px;
        }

        .card-header h4 {
            margin: 0;
            font-weight: bold;
            color: #1976d2;
        }

        /* Table Styles */
        .table {
            margin-top: 15px;
            background-color: white;
            border-radius: 5px;
        }

        .table th {
            background-color: #1976d2;
            color: white;
            text-align: center;
            vertical-align: middle;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table img {
            border-radius: 50%;
        }

        .table td img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }

        .btn-primary {
            background-color: #1976d2;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1565c0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-header h4 {
                font-size: 1.2rem;
            }

            .table {
                font-size: 0.875rem;
            }

            .btn-primary {
                font-size: 0.875rem;
            }
        }

        /* DataTable Styles */
        .dataTables_wrapper {
            padding: 10px;
        }

        .dataTables_filter input {
            border-radius: 5px;
            padding: 5px;
        }

        .dataTables_length select {
            border-radius: 5px;
            padding: 5px;
        }

        .dataTables_paginate .paginate_button {
            border-radius: 5px;
            padding: 5px 10px;
            background-color: #1976d2;
            color: white;
            border: 1px solid #1976d2;
        }

        .dataTables_paginate .paginate_button:hover {
            background-color: #1565c0;
        }

        .dataTables_info {
            font-size: 0.875rem;
            color: #1976d2;
        }

        .dataTables_paginate {
            margin-top: 15px;
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Monthly Attendance for {{ $month }}</div>
                    <div class="card-body">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Division</th>
                                    <th>Present</th>
                                    <th>Absent</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>
                                            @if($student->photo)
                                                <img src="{{ asset('storage/' . $student->photo) }}" 
                                                     alt="Student Photo" 
                                                     width="50">
                                            @endif
                                        </td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->division }}</td>
                                        <td>{{ $student->attendance->where('is_present', 1)->count() }} days</td>
                                        <td>{{ $student->attendance->where('is_present', 0)->count() }} days</td>
                                        <td>
                                            <form action="{{ route('professor.sendMonthlyReport', ['student' => $student->id, 'month' => $month]) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-envelope"></i> Send Report via Email
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>
</body>

</html>