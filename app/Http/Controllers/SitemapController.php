<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Post;
use Carbon\Carbon;

use DB;
use Illuminate\Support\Facades\Session;

class SitemapController extends Controller
{
	
    public function index()
    {
    	$pages = [
    		[
    			'url' => url('/sitemap_post.xml')
    		],
    		[
    			'url' => url('/sitemap_category.xml')
    		],
    	];
        return response()->view('sitemap.index', compact('pages'))->header('Content-Type', 'text/xml');
    }

    public  function post(){
		$posts = Post::all();
        return response()->view('sitemap.post', compact('posts'))->header('Content-Type', 'text/xml');
	}
	public  function category(){
		$categories = Category::all();
        return response()->view('sitemap.category', compact('categories'))->header('Content-Type', 'text/xml');
	}
}