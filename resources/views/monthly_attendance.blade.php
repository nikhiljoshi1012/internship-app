<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Attendance</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-home"></i> Home
                </a>
                <div class="ms-auto d-flex align-items-center">
                    <span class="text-white me-3">
                        Welcome, {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-sm logout-btn text-white">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Monthly Attendance for {{ $month }}</div>

                    <div class="card-body">
@foreach($students as $student)
    <div class="card mb-3">
        <div class="card-body">
            <h3>{{ $student->name }}</h3>
            <p>Division: {{ $student->division }}</p>
            <p>Present: {{ $student->attendance->where('is_present', 1)->count() }} days</p>
            <p>Absent: {{ $student->attendance->where('is_present', 0)->count() }} days</p>
            <form action="{{ route('professor.sendMonthlyReport', ['student' => $student->id, 'month' => $month]) }}"
                method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-envelope"></i> Send Report via Email
                </button>
            </form>
        </div>
    </div>
@endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>