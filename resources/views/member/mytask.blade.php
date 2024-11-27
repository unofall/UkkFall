@extends('template-admin/navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <style>
        /* Style Dropdown Filter */
        #eventDropdown {
            font-size: 0.9rem;
            padding: 0.35rem;
            padding-left: 15px;
            background-color: #f9f9f9;
            border-color: #ced4da;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            width: 300px
        }

        #eventDropdown:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            background-color: #fff;
        }

        #eventDropdown option {
            font-weight: 500;
        }

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
                <div class="card rounded-3 h-12">
                    {{-- <div class="d-flex justify-content-between align-items-center mx-3">
                        <!-- Title -->
                        <div class=" fs-6 fw-bold ms-2" style="letter-spacing: 1px; word-spacing: 3px">Management Task</div>
                        <!-- Filter Form -->
                        <form method="GET" action="/filter" class="d-flex align-items-center mt-3">
                            <label for="eventDropdown" class="form-label fs-6 mr-3" style="letter-spacing: 0.5px"> Filter
                                Event : </label>
                            <select id="eventDropdown" name="event_id" class=" form-select shadow-sm border-2"
                                onchange="this.form.submit()">
                                <option value="">All Task</option>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}"
                                        {{ request('event_id') == $event->id ? 'selected' : '' }}>
                                        {{ $event->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div> --}}
                </div>
                <div class="card rounded-3">
                    <div class="card-body">
                        <table class="table text-center">
                            <div class="card-sub">
                                This is the task table :
                            </div>
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Name Event</th>
                                    <th scope="col">Name Task</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Percentage</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tasks as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->events->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->calculatePercentage() }}%</td>
                                        <td>
                                            {{-- <div class="progress">
                                                <div class="progress-bar" style="width: {{ $item->percentage }}%"
                                                    aria-valuenow="{{ $item->percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                    {{ round($item->percentage, 2) }}%
                                                </div>
                                            </div> --}}
                                        </td>
                                        {{-- <td>{{ $item->users_id }}</td> --}}
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
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/addmember/{{ $item->id }}"
                                                                class="dropdown-item" title="Add Member">
                                                                <i class="bi bi-person-plus me-2"></i> Add Member
                                                            </a>
                                                        @endif

                                                    </li>

                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/subtask/{{ $item->id }}" class="dropdown-item"
                                                                title="View Sub Task">
                                                                <i class="bi bi-list-task me-2"></i> View Sub Task
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/subtask/{{ $item->id }}"
                                                                class="dropdown-item" title="View Sub Task">
                                                                <i class="bi bi-list-task me-2"></i> View Sub Task
                                                            </a>
                                                        @endif

                                                    </li>

                                                    <li class="mb-1">
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/task/update/{{ $item->id }}"
                                                                class="dropdown-item" title="Update Task">
                                                                <i class="bi bi-pencil-square me-2"></i> Update Task
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/task/update/{{ $item->id }}"
                                                                class="dropdown-item" title="Update Task">
                                                                <i class="bi bi-pencil-square me-2"></i> Update Task
                                                            </a>
                                                        @endif
                                                    </li>

                                                    <li>
                                                        @if (Auth::user()->level === 'Admin')
                                                            <a href="/deletetask/{{ $item->id }}"
                                                                class="dropdown-item text" title="Delete Task">
                                                                <i class="bi bi-trash me-2"></i> Delete Task
                                                            </a>
                                                        @elseif (Auth::user()->level === 'Member')
                                                            <a href="/member/deletetask/{{ $item->id }}"
                                                                class="dropdown-item text" title="Delete Task">
                                                                <i class="bi bi-trash me-2"></i> Delete Task
                                                            </a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center ">No tasks found</td>

                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
