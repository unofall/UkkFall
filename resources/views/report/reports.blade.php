@extends('template-admin.navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <style>
        <style>.custom-dropdown-menu {
            min-width: 60px;
        }

        .custom-dropdown-menu li a {
            font-size: 13px;
            margin: 30px 10px 10px 20px;
            text-decoration: none;
            color: black
        }
    </style>
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mx-3">Management Report</div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="card-sub">
                        This is the basic table view of the ready dashboard :
                    </div> --}}

                        <table class="table mt-3 text-center">
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
                                            <div class="dropdown">
                                                <button type="button" class="btn btn-link" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"
                                                        style="font-size: 17px; color: #000;"></i>
                                                </button>
                                                <ul class="dropdown-menu custom-dropdown-menu">
                                                    <li>
                                                        <a href="/addDetailReport/{{ $item->id }}"
                                                            title="View Sub Task">Add Detail Report</a>
                                                    </li>
                                                    <li>
                                                        <a href="/report/update/{{ $item->id }}"
                                                            title="Update Task">Update Task</i></a>
                                                    </li>
                                                    <li>
                                                        <a href="/deletereport/{{ $item->id }}"
                                                            title="Delete Task">Delete Task</a>
                                                    </li>
                                                </ul>
                                            </div>
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
