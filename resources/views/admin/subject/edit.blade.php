@extends('layouts.admin')
@section('content')

<div class="container">
    <div class="create row">
        <div class="col ">
            <h2 class="mt-4 mb-4">Edit subject</h2>
            <form action="/admin/edit-subject/{{ $subject->id }}" method="post">
                @csrf
                @method('PATCH')
                @if(session()->has('error'))
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session()->get('error') }}
                </div>
                @endif
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{session()->get('success')}}
                </div>
                @endif
                <div class="form-group row">
                    <label for="Subject-title" class="col-sm-2 col-form-label">Subject title</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="title" id="Subject-title" value="{{ $subject->title }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Subject-id" class="col-sm-2 col-form-label">Subject id</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject_id" id="Subject-id" value="{{ $subject->subject_id }}" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Subject-description" class="col-sm-2 col-form-label">Subject description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="description" id="Subject-description" required>{{ $subject->description }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="Privacy" class="col-sm-2 col-form-label">Privacy</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-switch">

                            <input type="checkbox" class="custom-control-input" name="private" value="private" id="private" {{ $subject->private == 1 ? 'checked' : '' }}>
                            <label class="custom-control-label" for="private">Private</label>
                            <span>*Private means students can join subject only via subject join code, else any student can join subject.</span>
                        </div>
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-sm-12 text-right">
                        <button type="submit" class="btn btn-primary">Edit Subject</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection