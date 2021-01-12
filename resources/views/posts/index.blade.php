@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    <h5>Filter by University and Faculty</h5>
    {!! Form::open(['action' => 'SearchesController@search', 'method' => 'GET', 'class'=>"form-inline md-form mr-auto mb-4"]) !!}
    <select name = "school" class="custom-select">
            <option value="" disabled selected>Select your University</option>
            <option value = "University of British Columbia">University of British Columbia</option>
            <option value = "University of Toronto">University of Toronto</option>
            <option value = "McGill University">McGill University </option>
            <option value = "University of Waterloo">University of Waterloo</option>
            <option value = "Wilfrid Laurier University">Wilfrid Laurier University</option>
            <option value = "Queen's University">Queen's University</option>
            <option value = "University of Western Ontario">University of Western Ontario</option>
            <option value = "McMaster University">McMaster University</option>
            <option value = "Dalhousie University">Dalhousie University</option>
            <option value = "University of Guelph">University of Guelph</option>
            <option value = "York University">York University</option>
            <option value = "Ryerson University">Ryerson University</option>
            <option value = "University of Alberta">University of Alberta</option>
            <option value = "University of Montreal">University of Montreal</option>
            <option value = "University of Calgary">University of Calgary</option>
            <option value = "University of Ottawa">University of Ottawa</option>
            <option value = "Simon Fraser University">Simon Fraser University</option>
            <option value = "University of Victoria">University of Victoria</option>
            <option value = "Concordia University">Concordia University</option>
            <option value = "Laval University">Laval University</option>
            <option value = "University of Saskatchewan">University of Saskatchewan</option>
            <option value = "Carleton University">Carleton University</option>
            <option value = "University of Manitoba">University of Manitoba</option>
            <option value = "University of Windsor">University of Windsor</option>
            <option value = "Brock University">Brock University</option>
            <option value = "University of Regina">University of Regina</option>
            <option value = "University of Winnipeg">University of Winnipeg</option>
            <option value = "Nipissing University">Nipissing University</option>
            </select>

            <select name = "faculty" class="custom-select">
                    <option value="" disabled selected>Select Faculty/Subject</option>
                    <option value = "Commerce Business" >Commerce/Business</option>
                    <option value = "Computer Science">Computer Science</option>
                    <option value = "Mathematics">Mathematics</option>
                    <option value = "Arts">Arts</option>
                    <option value = "Science">Science</option>
                    <option value = "Engineering">Applied Science/Engineering</option>
                    <option value = "Architecture">Architecture</option>
                    <option value = "Dentistry">Dentistry</option>
                    <option value = "Education">Education</option>
                    <option value = "Forestry">Foresty</option>
                    <option value = "Kinesiology">Kinesiology</option>
                    <option value = "Land and Food Systems">Land and Food Systems</option>
                    <option value = "Law">Law</option>
                    <option value = "Medicine Pharmacy Health">Medicine/Pharmacy/Health</option>
                    <option value = "Music">Music</option>
                    <option value = "Humanities">Humanities</option>
                    <option value = "Philosophy">Philosophy</option>
                    <option value = "Languages">Languages</option>
                </select>

                {{Form::text('search', '', ['class'=>'form-control', 'placeholder'=>'Search For Reviews'])}}
                <button class="btn aqua-gradient btn-rounded btn-sm my-0" type="submit">Search</button>
            {!! Form::close() !!}

    @if(count($posts) > 0)
        Scores go from 1 to 5: 1 being really bad to 5 being freaking awesome.
        @foreach($posts as $post)
            <div class = "well well-lg">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                            <div class="row">
                            Upvotes: {{$post->upvotes}} &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                            {!! Form::open(['action' => 'VotesController@upvote', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                                <input type = 'hidden' name = 'id' value = '{{$post->id}}'>
                                <input type = 'hidden' name = 'show' value = 'false'>
                                {{Form::submit('upvote', ['class'=>'btn btn-primary'])}}
                            {!! Form::close() !!}
                            </div>
                            
                            <div class="row">
                            Downvotes: {{$post->downvotes}} &nbsp
                            {!! Form::open(['action' => 'VotesController@downvote', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                                <input type = 'hidden' name = 'id' value = '{{$post->id}}'>
                                <input type = 'hidden' name = 'show' value = 'false'>
                                {{Form::submit('downvote', ['class'=>'btn btn-primary'])}}
                            {!! Form::close() !!}
                            </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a> Score: {{$post->rating}}</h3> <!-- assign id by alphabetical order --->
                            <h5>{{$post->school}}, {{$post->faculty}}, {{$post->winorsum}}, {{$post->online}}</h5>
                            <small>Written on {{$post->created_at}} by {{$post->user->major}} student</small>
                    </div>
                </div>
                
            </div>
            <br>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection