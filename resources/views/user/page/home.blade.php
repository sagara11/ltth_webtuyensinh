@extends('user.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/baiviet_box.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/paginate.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/home.css') }}">
<link rel="stylesheet" href="{{ asset('slick-1.8.1/slick/slick.css') }}">
<link rel="stylesheet" href="{{ asset('slick-1.8.1/slick/slick-theme.css') }}" />
@endsection
@section('title')
Home
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Bai viet chinh -->
            <section id="baiviet-chinh">
                <form id="baiviet-form" method="post" action="{{ route('chitiettin', $trend_first->slug) }}">
                    @csrf
                    <a onclick="document.getElementById('baiviet-form').submit()">
                        <img class="img-fluid" height="450px" src="{{ $trend_first->image }}" alt="">
                        <h5>
                            {{ $trend_first->name }}
                        </h5>
                    </a>
                    <input type="hidden" name="id" value="{{ $trend_first->id }}">
                </form>
                <p>
                    <small class="webtuyensinh-section">
                        <span>{{ $trend_first->categories->name }} |</span>
                        <span>{{ $trend_first->time() }} giờ trước |</span>
                        @if ($trend_first->comment != NULL )
                        <span>{{ $trend_first->comment }} bình luận |</span>
                        @else
                        <span>0 bình luận |</span>
                        @endif
                    </small>
                    <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                </p>
            </section>

            <!-- Bai viet tieu bieu -->
            <section id="baiviet-tieubieu">
                @foreach ($trend as $item)
                <div class="tieubieu-box">
                    <form id="baiviet-form" method="post" action="{{ route('chitiettin', $item->slug) }}">
                        @csrf
                        <a onclick="document.getElementById('baiviet-form').submit()">
                            <img class="img-fluid" src="{{ $item->image }}" alt="">
                            <h5>
                                {{ $item->name }}
                            </h5>
                        </a>
                        <input type="hidden" name="id" value="{{ $item->id }}">
                    </form>
                    <p>
                        <small class="webtuyensinh-section">
                            <span>{{ $item->categories->name }} |</span>
                            <span>{{ $item->time() }} giờ trước |</span>
                            @if ($item->comment != NULL )
                            <span>{{ $item->comment }} bình luận |</span>
                            @else
                            <span>0 bình luận |</span>
                            @endif
                        </small>
                        <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                    </p>
                </div>
                @endforeach
            </section>

            <!-- Bai viet - tin tuc -->
            <section id="baiviet-tintuc">
                @foreach ($news as $item)
                <div class="baiviet-box">
                    <div class="tintuc-img">
                        <img class="img-fluid" src="{{ $item->image }}" alt="" />
                    </div>
                    <div class="tintuc-detail">
                        <form id="baiviet-form" method="post" action="{{ route('chitiettin', $item->slug) }}">
                            @csrf
                            <a onclick="document.getElementById('baiviet-form').submit()">
                                <h5>
                                    {{ $item->name }}
                                </h5>
                            </a>
                            <input type="hidden" name="id" value="{{ $item->id }}">
                        </form>
                        <p>
                            <small class="webtuyensinh-section">
                                <span>{{ $item->categories->name }} |</span>
                                <span>{{ $item->time() }} giờ trước |</span>
                                @if ($item->comment != NULL )
                                <span>{{ $item->comment }} bình luận |</span>
                                @else
                                <span>0 bình luận |</span>
                                @endif
                            </small>
                            <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                        </p>
                    </div>
                </div>
                @endforeach
            </section>
            {{ $news->links() }}
        </div>

        <div class="col-lg-4">
            <!-- Banner quang cao -->
            <section id="quangcao">
                @foreach ($banner as $item)
                <div class="quangcao-box">
                    <a href="">
                        <img src="{{ $item->image }}" alt="" />
                    </a>
                </div>
                @endforeach
            </section>

            <!-- Xu huong -->
            <section id="xuhuong">
                <div class="side-header">
                    <i class="fas fa-desktop"></i>
                    <h4>XU HƯỚNG</h4>
                </div>
                <div class="side-content">
                    <a href="{{ route('chitiettin', $trend_first->id) }}" class="xuhuong-main">
                        <img class="img-fluid" src="{{ $trend_first->image }}" alt="" />
                        <p>
                            {{ $trend_first->name }}
                        </p>
                    </a>
                    <div>
                        @foreach ($sidetrend as $item)
                        <a href="{{ route('chitiettin', $item->id) }}" class="xuhuong-contents">
                            <img width="25%" height="70px" src="{{ $item->image }}" alt="" />
                            <p class="xuhuong-contents-des">
                                "{{ $item->name }}"
                            </p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Video -->
            <section id="videos">
                <div class="side-header">
                    <i class="far fa-play-circle"></i>
                    <h4>VIDEO</h4>
                </div>
                <div class="side-content">
                    <div class="video">
                        <video>
                            <source src="http://localhost\baotuyensinhView\media\\trandan.mp4" />
                        </video>
                        <p class="video-title">
                            Hội thảo sáng chế công nghệ sàn ô cờ ACH tiết kiệm chi phí xây
                            dựng tại Hồ Chí Minh
                        </p>
                    </div>
                    <div class="video">
                        <video>
                            <source src="http://localhost\baotuyensinhView\media\\trandan.mp4" />
                        </video>
                        <p class="video-title">
                            Hội thảo sáng chế công nghệ sàn ô cờ ACH tiết kiệm chi phí xây
                            dựng tại Hồ Chí Minh
                        </p>
                    </div>
                    <div class="video">
                        <video>
                            <source src="http://localhost\baotuyensinhView\media\\trandan.mp4" />
                        </video>
                        <p class="video-title">
                            Hội thảo sáng chế công nghệ sàn ô cờ ACH tiết kiệm chi phí xây
                            dựng tại Hồ Chí Minh
                        </p>
                    </div>
                </div>
            </section>

            <!-- Tuyen sinh -->
            <section id="tuyensinh">
                <div class="side-header">
                    <i class="fas fa-briefcase"></i>
                    <h4>TUYỂN SINH</h4>
                </div>
                <div class="side-content">
                    <a href="{{ route('chitiettin', $tuyensinh_first->id) }}" class="tuyensinh-main">
                        <img src="{{ $tuyensinh_first->image }}" alt="" />
                        <p class="tuyensinh-des">
                            "{{ $tuyensinh_first->name }}"
                        </p>
                    </a>
                    @foreach ($tuyensinh as $item)
                    <div class="tuyensinh-contents">
                        <a href="{{ route('chitiettin', $item->id) }}">
                            <p>
                                "{{ $item->name }}"
                            </p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Giao duc -->
            <section id="giaoduc">
                <div class="side-header">
                    <i class="fas fa-book-open"></i>
                    <h4 class="d-inline">GIÁO DỤC</h4>
                </div>
                <div class="side-content">
                    <a href="{{ route('chitiettin', $giaoduc_first->id) }}" class="giaoduc-main">
                        <img src="{{ $giaoduc_first->image }}" alt="" />
                        <div class="tuyensinh-des">
                            "{{ $giaoduc_first->name }}"
                        </div>
                    </a>
                    @foreach ($giaoduc as $item)
                    <div class="giaoduc-contents">
                        <a href="{{ route('chitiettin', $item->id) }}" class="">
                            <p>
                                "{{ $item->name }}"
                            </p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Big advertisement -->
            <section id="big-ad">
                <a href="">
                    <img src="{{ $footer_banner->image }}" alt="" />
                </a>
            </section>

            <!-- Facebook embed -->
            <section id="facebook-embed">
                <i class="fab fa-facebook-square"></i>
                <span>Fanpage facebook</span>
                <div id="fb-root">
                    <div class="fb-page" data-href="https://www.facebook.com/baotuyensinh/" data-tabs="timeline"
                        data-width="350px" data-height="200px" data-small-header="false"
                        data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/baotuyensinh/" class="fb-xfbml-parse-ignore">
                            <a href="https://www.facebook.com/baotuyensinh/">BÁO TUYỂN SINH</a>
                        </blockquote>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/user/home.js') }}"></script>
<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.js') }}"></script>
@endsection