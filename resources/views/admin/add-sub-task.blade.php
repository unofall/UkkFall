@extends('template-admin.navbar')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="card-title">Add Task</div>

                    </div>
                    <div class="card-body">
                        <form
                            @if (Auth::user()->level === 'Admin') action="/create-subtask/{{ $task->id }}"
                        @elseif (Auth::user()->level === 'Member')
                        action="/member/create-subtask/{{ $task->id }}" @endif
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="input-2">Event</label>
                                <input type="text" class="form-control input-square" id="input-1"
                                    placeholder="Input Name Event" value="{{ $task->events->name }}" disabled>
                            </div>
                            <input type="hidden" name="events_id" value="{{ $task->events->id }}">
                            <div class="form-group">
                                <label for="input-2">Main Task</label>
                                <input type="text" class="form-control input-square" name="task_idtasks" id="input-1"
                                    placeholder="Input name task" value="{{ $task->name }}" disabled>
                            </div>
                            <input type="hidden" name="task_idtasks" value="{{ $task->id }}">
                            <div class="d-flex justify-content-end mt-2 mr-2">
                                <button type="button" class="btn btn-primary " onclick="addCriteria()">
                                    <li class="la la-plus"></li>
                                </button>
                            </div>
                            <div id="criteria-container">
                                <div class="form-group">
                                    <label for="input-1">Sub Task</label>
                                    <input type="text" class="form-control input-square" name="name[]" id="input-1"
                                        placeholder="Input Sub Task">
                                </div>
                                <div class="form-group">
                                    <label for="input-3">Description</label>
                                    <textarea id="" cols="30" rows="7" id="input-3" name="description[]"
                                        class="form-control input-square"></textarea>
                                </div>
                            </div>
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
    <script>
        function addCriteria() {
            let criteriaContainer = document.getElementById('criteria-container');

            let newSubTaskForm = document.createElement('div');

            let newCriteria = criteriaContainer.querySelector('.form-group input').cloneNode(true);
            newCriteria.value = '';

            let newDesc = criteriaContainer.querySelector('.form-group textarea').cloneNode(true);
            newDesc.value = '';

            let newCriteriaContainer = document.createElement('div');
            newCriteriaContainer.classList.add('form-group');
            newCriteriaContainer.appendChild(newCriteria);

            let newDescContainer = document.createElement('div');
            newDescContainer.classList.add('form-group');
            newDescContainer.appendChild(newDesc);

            criteriaContainer.appendChild(newCriteriaContainer);
            criteriaContainer.appendChild(newDescContainer);
        }
    </script>
@endsection
