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
            <ul id="myTab" class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#taikhoancuatoi">Tài khoản của tôi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#doimatkhau">Đổi mật khẩu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#quanlybaidang">Thêm bài đăng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#danhsachbaidang">Danh sách bài đăng</a>
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
                    <form method="post" action="{{ route('updateavatar') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="avatar" id="avatar-file">
                        <label for="avatar-file">Tải lên ảnh đại diện mới</label>
                        <button type="submit">Đăng ảnh</button>
                    </form>
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
                                {{ $user->phone }}
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

                {{-- Them bai dang --}}
                <section id="quanlybaidang" class="container tab-pane fade"><br>
                    <div class="account-section-header">
                        <h3>THÊM BÀI ĐĂNG</h3>
                    </div>
                    <form class="form-group" method="post" action="{{ route('newscreate') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row account-section-content">
                            <div class="input-section col-lg-3">
                                Tên bài đăng
                            </div>
                            <div class="input-section col-lg-9">
                                <div>
                                    <input required name="news_name" class="form-control" type="text" placeholder="Tên bài đăng">
                                </div>
                            </div>
                            <div class="input-section col-lg-3">
                                Ảnh bài đăng
                            </div>
                            <div class="input-section col-lg-9">
                                <div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh</label>
                                        <input type="hidden" name="image" placeholder="image" id="url">
                                        <div style="margin-bottom: 15px;">
                                        <img src="/userfiles/images/default_avatar-ea7cf6abde4eec089a4e03cc925d0e893e428b2b6971b12405a9b118c837eaa2.png" class="img-fluid" alt="" id="avatar">
                                        </div>
                                        <button type="button" onclick="openPopup()" class="btn btn-primary">Chọn ảnh</button>
                                    </div>
                                </div>
                            </div>
                            <div class="input-section col-lg-3">
                                Danh mục
                            </div>
                            <div class="input-section col-lg-9">
                                <select required class="form-control" name="news_section" id="">
                                    @foreach ($nav_section as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-section col-lg-3">
                                Mô tả
                            </div>
                            <div class="input-section col-lg-9">
                                <input required name="news_description" type="text" class="form-control" placeholder="Mô tả">
                            </div>
                            <div class="input-section col-lg-3">
                                Nội dung
                            </div>
                            <div class="input-section col-lg-9">
                                <textarea required class="form-control" name="news_content" id="" rows="12"></textarea>
                            </div>

                            <div class="submit-section col-lg-12">
                                <button type="submit">
                                    ĐĂNG BÀI
                                </button>
                            </div>
                        </div>
                    </form>
                </section>

                {{-- Danh sach bai dang --}}
                <section id="danhsachbaidang" class="container tab-pane fade"><br>
                    <div class="account-section-header">
                        <h3>DANH SÁCH BÀI ĐĂNG</h3>
                    </div>
                    <div class="account-section-content">
                        <form method="post" action="{{ route('deletepost') }}">
                        <input id="post_id" type="hidden" name="post_id">
                        @foreach ($user_post as $item)
                            @csrf
                            <div class="baidang-box">
                                <div class="baidang-img">
                                <img class="img-fluid" src="{{ $item->image }}" alt="">
                                </div>
                                <div class="baidang-name">
                                    {{ $item->name }}
                                </div>
                                <div class="baidang-date">
                                    {{ $item->hour() }}
                                </div>
                            </div>
                            <button name="delete" id="{{ $item->id }}" class="delete_post_btn btn btn-danger" type="submit">
                                Xóa
                            </button>
                            <button data-toggle="modal" data-target="#update_post_modal" id="{{ $item->id }}" class="update_post_btn btn btn-success" type="button">
                                Sửa
                            </button>
                        </form>
                        @endforeach
                    </div>
                </section>

                {{-- Modal update post --}}
                <form method="post" action="{{ route('updatepost') }}">
                    @csrf
                    <div id="update_post_modal" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Chỉnh sửa bài viết
                                </div>
                                <div class="modal-body">
                                    <input id="update_id" type="hidden" name="update_id">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh</label>
                                        <input type="hidden" name="update_image" placeholder="image" id="url1">
                                        <div style="margin-bottom: 15px;">
                                        <img src="" class="img-fluid" alt="" id="avatar1">
                                        </div>
                                        <button type="button" onclick="openPopup1()" class="btn btn-primary">Chọn ảnh</button>
                                    </div>
                                    <input name="update_name" class="form-control mb-2" type="text" placeholder="Tên bài viết">
                                    <input name="update_description" class="form-control mb-2" type="text" placeholder="Mô tả bài viết">
                                    <textarea name="update_content" class="form-control mb-2" name="" id="" rows="10" placeholder="Nội dung bài viết"></textarea>
                                    <button class="btn btn-success" type="submit">Lưu</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- Quan ly binh luan --}}
                <section id="quanlybinhluan" class="container tab-pane fade"><br>
                    <div class="account-section-header">
                        <h3>QUẢN LÝ BÌNH LUẬN</h3>
                    </div>
                    <div class="account-section-content">
                        @foreach ($comment as $item)
                        <div class="comment-box">
                            <p class="news-name">
                                {{ $item->post->name }}
                            </p>
                            <div class="webtuyensinh-link">
                                <p>
                                    <small class="webtuyensinh-section">{{ $item->post->categories->name }} |
                                        {{ $item->post->hour() }} | {{ $item->post->comment }} bình luận |
                                    </small>
                                    <small><a class="webtuyensinh-link"
                                            href="">{{ $item->post->source->name }}</a></small>
                                </p>
                            </div>
                            <div class="row your-comment">
                                <div class="your-image">
                                    <img src="" alt="">
                                </div>
                                <div class="comment-content">
                                    <span>{{ $user->name }}</span>
                                    <span>- {{ $item->created_at->toDateString() }}</span>
                                    <p>
                                        {{ $item->comment }}
                                    </p>
                                    <div class="comment-edit">
                                        <span>
                                            <a class="update_btn" data-target="#updatecomment" id="{{ $item->id }}"
                                                data-toggle="modal" href="">Sửa</a>
                                        </span>
                                        <span>
                                            <a href="{{ route('deletecomment',$item->id) }}">Xóa</a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>

                <form method="post" action="{{ route('updatecomment') }}">
                    @csrf
                    <div class="modal fade" id="updatecomment">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <h4>Chỉnh sửa bình luận</h4>
                                    <input id="get_id" name="get_id" type="hidden">
                                    <input class="form-control" type="text" name="updatecomment">
                                    <button type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

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
<script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
<script>
    $('body').on('click', '.update_btn', function set(){
    $('#get_id').val(this.id);
});
</script>
<script>
    function openPopup() {
        CKFinder.popup( {
            chooseFiles: true,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    document.getElementById( 'avatar' ).src = file.getUrl();
                } );
                finder.on( 'file:choose:resizedImage', function( evt ) {
                    document.getElementById( 'avatar' ).src = evt.data.resizedUrl;
                } );
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    document.getElementById( 'url' ).value = file.getUrl();
                } );
                finder.on( 'file:choose:resizedImage', function( evt ) {
                    document.getElementById( 'url' ).value = evt.data.resizedUrl;
                } );
            }
        } );
    }

    function openPopup1() {
        CKFinder.popup( {
            chooseFiles: true,
            onInit: function( finder ) {
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    document.getElementById( 'avatar1' ).src = file.getUrl();
                } );
                finder.on( 'file:choose:resizedImage', function( evt ) {
                    document.getElementById( 'avatar1' ).src = evt.data.resizedUrl;
                } );
                finder.on( 'files:choose', function( evt ) {
                    var file = evt.data.files.first();
                    document.getElementById( 'url1' ).value = file.getUrl();
                } );
                finder.on( 'file:choose:resizedImage', function( evt ) {
                    document.getElementById( 'url1' ).value = evt.data.resizedUrl;
                } );
            }
        } );
    }

    $('body').on('click', '.delete_post_btn', function set(){
        $('#post_id').val(this.id);
        return confirm("Bạn có chắc muốn xóa bài?");
    });
    $('body').on('click', '.update_post_btn', function set(){
        $('#update_id').val(this.id);
    });
</script>
@endsection