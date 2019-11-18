@extends('user.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/comment.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/video.css') }}">
@endsection
@section('title')
Video
@endsection
@section('content')
<main class="container">
    <section id="danhmuc">
        <h4>VIDEO</h4>
    </section>
    <section id="top-video">
        <div class="row">
            <div class="video">
                <img class="img-fluid" src="{{ asset("media/tải xuống.png") }}" alt="">
            </div>
            <div class="v-detail">
                <div class="video-detail">
                    <h4>
                        "Tuyển dụng 50 nhân viên thì có tới..."
                    </h4>
                    <p>
                        <small class="webtuyensinh-section">Tuyển sinh | 1 giờ | 3 bình luận | </small>
                        <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                    </p>
                    <p class="video-description">
                        TP.HMC là trung tâm đào tạo lớn nhất..
                    </p>
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
                                    <img class="rounded rounded-circle" src="{{ asset('media/tải xuống (1).png') }}"
                                        alt="">
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
            </div>
        </div>
    </section>

    {{-- Danh muc video --}}
    <section id="video-list">
        <div class="row">
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="xemthem-btn">
            <button>XEM THÊM</button>
        </div>
    </section>

    {{-- Video giao duc --}}
    <section class="video-section">
        <div>
            <h4>VIDEO GIÁO DỤC</h4>
        </div>
        <div class="row">
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Video tuyen sinh --}}
    <section class="video-section">
        <div>
            <h4>VIDEO TUYỂN SINH</h4>
        </div>
        <div class="row">
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
            <div class="col-lg-3 video-box">
                <div>
                    <img class="img-fluid" src="{{ asset('media/blank-img.jpg') }}" alt="">
                    <p class="video-box-des">
                        Tuyển dụng 50 nhân viên thì có tới....
                    </p>
                    <p class="video-info">
                        <span>01:06 | Tuyển sinh</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/user/home.js') }}"></script>
@endsection