@extends('template-admin.navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="card-title">Create Event</div>

                    </div>
                    <div class="card-body">
                        <form
                            @if (Auth::user()->level === 'Admin') action="/create_event"
                    @elseif (Auth::user()->level === 'Member')
                        action="/member/create_event" @endif
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="squareInput">Name Event</label>
                                <input type="text" class="form-control input-square" name="name" id="squareInput"
                                    placeholder="Input Name Event">
                                @error('name')
                                    <span class="text-danger">Name Event cannot be empty</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Description</label>
                                <textarea id="" cols="30" rows="10" name="description" class="form-control input-square"></textarea>

                                @error('description')
                                    <span class="text-danger">Description cannot be empty</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="squareInput">Date</label>
                                <input type="datetime-local" class="form-control input-square" id="squareInput"
                                    name="date" placeholder="Input Date">
                                @error('date')
                                    <span class="text-danger">Date must be current</span>
                                @enderror
                            </div>
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

                            <button type="submit" class="w-100 mb-2 btn btn-success">Submit</button>
                            {{--  <a href="/event" class="btn btn-danger  w-100">Back</a>  --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
