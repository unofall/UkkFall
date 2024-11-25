@extends('/template-admin/navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
</head>
<body>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <i class="bi bi-arrow-left me-2 fs-5"></i> <!-- Ikon di sebelah kiri -->
                        <h5 class="card-title text-center flex-grow-1 m-0">Create User</h5> <!-- Teks tetap di tengah -->
                    </div>
                    <div class="card-body">
                        <form action="/adduser" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="squareInput">Name</label>
                                <input type="text" class="form-control input-square" name="name" id="squareInput" placeholder="Input Name" >
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Username</label>
                                <input type="text" class="form-control input-square" id="squareInput" name="username" placeholder="Input Username">
                                @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Email</label>
                                <input type="text" class="form-control input-square" id="squareInput" name="email" placeholder="Input Email">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Number Phone</label>
                                <input type="text" class="form-control input-square" id="squareInput" name="nohp" placeholder="Input Number Phone">
                                @error('nohp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Address</label>
                                <input type="text" class="form-control input-square" id="squareInput" name="address" placeholder="Input Address">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{--  <div class="form-group">
                                <label for="squareInput">Foto</label>
                                <input type="file" class="form-control input-square" id="squareInput" name="foto">
                                @error('foto')
                                    <span class="text-danger">Foto cannot be empty</span>
                                @enderror
                            </div>  --}}
                            <div class="form-group">
                                <label for="squareInput">Password</label>
                                <input type="text" class="form-control input-square" id="squareInput" name="password" placeholder="Input Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <a href="/user" class="btn btn-danger mb-2 w-100">Back</a> --}}
                            <button type="submit" class="mb-2 btn btn-success w-100">Submit</button>

                        </form>
                        {{--  <div class="form-group">
                            <label for="pillInput">Pill Input</label>
                            <input type="text" class="form-control input-pill" id="pillInput" placeholder="Pill Input">
                        </div>  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
