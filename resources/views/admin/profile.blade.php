@extends('template-admin.navbar')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@section('content')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .card img {
            transition: transform 0.3s ease;
        }

        .card img:hover {
            transform: scale(1.1);
        }

        .list-group-item {
            background-color: #f9f9f9;
            border: none;
        }

        .card-header {
            font-size: 18px;
            text-transform: uppercase;
        }
    </style>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Profile Card -->
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <img src="{{ Auth::user()->level === 'Admin' ? asset('assets/img/profile.jpg') : asset('assets/img/member.jpg') }}"
                                    class="rounded-circle img-fluid mb-3"
                                    style="width: 150px; height: 150px; object-fit: cover;" alt="Profile Picture">
                                <h5 class="card-title fw-bold ">{{ Auth::User()->name }}</h5>
                                <p class="card-text text-muted">
                                    {{ Auth::user()->level === 'Admin' ? 'Administrator' : 'Member' }}
                                </p>
                                <a  href="/member/profupdate/{{ Auth::user()->id }}" class="btn btn-outline-primary">
                                    Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="col-md-8">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-primary text-white text-center fw-bold" style="font-size: 20px;">
                                Your Profile
                            </div>
                            <div class="card-body bg-light">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span class="fw-bold">Username:</span>
                                        <span>{{ Auth::User()->username }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span class="fw-bold">Email:</span>
                                        <span>{{ Auth::User()->email }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span class="fw-bold">Phone Number:</span>
                                        <span>{{ Auth::User()->nohp }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span class="fw-bold">Address:</span>
                                        <span>{{ Auth::User()->address }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                @if (Auth::user()->level === 'Admin')
                                    <img src={{ asset('assets/img/profile.jpg') }}
                                        class="card-img-top mt-3 rounded-circle mx-auto" style="object-fit: cover"
                                        alt="Foto Profil">
                                @else
                                    <img src={{ asset('assets/img/member.jpg') }}
                                        class="card-img-top mt-3 rounded-circle mx-auto" style="object-fit: cover"
                                        alt="Foto Profil">
                                @endif


                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header text-center" style="font-size: 20px">
                                    Your Profile
                                </div>
                                <div class="card-body" style="font-size: 15px">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <label for="">Username : </label> {{ Auth::User()->username }}
                                        </li>
                                        <li class="list-group-item">Email : {{ Auth::User()->email }}</li>
                                        <li class="list-group-item">Number Handphone : {{ Auth::User()->nohp }}</li>
                                        <li class="list-group-item">Address : {{ Auth::User()->address }}</li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
