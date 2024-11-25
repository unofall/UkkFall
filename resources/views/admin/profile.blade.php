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
</style>

<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
                {{--  <div class="row">
                    <div class="card col-4 text-center">
                        <img src="https://via.placeholder.com/150" class="card-img-top rounded-circle mx-auto" alt="Foto Profil">
                        <h5>{{ Auth::User()->name }}</h5>
                    </div>
                    <p>Status: {{ Auth::User()->level }}</p>
                    <button class="btn btn-primary">Edit Profil</button>
                    <button class="btn btn-secondary">Kirim Pesan</button>
                    </div>
                </div>
        </div>  --}}

        <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                <div class="card">
                  <img src="{{ Auth::User()->foto }}" class="card-img-top mt-3 rounded-circle mx-auto" style="object-fit: cover" alt="Foto Profil">
                  <div class="card-body text-center">
                    <h5 class="card-title">{{ Auth::User()->name }}</h5>
                    <p class="card-text">{{ Auth::User()->level }}</p>
                    {{--  <a href="update/{{ Auth::User()->id }}" class="btn btn-primary">
                        <i class="la la-edit"></i>
                        Edit Profile
                    </a>  --}}
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card">
                  <div class="card-header text-center" style="font-size: 20px">
                    Your Profile
                  </div>
                  <div class="card-body"  style="font-size: 15px">
                    <ul class="list-group">
                      <li class="list-group-item">
                        <label for="">Username : </label> {{ Auth::User()->username }}</li>
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
@endsection
