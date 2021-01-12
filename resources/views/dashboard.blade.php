@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/posts/create" class="btn btn-primary">Post a Review!</a>
                    <br><br>
                    <h3>Your Course Reviews</h3>
                    <br>
                    @if(count($posts) > 0)
                    <table class = "table table-striped">
                        <tr>
                            <th>Courses</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                                <td><a href="/posts/{{$post->id}}" >{{$post->title}}</a></td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                <td>{!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}
                                    {!!Form::close() !!}</td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <p>You have no reviews. :(</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
