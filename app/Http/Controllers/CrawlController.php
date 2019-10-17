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
    function pages_insert($domain){
        for($i=3;$i<4;$i++){
            $domain_name = _NAMESPACE_. '\\'.'CrawlerPages'.'\\'. $domain.'Controller';
            $crawl = new $domain_name;
            $posts = $crawl->posts($i);
            foreach($posts as $key => $value){
                $post = $crawl->post($value['urls']);
                $data = new Post();
                $data->name = $post['name'];
                $data->description = $post['description'];
                $data->image = $value['img'];
                $data->slug = $post['slug'];
                $data->content = htmlentities($post['content']);
                $data->save();
            }
        }  
    }

}
