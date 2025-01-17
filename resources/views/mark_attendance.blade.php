<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Attendance - Division {{ $division }}</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .custom-control-input:checked ~ .custom-control-label::before {
            background-color: #28a745;
            border-color: #28a745;
        }
        .attendance-summary {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .table td { vertical-align: middle; }
        .card-header { background-color: #f8f9fa; }
        .card-header h4 { margin-bottom: 0; color: #333; }
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