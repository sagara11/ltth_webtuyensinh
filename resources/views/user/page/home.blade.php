@extends('user.layout.master')
@section('title')
Home
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <!-- Bai viet chinh -->
            <section id="baiviet-chinh">
                <a href="">
                    <img height="350px" width="100%" src="{{ $trend_first->image }}" alt="" />
                    <h5>
                        {{ $trend_first->name }}
                    </h5>
                </a>
                <p>
                    <small>Tuyển sinh | 1 giờ | 3 bình luận | </small>
                    <small><a href="">Báo tuyển sinh</a></small>
                </p>
            </section>

            <!-- Bai viet tieu bieu -->
            <section class="d-flex" id="baiviet-tieubieu">
                @foreach ($trend as $item)
                <div class="baiviet-box p-2">
                    <a href="">
                        <img class="img-fluid" src="{{ $item->image }}" alt="" />
                        <h5>
                            {{ $item->name }}
                        </h5>
                    </a>
                    <p>
                        <small>3 bình luận | </small>
                        <small><a href="">Báo tuyển sinh</a></small>
                    </p>
                </div>
                @endforeach
            </section>

            <!-- Bai viet - tin tuc -->
            <section id="baiviet-tintuc">
                @foreach ($news as $item)
                <div class="baiviet-box d-flex p-2">
                    <div class="tintuc-img w-30">
                        <img class="img-fluid" src="{{ $item->image }}" alt="" />
                    </div>
                    <div class="tintuc-detail">
                        <a href="">
                            <h5>
                                {{ $item->name }}
                            </h5>
                        </a>
                        <p>
                            <small>3 bình luận | </small>
                            <small><a href="">Báo tuyển sinh</a></small>
                        </p>
                    </div>
                </div>
                @endforeach
                {{ $news->links() }}
            </section>
        </div>

        <div class="col-lg-4">
            <!-- Banner quang cao -->
            <section id="quangcao">
                <div class="p-2">
                    <a href="">
                        <img class="img-fluid" src="http://localhost\baotuyensinhView\media\blank-img.jpg" alt="" />
                    </a>
                </div>
                <div class="p-2">
                    <a href="">
                        <img class="img-fluid" src="http://localhost\baotuyensinhView\media\blank-img.jpg" alt="" />
                    </a>
                </div>
            </section>

            <!-- Xu huong -->
            <section id="xuhuong">
                <i class="fas fa-facebook"></i>
                <h4 class="d-inline">XU HƯỚNG</h4>
                <a href="" class="xuhuong-main">
                    <img class="img-fluid" src="{{ $trend_first->image }}" alt="" />
                    <p>
                        {{ $trend_first->name }}
                    </p>
                </a>
                <div>
                    @foreach ($sidetrend as $item)
                    <a href="" class="d-flex xuhuong-contents p-2">
                        <img width="25%" height="70px" src="{{ $item->image }}" alt="" />
                        <p class="xuhuong-contents-des">
                            "{{ $item->name }}"
                        </p>
                    </a>
                    @endforeach
                </div>
            </section>

            <!-- Video -->
            <section id="videos">
                <h4>VIDEO</h4>
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
            </section>

            <!-- Tuyen sinh -->
            <section id="tuyensinh">
                <h3>TUYỂN SINH</h3>
                <a href="" class="d-flex tuyensinh-main">
                    <img width="35%" height="100px" src="{{ $tuyensinh_first->image }}" alt="" />
                    <p class="tuyensinh-des">
                        "{{ $tuyensinh_first->name }}"
                    </p>
                </a>
                @foreach ($tuyensinh as $item)
                <a href="" class="tuyensinh-contents">
                    <p>
                        "{{ $item->name }}"
                    </p>
                </a>
                @endforeach
            </section>

            <!-- Giao duc -->
            <section id="giaoduc">
                <h4>GIÁO DỤC</h4>
                <a href="" class="d-flex tuyensinh-main">
                    <img width="35%" height="100px" src="{{ $giaoduc_first->image }}"
                        alt="" />
                    <div class="tuyensinh-des">
                        "{{ $giaoduc_first->name }}"
                    </div>
                </a>
                @foreach ($giaoduc as $item)
                <a href="" class="tuyensinh-contents">
                    <p>
                        "{{ $item->name }}"
                    </p>
                </a>
                @endforeach
            </section>

            <!-- Big advertisement -->
            <section id="big-ad">
                <a href="">
                    <img height="500px;" class="img-fluid" src="http://localhost\baotuyensinhView\media\blank-img.jpg"
                        alt="" />
                </a>
            </section>

            <!-- Facebook embed -->
            <section id="facebook-embed">
                <i class="fab fa-facebook"></i>
                <div id="fb-root">
                    <div class="fb-page" data-href="https://www.facebook.com/baotuyensinh/" data-tabs="timeline"
                        data-width="350px" data-height="150px" data-small-header="false"
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

<article class="container">
    <div class="d-flex">
        <p>Liên kết đối tác:</p>
        <div class="doitac-img">
            <img class="img-fluid" src="http://localhost\baotuyensinhView\media\Young-Greens-Logo-Icon-02.png" alt="" />
        </div>
        <div class="doitac-img">
            <img class="img-fluid" src="http://localhost\baotuyensinhView\media\Young-Greens-Logo-Icon-02.png" alt="" />
        </div>
        <div class="doitac-img">
            <img class="img-fluid" src="http://localhost\baotuyensinhView\media\Young-Greens-Logo-Icon-02.png" alt="" />
        </div>
        <div class="doitac-img">
            <img class="img-fluid" src="http://localhost\baotuyensinhView\media\Young-Greens-Logo-Icon-02.png" alt="" />
        </div>
        <div class="doitac-img">
            <img class="img-fluid" src="http://localhost\baotuyensinhView\media\Young-Greens-Logo-Icon-02.png" alt="" />
        </div>
        <div class="doitac-img">
            <img class="img-fluid" src="http://localhost\baotuyensinhView\media\Young-Greens-Logo-Icon-02.png" alt="" />
        </div>
        <div class="doitac-img">
            <img class="img-fluid" src="http://localhost\baotuyensinhView\media\Young-Greens-Logo-Icon-02.png" alt="" />
        </div>
        <div class="doitac-img">
            <img class="img-fluid" src="http://localhost\baotuyensinhView\media\Young-Greens-Logo-Icon-02.png" alt="" />
        </div>
    </div>
</article>
@endsection