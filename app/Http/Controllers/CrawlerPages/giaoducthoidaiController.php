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
        $post = $posts->find('.news-detail ul li a');
        
        $src = $posts->find('.news-detail ul li a .nd-img img');
        foreach($post as $key){
            $object = array(
                'urls' => 'https://giaoducthoidai.vn'.$key->href,
                'img' => str_replace("/220x142","",$src[$count]->src)
            );
            array_push($datas, $object);
            $count++;
        }

        // dd($datas);
        // return mang page va hinh anh
        return $datas;
    }

    function post($page_url){
        $post = new Dom;
        $post->loadFromUrl($page_url);

        // lay cac phan tu cua page
        try{
            $name = strip_tags($post->find('h1.cms-title')->innerHTML);
            if(preg_match('/\/.+\/(.+)-\d/m', $page_url, $match)) 
            {
                $slug = $match[1];
            }
            $description = strip_tags(html_entity_decode($post->find('label.cms-description div')->innerHTML));
            $content = $post->find('#abody')->innerHTML;
        }
        catch(\Exception $e){
            $name = strip_tags($post->find('h1.cms-title')->innerHTML);
            if(preg_match('/\/.+\/(.+)-\d/m', $page_url, $match)) 
            {
                $slug = $match[1];
            }
            $description = html_entity_decode($post->find('label.cms-description')->innerHTML);
            $content = $post->find('#abody')->innerHTML;
        }

        $post_link = $page_url;
        $str = $post->find('span.cms-date')->innerHTML;
        $string1 = explode(" ", $str)[1];
        $string2 = explode("/", $string1);
        $hour = explode(" ", $str)[0];

        $created_at = date("Y-m-d H:i:s",strtotime($string2[2]."/".$string2[1]."/".$string2[0]." ".$hour));

        //gan thuoc tinh cua trang
        return array(
            'name' => $name,
            'description' => $description,
            'slug' => $slug,
            'content' => $content,
            'post_link' => $post_link,
            'created_at' => $created_at
        );
    }
}