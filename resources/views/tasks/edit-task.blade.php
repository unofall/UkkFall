@extends('template-admin.navbar')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header text-center">
                    <div class="card-title">Add Task</div>

                </div>
                <div class="card-body">
                    <form @if (Auth::user()->level === 'Admin') action="/task/update/{{ $task->id }}"
                        @elseif (Auth::user()->level === 'Member')
                        action="/member/task/update/{{ $task->id }}" @endif   method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="squareInput">Event</label>
                            <input type="text" class="form-control input-square" id="squareInput" placeholder="Input Name Event" value="{{ $task->events->name }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="squareInput">Task</label>
                            <input type="text" class="form-control input-square" name="name" id="squareInput" value="{{ $task->name }}" placeholder="Input name task">
                        </div>

                        <input type="hidden" name="events_id" value="{{ $task->events->id }}">
                        <div class="form-group">
                            <label for="squareInput">Description</label>
                            <textarea id="" cols="30" rows="7" name="description" class="form-control input-square" placeholder="Input description task">{{ $task->description }}</textarea>
                        </div>

                        {{--  <input type="hidden" name="events_id" value="{{ $event->id }}">  --}}
                        {{--  <input type="hidden" name="task_idtasks" value="">  --}}



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
