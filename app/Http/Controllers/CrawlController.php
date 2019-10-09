<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Category;
use App\Http\Controllers\CrawlerPages\tuoitreController;
use App\Http\Controllers\Admin\PostController;

class CrawlController extends Controller
{
    function db_insert($object){
        $data = new Post();
        $data->name = $object['name'];
        $data->description = $object['description'];
        $data->image = $object['image'];
        $data->slug = $object['slug'];
        $data->content = $object['content'];
        $data->category_id = 40;
        $data->publish = 1;
        $data->save();
    }

    function pages_insert(Post $post){
        for($i=3;$i<4;$i++){
            $tuoitre = new tuoitreController;
            $tuoitre->posts('https://tuoitre.vn/giao-duc/',$i);
        }
        return redirect()->route('indexPost');
    }
}
