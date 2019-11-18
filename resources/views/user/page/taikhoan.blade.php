@extends('user.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/taikhoan.css') }}">
@endsection
@section('title')
Tài khoản
@endsection
@section('content')
<main class="container">
    <section id="danhmuc">
        <h4>TÀI KHOẢN</h4>
    </section>
    <section class="row" id="account">
        <div class="account-nav col-lg-4">
            <div class="user-info">
                <img class="rounded rounded-circle" src="{{ asset('media/tải xuống (1).png') }}" alt="">
                <p>
                    Nguyễn Văn Nam
                </p>
                <p>
                    <small>Ngày tham gia 20/09/2019</small>
                </p>
            </div>
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#taikhoancuatoi">Tài khoản của tôi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#doimatkhau">Đổi mật khẩu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#quanlybinhluan">Quản lý bình luận</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#thoat">Thoát</a>
                </li>
            </ul>
        </div>
        <div class="account-content col-lg-8">
            <div class="tab-content">
                {{-- Tai khoan cua toi --}}
                <section id="taikhoancuatoi" class="container tab-pane"><br>
                    <div class="account-section-header">
                        <h3>TÀI KHOẢN CỦA TÔI</h3>
                    </div>
                    <input type="file">
                    <div class="account-section-content row">
                        <div class="col-lg-3">
                            Tên tài khoản
                        </div>
                        <div class="col-lg-9">
                            <div>
                                Nguyễn Văn Nam
                            </div>
                            <div>
                                <a data-toggle="collapse" data-target="#tentaikhoan" href="">Thay đổi</a>
                            </div>
                            <div class="collapse account-edit" id="tentaikhoan">
                                <p>
                                    <b>Tên tài khoản</b>
                                </p>
                                <input class="form-control" type="text" placeholder="Nhập tên tài khoản">
                                <span>
                                    <button>LƯU LẠI</button>
                                </span>
                                <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            Họ và Tên
                        </div>
                        <div class="col-lg-9">
                            <div>
                                Nguyễn Văn Nam
                            </div>
                            <div>
                                <a data-toggle="collapse" data-target="#hovaten" href="">Thay đổi</a>
                            </div>
                            <div class="collapse account-edit" id="hovaten">
                                <p>
                                    <b>Họ và tên</b>
                                </p>
                                <input class="form-control" type="text" placeholder="Nhập tên tài khoản">
                                <span>
                                    <button>LƯU LẠI</button>
                                </span>
                                <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            Địa chỉ
                        </div>
                        <div class="col-lg-9">
                            <div>
                                Long biên, hà nội
                            </div>
                            <div>
                                <a data-toggle="collapse" data-target="#diachi" href="">Thay đổi</a>
                            </div>
                            <div class="collapse account-edit" id="diachi">
                                <p>
                                    <b>Địa chỉ</b>
                                </p>
                                <input class="form-control" type="text" placeholder="Nhập họ và tên">
                                <span>
                                    <button>LƯU LẠI</button>
                                </span>
                                <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            Email
                        </div>
                        <div class="col-lg-9">
                            <div>
                                Demo.gmail.com
                            </div>
                            <div>
                                <a data-toggle="collapse" data-target="#email" href="">Thay đổi</a>
                            </div>
                            <div class="collapse account-edit" id="email">
                                <p>
                                    <b>Email</b>
                                </p>
                                <input class="form-control" type="email" placeholder="Nhập email">
                                <span>
                                    <button>LƯU LẠI</button>
                                </span>
                                <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            Điện thoại
                        </div>
                        <div class="col-lg-9">
                            <div>
                                0124.54.989
                            </div>
                            <div>
                                <a data-toggle="collapse" data-target="#dienthoai" href="">Thay đổi</a>
                            </div>
                            <div class="collapse account-edit" id="dienthoai">
                                <p>
                                    <b>Điện thoại</b>
                                </p>
                                <input class="form-control" type="number" placeholder="Nhập điện thoại">
                                <span>
                                    <button>LƯU LẠI</button>
                                </span>
                                <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            Ngày sinh
                        </div>
                        <div class="col-lg-9">
                            <div>
                                09/07/2000
                            </div>
                            <div>
                                <a data-toggle="collapse" data-target="#ngaysinh" href="">Thay đổi</a>
                            </div>
                            <div class="collapse account-edit" id="ngaysinh">
                                <p>
                                    <b>Ngày sinh</b>
                                </p>
                                <input class="form-control" type="date" placeholder="Nhập ngày sinh">
                                <span>
                                    <button>LƯU LẠI</button>
                                </span>
                                <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            Giới tính
                        </div>
                        <div class="col-lg-9">
                            <div>
                                Nam
                            </div>
                            <div>
                                <a data-toggle="collapse" data-target="#gioitinh" href="">Thay đổi</a>
                            </div>
                            <div class="collapse account-edit" id="gioitinh">
                                <p>
                                    <b>Giới tính</b>
                                </p>
                                <input class="form-control" type="text" placeholder="Nhập giới tính">
                                <span>
                                    <button>LƯU LẠI</button>
                                </span>
                                <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Doi mat khau --}}
                <section id="doimatkhau" class="container tab-pane"><br>
                    <div class="account-section-header">
                        <h3>ĐỔI MẬT KHẨU</h3>
                    </div>
                    <div class="row account-section-content">
                        <div class="col-lg-3">
                            Mật khẩu cũ
                        </div>
                        <div class="col-lg-9">
                            <input type="password">
                        </div>
                        <div class="col-lg-3">
                            Mật khẩu mới
                        </div>
                        <div class="col-lg-9">
                            <input type="password">
                        </div>
                        <div class="col-lg-3">
                            Nhập lại mật khẩu mới
                        </div>
                        <div class="col-lg-9">
                            <input type="password">
                        </div>
                        <div class="col-lg-3">
                        </div>
                        <div class="col-lg-9">
                            <button>LƯU LẠI</button>
                            <span>Quên mật khẩu?</span>
                            <span>
                                <a href="">Lấy lại mật khẩu</a>
                            </span>
                        </div>
                    </div>
                </section>

                {{-- Quan ly binh luan --}}
                <section id="quanlybinhluan" class="container tab-pane active"><br>
                    <div class="account-section-header">
                        <h3>QUẢN LÝ MẬT KHẨU</h3>
                    </div>
                    <div class="account-section-content">
                        <div class="comment-box">
                            <p class="news-name">
                                ""Tuyển dụng 50 hân viên thì ....
                            </p>
                            <div class="webtuyensinh-link">
                                <p>
                                    <small class="webtuyensinh-section">Tuyển sinh | 1 giờ | 3 bình luận | </small>
                                    <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                                </p>
                            </div>
                            <div class="row your-comment">
                                <div class="your-image">
                                    <img src="" alt="">
                                </div>
                                <div class="comment-content">
                                    <span>Nguyễn Văn Nam</span>
                                    <span>- 16:50  06/11/2019</span>
                                    <p>
                                        Trong 3 năm gần nhất, ngành dân tộc hoc tuyển được một học viên.....
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Thoat --}}
                <section id="thoat" class="container tab-pane"><br>
                    Thoát
                </section>
            </div>
        </div>
    </section>
</main>
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('js/user/home.js') }}"></script>
@endsection