<div class="col-lg-4">
    <!-- Banner quang cao -->
    <section id="quangcao">
        @foreach ($banner as $item)
        <div class="quangcao-box">
            <a target="_blank" href="{{ $item->altlink }}">
                <img src="{{ $item->image }}"="{{ $item->name }}" />
            </a>
        </div>
        @endforeach
    </section>

    <!-- Xu huong -->
    <section id="xuhuong">
        <div class="side-header">
            <i class="fa fa-desktop"></i>
            <h4>XU HƯỚNG</h4>
        </div>
        <div class="side-content">
            <div class="featured">
                <a href="{{ route('chitiettin',$xuhuong_first->slug) }}" class="xuhuong-main">
                    <img class="img-fluid" src="{{ $xuhuong_first->image }}" alt="{{ $xuhuong_first->name }}" />
                </a>
                <h6>
                    <a href="{{ route('chitiettin',$xuhuong_first->slug) }}"> {{ $xuhuong_first->name }} </a>
                </h6>
            </div>
            @foreach ($xuhuong as $item)
            <div class="item">
                <div class="row">
                    <div class="col-md-4 col-5">
                        <a href="{{ route('chitiettin',$item->slug) }}">
                            <img class="img-fluid" src="{{ $item->image }}" alt="{{ $item->name }}" />
                        </a>
                    </div>
                    <div class="col-md-8 col-7">
                        <p> <a href="{{ route('chitiettin',$item->slug) }}"> {{ $item->name }} </a> </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Video -->
    {{-- <section id="videos">
                <div class="side-header">
                    <i class="fa fa-play-circle"></i>
                    <h4>VIDEO</h4>
                </div>
                <div class="side-content">
                    <div class="video">
                        <video>
                            <source src="http://localhost\baotuyensinhView\media\\trandan.mp4" />
                        </video>
                        <p class="video-title">
                            Hội thảo sáng chế công nghệ sàn ô cờ ACH tiết kiệm chi phí xây
                            dựng tại Hồ Chí Minh
                        </p>
                    </div>
                    <div class="video">
                        <video>
                            <source src="http://localhost\baotuyensinhView\media\\trandan.mp4" />
                        </video>
                        <p class="video-title">
                            Hội thảo sáng chế công nghệ sàn ô cờ ACH tiết kiệm chi phí xây
                            dựng tại Hồ Chí Minh
                        </p>
                    </div>
                    <div class="video">
                        <video>
                            <source src="http://localhost\baotuyensinhView\media\\trandan.mp4" />
                        </video>
                        <p class="video-title">
                            Hội thảo sáng chế công nghệ sàn ô cờ ACH tiết kiệm chi phí xây
                            dựng tại Hồ Chí Minh
                        </p>
                    </div>
                </div>
            </section> --}}

    <!-- Tuyen sinh -->
    <section id="tuyensinh">
        <div class="side-header">
            <i class="fa fa-briefcase"></i>
            <h2>TUYỂN SINH</h2>
        </div>
        <div class="side-content">
            <a href="{{ route('chitiettin', $tuyensinh_first->slug) }}" class="tuyensinh-main">
                <img src="{{ $tuyensinh_first->image }}" alt="{{ $tuyensinh_first->image }}" />
                <p class="tuyensinh-des">
                    {{ $tuyensinh_first->name }}
                </p>
            </a>
            @foreach ($tuyensinh as $item)
            <div class="tuyensinh-contents">
                <a href="{{ route('chitiettin',$item->slug) }}">
                    <p>
                        {{ $item->name }}
                    </p>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Giao duc -->
    <section id="giaoduc">
        <div class="side-header">
            <i class="fa fa-book"></i>
            <h2 class="d-inline">GIÁO DỤC</h2>
        </div>
        <div class="side-content">
            <a href="{{ route('chitiettin',$giaoduc_first->slug) }}" class="giaoduc-main">
                <img src="{{ $giaoduc_first->image }}" alt="{{ $giaoduc_first->name }}" />
                <div class="side-des">
                    {{ $giaoduc_first->name }}
                </div>
            </a>
            @foreach ($giaoduc as $item)
            <div class="giaoduc-contents">
                <a href="{{ route('chitiettin',$item->slug) }}" class="">
                    <p>
                        {{ $item->name }}
                    </p>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Cong dong --}}
    <section id="congdong">
        <div class="side-header">
            <i class="fa fa-users"></i>
            <h2 class="d-inline">CỘNG ĐỒNG</h2>
        </div>
        <div class="side-content">
            @foreach ($congdong as $item)
            <div class="congdong-box">
                <div class="congdong-avatar">
                    <img class="rounded rounded-circle" height="35px" width="35px" src="{{ $item->image }}" alt="">
                </div>
                <div class="congdong-contents">
                    <p class="user-name">{{ $item->user->name }}</p>
                    <a href="{{ route('forum', $item->slug) }}" class="">
                        <p class="forum-name">
                            {{ $item->name }}
                        </p>
                    </a>
                    <p>
                        <small>{{ $item->hour() }}</small>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Nguoi dung moi --}}
    <section id="nguoidungmoi">
        <div class="side-header">
            <i class="fa fa-user-circle"></i>
            <h2 class="d-inline">NGƯỜI DÙNG MỚI</h2>
        </div>
        <div class="side-content">
            @foreach ($nguoidungmoi as $item)
            <div class="nguoidungmoi-box">
                <div class="nguoidungmoi-avatar">
                    @if (isset($item->avatar))
                    <img height="35px" width="35px" class="rounded rounded-circle" src="{{ $item->avatar }}" alt="">
                    @else
                    <div class="empty-avatar">
                        <p>
                            {{ substr($item->name, 0, 1) }}
                        </p>
                    </div>
                    @endif
                </div>
                <div class="nguoidungmoi-contents">
                    @if (isset($item->name))
                    <p>
                        {{ $item->name }}
                    </p>
                    @else
                    <p>User</p>
                    @endif

                </div>
            </div>
            @endforeach
        </div>
    </section>

    <div class='sticky-top'>
        <!-- Big advertisement -->
        <section id="big-ad">
            <a href="$footer_banner->link" target="_blank">
                <img src="{{ $footer_banner->image }}" alt="{{$footer_banner->name }}" />
            </a>
        </section>

        <!-- Facebook embed -->
        <section id="facebook-embed">
            <i class="fa fa-facebook-square"></i>
            <span>Fanpage facebook</span>
            <div id="fb-root">
                <div class="fb-page" data-href="https://www.facebook.com/baotuyensinh/" data-tabs="timeline"
                    data-width="350px" data-height="200px" data-small-header="false" data-adapt-container-width="true"
                    data-hide-cover="false" data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/baotuyensinh/" class="fb-xfbml-parse-ignore">
                        <a href="https://www.facebook.com/baotuyensinh/">BÁO TUYỂN SINH</a>
                    </blockquote>
                </div>
            </div>
        </section>
    </div>
</div>