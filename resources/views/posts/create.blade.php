@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Course')}}
            {{Form::text('title', '', ['class'=>'form-control', 'placeholder'=>'e.g. COMM 101'])}}
        </div>

        <select name = "rating" class="custom-select">
            <option value = "5" selected>Choose your rating</option> <!-- gotta change front end to require select -->
            <option value = "5">5 stars - Awesome</option>
            <option value = "4">4 stars</option>
            <option value = "3">3 stars - Pretty good</option>
            <option value = "2">2 stars</option>
            <option value = "1">1 stars - Don't take</option>
        </select>

        <br>
        <br>

        <div class="form-group">
                {{Form::label('prof_firstname', 'Prof\'s First Name')}}
                {{Form::text('prof_firstname', '', ['class'=>'form-control', 'placeholder'=>'e.g. Jonathan'])}}
        </div>
        <div class="form-group">
                {{Form::label('prof_lastname', 'Prof\'s Last Name')}}
                {{Form::text('prof_lastname', '', ['class'=>'form-control', 'placeholder'=>'e.g. Topley'])}}
        </div>

        Did you take it in a Winter term or in a Summer term?
        <select name = "winorsum" class="custom-select">
            <option value = "winter term 1" selected>Winter Term 1</option>
            <option value = "winter term 2">Winter Term 2</option>
            <option value = "summer term 1">Summer Term 1</option>
            <option value = "summer term 2">Summer Term 2</option>
            <option value = "winter term">Winter Term</option>
            <option value = "fall term">Fall Term</option>
            <option value = "summer term">Summer Term</option>
            <option value = "spring term">Spring Term</option>
            <option value = "full year term">Full Year Course Term</option>
            <option value = "other">Other</option>
        </select>
        <br>

        Was the course online?
        <select name = "online" class="custom-select">
            <option value = "offline" selected>Offline</option>
            <option value = "online">Online</option>
        </select>
        <br><br>

        Faculty of Course (UPDATED: MORE FACULTIES AVAILABLE)
        <select name = "faculty" class="custom-select">
            <option value = "Commerce Business" selected>Commerce/Business</option>
            <option value = "Computer Science">Computer Science</option>
            <option value = "Mathematics">Mathematics</option>
            <option value = "Arts">Arts</option>
            <option value = "Science">Science</option>
            <option value = "Applied Science Engineering">Applied Science/Engineering</option>
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
        <br>

        <!-- This can be uncommented once the site is open to all schools
        <div class="form-group">
                {{Form::label('school', 'School (Use Full Name)')}}
                {{Form::text('school', '', ['class'=>'form-control', 'placeholder'=>'e.g. University of British Columbia'])}}
        </div>
    -->
    School
    <select name = "school" class="custom-select">
        <option value = "University of British Columbia" selected>University of British Columbia</option>
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
        <br><br>

        <div class="form-group">
                {{Form::label('body', 'Review:')}}
                <p>Best if you can answer questions such as, "Was the content of the course useful?", "Is it a lot of workload?", "Do you recommend to take it in the summer?", and "Do you need this course for any major or minor?"</p>
                {{Form::textarea('body', '', ['id'=>'summary-ckeditor','class'=>'form-control', 'placeholder'=>'Body Text'])}}
        </div>
        
        <!----//upload file UI--->
        <div class = "form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection