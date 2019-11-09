<?php

namespace App\Http\Controllers\CrawlerPages;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CrawlController;

class dantriController extends Controller
{
    function posts($url, $page){
        // load tung trang trong muc giao duc
        $posts  = new Dom;
        $posts->loadFromUrl($url.'trang-'.$page.'.htm');

        // gan cac link va anh trong muc tin moi vao mang
        $datas = [];
        $count = 0;
        $post = $posts->find('.eplcheck div.mr1 h2 a');
        $src = $posts->find('img.img130');

        foreach($post as $key){
            $object = array(
                'urls' => 'dantri.com.vn'.$key->href,
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
        $name = $post->find('h1.fon31.mgb15')->innerHTML;
        $slug = trim(str_replace("dantri.com.vn/giao-duc-khuyen-hoc/","",$page_url),'.htm');
        $description_span = $post->find('h2.fon33.mt1.sapo')->innerHTML;
        $description = trim($description_span, "<span>Dân trí<span/>&nbsp;");
        $content = $post->find('.detail-content');

        //gan thuoc tinh cua trang
        return array(
            'name' => $name,
            'description' => $description,
            'slug' => $slug,
            'content' => $content
        );
    }
}
