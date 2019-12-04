@extends('user.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/taikhoan.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
@endsection
@section('title')
Web Tuyển Sinh - Trang thông tin chính thức về tuyển sinh
@endsection
@section('content')
<main class="container">
    <section id="danhmuc">
        <h4>TÀI KHOẢN</h4>
    </section>
    <section class="row" id="account">
        <div class="account-nav col-lg-3">
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
                    <a href="{{ route('taikhoan') }}" class="nav-link">Tài khoản của tôi</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('doimatkhau') }}" class="nav-link">Đổi mật khẩu</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('thembaidang') }}" class="nav-link">Thêm bài đăng</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('danhsachbaidang') }}" class="nav-link active">Danh sách bài đăng</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('quanlybinhluan') }}" class="nav-link">Quản lý bình luận</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#thoat" href="">Thoát</a>
                </li>
            </ul>
        </div>
        <div class="account-content col-lg-9">
            <div style="display: flex; flex-direction: column; align-items: center">
                <form method="post" action="{{ route('updatepostimage') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post_update->id }}">
                    <input onchange="readURL(this);" required type="file" name="avatar" id="avatar-file">
                    <label for="avatar-file">Tải lên ảnh đại diện mới</label>
                    <div>
                        <img height="60px" width="100px" id="blah" src="#" alt="" />
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-success" type="submit">Thay đổi ảnh bài viết</button>
                    </div>
                </form>
                {{-- Danh sach bai dang --}}
                <form method="post" action="{{ route('updatepost') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="update_post_modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Chỉnh sửa bài viết
                                </div>
                                <div class="modal-body">
                                    <input id="update_id" type="hidden" name="update_id" value="{{ $post_update->id }}">
                                    <div class="form-group">
                                        <p>Hình ảnh</p>
                                        <img class="img-fluid m-1" src="{{ $post_update->image }}" alt="">
                                        <input value="{{ $post_update->image }}" type="hidden" name="image_1">
                                    </div>
                                    <p>Tên bài đăng</p>
                                    <input required name="update_name" class="form-control mb-2" type="text"
                                        value="{{ $post_update->name }}">
                                    <p>Mô tả</p>
                                    <input required name="update_description" class="form-control mb-2" type="text"
                                        value="{{ $post_update->description }}">
                                    <p>Nội dung</p>
                                    <textarea id="summernote" required name="update_content" class="form-control mb-2"
                                        name="" id="" rows="10">{{ strip_tags($post_update->content) }}</textarea>
                                    <button class="btn btn-success m-1" type="submit">Lưu</button>
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
<script>
    $('body').on('click', '.update_btn', function set(){
    $('#get_id').val(this.id);
});
</script>
<script>
    function imagechange(){
        // alert("hello");
        $("input:hidden").val(1);
    }
    $('body').on('click', '.update_post_btn', function set(){
        $('#update_id').val(this.id);
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.js"></script>
<script>
    $('#summernote').summernote({
          placeholder: 'Hello stand alone ui',
          tabsize: 2,
          height: 100
        });
</script>
@endsection