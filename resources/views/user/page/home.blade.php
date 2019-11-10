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
                    <img height="350px" width="100%" src="{{ $tuoitre1->image }}"
                        alt="" />
                    <h5>
                        {{ $tuoitre1->name }}
                    </h5>
                </a>
                <p>
                    <small>Tuyển sinh | 1 giờ | 3 bình luận | </small>
                    <small><a href="">Báo tuyển sinh</a></small>
                </p>
            </section>

            <!-- Bai viet tieu bieu -->
            <section class="d-flex" id="baiviet-tieubieu">
                @foreach ($tuoitre as $item)
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
                    <img class="img-fluid" src="http://localhost\baotuyensinhView\media\blank-img.jpg" alt="" />
                    <p>
                        Hội thảo Sáng chế công nghệ sàn ô cờ ở ACH tiết kiệm chi phí xây
                        dựng tại Hồ Chí Minh
                    </p>
                </a>
                <div>
                    <a href="" class="d-flex xuhuong-contents p-2">
                        <img width="25%" height="70px" src="http://localhost\baotuyensinhView\media\blank-img.jpg"
                            alt="" />
                        <p class="xuhuong-contents-des">
                            "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                            trúng tuyển"
                        </p>
                    </a>
                    <a href="" class="d-flex xuhuong-contents p-2">
                        <img width="25%" height="70px" src="http://localhost\baotuyensinhView\media\blank-img.jpg"
                            alt="" />
                        <p class="xuhuong-contents-des">
                            "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                            trúng tuyển"
                        </p>
                    </a>
                    <a href="" class="d-flex xuhuong-contents p-2">
                        <img width="25%" height="70px" src="http://localhost\baotuyensinhView\media\blank-img.jpg"
                            alt="" />
                        <p class="xuhuong-contents-des">
                            "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                            trúng tuyển"
                        </p>
                    </a>
                    <a href="" class="d-flex xuhuong-contents p-2">
                        <img width="25%" height="70px" src="http://localhost\baotuyensinhView\media\blank-img.jpg"
                            alt="" />
                        <p class="xuhuong-contents-des">
                            "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                            trúng tuyển"
                        </p>
                    </a>
                    <a href="" class="d-flex xuhuong-contents p-2">
                        <img width="25%" height="70px" src="http://localhost\baotuyensinhView\media\blank-img.jpg"
                            alt="" />
                        <p class="xuhuong-contents-des">
                            "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                            trúng tuyển"
                        </p>
                    </a>
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
                    <img width="35%" height="100px" src="http://localhost\baotuyensinhView\media\blank-img.jpg"
                        alt="" />
                    <p class="tuyensinh-des">
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </p>
                </a>
                <a href="" class="tuyensinh-contents">
                    <p>
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </p>
                </a>
                <a href="" class="tuyensinh-contents">
                    <p>
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </p>
                </a>
                <a href="" class="tuyensinh-contents">
                    <p>
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </p>
                </a>
                <a href="" class="tuyensinh-contents">
                    <p>
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </p>
                </a>
            </section>

            <!-- Giao duc -->
            <section id="giaoduc">
                <h4>GIÁO DỤC</h4>
                <a href="" class="d-flex tuyensinh-main">
                    <img width="35%" height="100px" src="http://localhost\baotuyensinhView\media\blank-img.jpg"
                        alt="" />
                    <div class="tuyensinh-des">
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </div>
                </a>
                <a href="" class="tuyensinh-contents">
                    <p>
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </p>
                </a>
                <a href="" class="tuyensinh-contents">
                    <p>
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </p>
                </a>
                <a href="" class="tuyensinh-contents">
                    <p>
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </p>
                </a>
                <a href="" class="tuyensinh-contents">
                    <p>
                        "Tuyển dụng 50 nhân viên thì có tới 49 sinh viên trường nghề
                        trúng tuyển"
                    </p>
                </a>
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