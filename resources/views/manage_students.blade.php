<!-- filepath: /d:/GIT/internship-app/resources/views/manage_students.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        /* General Body Styling */
        body {
            background: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(90deg, #2c3e50, #34495e);
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.25rem;
            color: #ecf0f1 !important;
        }

        .navbar .text-white {
            font-size: 0.9rem;
        }

        .logout-btn {
            background: #e74c3c;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .logout-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .card-header {
            background: #34495e;
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 15px;
            font-size: 1.25rem;
        }

        .card-header .btn-primary {
            background: #3498db;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .card-header .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        /* Table Styling */
        .table {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table th {
            background: #34495e;
            color: white;
            text-align: center;
            font-size: 0.9rem;
            font-weight: bold;
        }

        .table td {
            text-align: center;
            vertical-align: middle;
            font-size: 0.875rem;
            color: #2c3e50;
        }

        .table img {
            border-radius: 50%;
            border: 2px solid #ddd;
        }

        .table .btn-danger {
            background: #e74c3c;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .table .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        /* Success Alert */
        .alert-success {
            border-left: 5px solid #27ae60;
            background: #ecfdf4;
            color: #2c3e50;
            border-radius: 8px;
            padding: 10px;
            margin-top: 15px;
        }

        /* DataTable Customization */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 5px 10px;
            margin: 2px;
            background: #3498db;
            color: white !important;
            border-radius: 5px;
            border: none;
            transition: all 0.3s ease-in-out;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #2980b9;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #2c3e50 !important;
            color: white !important;
        }

        .dataTables_filter input {
            border-radius: 5px;
            border: 1px solid #ccc;
            padding: 5px 10px;
        }

        .dataTables_filter input:focus {
            border-color: #3498db;
            box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .navbar-brand {
                font-size: 1rem;
            }

            .logout-btn {
                padding: 5px 8px;
                font-size: 0.875rem;
            }

            .table th, .table td {
                font-size: 0.75rem;
            }

            .card-header h4 {
                font-size: 1rem;
            }

            .card-header .btn-primary {
                padding: 6px 10px;
            }
        }
    </style>
</head>
<body>
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
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Manage Students</h4>
                <a href="{{ route('professor.create') }}" class="btn btn-primary">Add New Student</a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Division</th>
                            <th>Email</th>
                            <th>Actions</th>
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
                                <td>{{ $student->rollno }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->division }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    <form action="{{ route('professor.destroy', $student->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this student?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable({
                "ordering": true,
                "searching": true,
                "responsive": true
            });
        });
    </script>
</body>
</html>