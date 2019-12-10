<?php

namespace App\Http\Controllers\CrawlerPages;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CrawlController;

class vnexpressController extends Controller
{
    function posts($url, $page){   
        // load tung trang trong muc giao duc
        $posts  = new Dom;
        $posts->loadFromUrl($url.'-p'.$page);

        // gan cac link va anh trong muc tin moi vao mang
        $datas = [];
        $count = 0;
        $list_news = $posts->find('.list_news');

        foreach($list_news as $k => $key){
            if(!$key->find('img')->count()) continue;
            $object = array(
                'urls' => $key->find('a')->href,
                'img' => str_replace("_180x108","", $key->find('img')->getAttribute('data-original')) 
                            );
            array_push($datas, $object);
        }

        // return mang url tung page va hinh anh
        return $datas;
    }

    function post($page_url){
        $post = new Dom;
        $post->loadFromUrl($page_url);

        // lay cac phan tu name, description, image, content, slug
        try{
            $name = $post->find('h1.title_news_detail')->innerHTML;
            if(preg_match('/\/.+\/(.+)-\d/m', $page_url, $match)) 
            {
                $slug_arr = $match[1];
            } 
            $slug = explode('.html?', $slug_arr);
            $description = $post->find('p.description')->innerHTML;
            $content = $post->find('.content_detail')->innerHTML;
        }
        catch(\Exception $e){
            $name = $post->find('h1.title_news_detail')->innerHTML;
            if(preg_match('/\/.+\/(.+)-\d/m', $page_url, $match)) 
            {
                $slug_arr = $match[1];
            } 
            $slug = explode('.html?', $slug_arr);
            $description = $post->find('h2.description')->innerHTML;
            $content = $post->find('.content_detail')->innerHTML;                                                                                                                                                                                       
            exit();
        }

        $post_link = $page_url;
        $str = $post->find('span.time')->innerHTML;
        $string1 = explode(", ", $str)[1];

        $hour = explode(" ",$str)[3];

        $string2 = explode("/", $string1);
        $created_at = date("Y-m-d H:i:s",strtotime($string2[2]."/".$string2[1]."/".$string2[0]." ".$hour));

        //gan thuoc tinh cua trang
        return array(
            'name' => html_entity_decode($name),
            'description' => strip_tags($description),
            'slug' => $slug[0],
            'content' => $content,
            'post_link' => $post_link,
            'created_at' => $created_at
        );
    }
}
