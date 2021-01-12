<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

use Illuminate\Support\Facades\Auth;

class SearchesController extends Controller
{
    public function search(Request $request)
    {
        /*$this->validate($request, [
            'search' => 'required',
        ]);
        */
        /*
        $hn='localhost';
        //$un='philipko'
        //$pw='12378Jjnghtyu!'
        //$db='philipko_lsapp'
        $un='jim';
        $pw='mypasswd';
        $db='lsapp';
        $conn = new mysqli($hn,$un,$pw,$db);
        if($conn->connect_error) die("Fatal Error");
        
        $search = mysql_entities_fix_string($conn, $request->input('search'));
        $conn->close();
        */

        $search = metaphone( $request->input('search') );
        $faculty = metaphone( $request->input('faculty') );
        $school = metaphone( $request->input('school') );
         //I need to alter this so that it searches using AND to narrow search results if typed a lot in the search bar

        $posts = Post::where('sounds_like','LIKE',"%{$search}%")
            ->where('sounds_like','LIKE',"%{$faculty}%")
            ->where('sounds_like','LIKE',"%{$school}%")
            ->orderBy('title', 'desc')
            ->paginate(300);

        return view('posts.index')->with('posts',$posts);
    }
    /*
    //preventing HTML or SQL Injection
    function mysql_entities_fix_string($conn, $string){
        return htmlentities(mysql_fix_string($conn, $string));
    }
    function mysql_fix_string($conn, $string){
        if(get_magic_quotes_gpc()) $string = stripslashes($string);
        return $conn->real_escape_string($string);
    }
    */
}
