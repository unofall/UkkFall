@extends('template-admin/navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <style>
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
            @if (session()->has('pesan'))
                <div class="alert alert-success" style="width: 100% ; ">
                    {{ session()->get('pesan') }}
                </div>
            @endif
            {{--  Notif Berhasil Diubah  --}}
            @if (session()->has('edit'))
                <div class="alert alert-info" style="width: 100% ; ">
                    {{ session()->get('edit') }}</div>
            @endif
            {{--  Notif Berhasil Dihapus  --}}
            @if (session()->has('Pesan'))
                <div class="alert alert-danger" style="width: 100% ; ">
                    {{ session()->get('Pesan') }}</div>
            @endif
            <div class="container-fluid">
                <div class="card rounded-3 p-2">
                    <div class="d-flex justify-content-between align-items-center mx-3">
                        <!-- Title -->
                        <div class=" fs-6 fw-bold" style="letter-spacing: 1px; word-spacing: 3px">Management Event</div>
                        <!-- Filter Form -->
                        <div class="d-flex justify-content-end p-1">
                            @if (Auth::user()->level === 'Admin')
                                <a href="/create_event" class="btn btn-primary fw-bold">Create Event</a>
                            @elseif (Auth::user()->level === 'Member')
                                <a href="/member/create_event" class="btn btn-primary fw-bold">Create Event</a>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table text-center">
                            <div class="card-sub">
                                This is the events table :
                            </div>
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Tanggal</th>
                                    {{-- <th scope="col">Percentage</th> --}}
                                    <th scope="col">Dibuat Oleh</th>
                                    {{-- <th scope="col">Task</th> --}}
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->date }}</td>
                                        {{-- <td>{{ $item->calculated_percentage }}%</td> --}}
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                            <div class="dropdown-center">
                                                <button type="button" class="btn btn-link p-0" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"
                                                        style="font-size: 20px; color: #555;"></i>
                                                </button>
                                                <ul class="dropdown-menu shadow-lg rounded-3 p-2 custom-dropdown-menu">
                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/task/create/{{ $item->id }}" class="dropdown-item"
                                                                title="Create Task">
                                                                <i class="bi bi-plus-circle me-2"></i> Create Task
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/task/create/{{ $item->id }}"
                                                                class="dropdown-item" title="Create Task">
                                                                <i class="bi bi-plus-circle me-2"></i> Create Task
                                                            </a>
                                                        @endif
                                                    </li>
                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/event/edit_event/{{ $item->id }}"
                                                                class="dropdown-item" title="Update Event">
                                                                <i class="bi bi-pencil-square me-2"></i> Update Event
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/edit_event/{{ $item->id }}"
                                                                class="dropdown-item" title="Update Event">
                                                                <i class="bi bi-pencil-square me-2"></i> Update Event
                                                            </a>
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/deleteevent/{{ $item->id }}"
                                                                class="dropdown-item text" title="Delete Event">
                                                                <i class="bi bi-trash me-2"></i> Delete Event
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/deleteevent/{{ $item->id }}"
                                                                class="dropdown-item text" title="Delete Event">
                                                                <i class="bi bi-trash me-2"></i> Delete Event
                                                            </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>

                                            {{-- <a href="/task/create/{{ $item->id }}" class="btn btn-link btn-success" title="Add Task">
                                        <i class="bi bi-plus-circle" style="font-size: 17px;"></i>
                                    </a>
                                    <a href="/event/edit_event/{{ $item->id }}" class="btn btn-link btn-primary" title="Edit Event">
                                        <i class="bi bi-pencil-square" style="font-size: 17px;"></i>
                                    </a>
                                    <a href="/deleteevent/{{ $item->id }}" class="btn btn-link btn-danger" title="Delete Event" >
                                        <i class="bi bi-x-lg" style="font-size: 17px;"></i>
                                    </a> --}}
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
