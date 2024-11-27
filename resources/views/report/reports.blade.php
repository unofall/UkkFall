@extends('template-admin.navbar')
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
            <div class="container-fluid">
                <div class="card rounded-3 h-12" style="padding: 20px 10px">
                    <div class="d-flex justify-content-between align-items-center mx-3">
                        <div class=" fs-6 fw-bold" style="letter-spacing: 1px; word-spacing: 3px">Management Report</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <table class="table mt-3 text-center">
                            <div class="card-sub">
                                This is Report table :
                            </div>
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Name Event</th>
                                    <th scope="col">Name Report</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Persentase selesai</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($report as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->tasks->events->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->subSubTasks->name }}</td>
                                        <td>{{ $item->duetime }}</td>
                                        <td>{{ $item->percentage }}%</td>
                                        <td>
                                            <div class="dropdown-center">
                                                <button type="button" class="btn btn-link p-0" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"
                                                        style="font-size: 20px; color: #555;"></i>
                                                </button>
                                                <ul
                                                    class="dropdown-menu shadow-lg rounded-3 p-2 custom-dropdown-menu justify-content-center">

                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/addDetailReport/{{ $item->id }}"
                                                                class="dropdown-item" title="Create Report">
                                                                <i class="bi bi-file-earmark-plus me-2"></i> Create Detail
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/addDetailReport/{{ $item->id }}"
                                                                class="dropdown-item" title="Create Report">
                                                                <i class="bi bi-file-earmark-plus me-2"></i> Create Detail
                                                            </a>
                                                        @endif
                                                    </li>




                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                        <a href="/report/update/{{ $item->id }}"
                                                                class="dropdown-item" title="Update Report">
                                                                <i class="bi bi-pencil-square me-2"></i> Update Report
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/report/update/{{ $item->id }}"
                                                                class="dropdown-item" title="Update Report">
                                                                <i class="bi bi-pencil-square me-2"></i> Update Report
                                                            </a>
                                                        @endif
                                                    </li>

                                                    <li>
                                                        @if (Auth::user()->level === 'Admin')
                                                        <a href="/deletereport/{{ $item->id }}"
                                                                class="dropdown-item text" title="Delete Report">
                                                                <i class="bi bi-trash me-2"></i> Delete Report
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/deletereport/{{ $item->id }}"
                                                                class="dropdown-item text" title="Delete Report">
                                                                <i class="bi bi-trash me-2"></i> Delete Report
                                                            </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>


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
