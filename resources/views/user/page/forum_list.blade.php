@extends('user.layout.master')
@section('meta')
<meta name="description" content="Webtuyensinh">
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/user_web/layout/header.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/footer.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/page/home.css') }}">
<link rel="stylesheet" href="{{ asset('css/user_web/layout/forum_post.css') }}">
@endsection
@section('title')
Forum - Web Tuyển Sinh
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="forum-contain">
                @foreach ($forum_post as $item)
                <div class="forum-box">
                    <div class="post-img">
                        @if (isset($item->user->avatar))
                        <img height="50px" width="50px" class="rounded rounded-circle" src="{{ $item->user->avatar }}" alt="">
                        @else
                        <div class="empty-avatar">
                            <p>
                                {{ substr($item->user->name, 0, 1) }}
                            </p>
                        </div>
                        @endif
                    </div>
                    <div>
                        <div class="arrow"></div>
                        <div class="post-content">
                            <div>
                                {{ $item->name }}
                            </div>
                        </div>
                        <div>
                            <p><small>viết bởi</small> <span>{{ $item->user->name }}</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
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