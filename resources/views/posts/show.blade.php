@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default" >Go Back</a>
    <h1>{{$post->title}}</h1>
    
    <h1><b>Score: {{$post->rating}}</b></h1>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <h4>Prof: {{$post->prof_firstname}} {{$post->prof_lastname}}<br></h4>
        <h5>Faculty: {{$post->faculty}}<br>
        {{$post->school}} <br><br>
    {{$post->winorsum}}<br>
    {{$post->online}}</h5>
    <div>
        {!!$post->body!!}
    </div>
    
    <small>Written on {{$post->created_at}} by {{$post->user->major}} student</small>
    <hr>

    <div class="row">
            <div class="row">
                Upvotes: {{$post->upvotes}} &nbsp
                {!! Form::open(['action' => 'VotesController@upvote', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                    <input type = 'hidden' name = 'id' value = '{{$post->id}}'>
                    <input type = 'hidden' name = 'show' value = 'true'>
                    {{Form::submit('upvote', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <div class="row">
                Downvotes: {{$post->downvotes}} &nbsp
                {!! Form::open(['action' => 'VotesController@downvote', 'method' => 'GET', 'enctype' => 'multipart/form-data']) !!}
                    <input type = 'hidden' name = 'id' value = '{{$post->id}}'>
                    <input type = 'hidden' name = 'show' value = 'true'>
                    {{Form::submit('downvote', ['class'=>'btn btn-primary'])}}
                {!! Form::close() !!}
            </div>
        </div>
    
    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
    
            {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
            {!!Form::close() !!}
         @endif
    @endif
@endsection