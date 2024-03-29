@extends('layouts.teacher')
@section('title','Subjects')
@section('content')
<div class="cd-content-wrapper">
    @section('header')
    <div class="container-fluid no-gutters">
        <div class="row no-gutters">
            <div class="col">
                <div class="hero hero-subject">
                    <div class="layout">
                        <h3>Subjects</h3>

                    </div>

                </div>
            </div>
        </div>
    </div>
    @endsection

    <div class="container">
        <!-- <div class="add row justify-content-end">
            <div class="col-sm-12 col-lg-4 text-right">
                <a href="/create-subject">Create new subject</a>
            </div>
        </div> -->
        <div class="row">
            <div class="col">
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
                    {{ session()->get('success') }}
                </div>
                @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Subject title</th>
                            <th scope="col">Subject id</th>
                            <th scope="col">Subject code</th>
                            <th scope="col">Participants</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $row_count = 1;
                        @endphp
                        @if($subjects->count() > 0)
                        @foreach($subjects as $subject)
                        <tr>
                            <td scope="row">{{$row_count++}}</td>
                            <td scope="col"><a href="subject/{{$subject->id}}">{{$subject->title}}</a></td>
                            <td scope="col">{{$subject->subject_id}}</td>
                            <td scope="col">
                                @if(isTeacherAssigned(Auth::user()->id, $subject->id))
                                {{$subject->code}}
                                @else
                                -
                                @endif
                            </td>
                            <td scope="col"><a href="/subject/{{$subject->id}}/participants">{{ $subject->students->count() }}</a></td>
                            <td scope="col"><i class="{{$subject->private== '1' ? 'fas fa-lock' : 'fas fa-lock-open'}}"> </i>{{$subject->private== 1? "private": "public"}}</td>
                            @if(isTeacherAssigned(Auth::user()->id, $subject->id))
                            <td scope="col"><a href="" class="drop" role="teacher" teacher-id="{{ Auth::user()->id }}" subject-id="{{ $subject->id }}" data-status="{{ $subject->private }}">Drop</a></td>
                            @else
                            <td scope="col"><a href="" class="join" role="teacher" subject-id="{{ $subject->id }}" data-status="{{ $subject->private }}">Join</a></td>
                            @endif
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td scope="row">{{$row_count++}}</td>
                            <td scope="col"><a href="/subject">-</a></td>
                            <td scope="col">-</td>
                            <td scope="col">-</td>
                            <td scope="col"><a href="/subject">-</a></td>
                            <td scope="col"><i class="fas fa-lock-open"></i></td>
                            <td scope="col"><a href="" class="join" role="teacher" subject-id="" data-status="">Join</a></td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<meta name="_token" content="{{ csrf_token() }}">
<script src="{{ asset('js/joinSubject.js') }}"></script>
<script src="{{ asset('js/dropSubject.js') }}"></script>

@endsection