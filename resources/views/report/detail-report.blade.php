@extends('template-admin/navbar')
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
                        <div class="card-title mx-3">Management Detail Reports</div>
                    </div>
                    <div class="card-body">
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
                                                    <li>
                                                        <a href="/updateDetail/{{ $item->id }}"
                                                            title="Update Task">Update Detail Report</i></a>
                                                    </li>
                                                    <li>
                                                        <a href="/deleteDetail/{{ $item->id }}"
                                                            title="Delete Detail Report">Delete Detail Report</a>
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
