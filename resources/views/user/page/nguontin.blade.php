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
Web Tuyển Sinh - Trang thông tin chính thức về tuyển sinh
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-8">
            <!-- Bai viet chinh -->
            <section id="baiviet-chinh">
                <a href="{{ route('chitiettin', $data_first->slug) }}">
                    <img class="img-fluid" src="{{ $data_first->image }}" alt="{{ $data_first->name }}">
                </a>
                <h5>
                    <a href="{{ route('chitiettin',$data_first->slug) }}"> {{ $data_first->name }} </a>
                </h5>
                <p>
                    <span>{{ $data_first->categories->name }} |</span>
                    <span>{{ $data_first->hour() }} |</span>
                    <!-- <span>{{ $data_first->comment ? $data_first->comment : 0 }} bình luận |</span> -->
                    <a class="webtuyensinh-link" href="">{{ $data_first->source->web_name }}</a>
                </p>
            </section>

            <!-- Bai viet tieu bieu -->
            <section class="row" id="baiviet-tieubieu">
                @foreach ($data_second as $item)
                <div class="col-md-4  tieubieu-box">
                    <div class="row">
                        <div class="col-md-12 col-5">
                            <a href="{{ route('chitiettin',$item->slug) }}">
                                <img class="img-fluid" src="{{ $item->image }}" alt="{{$item->slug}}">
                            </a>
                        </div>
                        <div class="col-md-12 col-7">
                            <h5> <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a> </h5>
                            <p>
                                <span>{{ $item->categories->name }} |</span>
                                <span>{{ $item->hour() }} |</span>
                                <a class="webtuyensinh-link" href="">{{ $item->source->web_name }}</a>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </section>

            <!-- Bai viet - tin tuc -->
            <section id="baiviet-tintuc">
                @foreach ($data_third as $item)
                <div class="baiviet-box" id="{{ $item->id }}">
                    <div class="row">
                        <div class="col-md-3 col-5">
                            <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                                <img class="img-fluid" src="{{ $item->image }}" alt="" />
                            </a>
                        </div>

                        <div class="col-md-9 col-7">
                            <h5> <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a> </h5>
                            <p>
                                <span> {{ isset($item->categories->name) ? $item->categories->name : '' }} </span>
                                <span> {{ $item->hour() }} </span>
                                <a class="webtuyensinh-link" href=""> {{ isset($item->source->web_name) ? $item->source->web_name : '' }} </a>
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