@extends('user.layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/baiviet_box.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/paginate.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/chitiettin.css') }}">
@endsection
@section('title')
Kết quả tìm kiếm
@endsection
@section('content')
<main class="container">
    <section id="danhmuc">
        <h4> Tìm kiếm </h4>
    </section>
    <section>
        Tìm thấy {{ $news_name->count() }} kết quả cho từ khóa "{{ $name}}"
    </section>
    <div class="row">
        <div class="col-md-8">
            <section id="baiviet-tintuc">
                @foreach ($news_name as $item)
                <div class="baiviet-box">
                    <div class="row">
                        <div class="col-md-3 col-5">
                            <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                                <img class="img-fluid" src="{{ $item->image }}" alt="{{ $item->name }}" />
                            </a>
                        </div>

                        <div class="col-md-9 col-7">
                            <h5> <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a> </h5>
                            <p>
                                @if (isset($item->categories->name))
                                <span> {{ $item->categories->name }} </span>
                                @endif
                                <span> {{ $item->hour() }} </span>
                                @if (isset($item->source->web_name))
                                <a class="webtuyensinh-link" href="{{ route('nguon_tin', $item->source->id) }}"> {{ $item->source->web_name }} </a>
                                @endif
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