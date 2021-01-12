<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    /** Take this whole section till the next comment section to allow nonusers to post
     * Create a new controller instance.
     *
     * @return void
     *
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::all();
        //$posts = Post::orderBy('title', 'desc')->get();
        //$posts = Post::orderBy('title', 'desc')->take(1)->get();
        $posts = Post::orderBy('created_at', 'desc')->paginate(20);
        //$posts = DB::select('SELECT * FROM posts');
        //return Post::where('title', 'Post Two')->get();
        return view('posts.index')->with('posts',$posts);
    }

    public function make_sounds_like($request){
        $sounds_like = '';
        $sounds_like.= metaphone($request->input('title')).' ';
        $sounds_like.= metaphone($request->input('prof_firstname')).' ';
        $sounds_like.= metaphone($request->input('prof_lastname')).' ';
        $sounds_like.= metaphone($request->input('winorsum')).' ';
        $sounds_like.= metaphone($request->input('online')).' ';
        $sounds_like.= metaphone($request->input('faculty')).' ';
        $sounds_like.= metaphone($request->input('school')).' ';
        return $sounds_like;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'rating' => 'required',
            'prof_firstname' => 'required',
            'prof_lastname' => 'required',
            'winorsum' => 'required',
            'online' => 'required',
            'school' => 'required',
            'faculty' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to Store with timestamp to make the name completely unique
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image/file
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } else{
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input('title');
        $post->rating = $request->input('rating');
        $post->body = $request->input('body');
        $post->prof_firstname = $request->input('prof_firstname');
        $post->prof_lastname = $request->input('prof_lastname');
        $post->winorsum = $request->input('winorsum');
        $post->online = $request->input('online');
        $post->school = $request->input('school');
        $post->faculty = $request->input('faculty');
        $post->user_id = 0;
        $post->upvotes = 0;
        $post->downvotes = 0;

        //title, prof first, prof last, winorsum, online, faculty, school
        /*
        $post->sounds_like = make_sounds_like($request->input('title'), $request->input('prof_firstname'),
        $request->input('prof_lastname'), $request->input('winorsum'), $request->input('online'), 
        $request->input('faculty'), $request->input('school'));
        */
        //$post->sounds_like = make_sounds_like($request);
        $sounds_like = '';
        $sounds_like.= metaphone($request->input('title')).' ';
        $sounds_like.= metaphone($request->input('prof_firstname')).' ';
        $sounds_like.= metaphone($request->input('prof_lastname')).' ';
        $sounds_like.= metaphone($request->input('winorsum')).' ';
        $sounds_like.= metaphone($request->input('online')).' ';
        $sounds_like.= metaphone($request->input('faculty')).' ';
        $sounds_like.= metaphone($request->input('school')).' ';
        $post->sounds_like = $sounds_like;

        if(!Auth::Guest()){
            $post->user_id = auth()->user()->id;
        }
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    public function search(Request $request)
    {
        $hn='localhost';
        /*$un='philipko'
        $pw='12378Jjnghtyu!'
        $db='philipko_lsapp'*/
        $un='jim';
        $pw='mypasswd';
        $db='lsapp';
        $conn = new mysqli($hn,$un,$pw,$db);
        if($conn->connect_error) die("Fatal Error");
        
        $search = mysql_entities_fix_string($conn, $request->input('search'));
        $search = metaphone($search);

        $posts = User::where('sounds_like','LIKE',"%{$search}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->get();

        return view('posts.index')->with('posts',$posts);
    }

    //preventing HTML or SQL Injection
    function mysql_entities_fix_string($conn, $string){
        return htmlentities(mysql_fix_string($conn, $string));
    }
    function mysql_fix_string($conn, $string){
        if(get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conn->real_escape_string($string);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for correct user
        if(auth()->user()->id == $post->user_id){
            return view('posts.edit')->with('post', $post);
        }

        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'rating' => 'required',
            'prof_firstname' => 'required',
            'prof_lastname' => 'required',
            'winorsum' => 'required',
            'online' => 'required',
            'school' => 'required',
            'faculty' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            // Filename to Store with timestamp to make the name completely unique
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image/file
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
        } 

        // Create Post
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->rating = $request->input('rating');
        $post->body = $request->input('body');
        $post->prof_firstname = $request->input('prof_firstname');
        $post->prof_lastname = $request->input('prof_lastname');
        $post->winorsum = $request->input('winorsum');
        $post->online = $request->input('online');
        $post->school = $request->input('school');
        $post->faculty = $request->input('faculty');
        $post->user_id = 0;
        

        $sounds_like = '';
        $sounds_like.= metaphone($request->input('title')).' ';
        $sounds_like.= metaphone($request->input('prof_firstname')).' ';
        $sounds_like.= metaphone($request->input('prof_lastname')).' ';
        $sounds_like.= metaphone($request->input('winorsum')).' ';
        $sounds_like.= metaphone($request->input('online')).' ';
        $sounds_like.= metaphone($request->input('faculty')).' ';
        $sounds_like.= metaphone($request->input('school')).' ';
        $post->sounds_like = $sounds_like;

        if(!Auth::Guest()){
            $post->user_id = auth()->user()->id;
        }
        if($request->hasFile('cover_image')){
            $post->cover_image = $fileNameToStore;
        } /*else { //shouldn't have this else statement
            $post->cover_image = 'noimage.jpg';
        }*/

        //$post->sounds_like = make_sounds_like($request);

        $post->save();

        return redirect('/posts')->with('success', 'Post Updated');
    }



    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = POST::find($id);

        if(auth()->user()->id == $post->user_id && $post->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        // Check for correct user
        if(auth()->user()->id == $post->user_id){
            $post->delete();
            return redirect('/posts')->with('success', 'Post Removed');
        }


        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page');
        }

    }
}
