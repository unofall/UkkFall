<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href={{ asset('assets/css/styles.min.css') }}>
    {{--  <style>
        :root{
            --color-main: rgb(180, 160, 121);
        }

        body{
            background-color: var(--color-main);
        }

        .img-login{
            width: 100%;
        }
    </style>  --}}
</head>
<body>

    {{--  <div class=" text-white  justify-content-center p-4">
        <h1 class="">Name</h1>
            <div class="card  col-md-5 p-5 rounded text-dark mt-5 ">
                <form action="/auth" class="w-100" method="post">
                    @csrf
                    <div class="mb-4 text-center">
                        <h3>Login</h3>
                        Belajar Bimbingan Online, Bersama kita anda Cerdas.
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>


                    <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
                    <a href="/register" class="btn btn-warning w-100">Register</a>
                </form>
            </div>
        </div>
    </div>  --}}
    {{--  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">  --}}
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6 col-xxl-3">
                @if (session()->has('pesan'))
                     <div class="alert alert-danger text-center" style="width: 100% ; ">
                 {{ session()->get('pesan') }}</div>
             @endif
                <div class="card mb-0">
                    <div class="card-body">
               <h3 class="text-center p-3">Login</h3>
                <form method="POST" action="/auth">
                    @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remember this Device
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="./index.html">Forgot Password ?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >Sign In</button>
                  {{--  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">New to Modernize?</p>
                    <a class="text-primary fw-bold ms-2" href="./authentication-register.html">Create an account</a>
                  </div>  --}}
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
