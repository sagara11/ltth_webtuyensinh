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
                <img class="rounded rounded-circle" src="{{ $user->avatar }}" alt="">
                <p>
                    {{ $user->name }}
                </p>
                <p>
                    <small>Ngày tham gia {{ $user->created_at->toDateString() }}</small>
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
                    <a class="nav-link" data-toggle="modal" data-target="#thoat" href="">Thoát</a>
                </li>
            </ul>
        </div>
        <div class="account-content col-lg-8">
            <div class="tab-content">
                {{-- Tai khoan cua toi --}}
                <section id="taikhoancuatoi" class="container tab-pane active"><br>
                    <div class="account-section-header">
                        <h3>TÀI KHOẢN CỦA TÔI</h3>
                    </div>
                    <input type="file" class="custom-file-input" id="avatar-file">
                    <label for="avatar-file">Tải lên ảnh đại diện mới</label>
                    <div class="account-section-content row">
                        <div class="col-lg-3">
                            Tên tài khoản
                        </div>
                        <div class="col-lg-9">
                            <div>
                                {{ $user->name }}
                            </div>
                            <div>
                                <a data-toggle="collapse" data-target="#tentaikhoan" href="">Thay đổi</a>
                            </div>
                            <div class="collapse account-edit" id="tentaikhoan">
                                <form method="post" action="{{ route('editaccount','name') }}">
                                    @csrf
                                    <p>
                                        <b>Tên tài khoản</b>
                                    </p>
                                    <input name="name" class="form-control" type="text"
                                        placeholder="Nhập tên tài khoản">
                                    <span>
                                        <button type="submit">LƯU LẠI</button>
                                    </span>
                                    <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            Email
                        </div>
                        <div class="col-lg-9">
                            <div>
                                {{ $user->email }}
                            </div>
                            <div>
                                <a data-toggle="collapse" data-target="#email" href="">Thay đổi</a>
                            </div>
                            <div class="collapse account-edit" id="email">
                                <form method="post" action="{{ route('editaccount','email') }}">
                                    @csrf
                                    <p>
                                        <b>Email</b>
                                    </p>
                                    <input name="email" class="form-control" type="email" placeholder="Nhập email">
                                    <span>
                                        <button type="submit">LƯU LẠI</button>
                                    </span>
                                    <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                                </form>
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
                                <form method="post" action="{{ route('editaccount','phone') }}">
                                    @csrf
                                    <p>
                                        <b>Điện thoại</b>
                                    </p>
                                    <input name="phone" class="form-control" type="number"
                                        placeholder="Nhập điện thoại">
                                    <span>
                                        <button type="submit">LƯU LẠI</button>
                                    </span>
                                    <span>Webtuyensinh cam kết bảo mật thông tin này</span>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Doi mat khau --}}
                <section id="doimatkhau" class="container tab-pane fade"><br>
                    <div class="account-section-header">
                        <h3>ĐỔI MẬT KHẨU</h3>
                    </div>
                    <form method="post" action="{{ route('changepassword') }}">
                        @csrf
                        <div class="row account-section-content">
                            <div class="col-lg-3">
                                Mật khẩu cũ
                            </div>
                            <div class="col-lg-9">
                                <input type="password" name="old_password">
                            </div>
                            <div class="col-lg-3">
                                Mật khẩu mới
                            </div>
                            <div class="col-lg-9">
                                <input type="password" name="new_password">
                            </div>
                            <div class="col-lg-3">
                                Nhập lại mật khẩu mới
                            </div>
                            <div class="col-lg-9">
                                <input type="password" name="new_password_confirm">
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
                    </form>
                </section>

                {{-- Quan ly binh luan --}}
                <section id="quanlybinhluan" class="container tab-pane fade"><br>
                    <div class="account-section-header">
                        <h3>QUẢN LÝ BÌNH LUẬN</h3>
                    </div>
                    <div class="account-section-content">
                        <div class="comment-box">
                            <p class="news-name">
                                Tuyển dụng 50 nhân viên thì ....
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
                                    <span>- 16:50 06/11/2019</span>
                                    <p>
                                        Trong 3 năm gần nhất, ngành dân tộc hoc tuyển được một học viên.....
                                    </p>
                                    <div class="comment-edit">
                                        <span>
                                            <a href="">Sửa</a>
                                        </span>
                                        <span>
                                            <a href="">Xóa</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row your-comment">
                                <div class="your-image">
                                    <img src="" alt="">
                                </div>
                                <div class="comment-content">
                                    <span>Nguyễn Văn Nam</span>
                                    <span>- 16:50 06/11/2019</span>
                                    <p>
                                        Trong 3 năm gần nhất, ngành dân tộc hoc tuyển được một học viên.....
                                    </p>
                                    <div class="comment-edit">
                                        <span>
                                            <a href="">Sửa</a>
                                        </span>
                                        <span>
                                            <a href="">Xóa</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-box">
                            <p class="news-name">
                                Tuyển dụng 50 nhân viên thì ....
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
                                    <span>- 16:50 06/11/2019</span>
                                    <p>
                                        Trong 3 năm gần nhất, ngành dân tộc hoc tuyển được một học viên.....
                                    </p>
                                    <div class="comment-edit">
                                        <span>
                                            <a href="">Sửa</a>
                                        </span>
                                        <span>
                                            <a href="">Xóa</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- Thoat --}}
                <section class="modal fade" id="thoat">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Thoát</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Xác nhận bạn thoát khỏi tài khoản Webtuyensinh
                            </div>

                            <!-- Modal footer -->
                            <form method="get" action="{{ route('log-out') }}">
                                <div class="modal-footer">
                                    <button id="logout-btn" type="submit">THOÁT</button>
                                    <button id="cancel-btn" type="button" data-dismiss="modal">QUAY LẠI</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</main>
@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>
<script type="text/javascript" src="{{ asset('js/user/home.js') }}"></script>
@endsection