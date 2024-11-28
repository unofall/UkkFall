@extends('template-admin/navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <style>
       /* Style dropdown Tabel */
       .custom-dropdown-menu li a {
            font-size: 15px;
            /* Mengatur ukuran font untuk teks di dalam dropdown */
            margin: 10px 10px 10px 20px;
            /* Mengurangi padding untuk setiap item */
            text-decoration: none;
            color: black;
            font-weight: 600
        }

        .custom-dropdown-menu {
            background-color: #ffffff;
            /* Warna latar belakang */
            border: 1px solid #ddd;
            /* Border halus */
            border-radius: 8px;
            /* Border melengkung */
            padding: 10px;
            /* Ruang dalam */
            min-width: 200px;
            /* Lebar minimum dropdown */
        }

        .custom-dropdown-menu .dropdown-item {
            display: block;
            /* Pastikan elemen mengambil seluruh lebar dropdown */
            width: 80%;
            /* Pastikan elemen melebar sesuai dropdown */
            padding: 10px 1px;
            /* Padding antar teks dan tepi */
            border-radius: 4px;
            /* Border item melengkung */
            transition: background-color 0.2s ease, color 0.2s ease;
            /* Animasi transisi */
        }

        .custom-dropdown-menu .dropdown-item:hover {
            background-color: #007bff;

            color: #fff;

        }


        .custom-dropdown-menu .dropdown-item.text:hover {
            background-color: #dc3545;

            color: #fff;
        }
    </style>
    <div class="main-panel">
        <div class="content">
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


            <div class="container-fluid">
                <div class="card rounded-3 h-12" style="padding: 20px 10px">
                    <div class="d-flex justify-content-between align-items-center mx-3">
                        <div class=" fs-6 fw-bold" style="letter-spacing: 1px; word-spacing: 3px">Management Member</div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table text-center">
                            <div class="card-sub">
                                This is the task table :
                            </div>
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Name Task</th>
                                    <th scope="col">Name Member</th>

                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = ($members->currentPage() - 1) * $members->perPage() + 1;
                                @endphp
                                @foreach ($members as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->tasks->name }}</td>
                                        <td>{{ $item->users->name }}</td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-link" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"
                                                        style="font-size: 17px; color: #000;"></i>
                                                </button>
                                                <ul class="dropdown-menu custom-dropdown-menu">
                                                    <li class="mb-1">

                                                        <a href="/member/edit/{{ $item->id }}" class="dropdown-item"
                                                                title="Update Member">
                                                                <i class="bi bi-pencil-square me-2"></i> Update Member
                                                        </a>

                                                        <a href="/member/delete/{{ $item->id }}"  class="dropdown-item text"
                                                            title="Delete Member">
                                                            <i class="bi bi-trash me-2"></i> Delete Member
                                                    </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                {{-- <div class="d-flex justify-content-end p-1 ">
                                    <a href="/addmember" class="btn btn-primary">Create Member</a>
                                </div> --}}
                            </tbody>
                        </table>

                        {{ $members->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
