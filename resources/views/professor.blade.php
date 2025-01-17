<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
                    <div class="card-header">Professor Dashboard</div>

                    <div class="card-body">
                        <h2>Students</h2>
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Division</th>
                                    <th>Roll Number</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->division }}</td>
                                        <td>{{ $student->rollno }}</td>
                                        <td>
                                            @if($student->photo)
                                                <img src="{{ asset('storage/' . $student->photo) }}" alt="Photo" width="50">
                                            @else
                                                No Photo
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('professor.destroy', ['id' => $student->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('professor.create') }}" class="btn btn-primary">Create Student</a>
                        <a href="{{ route('professor.attendance', ['division' => 'A']) }}" class="btn btn-success">Mark Attendance for Division A</a>
                        <a href="{{ route('professor.attendance', ['division' => 'B']) }}" class="btn btn-success">Mark Attendance for Division B</a>
                        <a href="{{ route('professor.monthlyAttendance', ['month' => now()->format('m')]) }}" class="btn btn-info">View Monthly Attendance</a>
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