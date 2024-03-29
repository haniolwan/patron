@extends('layouts.student')
@section('content')
<div class="cd-content-wrapper">
    @section('header')
    <div class="container-fluid no-gutters">
        <div class="row no-gutters">
            <div class="col">
                <div class="hero hero-subject">
                    <div class="layout">
                        <h3>Quizzes</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <div class="container">
        <div class="add row">
            <div class="col">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search for quiz ..." aria-label="Search">
                </form>
            </div>

        </div>
        <div class="row">
            <div class="col">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Quiz title</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $row_count =1;
                        @endphp
                        @if($quizzes->count() > 0)
                        @foreach($quizzes as $quiz)
                        <tr>
                            <td scope="row">{{ $row_count++ }}</td>
                            <td scope="col">{{ $quiz->title }}</td>
                            <td scope="col"><a href="/student/subject/{{ $quiz->subject->id }}">{{ $quiz->subject->title }}</a></td>
                            @if($quiz->mark / 2 <= $quiz->pivot['score'])
                                <td scope="col">
                                    <span class="text-success">
                                        {{ $quiz->pivot['score'] }}
                                    </span> /
                                    {{ $quiz->mark }}
                                </td>
                                @else
                                <td scope="col">
                                    <span class="text-danger">
                                        {{ $quiz->pivot['score'] }}
                                    </span> /
                                    {{ $quiz->mark }}
                                </td>
                                @endif
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td scope="row">{{ $row_count++ }}</td>
                            <td scope="col">-</td>
                            <td scope="col"><a href="">-</a></td>
                            <td scope="col">-</td>
                            <td class="text-success" scope="col">-</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> <!-- .cd-content-wrapper -->
<meta name="_token" content="{{ csrf_token() }}">
</main> <!-- .cd-main-content -->
<script src="{{ asset('js/attendQuiz.js') }}"></script>
@endsection