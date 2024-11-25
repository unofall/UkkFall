@extends('template-admin.navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header text-center">
                    <div class="card-title">Update Event</div>

                </div>
                <div class="card-body">
                    <form @if (Auth::user()->level === 'Admin') action="/event/edit_event/{{ $event->id }}"
                        @elseif (Auth::user()->level === 'Member')
                            action="/member/edit_event/{{ $event->id }}" @endif method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="squareInput">Name Event</label>
                            <input type="text" class="form-control input-square" name="name" id="squareInput" placeholder="Input Name Event" value="{{ $event->name }}">
                        </div>
                        <div class="form-group">
                            <label for="squareInput">Description</label>
                            <textarea id="" cols="30" rows="10" name="description" class="form-control input-square" placeholder="Input Description">{{ $event->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="squareInput">Date</label>
                            <input type="date" class="form-control input-square" id="squareInput" name="date" placeholder="Input Date"  value="{{ $event->date }}">
                        </div>
                        {{-- <div class="form-group">
                            <label for="squareInput">Who Created It ?</label>
                           <select id="created_by" name="created_by" class="form-control input-square">
                            @foreach ($user as $item)
                            <option value=""></option>
                              <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                           </select>
                        </div> --}}

                        @if (auth()->user()->level === 'Admin')
                                <div class="form-group">
                                    <label for="squareInput">Who Created It ?</label>
                                    <select id="created_by" name="created_by" class="form-control input-square">
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif

                            @if (auth()->user()->level === 'Member')
                                <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                            @endif


                        <div class="d-flex justify-content-end mt-2">
                            <button type="submit" class="mr-2 w-100 btn btn-success">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
