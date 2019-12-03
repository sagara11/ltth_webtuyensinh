@extends('user.layout.master')
@section('meta')
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/baiviet_box.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/comment.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/chitiettin.css') }}">
@endsection
@section('title')
Web Tuyển Sinh - Trang thông tin chính thức về tuyển sinh
@endsection
@section('content')
    <main class="container">
        <div style="padding: 20px 20px; background-color: whitesmoke; border-radius: 5px;" class="error-box">
            <div>
                <h3 style="text-align: center">Bài viết không tồn tại</h3>
            </div>
        </div>
    </main>
@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>
<script type="text/javascript" src="{{ asset('js/user/chitiettin.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/user/home.js') }}"></script>

<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.js') }}"></script>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59b0b0bc0881afd4"></script>
@endsection