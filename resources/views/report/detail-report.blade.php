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
                        <div class=" fs-6 fw-bold" style="letter-spacing: 1px; word-spacing: 3px">Management Detail Report
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table mt-3 text-center">
                            <div class="card-sub">
                                This is Detail Report table :
                                <a @if (Auth::user()->level === 'Admin') href="/tasks/export"
                                    @elseif (Auth::user()->level === 'Member')
                                    href="/member/tasks/export" @endif
                                    class="btn btn-success">EXPORT EXCEL</a>
                            </div>
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Name Report</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Percentage</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = ($details->currentPage() - 1) * $details->perPage() + 1;
                                @endphp
                                @foreach ($details as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>

                                        <td>{{ $item->reports->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->datetime }}</td>
                                        <td>
                                            @if ($item->link_file)
                                                <a href="{{ $item->link_file }}"
                                                    target="_blank">{{ Str::limit($item->link_file, 20) }}</a>
                                            @else
                                                Tidak ada link
                                            @endif
                                        <td>
                                            @if ($item->file_upload)
                                                {{ $item->file_upload }}
                                            @else
                                                Tidak Ada File
                                            @endif
                                        </td>
                                        <td>{{ $item->percentage }}%</td>

                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-link" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"
                                                        style="font-size: 17px; color: #000;"></i>
                                                </button>
                                                <ul class="dropdown-menu custom-dropdown-menu">



                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/updateDetail/{{ $item->id }}"class="dropdown-item"
                                                                title="Update Detail">
                                                                <i class="bi bi-pencil-square me-2"></i> Update Detail
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/updateDetail/{{ $item->id }}"
                                                                class="dropdown-item" title="Update Detail">
                                                                <i class="bi bi-pencil-square me-2"></i> Update Detail
                                                            </a>
                                                        @endif

                                                    </li>

                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/deleteDetail/{{ $item->id }}"
                                                                class="dropdown-item text" title="Delete Detail">
                                                                <i class="bi bi-trash me-2"></i> Delete Detail
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/deleteDetail/{{ $item->id }}"
                                                                class="dropdown-item text" title="Delete Detail">
                                                                <i class="bi bi-trash me-2"></i> Delete Detail
                                                            </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>



                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $details->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
