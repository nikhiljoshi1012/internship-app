<!-- resources/views/student_attendance.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Attendance</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Home</a>
            <div class="ms-auto d-flex align-items-center">
                <span class="text-white me-3">Welcome, {{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm logout-btn text-white">Sign Out</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>My Attendance Record</h4>
            </div>
            <div class="card-body">
                <div class="attendance-summary alert alert-info">
                    <p>Total Classes: {{ $attendances->count() }}</p>
                    <p>Present: {{ $attendances->where('is_present', 1)->count() }}</p>
                    <p>Absent: {{ $attendances->where('is_present', 0)->count() }}</p>
                    <p>Attendance Percentage: 
                        {{ $attendances->count() > 0 
                            ? round(($attendances->where('is_present', 1)->count() / $attendances->count()) * 100, 2) 
                            : 0 }}%
                    </p>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->date }}</td>
                                <td>{{ $attendance->is_present ? 'Present' : 'Absent' }}</td>
                                <td>{{ $attendance->remarks ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>