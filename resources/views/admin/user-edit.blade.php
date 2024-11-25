@extends('/template-admin/navbar')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@section('content')

<body>
    <div class="main-panel">
        <div class="content">

            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="card-title">Form Control Styles</div>
                    </div>
                    <div class="card-body">
                        <form action="/edit/{{ $user->id }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="squareInput">Name</label>
                                <input type="text" class="form-control input-square" name="name" id="squareInput" placeholder="Input Name" value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Username</label>
                                <input type="text" class="form-control input-square" id="squareInput" name="username" placeholder="Input Username" value="{{ $user->username }}" >
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Email</label>
                                <input type="text" class="form-control input-square" id="squareInput" name="email" placeholder="Input Email" value="{{ $user->email }}">
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Number Handphone</label>
                                <input type="text" class="form-control input-square" id="squareInput" name="nohp" placeholder="Input Nomor Handphone" value="{{ $user->nohp }}">
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Address</label>
                                <input type="text" class="form-control input-square" id="squareInput" name="address" placeholder="Input Address" value=" {{ $user->address }}">
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Password</label>
                                <input type="password" class="form-control input-square" id="squareInput" name="password" placeholder="Input Password">
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="/user" class="btn btn-danger mr-2">Back</a>
                                <button type="submit" class="mr-2 btn btn-success">Submit</button>
                            </div>
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
