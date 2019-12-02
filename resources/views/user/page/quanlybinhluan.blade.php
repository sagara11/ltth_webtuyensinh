@extends('user.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/taikhoan.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-lite.css" rel="stylesheet">
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
                    <a href="{{ route('danhsachbaidang') }}" class="nav-link">Danh sách bài đăng</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('quanlybinhluan') }}" class="nav-link active">Quản lý bình luận</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#thoat" href="">Thoát</a>
                </li>
            </ul>
        </div>
        <div class="account-content col-lg-9">
            <div class="tab-content">

                {{-- Quan ly binh luan --}}
                <section id="quanlybinhluan" class="container tab-pane-active"><br>
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
                                            <button class="m-1 btn btn-success update_btn" data-target="#updatecomment" id="{{ $item->id }}"
                                                data-toggle="modal">Sửa
                                            </button>
                                        </span>
                                        <form method="post" action="{{ route('deletecomment') }}">
                                            @csrf
                                            <span>
                                                <input type="hidden" name="comment_delete_id" value="{{ $item->id }}">
                                                <button id="deletecomment" class="m-1 btn btn-danger" type="submit">Xóa</button>
                                            </span>
                                        </form>
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
                                    <button type="submit" class="m-2 btn btn-success">Submit</button>
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
<script>
    CKFinder.config( { connectorPath: '/ckfinder/connector' } );
</script>
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
    // $('#deletecomment').click(function(){
    //     var confirm = window.confirm('Bạn có muốn xóa bình luận này');
    //     if(confirm){
    //         $("#deleteconfirm").type = "submit";
    //         $("#deleteconfirm").click();
    //     }
    // });
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