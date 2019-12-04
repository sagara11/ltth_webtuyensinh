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
<main>
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
                        <input type="file" name="avatar" value="{{ $post_update->image }}">
                        <small style="color: red;">Chọn lại hình ảnh</small>
                        {{-- <img class="m-2 img-fluid" src="{{ $post_update->image }}" alt=""> --}}
                    </div>
                    <p>Tên bài đăng</p>
                    <input required name="update_name" class="form-control mb-2" type="text" value="{{ $post_update->name }}">
                    <p>Mô tả</p>
                    <input required name="update_description" class="form-control mb-2" type="text"
                        value="{{ $post_update->description }}">
                    <p>Nội dung</p>
                    <textarea required name="update_content" class="form-control mb-2" name="" id="" rows="10"
                        >{{ strip_tags($post_update->content) }}</textarea>
                    <button class="btn btn-success" type="submit">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    </form>
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