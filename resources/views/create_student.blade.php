<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
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
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-home"></i> Home
            </a>
            <div class="ms-auto d-flex align-items-center">
                <span class="text-white me-3">
                    Welcome, {{ Auth::user()->name }}
                </span>
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
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
                @if(session('success'))
                    <div class="alert alert-success mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger mb-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Create Student</span>
                        <a href="{{ route('professor.dashboard') }}" class="btn btn-secondary btn-sm">Back to Dashboard</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('professor.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="division">Division</label>
                                <select id="division" name="division" class="form-control" required>
                                    <option value="">Select Division</option>
                                    <option value="A" {{ old('division') == 'A' ? 'selected' : '' }}>A</option>
                                    <option value="B" {{ old('division') == 'B' ? 'selected' : '' }}>B</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="rollno">Roll Number</label>
                                <input type="text" id="rollno" name="rollno" class="form-control" value="{{ old('rollno') }}" required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="photo">Upload Photo</label>
                                <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Create Student</button>                                
                                <a href="{{ route('professor.dashboard') }}" class="btn btn-secondary btn-sm">Back to Dashboard</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
</body>
</html>