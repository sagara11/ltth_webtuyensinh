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
        $post = $posts->find('.sidebar_1 .list_news .title_news .icon_commend');
        $src = $posts->find('.thumb_art .thumb.thumb_5x3 img.vne_lazy_image');

        foreach($post as $key){
            $object = array(
                'urls' => $key->href,
                'img' => $src[$count]->src
            );
            array_push($datas, $object);
            $count++;
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
            $slug = trim(trim($page_url, "https://vnexpress.net/giao-duc/"),".html");
            $description = $post->find('p.description')->innerHTML;
            $content = $post->find('.content_detail')->innerHTML;
        }
        catch(\Exception $e){
            $name = $post->find('h1.title_news_detail')->innerHTML;
            $slug = trim(trim($page_url, "https://vnexpress.net/giao-duc/"),".html");
            $description = $post->find('h2.description')->innerHTML;
            $content = $post->find('.content_detail')->innerHTML;                                                                                                                                                                                       
            exit();
        }
        catch(\Exception $e){
   
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
