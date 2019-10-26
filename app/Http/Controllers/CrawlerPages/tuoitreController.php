<?php

namespace App\Http\Controllers\CrawlerPages;

use Illuminate\Http\Request;
use PHPHtmlParser\Dom;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CrawlController;

class tuoitreController extends Controller
{
    function posts($url, $page){
        // load tung trang trong muc giao duc
        $posts  = new Dom;
        $posts->loadFromUrl($url.'trang-'.$page.'.htm');

        // gan cac link va anh trong muc tin moi vao mang
        $datas = [];
        $count = 0;
        $post = $posts->find('h3.title-news a');
        $src = $posts->find('a.img212x132 img.img212x132');

        foreach($post as $key){
            $object = array(
                'urls' => 'tuoitre.vn/'.$key->href,
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

        // lay cac phan tu cua trang
        $name = $post->find('h1.article-title')->innerHTML;
        $slug = trim(trim($page_url, "tuoitre.vn//"),".htm");
        $description = $post->find('h2.sapo')->innerHTML;
        $content = htmlentities($post->find('#main-detail-body'));

        return array(
            'name' => $name,
            'description' => $description,
            'slug' => $slug,
            'content' => $content
        );
    }
}