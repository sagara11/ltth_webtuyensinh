<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $setting['seo_title'] }} - Web Tuyển Sinh </title>
    <meta name="description" content="{{ $setting['seo_description'] }}" />
    <meta name="robots" content="index, follow" />
    <meta http-equiv="content-language" content="vi" />
    <meta property="og:title" content="{{ $setting['seo_title'] }}">
    <meta property="og:description" content="{{ $setting['seo_description'] }}">
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ $setting['canonical'] }}">
    <link rel="canonical" href="{{ $setting['canonical'] }}" />
    <meta property="og:site_name" content="Web Tuyển Sinh">
    <link rel="icon" href="" type="image/x-icon"/>
    <meta property="og:image" content="{{ $setting['seo_image']  }}" />

    <script type="application/ld+json">
    {
       "@context": "http://schema.org",
       "@type": "WebSite",
       "name" : "",
       "url": "https://webtuyensinh.edu.vn",
       "potentialAction": [{
          "@type": "SearchAction",
          "target": "https://webtuyensinh.edu.vn/search?name_search={search_term}",
          "query-input": "required name_search=search_term"
        }]
    }
    </script>

    <script type="application/ld+json">
    { 
      "@context" : "http://schema.org",
        "@type" : "Organization",
        "legalName" : "",
        "url" : "https://webtuyensinh.edu.vn",
        "contactPoint" : [{
          "@type" : "ContactPoint",
          "telephone" : "+84 0971.722.666",
          "contactType" : "customer service"
        }],
        "logo" : "https://webtuyensinh.edu.vn/media/logo-main.png",
        "sameAs" : [ 
          "https://www.facebook.com/baotuyensinh/"
        ]
    }
    </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    @yield('css')
  </head>
  <body>
      @include('user.layout.header')
      @yield('content')
      @include('user.layout.footer')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=2270247446437024&autoLogAppEvents=1">
    </script>
    @yield('js')
  </body>
</html>