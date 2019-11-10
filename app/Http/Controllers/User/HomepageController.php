<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;

class HomepageController extends Controller
{
    function home(){
        $news = Post::paginate(20);
        $tuoitre1 = Post::where('category_id', 37)->first();
        $tuoitre = Post::where('category_id', 37)->paginate(3);
        return view('user.page.home', compact('news','tuoitre1','tuoitre'));
    }
}
