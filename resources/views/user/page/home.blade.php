@extends('user.layout.master')
@section('meta')
<meta name="description" content="Webtuyensinh">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/baiviet_box.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/paginate.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/home.css') }}">
@endsection
@section('title')
Home
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-8">
            <!-- Bai viet chinh -->
            <section id="baiviet-chinh">
                <a href="{{ route('chitiettin', $trend_first->slug) }}">
                    <img class="img-fluid" src="{{ $trend_first->image }}" alt="{{ $trend_first->name }}">
                </a>
                <h5>
                    <a href="{{ route('chitiettin',$trend_first->slug) }}"> {{ $trend_first->name }} </a>
                </h5>
                <p>
                    <span>{{ $trend_first->categories->name }} |</span>
                    <span>{{ $trend_first->hour() }} |</span>
                    <!-- <span>{{ $trend_first->comment ? $trend_first->comment : 0 }} bình luận |</span> -->
                    <span class="webtuyensinh-link" href="">{{ $trend_first->source->web_name }}</span>
                </p>
            </section>

            <!-- Bai viet tieu bieu -->
            <section class="row" id="baiviet-tieubieu">
                @foreach ($trend as $item)
                <div class="col-md-4  tieubieu-box">
                    <div class="row">
                        <div class="col-md-12 col-5">
                            <a href="{{ route('chitiettin',$item->slug) }}">
                                <img class="img-fluid" src="{{ $item->image }}" alt="{{$item->slug}}">
                            </a>
                        </div>
                        <div class="col-md-12 col-7">
                            <h5> <a href="{{ route('chitiettin',$item->slug) }}">  {{ $item->name }} </a> </h5>
                            <p>
                                <span>{{ $item->categories->name }} |</span>
                                <span>{{ $item->hour() }} |</span>
                                <span class="webtuyensinh-link" href="">{{ $item->source->web_name }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </section>

            <!-- Bai viet - tin tuc -->
            <section id="baiviet-tintuc">
                @foreach ($news as $item)
                <div class="baiviet-box">
                    <div class="row">
                        <div class="col-md-3 col-5">
                            <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                                <img class="img-fluid" src="{{ $item->image }}" alt="" />
                            </a>
                        </div>

                        <div class="col-md-9 col-7">
                            <h5> <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a> </h5>
                            <p>
                                <span > {{ $item->categories->name }} </span>
                                <span > {{ $item->hour() }} </span>
                                <a class="webtuyensinh-link" href=""> {{ $item->source->web_name }} </a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </section>
        </div>
         @include('user.layout.sidebar')
    </div>
</main>
@endsection
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.marquee/1.3.1/jquery.marquee.min.js"></script>
<script type="text/javascript" src="{{ asset('js/user/home.js') }}"></script>
<script type="text/javascript" src="{{ asset('slick-1.8.1/slick/slick.js') }}"></script>
@endsection