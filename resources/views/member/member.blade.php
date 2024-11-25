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
                <div class="card">
                    <div class="card-header">
                        <div class="card-title mx-3">Members Table</div>
                    </div>
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
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Name Task</th>
                                    <th scope="col">Name Member</th>

                                    <th scope="col">Aksi</th>
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
                                            <div class="dropdown-center">
                                                <button type="button" class="btn btn-link" data-bs-toggle="dropdown">
                                                    <i class="bi bi-three-dots-vertical"
                                                        style="font-size: 17px; color: #000;"></i>
                                                </button>
                                                <ul class="dropdown-menu custom-dropdown-menu">
                                                    <li>
                                                        <a href="update/{{ $item->id }}" title="Edit Member">Edit
                                                            Member</a>
                                                    </li>
                                                    <li>
                                                        <a href="/member/delete/{{ $item->id }}" title="Delete Member"> Delete
                                                            Member
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
