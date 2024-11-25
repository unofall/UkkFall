@extends('template-admin.navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="card-title">Create Report</div>

                    </div>
                    <div class="card-body">
                        <form
                            @if (Auth::user()->level === 'Admin') action="/report/create_report/{{ $task->id }}"
                        @elseif (Auth::user()->level === 'Member')
                        action="/member/create_report/{{ $task->id }}" @endif
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="squareInput">Task Name</label>
                                <input type="text" class="form-control input-square" name="" id="squareInput"
                                    placeholder="Input Name Event" value="{{ $task->name }}" disabled>

                                <input type="hidden" name="task_idtasks" value="{{ $task->id }}">
                            </div>
                            <div class="form-group">
                                <label for="squareInput"> Name Report</label>
                                <input type="text" class="form-control input-square" name="name[]" id ="squareInput"
                                    placeholder="Input Name Report">
                            </div>

                            <div class="form-group">
                                <label for="squareInput">DueTime</label>
                                <input type="datetime-local" class="form-control input-square" id="squareInput"
                                    name="duetime">
                                @error('duetime')
                                    <span class="text-danger">Date cannot be empty</span>
                                @enderror
                            </div>



                            <button type="submit" class="w-100 mb-2 btn btn-success">Submit</button>
                            {{--  <a href="/event" class="btn btn-danger  w-100">Back</a>  --}}

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
