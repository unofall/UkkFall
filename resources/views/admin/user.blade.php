@extends('template-admin/navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
<style>
    .custom-dropdown-menu {
        min-width: 60px; /* Anda bisa mengatur ukuran sesuai kebutuhan */
    }
    .custom-dropdown-menu li a {
        font-size: 15px; /* Mengatur ukuran font untuk teks di dalam dropdown */
        margin: 40px 10px 10px 20px; /* Mengurangi padding untuk setiap item */
        text-decoration: none;
        color: black;
        font-weight: 600
    }
</style>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="card rounded-3 p-2">
                    <div class="d-flex justify-content-between align-items-center mx-3">
                        <!-- Title -->
                        <div class=" fs-6 fw-bold" style="letter-spacing: 1px; word-spacing: 3px">Management User</div>
                        <!-- Filter Form -->
                        <div class="d-flex justify-content-end p-1 ">
                            <a href="/adduser" class="btn btn-primary">Create User</a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        @if (session()->has('Pesan'))
                            <div class="alert alert-danger" style="width: 100% ; ">
                                {{ session()->get('Pesan') }}
                            </div>
                        @endif

                        {{--  Notif Berhasil ditambahkann  --}}
                        @if (session()->has('Sukses'))
                            <div class="alert alert-success" style="width: 100% ; ">
                                {{ session()->get('Sukses') }}
                            </div>
                        @endif
                        {{--  Notif Berhasil Diubah  --}}

                        @if (session()->has('pesan'))
                            <div class="alert alert-warning" style="width: 100% ; ">
                                {{ session()->get('pesan') }}
                            </div>
                        @endif

                        @if (session()->has('Delete'))
                            <div class="alert alert-danger" style="width: 100% ; ">
                                {{ session()->get('Delete') }}
                            </div>
                        @endif


                        <table class="table mt-3 text-center">
                            <div class="card-sub">
                                This is the User table :
                            </div>
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Alamat</th>
                                    {{--  <th scope="col">Foto</th>  --}}
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = ($users->currentPage() - 1) * $users->perPage() + 1;
                                @endphp
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->username }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->nohp }}</td>
                                        <td>{{ $item->level }}</td>
                                        <td>{{ $item->address }}</td>
                                        {{--  <td><img src="{{ asset('storage/foto/'.$item->foto) }}" class="rounded-circle" width="50px" height="50px" alt=""></td>  --}}
                                        <td>
                                            <div class="dropdown-center">
                                                <button type="button" class="btn btn-link" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"
                                                        style="font-size: 17px; color: #000;"></i>
                                                </button>
                                                <ul class="dropdown-menu custom-dropdown-menu">
                                                    <li>
                                                        <a href="update/{{ $item->id }}" title="Edit User">Edit
                                                            User</a>
                                                    </li>
                                                    <li>
                                                        <a href="/delete/{{ $item->id }}" title="Delete User"> Delete
                                                            User
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
