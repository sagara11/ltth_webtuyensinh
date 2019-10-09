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
    public $post_links = array();
    public $img_links = array();

    function posts($url, $page){    
        $posts  = new Dom;

        // load tung trang trong muc giao duc
        $posts->loadFromUrl($url.'trang-'.$page.'.htm');

        // gan cac link trong muc tin moi vao mang
        $post = $posts->find('h3.title-news a');
        foreach($post as $key){
            array_push($this->post_links,'tuoitre.vn/'.$key->href);
        }

        $src = $posts->find('a.img212x132 img.img212x132');
        foreach($src as $key){
            array_push($this->img_links, $key->src);
        }

        // xu ly tung bai viet
        $i=0;
        foreach($this->post_links as $key){
            $this->post($key, $this->img_links[$i]);
            $i++;
        }
    }

    function post($page_url, $img){
        $post = new Dom;
        $post->loadFromUrl($page_url);

        // lay cac phan tu name, description, image, content, slug
        $name = $post->find('h1.article-title')->innerHTML;
        $slug = $page_url;
        $description = $post->find('h2.sapo')->innerHTML;
        $image = $img;
        $content_arr = $post->find('div.content.fck p');
        $content = '';
        foreach($content_arr as $key){
            $content.=$key;
        }

        // gan thuoc tinh vao doi tuong object
        $this->object=array(
            'name' => $name,
            'description' => $description,
            'image' => $image,
            'slug' => $slug,
            'content' => $content
        );

        // insert len DB
        $crawlcontroller = new CrawlController;
        $crawlcontroller->db_insert($this->object);
    }
}