@extends('user.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/baiviet_box.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/comment.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/chitiettin.css') }}">
@endsection
@section('title')
Chi tiết tin
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <section id="danhmuc">
                <h4>TUYỂN SINH</h4>
            </section>

            {{-- Ten bai viet --}}
            <section id="baiviet-name">
                <h5>"{{ $new->name }}"</h5>
                <div class="webtuyensinh-link">
                    <p>
                        <small class="webtuyensinh-section">Tuyển sinh | 1 giờ | 3 bình luận | </small>
                        <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                    </p>
                </div>
            </section>

            {{-- Description --}}
            <section id="baiviet-description">
                <div>
                    <p>
                        {!! $new->description !!}
                    </p>
                </div>
            </section>

            {{-- Image --}}
            <section id="baiviet-img">
                <img class="img-fluid" src="{{ $new->image }}" alt="">
            </section>

            {{-- Content --}}
            <section id="baiviet-content">
                {!! $new->content !!}
            </section>

            {{-- Comment --}}
            <article id="comment">
                <div class="comment-header">
                    <p>Ý KIẾN BẠN ĐỌC(11)</p>
                </div>
                <div class="user-comment">
                    <div class="comment-box father">
                        <div class="comment-box-img">
                            <img class="rounded rounded-circle" src="{{ asset('media/tải xuống (1).png') }}" alt="">
                        </div>
                        <div class="comment-box-content">
                            <span class="user-name">
                                Nguyễn Văn Nam
                            </span>
                            <span class="comment-time">16:50 06/11/2019</span>
                            <p>
                                Trong 3 năm gần nhất, ngành dân tộc học cổ truyền...
                            </p>
                            <div class="comment-reply">
                                <span>Trả lời | </span>
                                <span>Sửa | </span>
                                <span>Xóa</span>
                            </div>
                        </div>
                        <div class="comment-box children">
                            <div class="comment-box-img">
                                <img class="rounded rounded-circle" src="{{ asset('media/tải xuống (1).png') }}" alt="">
                            </div>
                            <div class="comment-box-content">
                                <span class="user-name">
                                    Nguyễn Văn Nam
                                </span>
                                <span class="comment-time">16:50 06/11/2019</span>
                                <p>
                                    Trong 3 năm gần nhất, ngành dân tộc học cổ truyền...
                                </p>
                                <div class="comment-reply">
                                    <span>Trả lời | </span>
                                    <span>Sửa | </span>
                                    <span>Xóa</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-box father">
                        <div class="comment-box-img">
                            <img class="rounded rounded-circle" src="{{ asset('media/tải xuống (1).png') }}" alt="">
                        </div>
                        <div class="comment-box-content">
                            <span class="user-name">
                                Nguyễn Văn Nam
                            </span>
                            <span class="comment-time">16:50 06/11/2019</span>
                            <p>
                                Trong 3 năm gần nhất, ngành dân tộc học cổ truyền...
                            </p>
                            <div class="comment-reply">
                                <span>Trả lời | </span>
                                <span>Sửa | </span>
                                <span>Xóa</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="your-comment">
                    <form action="">
                        <input class="form-control" type="textarea" placeholder="Ý kiến của bạn">
                    </form>
                    <span>
                        <img class="rounded rounded-circle" src="{{ asset('media/tải xuống (1).png') }}" alt="">
                    </span>
                    <span><b>Nguyễn Văn Nam</b></span>
                    <button>GỬI</button>
                </div>
            </article>

            {{-- Tin lien quan --}}
            <section class="tintuc-contain">
                <div class="tin-header">
                    <h3>TIN LIÊN QUAN</h3>
                </div>
                <div class="tin-content">
                    @foreach ($tinlienquan as $item)
                    <div class="baiviet-box">
                        <div class="tintuc-img">
                            <img class="img-fluid" src="{{ $item->image }}" alt="" />
                        </div>
                        <div class="tintuc-detail">
                            <a href="{{ route('chitiettin', $item->id) }}">
                                <h5>
                                    {{ $item->name }}
                                </h5>
                            </a>
                            <p>
                                <small class="webtuyensinh-section">Tuyển sinh | 1 giờ | 3 bình luận | </small>
                                <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            {{-- Tin moi --}}
            <section class="tintuc-contain">
                <div class="tin-header">
                    <h3>TIN MỚI</h3>
                </div>
                <div class="tin-content">
                    @foreach ($tinmoi as $item)
                    <div class="baiviet-box">
                        <div class="tintuc-img">
                            <img class="img-fluid" src="{{ $item->image }}" alt="" />
                        </div>
                        <div class="tintuc-detail">
                            <a href="{{ route('chitiettin', $item->id) }}">
                                <h5>
                                    {{ $item->name }}
                                </h5>
                            </a>
                            <p>
                                <small class="webtuyensinh-section">Tuyển sinh | 1 giờ | 3 bình luận | </small>
                                <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            {{-- Tin nong --}}
            <section class="tintuc-contain">
                <div class="tin-header">
                    <h3>TIN NÓNG</h3>
                </div>
                <div class="tin-content">
                    @foreach ($tinmoi as $item)
                    <div class="baiviet-box">
                        <div class="tintuc-img">
                            <img class="img-fluid" src="{{ $item->image }}" alt="" />
                        </div>
                        <div class="tintuc-detail">
                            <a href="{{ route('chitiettin', $item->id) }}">
                                <h5>
                                    {{ $item->name }}
                                </h5>
                            </a>
                            <p>
                                <small class="webtuyensinh-section">Tuyển sinh | 1 giờ | 3 bình luận | </small>
                                <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
        <div class="col-lg-4">
            <!-- Banner quang cao -->
            <section id="quangcao">
                <div class="quangcao-box">
                    <a href="">
                        <img src="{{ asset('media/Untitled-1.png') }}" alt="" />
                    </a>
                </div>
                <div class="quangcao-box">
                    <a href="">
                        <img src="{{ asset('media/Untitled-2.png') }}" alt="" />
                    </a>
                </div>
            </section>

            <!-- Xu huong -->
            <section id="xuhuong">
                <div class="side-header">
                    <i class="fas fa-desktop"></i>
                    <h4>XU HƯỚNG</h4>
                </div>
                <div class="side-content">
                    <a href="{{ route('chitiettin', $new->id) }}" class="xuhuong-main">
                        <img class="img-fluid" src="{{ $new->image }}" alt="" />
                        <p>
                            {{ $new->name }}
                        </p>
                    </a>
                    <div>
                        @foreach ($xuhuong as $item)
                        <a href="{{ route('chitiettin', $item->id) }}" class="xuhuong-contents">
                            <img width="25%" height="70px" src="{{ $item->image }}" alt="" />
                            <p class="xuhuong-contents-des">
                                "{{  $item->name }}"
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
                        <img src="{{  $tuyensinh_first->image }}" alt="" />
                        <p class="tuyensinh-des">
                            "{{  $tuyensinh_first->name }}"
                        </p>
                    </a>
                    @foreach ($tuyensinh as $item)
                    <div class="tuyensinh-contents">
                        <a href="{{ route('chitiettin', $item->id) }}">
                            <p>
                                "{{  $item->name }}"
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
                    <a href="{{ route('chitiettin', $giaoduc_first->id) }}" class="tuyensinh-main">
                        <img src="{{ $giaoduc_first->image }}" alt="" />
                        <div class="tuyensinh-des">
                            "{{  $giaoduc_first->name }}"
                        </div>
                    </a>
                    @foreach ($giaoduc as $item)
                    <div class="tuyensinh-contents">
                        <a href="{{ route('chitiettin', $item->id) }}" class="">
                            <p>
                                "{{  $item->name }}"
                            </p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Big advertisement -->
            <section id="big-ad">
                <a href="">
                    <img class="img-fluid" src="{{ asset('media/Untitled-3.jpg') }}" alt="" />
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
@endsection