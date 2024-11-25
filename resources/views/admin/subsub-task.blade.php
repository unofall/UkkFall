@extends('template-admin/navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <style>
        .custom-dropdown-menu li a {
            font-size: 15px;
            /* Mengatur ukuran font untuk teks di dalam dropdown */
            margin: 10px 10px 10px 10px;
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
            width: 90%;
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
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"><a href="/subtask/{{ $task->id }}" style="color: black">Management Task /
                                {{ $task->name }}</a></div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="card-sub">
                        This is the basic table view of the ready dashboard :
                    </div> --}}
                        <table class="table mt-3 text-center">
                            <div class="d-flex justify-content-end p-1">
                                @if (Auth::user()->level === 'Admin')
                                <a href="/create-subSubtask/{{ $task->id }}" class="btn btn-primary fw-bold">Add sub-Sub
                                    Task</a>
                            @elseif (Auth::user()->level === 'Member')
                            <a href="/member/create-subSubtask/{{ $task->id }}" class="btn btn-primary fw-bold">Add sub-Sub
                                Task</a>
                            @endif

                            </div>
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Sub Sub Task</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Persentase</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $key => $item)
                                    <tr>
                                        <td>{{ $key += 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->percentage }}%</td>
                                        <td>
                                            <div class="dropdown-center">
                                                <button type="button" class="btn btn-link p-0" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"
                                                        style="font-size: 20px; color: #555;"></i>
                                                </button>
                                                <ul class="dropdown-menu custom-dropdown-menu">
                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/report/create_report/{{ $item->id }}"
                                                                class="dropdown-item" title="Create Report">
                                                                <i class="bi bi-file-earmark-plus me-2"></i> Create Report
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/create_report/{{ $item->id }}"
                                                                class="dropdown-item" title="Create Report">
                                                                <i class="bi bi-file-earmark-plus me-2"></i> Create Report
                                                            </a>
                                                        @endif
                                                    </li>

                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                        <a href="/edit-subSubtask/{{ $item->id }}" class="dropdown-item"
                                                            title="Edit Sub Sub Task">
                                                            <i class="bi bi-pencil-square me-2"></i> Edit Sub Sub Task
                                                        </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                        <a href="/member/edit-subSubtask/{{ $item->id }}" class="dropdown-item"
                                                            title="Edit Sub Sub Task">
                                                            <i class="bi bi-pencil-square me-2"></i> Edit Sub Sub Task
                                                        </a>
                                                        @endif
                                                    </li>

                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                        <a href="/deletesubSubTask/{{ $item->id }}"
                                                            class="dropdown-item text-danger" title="Delete Sub Sub Task">
                                                            <i class="bi bi-trash me-2"></i> Delete Sub Sub Task
                                                        </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                        <a href="/member/deletesubSubTask/{{ $item->id }}"
                                                            class="dropdown-item text-danger" title="Delete Sub Sub Task">
                                                            <i class="bi bi-trash me-2"></i> Delete Sub Sub Task
                                                        </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>

                                            {{-- <li>
                                        <a href="/completeTask/{{ $item->id }}" title="Delete Sub Sub Task" >Selesai</a>
                                    </li> --}}
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
