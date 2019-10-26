<?php

namespace App\Http\Controllers;

use App\Crawl;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Http\Controllers\CrawlerPages\tuoitreController;
use App\Http\Controllers\CrawlerPages\dantriController;
use App\Http\Controllers\CrawlerPages\vnexpressController;
use App\Http\Controllers\CrawlerPages\giaoducthoidaiController;

class CrawlController extends Controller
{
    function crawl_routine($frequency){
        // lay het doi tuong bang bien frequency
        $object = Crawl::where('frequency', $frequency)->get();
        foreach($object as $key){
            // lay web_name va link cua tung web
            $object_name = $key['web_name'];
            $object_link = $key['links'];
            $object_category_id = $key['bts_categories'];
            $object_source_id = $key['id'];
            //tao doi tuong voi web_name
            $domain_name = __NAMESPACE__. '\\'.'CrawlerPages'.'\\'. $object_name.'Controller';
            $crawl = new $domain_name;
            for($i=1; $i<2; $i++){
                // truyen link voi link
                $posts = $crawl->posts($object_link, $i);
                foreach($posts as $key => $value){
                    try{
                        $post = $crawl->post($value['urls']);
                        $data = new Post();
                        $data->name = $post['name'];
                        $data->description = $post['description'];
                        $data->image = $value['img'];
                        $data->slug = $post['slug'];
                        $data->content = htmlentities($post['content']);
                        $data->publish = 1;
                        $data->view = 0;
                        $data->category_id = $object_category_id;
                        $data->source_id = $object_source_id;
                        $this->slug_check($post['slug']);
                        if($this->slug_check($post['slug'])==1){
                            echo "+ Already exist".PHP_EOL;
                            continue;
                        }
                        else{
                            echo "+ OK. ".$post['name'].PHP_EOL;
                            $data->save();
                        }
                    } 
                    catch(\Exception $e){
                        continue;
                    }
                }
            }
        }
    }

    // kiem tra bai viet da ton tai
    function slug_check($slug){
        $slug_arr = Post::where('slug',$slug)->first();
        if(empty($slug_arr))
        {
            return 0;
        }
        else{
            return 1;
        }
    }

}
