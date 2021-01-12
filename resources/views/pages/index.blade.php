@extends('layouts.app')

@section('content')
       <div class="jumbotron text-center">
               <h1>Rate Your Courses!</h1>
               <h5>Welcome to RateMyCourse! You can use this site to</h5>
               <p>
                       <li>Make sure the courses you're taking are useful and fun</li>
                        <li>Learn more about the courses you're taking</li>
                        <li>Check whether your course is required for your degree</li>
                        <li>Anonymously post reviews of the courses you took to help<br> others choose their courses</li>
                       
                </p><br>
                <p><b>Why should you create an account here:</b>
                                <li>You can edit your reviews later on if you change your mind</li> 
                                <li>First members who sign up will be given life-time of free features</li>          
                 </p>
               <p> <a class='btn btn-primary btn-lg' href="/posts/create" role="button">Post a Review</a> </p>
               <p> <a class='btn btn-primary btn-lg' href="/posts" role="button">See Reviews</a> </p>
               @guest
                <p> <a class='btn btn-primary btn-lg' href="/login" role="button">Login</a> <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a></p>
                @endguest
               <h5>UPDATE: Now, open to almost all Canadian Universities!</h5>
        </div>
@endsection