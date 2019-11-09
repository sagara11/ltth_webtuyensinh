<?php

namespace App\Http\Controllers\CrawlerPages;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CrawlController;

class giaoducthoidaiController extends Controller
{
    function posts($url, $page){
        // load tung trang trong muc giao duc
        $posts  = new Dom;
        $posts->loadFromUrl($url.'?page='.$page);

        // gan cac link va anh trong muc tin moi vao mang
        $datas = [];
        $count = 0;
        $post = $posts->find('.zone-list article.story .thumbnail a');
        $src = $posts->find('.zone-list article.story .thumbnail a img');

        foreach($post as $key){
            $object = array(
                'urls' => 'https://giaoducthoidai.vn'.$key->href,
                'img' => $src[$count]->src
            );
            array_push($datas, $object);
            $count++;
        }

        // return mang page va hinh anh
        return $datas;
    }

    function post($page_url){
        $post = new Dom;
        $post->loadFromUrl($page_url);

        // lay cac phan tu name, description, image, content, slug
        try{
            $name = strip_tags($post->find('h1.cms-title')->innerHTML);
            $slug = trim(str_replace("ps://giaoducthoidai.vn/giao-duc","",$page_url),'.html');
            $description = $post->find('div.summary.cms-desc div')->innerHTML;
            $content = htmlentities($post->find('.cms-body'));
        }
        catch(\Exception $e){
            $name = strip_tags($post->find('h1.cms-title')->innerHTML);
            $slug = trim(str_replace("ps://giaoducthoidai.vn/giao-duc","",$page_url),'.html');
            $description = $post->find('div.summary.cms-desc')->innerHTML;
            $content = $post->find('.cms-body');
        }

        //gan thuoc tinh cua trang
        return array(
            'name' => $name,
            'description' => $description,
            'slug' => $slug,
            'content' => $content
        );
    }
}




