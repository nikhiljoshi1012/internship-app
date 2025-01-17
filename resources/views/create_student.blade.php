<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student</title>
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
                    <div class="card-header">Create Student</div>

                    <div class="card-body">
                        <form action="{{ route('professor.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="photo">Upload Photo</label>
                                <input type="file" id="photo" name="photo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="division">Division</label>
                                <input type="text" id="division" name="division" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="rollno">Roll Number</label>
                                <input type="text" id="rollno" name="rollno" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Student</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>