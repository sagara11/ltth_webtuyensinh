@extends('user.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/baiviet_box.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/comment.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/chitiettin.css') }}">
@endsection
@section('content')

<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "NewsArticle",
      "name": "{{ $new->name }}",
      "image" : "{{ $new->image }}",
      "description" : "{{ $new->description }}",
      "author"      : "webtuyensinh",
      "headline":"Web Tuyển Sinh",
        "datePublished": "{{ $new->created_at }}",
        "dateModified": "{{ $new->updated_at }}",
      "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "reviewCount": "{{ $new->id }}"
      },
      "publisher": {
        "@type": "Organization",
        "name": "https://webtuyensinh.edu.vn",
        "logo": {
            "@type": "ImageObject",
            "url": "",
            "width": 60,
            "height": 60
        }
      },
      "mainEntityOfPage": {
            "@type": "WebPage",
            "@id"   : "https://webtuyensinh.edu.vn/{{ $new->slug }}"
      }
    }
</script>

<script type="application/ld+json">
    {
     "@context": "http://schema.org",
     "@type": "BreadcrumbList",
     "itemListElement":
     [
      {
       "@type": "ListItem",
       "position": 1,
       "item":
       {
        "@id": "https://webtuyensinh.edu.vn",
        "name": "Trang chủ"
        }
      },
      {
        "@type": "ListItem",
        "position": 2,
        "item":
                         {
           "@id": "https://webtuyensinh.edu.vn/danh-muc/{{ $new->slug }}/",
           "name":"{{ $new->name }}" 
         }
       
      },
      {
        "@type": "ListItem",
        "position": 3,
        "item":
         {
           "@id": "https://webtuyensinh.edu.vn/{{ $new->slug }}/",
           "name": ">{{ $new->name }}y"
         }
        }
     ]
    }
    </script>
<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <section id="danhmuc">
                @if (isset($new->categories->name))
                <h4> {{ $new->categories->name }} </h4>
                @endif
            </section>
            <section id="baiviet-name">
                <h1> {{ $new->name }} </h1>
                <div class="webtuyensinh-section">
                    @if (isset($new->categories->name))
                    <span>{{ $new->categories->name }} |</span>
                    @endif
                    <span>{{ $new->hour() }} |</span>
                    <span> {{ $comment->count() }} bình luận |</span>
                    @if ($new->source->id)
                    <a class="webtuyensinh-link"
                        href="{{ route('nguon_tin', $new->source->id) }}">{{ $new->source->web_name }}</a>
                    @endif
                    <span class="new_view">| {{ $new->view }} lượt xem</span>
                </div>
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            </section>

            <article id="baiviet-description">
                {!! $new->description !!}
            </article>

            <article id="baiviet-content">
                <div style="overflow-wrap: break-word;" class="clearfix">
                    {!! $new->content !!}
                </div>
            </article>

            <section id="news_source">
                @if (isset($new->source->web_name))
                <a target="_blank" rel="nofollow" href="{{ $new->post_link }}">
                    Theo <b>{{ $new->source->web_name }}</b>
                </a>
                @endif
            </section>

            <article id="comment">
                <div class="comment-header">
                    <p>Ý KIẾN BẠN ĐỌC ({{ $comment->count() }})</p>
                </div>
                <?php
                    $i=0;
                ?>
                <div class="user-comment">
                    <form method="post" action="{{ route('comment') }}">
                        <input id="input1" type="hidden" name="input1">
                        @foreach ($comment as $item)
                        <div class="comment-box father">
                            <div class="comment-box-img">
                                <img class="rounded rounded-circle" src="{{ $item->user->avatar }}" alt="avatar">
                            </div>
                            <div class="comment-box-content">
                                <span class="user-name">
                                    {{ $item->user->name }}
                                </span>
                                <span class="comment-time">{{ $item->hour() }}</span>
                                <p>
                                    {{ $item->comment }}
                                </p>
                                <div class="comment-reply">
                                    <span data-toggle="collapse" data-target="#comment-reply-{{ $item->id }}">Trả lời
                                    </span>
                                    @if (Auth::check())
                                    @if ($item->user->id == Auth::user()->id)
                                    <!-- <span> Sửa  </span> -->
                                    <span>
                                        <a href="{{ route('deletecomment_chitiet',$item->id) }}">Xóa</a>
                                    </span>
                                    @endif
                                    @endif
                                </div>
                                <div class="mb-3 your-comment collapse" id="comment-reply-{{ $item->id }}">
                                    @if (Auth::check())
                                    @csrf
                                    <input type="hidden" name="parent_id[]" value="{{ $item->id }}">
                                    <input type="hidden" name="post_id" value="{{ $new->id }}">
                                    <input id="{{ $i }}" name="your_comment_reply-{{ $item->id }}"
                                        class="form-control child_rep_comment" type="textarea"
                                        placeholder="Ý kiến của bạn">

                                    <div class="row">
                                        <div class="col-md-9">
                                            <span>
                                                <img class="rounded rounded-circle" src="{{ Auth::user()->avatar }}"
                                                    alt="avatar">
                                            </span>
                                            <span><b>{{ Auth::user()->name }}</b></span>
                                        </div>
                                        <div class="col-md-3">
                                            <button id="submit_btn" name="submit1" type="submit">GỬI</button>
                                        </div>
                                    </div>
                                    @else
                                    <p>
                                        Bạn cần <a href="#" data-toggle="modal" data-target="#signin"> Đăng nhập </a> để
                                        có thể bình luận hoặc
                                        <a href="#" data-toggle="modal" data-target="#signup"> Đăng ký </a> nếu chưa có
                                        tài khoản </p>
                                    </p>
                    </form>
                    @endif
                </div>
        </div>
    </div>
    @if (isset($item->child_comments))
    @foreach ($item->child_comments as $child_item)
    <div class="comment-box children">
        <div class="comment-box-img">
            <img class="rounded rounded-circle" src="{{ $child_item->user->avatar }}" alt="avatar">
        </div>
        <div class="comment-box-content">
            <span class="user-name"> {{ $child_item->user->name }} </span>
            <span class="comment-time">{{ $child_item->hour() }}</span>
            <p> {{ $child_item->comment }} </p>
        </div>
    </div>
    @endforeach
    @endif

    <?php
                        $i++;
                    ?>
    @endforeach
    </div>
    <div class="your-comment">
        @if (Auth::check())
        <form method="post" action="{{ route('comment') }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $new->id }}">
            <input name="your_comment" class="form-control" type="textarea" placeholder="Ý kiến của bạn">
            <div class="row">
                <div class="col-md-9">
                    <span>
                        <img class="rounded rounded-circle" src="{{ Auth::user()->avatar }}" alt="avatar">
                    </span>
                    <span><b>{{ Auth::user()->name }}</b></span>
                </div>
                <div class="col-md-3">
                    <button name="submit2" type="submit">GỬI</button>
                </div>
            </div>

        </form>
        @else
        <p>
            Bạn cần <a href="#" data-toggle="modal" data-target="#signin"> Đăng nhập </a> để có thể bình luận hoặc
            <a href="#" data-toggle="modal" data-target="#signup"> Đăng ký </a> nếu chưa có tài khoản </p>
        @endif
    </div>
    </article>

    {{-- Tin lien quan --}}
    <section class="tintuc-contain">
        <div class="tin-header">
            <h3> <span> TIN LIÊN QUAN </span> </h3>
        </div>
        <div class="tin-content">
            @foreach ($tinlienquan as $item)
            <div class="baiviet-box">
                <div class="row">
                    <div class="col-md-3 col-5">
                        <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                            <img class="img-fluid" src="{{ $item->image }}" alt="{{ $item->name }}" />
                        </a>
                    </div>

                    <div class="col-md-9 col-7">
                        <h5> <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a> </h5>
                        <p>
                            <span> {{ $item->hour() }} </span>
                            @if (isset($item->source->id))
                            <a class="webtuyensinh-link" href="{{ route('nguon_tin', $item->source->id) }}">
                                {{ $item->source->web_name }} </a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Tin moi --}}
    <section class="tintuc-contain">
        <div class="tin-header">
            <h3> <span> TIN MỚI </span> </h3>
        </div>
        <div class="tin-content">
            @foreach ($tinmoi as $item)
            <div class="baiviet-box">
                <div class="row">
                    <div class="col-md-3 col-5">
                        <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                            <img class="img-fluid" src="{{ $item->image }}" alt="{{ $item->name }}" />
                        </a>
                    </div>

                    <div class="col-md-9 col-7">
                        <h5> <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a> </h5>
                        <p>
                            @if (isset($item->categories->name))
                            <span> {{ $item->categories->name }} </span>
                            @endif
                            <span> {{ $item->hour() }} </span>
                            @if (isset($item->source->id))
                            <a class="webtuyensinh-link" href="{{ route('nguon_tin', $item->source->id) }}">
                                {{ $item->source->web_name }} </a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Tin nong --}}
    <section class="tintuc-contain">
        <div class="tin-header">
            <h3> <span> TIN NÓNG </span> </h3>
        </div>
        <div class="tin-content">
            @foreach ($tinnong as $item)
            <div class="baiviet-box">
                <div class="row">
                    <div class="col-md-3 col-5">
                        <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                            <img class="img-fluid" src="{{ $item->image }}" alt="{{ $item->name }}" />
                        </a>
                    </div>

                    <div class="col-md-9 col-7">
                        <h5> <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a> </h5>
                        <p>
                            <span> {{ $item->categories->name }} </span>
                            <span> {{ $item->hour() }} </span>
                            @if (isset($item->source->id))
                            <a class="webtuyensinh-link" href="{{ route('nguon_tin', $item->source->id) }}">
                                {{ $item->source->web_name }} </a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    </div>
    @include('user.layout.sidebar')
    </div>
</main>
@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>
<script type="text/javascript" src="{{ asset('js/user/chitiettin.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/user/home.js') }}"></script>

<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.js') }}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59b0b0bc0881afd4"></script>
@endsection