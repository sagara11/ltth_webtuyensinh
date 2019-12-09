<?xml version="1.0" encoding="utf-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
   xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
   xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    
    @php 
		foreach($categories as $page):
			// dd($page);
	@endphp
     <url>
        <loc>{{  url('/')."/danh-muc/".$page->slug }}</loc>
        <lastmod>{{ date('Y-m-d', strtotime($page->created_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
     </url>
    @php 
    	endforeach;
  	@endphp 
</urlset>