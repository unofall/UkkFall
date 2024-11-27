@extends('template-admin.navbar')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .hidden {
        display: none;
    }
</style>
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header text-center">
                        <div class="card-title">Create Detail Report</div>
                    </div>
                    <div class="card-body">
                        <form    @if (Auth::user()->level === 'Admin')  action="/addDetailReport/{{ $report->id }}"
                            @elseif (Auth::user()->level === 'Member')
                            action="/member/addDetailReport/{{ $report->id }}" @endif method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="squareInput">Description</label>
                                <input type="text" class="form-control input-square" name="description" id="squareInput">
                            @error('description')
                                    <span class="text-danger">Description cannot be empty</span>
                            @enderror
                            </div>

                            <input type="hidden" name="reports_id" value="{{ $report->id }}">
                            <div class="form-group">
                                <label for="squareInput">Date Time</label>
                                <input type="datetime-local" class="form-control input-square" id="squareInput" name="datetime">
                                @error('datetime')
                                    <span class="text-danger">Date cannot be empty</span>
                                @enderror
                            </div>
                            <div id="" class="form-group">
                                 <label for="linkLabel" id="linkLabel">Link File</label>
                                  <input type="text" class="form-control input-square" name="link_file" id="linkInput" placeholder="Input Link">
                                  @error('link_file')
                                    <span class="text-danger">Link cannot be empty</span>
                                  @enderror
                                <button type="button" class="btn btn-primary my-2" onclick="toggleInput()">Toggle Input</button>
                            </div>
                            <button type="submit" class="w-100 mb-2 btn btn-success">Submit</button>
                            {{--  <a href="/event" class="btn btn-danger  w-100">Back</a>  --}}

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleInput() {
            var linkInput = document.getElementById('linkInput');
            var linkLabel = document.getElementById('linkLabel');
            if (linkInput.type == 'text') {
                linkInput.type = 'file'
                linkInput.name = 'upload_file'
                linkInput.placeholder = 'Enter File'
                linkLabel.textContent = 'Upload File'
            } else {
                linkInput.type = 'text'
                linkInput.name = 'link_file'
                linkInput.placeholder = 'Enter link'
                linkLabel.textContent = 'Enter link'

            }
        }
    </script>
@endsection
