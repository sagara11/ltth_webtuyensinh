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
Chi tiết tin
@endsection
@section('content')
<main class="container">
    <div class="row">
        <div class="col-lg-8">
            <section id="danhmuc">
                <h4> {{ $new->categories->name }} </h4>
            </section>

            <section id="baiviet-name">
                <h1> {{ $new->name }} </h1>
                <div class="webtuyensinh-section">
                    <span>{{ $new->categories->name }} |</span>
                    <span>{{ $new->hour() }} |</span>
                    <span> {{ $comment->count() }} bình luận |</span>
                    <a class="webtuyensinh-link" href="">{{ $new->source->web_name }}</a>
                </div>
                <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox"></div>
            </section>

            <article id="baiviet-description">
                {!! $new->description !!}
            </article>



            <article id="baiviet-content">
                {!! $new->content !!}
            </article>

            <article id="comment">
                <div class="comment-header">
                    <p>Ý KIẾN BẠN ĐỌC ({{ $comment->count() }})</p>
                </div>
                <?php
                    $i=0;
                ?>
                <div class="user-comment">
                    <form method="post" action="{{ route('comment') }}">
                        <input id="input1" type="hidden" name="input1">
<<<<<<< HEAD
                        @foreach ($comment as $item)
                        <div>
                            <div class="comment-box father">
                                <div class="comment-box-img">
                                    <img class="rounded rounded-circle" src="{{ $item->user->avatar }}" alt="">
                                </div>
                                <div class="comment-box-content">
                                    <span class="user-name">
                                        {{ $item->user->name }}
                                    </span>
                                    <span class="comment-time">{{ $item->created_at->toDateString() }}</span>
                                    <p>
                                        {{ $item->comment }}
                                    </p>
                                    <div class="comment-reply">
                                        <span data-toggle="collapse" data-target="#comment-reply-{{ $item->id }}">Trả
                                            lời |
                                        </span>
                                        @if (Auth::check())
                                        @if ($item->user->id == Auth::user()->id)
                                        <span>Sửa | </span>
                                        <span>
                                            <a href="{{ route('deletecomment',$item->id) }}">Xóa</a>
                                        </span>
                                        @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (isset($item->child_comments))
                        @foreach ($item->child_comments as $child_item)
                        <div class="comment-box children">
                            <div class="comment-box-img">
                                <img class="rounded rounded-circle" src="{{ $child_item->user->avatar }}" alt="">
=======
                    @foreach ($comment as $item)
                        <div class="comment-box father">
                            <div class="comment-box-img">
                                <img class="rounded rounded-circle" src="{{ $item->user->avatar }}" alt="avatar">
>>>>>>> f675df168fa09a262373f64f3b478bfa049c6e7e
                            </div>
                            <div class="comment-box-content">
                                <span class="user-name">
                                    {{ $child_item->user->name }}
                                </span>
<<<<<<< HEAD
                                <span class="comment-time">{{ $child_item->created_at->toDateString() }}</span>
=======
                                <span class="comment-time">{{ $item->hour() }}</span>
>>>>>>> f675df168fa09a262373f64f3b478bfa049c6e7e
                                <p>
                                    {{ $child_item->comment }}
                                </p>
<<<<<<< HEAD
                            </div>
                        </div>
                        @endforeach
                        @endif
                        <div class="mb-3 your-comment collapse" id="comment-reply-{{ $item->id }}">
                            @if (Auth::check())
                            @csrf
                            <input type="hidden" name="parent_id[]" value="{{ $item->id }}">
                            <input type="hidden" name="post_id" value="{{ $new->id }}">
                            <input id="{{ $i }}" name="your_comment_reply-{{ $item->id }}"
                                class="form-control child_rep_comment" type="textarea" placeholder="Ý kiến của bạn">
                            <span>
                                <img class="rounded rounded-circle" src="{{ Auth::user()->avatar }}" alt="">
                            </span>
                            <span><b>{{ Auth::user()->name }}</b></span>
                            <button id="submit_btn" name="submit1" type="submit">GỬI</button>
                            @else
                            <p>
                                Bạn cần đăng nhập để có thể bình luận
                            </p>
                    </form>
=======
                                <div class="comment-reply">
                                    <span data-toggle="collapse" data-target="#comment-reply-{{ $item->id }}">Trả lời  </span>
                                    @if (Auth::check())
                                        @if ($item->user->id == Auth::user()->id)
                                            <!-- <span> Sửa  </span> -->
                                            <span>
                                                <a href="{{ route('deletecomment',$item->id) }}">Xóa</a>
                                            </span>
                                        @endif
                                    @endif
                                </div>
                                <div class="mb-3 your-comment collapse" id="comment-reply-{{ $item->id }}">
                                    @if (Auth::check())
                                        @csrf
                                        <input type="hidden" name="parent_id[]" value="{{ $item->id }}">
                                        <input type="hidden" name="post_id" value="{{ $new->id }}">
                                        <input id="{{ $i }}" name="your_comment_reply-{{ $item->id }}" class="form-control child_rep_comment" type="textarea"
                                            placeholder="Ý kiến của bạn">

                                        <div class="row">
                                            <div class="col-md-9">
                                                <span>
                                                    <img class="rounded rounded-circle" src="{{ Auth::user()->avatar }}" alt="">
                                                </span>
                                                <span><b>{{ Auth::user()->name }}</b></span>
                                            </div>
                                            <div class="col-md-3">
                                                <button id="submit_btn" name="submit1" type="submit">GỬI</button>
                                            </div>
                                        </div>
                                        @else
                                        <p>
                                            Bạn cần <a href="#" data-toggle="modal" data-target="#signin"> Đăng nhập </a> để có thể bình luận hoặc
                                        <a href="#" data-toggle="modal" data-target="#signup"> Đăng ký </a> nếu chưa có tài khoản </p>
                                        </p>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @if (isset($item->child_comments))
                    @foreach ($item->child_comments as $child_item)
                    <div class="comment-box children">
                        <div class="comment-box-img">
                            <img class="rounded rounded-circle" src="{{ $child_item->user->avatar }}" alt="">
                        </div>
                        <div class="comment-box-content">
                            <span class="user-name">  {{ $child_item->user->name }} </span>
                            <span class="comment-time">{{ $child_item->hour() }}</span>
                            <p>    {{ $child_item->comment }}  </p>
                        </div>
                    </div>
                    @endforeach
                    @endif
                    
                    <?php
                        $i++;
                    ?>
                    @endforeach
                </div>
                <div class="your-comment">
                    @if (Auth::check())
                    <form method="post" action="{{ route('comment') }}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $new->id }}">
                        <input name="your_comment" class="form-control" type="textarea" placeholder="Ý kiến của bạn">
                        <div class="row">
                            <div class="col-md-9">
                                <span>
                                    <img class="rounded rounded-circle" src="{{ Auth::user()->avatar }}" alt="">
                                </span>
                                <span><b>{{ Auth::user()->name }}</b></span>
                            </div>
                            <div class="col-md-3">
                                <button name="submit2" type="submit">GỬI</button>
                            </div>
                        </div>
                        
                    </form>
                    @else
                    <p>
                        Bạn cần <a href="#" data-toggle="modal" data-target="#signin"> Đăng nhập </a> để có thể bình luận hoặc
                            <a href="#" data-toggle="modal" data-target="#signup"> Đăng ký </a> nếu chưa có tài khoản </p>
>>>>>>> f675df168fa09a262373f64f3b478bfa049c6e7e
                    @endif
                </div>
                <?php
                        $i++;
                    ?>
                @endforeach
        </div>
        <div class="your-comment">
            @if (Auth::check())
            <form method="post" action="{{ route('comment') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $new->id }}">
                <input name="your_comment" class="form-control" type="textarea" placeholder="Ý kiến của bạn">
                <span>
                    <img class="rounded rounded-circle" src="{{ Auth::user()->avatar }}" alt="">
                </span>
                <span><b>{{ Auth::user()->name }}</b></span>
                <button name="submit2" type="submit">GỬI</button>
            </form>
            @else
            <p>
                Bạn cần đăng nhập để có thể bình luận
            </p>
            @endif
        </div>
        </article>

<<<<<<< HEAD
        {{-- Tin lien quan --}}
        <section class="tintuc-contain">
            <div class="tin-header">
                <h3>TIN LIÊN QUAN</h3>
            </div>
            <div class="tin-content">
                @foreach ($tinlienquan as $item)
                <div class="baiviet-box">
                    <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                        <img class="img-fluid" src="{{ $item->image }}" alt="" />
                    </a>
                    <div class="tintuc-detail">
                        <a href="{{ route('chitiettin',$item->slug) }}">
                            <h5>
                                {{ $item->name }}
                            </h5>
                        </a>
                        <p>
                            <small class="webtuyensinh-section">
                                <span>{{ $item->categories->name }} |</span>
                                <span>{{ $item->hour() }} |</span>
                                @if ($item->comment != NULL )
                                <span>{{ $item->comment }} bình luận |</span>
                                @else
                                <span>0 bình luận |</span>
                                @endif
                            </small>
                            <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                        </p>
=======
            {{-- Tin lien quan --}}
            <section class="tintuc-contain">
                <div class="tin-header">
                    <h3> <span> TIN LIÊN QUAN </span> </h3>
                </div>
                <div class="tin-content">
                    @foreach ($tinlienquan as $item)
                    <div class="baiviet-box">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                                    <img class="img-fluid" src="{{ $item->image }}" alt="" />
                                </a>
                            </div>

                            <div class="col-md-9">
                                <h5> <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a> </h5>
                                <p>
                                    <span > {{ $item->categories->name }} </span>
                                    <span > {{ $item->hour() }} </span>
                                    <a class="webtuyensinh-link" href=""> {{ $item->source->web_name }} </a>
                                </p>
                            </div>
                        </div>
>>>>>>> f675df168fa09a262373f64f3b478bfa049c6e7e
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Tin moi --}}
        <section class="tintuc-contain">
            <div class="tin-header">
                <h3>TIN MỚI</h3>
            </div>
            <div class="tin-content">
                @foreach ($tinmoi as $item)
                @if($item->publish == 1)
                <div class="baiviet-box">
                    <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                        <img class="img-fluid" src="{{ $item->image }}" alt="" />
                    </a>
                    <div class="tintuc-detail">
                        <a href="{{ route('chitiettin',$item->slug) }}">
                            <h5>
                                {{ $item->name }}
                            </h5>
                        </a>
                        <p>
                            <small class="webtuyensinh-section">
                                <span>{{ $item->categories->name }} |</span>
                                <span>{{ $item->hour() }} |</span>
                                @if ($item->comment != NULL )
                                <span>{{ $item->comment }} bình luận |</span>
                                @else
                                <span>0 bình luận |</span>
                                @endif
                            </small>
                            <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                        </p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </section>

        {{-- Tin nong --}}
        <section class="tintuc-contain">
            <div class="tin-header">
                <h3>TIN NÓNG</h3>
            </div>
            <div class="tin-content">
                @foreach ($tinnong as $item)
                <div class="baiviet-box">
                    <a href="{{ route('chitiettin',$item->slug) }}" class="tintuc-img">
                        <img class="img-fluid" src="{{ $item->image }}" alt="" />
                    </a>
                    <div class="tintuc-detail">
                        <a href="{{ route('chitiettin',$item->slug) }}">
                            <h5>
                                {{ $item->name }}
                            </h5>
                        </a>
                        <p>
                            <small class="webtuyensinh-section">Tuyển sinh | 1 giờ | 3 bình luận | </small>
                            <small><a class="webtuyensinh-link" href="">webtuyensinh</a></small>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
    @include('user.layout.sidebar')
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