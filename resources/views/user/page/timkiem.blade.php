@extends('user.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/baiviet_box.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/paginate.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/home.css') }}">
@endsection
@section('title')
Kết quả tìm kiếm
@endsection
@section('content')
<main class="container">
    <section id="baiviet-tintuc">
        @foreach ($news_name as $item)
        <div class="baiviet-box">
            <div class="tintuc-img">
                <a href="{{ route('chitiettin',$item->slug) }}">
                    <img class="img-fluid" src="{{ $item->image }}" alt="" />
                </a>
            </div>
            <div class="tintuc-detail">
                <h5>
                    <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a>
                </h5>
                <p>
                    <small class="webtuyensinh-section">
                        <span>{{ $item->categories->name }} |</span>
                        @if ($item->hour()<=24) 
                        <span>{{ $item->hour() }} giờ trước |</span>
                        @else
                        <span>{{ $item->day() }} |</span>
                        @endif
                        @if ($item->comment != NULL )
                        <span>{{ $item->comment }} bình luận |</span>
                        @else
                        <span>0 bình luận |</span>
                        @endif
                    </small>
                    <small><span class="webtuyensinh-link" href="">{{ $item->source->web_name }}</span></small>
                </p>
            </div>
        </div>
        @endforeach
    </section>
</main>
@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>
<script type="text/javascript" src="{{ asset('js/user/home.js') }}"></script>
<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.js') }}"></script>
@endsection