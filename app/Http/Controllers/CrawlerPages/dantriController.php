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
        $post = $posts->find('a.fon6');
        $src = $posts->find('img.img130');
        foreach($post as $key){
            $object = array(
                'urls' => 'https://dantri.com.vn'.$key->href,
                'img' => str_replace("zoom/130_100//","",$src[$count]->src)
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

        // lay cac phan tu cua page
        $name = $post->find('h1.fon31.mgb15')->innerHTML;
        if(preg_match('/\/.+\/(.+)-\d/m', $page_url, $match)) 
        {
            $slug = $match[1];
        } 
        $description_span = $post->find('h2.fon33.mt1.sapo')->innerHTML;
        $description = trim($description_span, "<span>Dân trí<span/>&nbsp;");
        $description = strip_tags($description);
        $content = $post->find('.detail-content');
        $str = $post->find('span.tt-capitalize')->innerHTML;
        // Thứ Sáu 29/11/2019 - 00:17
        $string1 = explode(" ", $str)[3];
    
        $hour = explode(" ",$str)[5];

        $string2 = explode("/", $string1);
        
        $created_at = date("Y-m-d H:i:s",strtotime($string2[2]."/".$string2[1]."/".$string2[0]." ".$hour));
        
        $post_link = $page_url;
        
        //gan thuoc tinh cua trang
        return array(
            'name' => html_entity_decode($name),
            'description' => $description,
            'slug' => $slug,
            'content' => $content,
            'post_link' => $post_link,
            'created_at' => $created_at
        );
    }
}
