<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href={{ asset('assets/css/styles.min.css') }}>
   <style>
    .body {
   background-image: url('img/bg.jpg');
}

.card {
    background-color: #fff;
    border: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 3rem;
    border-radius: 1rem;
}

h3 {
    color: #333;
    font-weight: 700;
}

.form-control {
    border: 1px solid #ddd;
    padding: 1rem;
    font-size: 1rem;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.btn-primary {
    background-color: #007bff;
    border: none;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.text-primary {
    color: #007bff;
    text-decoration: none;
}

.text-primary:hover {
    text-decoration: underline;
}

   </style>
</head>
<body>
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center" style="background-image: url('/assets/img/bg.jpg')">
        <div class="d-flex align-items-center justify-content-center w-100">
            <div class="row justify-content-center w-100">
                {{-- <div class="col-md-4">
                    <img src="{{ asset('assets/img/member.jpg') }}" alt="" srcset="">
                </div> --}}
                <div class="col-md-8 col-lg-6 col-xxl-4">
                    @if (session()->has('pesan'))
                        <div class="alert alert-danger text-center" style="width: 100%;">
                            {{ session()->get('pesan') }}
                        </div>
                    @endif
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body p-5">
                            <h3 class="text-center fw-bold mb-4">Welcome Back</h3>
                            <p class="text-center text-muted mb-4">Please login to your account</p>
                            <form method="POST" action="/auth">
                                @csrf
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" name="email" class="form-control form-control-lg rounded-3"
                                        id="email" placeholder="Enter your email" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <input type="password" name="password" class="form-control form-control-lg rounded-3"
                                        id="password" placeholder="Enter your password" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3 rounded-3">
                                    Sign In
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<script src="bootstrap/js/bootstrap.min.js"></script>
