<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance - Division {{ $division }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #e3f2fd, #90caf9);
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Navbar Styles */
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
        }

        .logout-btn:hover {
            background-color: #b71c1c;
        }

        /* Card Styles */
        .card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
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

        /* Form and Input Styles */
        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 0.2rem rgba(25, 118, 210, 0.25);
        }

        .custom-control-label::before,
        .custom-control-label::after {
            top: 0.1rem;
            height: 1rem;
            width: 1rem;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #28a745;
            border-color: #28a745;
        }

        /* Attendance Summary Styles */
        .attendance-summary {
            background-color: #f0f4c3;
            color: #558b2f;
            border: 1px solid #dcedc8;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .attendance-summary h5 {
            margin-bottom: 10px;
            font-weight: bold;
        }

        /* Buttons */
        .btn-primary {
            background-color: #1976d2;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #1565c0;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Date Toggle Switch */
        .custom-control-label {
            font-size: 0.9rem;
            color: #333;
        }

        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #1976d2;
            border-color: #1976d2;
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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Mark Attendance for Division {{ $division }}</h4>
                        <div class="form-group mt-3">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="dateToggle">
                                <label class="custom-control-label" for="dateToggle">Mark attendance for a different date</label>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('professor.attendance', ['division' => $division]) }}" method="post">
                            @csrf
                            <div class="form-group date-select" style="display: none;">
                                <label for="date">Select Date</label>
                                <input type="date" 
                                       class="form-control" 
                                       id="date" 
                                       name="date" 
                                       value="{{ request('date', now()->format('Y-m-d')) }}">
                            </div>

                            <input type="hidden" name="division" value="{{ $division }}">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Roll No</th>
                                        <th>Name</th>
                                        <th>Photo</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->rollno }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>
                                                @if($student->photo)
                                                    <img src="{{ asset('storage/' . $student->photo) }}" 
                                                         alt="Student Photo" 
                                                         width="50">
                                                @endif
                                            </td>
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" 
                                                           class="custom-control-input" 
                                                           id="present-{{ $student->id }}" 
                                                           name="attendance[{{ $student->id }}]" 
                                                           value="1">
                                                    <label class="custom-control-label" 
                                                           for="present-{{ $student->id }}">Present</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" 
                                                           class="custom-control-input" 
                                                           id="absent-{{ $student->id }}" 
                                                           name="attendance[{{ $student->id }}]" 
                                                           value="0" 
                                                           checked>
                                                    <label class="custom-control-label" 
                                                           for="absent-{{ $student->id }}">Absent</label>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" 
                                                       class="form-control"
                                                       name="remarks[{{ $student->id }}]"
                                                       placeholder="Optional remarks">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="attendance-summary alert alert-info mt-3">
                                <h5>Attendance Summary</h5>
                                <p>Total Students: <span id="total-students">{{ $students->count() }}</span></p>
                                <p>Present: <span id="present-count">0</span></p>
                                <p>Absent: <span id="absent-count">{{ $students->count() }}</span></p>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit Attendance</button>
                            <a href="{{ route('professor.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle date input visibility
            $('#dateToggle').change(function() {
                $('.date-select').toggle(this.checked);
                $('#date').prop('required', this.checked);
            });

            // Update attendance summary
            function updateAttendanceSummary() {
                let totalStudents = {{ $students->count() }};
                let presentCount = $('input[value="1"]:checked').length;
                let absentCount = totalStudents - presentCount;

                $('#present-count').text(presentCount);
                $('#absent-count').text(absentCount);
            }

            // Listen for radio button changes
            $('input[type="radio"]').change(function() {
                updateAttendanceSummary();
            });

            // Initial summary update
            updateAttendanceSummary();
        });
    </script>
</body>
</html>