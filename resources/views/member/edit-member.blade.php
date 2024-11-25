@extends('/template-admin/navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@section('content')
    </head>

    <body>
        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header text-center">
                            <div class="card-title">Create Member</div>
                        </div>
                        <div class="card-body">
                            <form action="/addmember/{{ $task->id }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="squareInput">Name Member</label>
                                    <select id="user_id" name="user_id" class="form-control input-square">
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="squareInput">Task</label>
                                    <input type="text" class="form-control input-square" name="" id="squareInput" placeholder="Input name task" value="{{ $task->name }}">
                                </div>
                                <input type="hidden" name="task_id" value="{{ $task->id }}">

                                <button type="submit" class="mb-2 btn btn-success w-100">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
@endsection
