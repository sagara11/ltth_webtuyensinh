<div class="col-lg-4">
            <!-- Banner quang cao -->
            <section id="quangcao">
                @foreach ($banner as $item)
                <div class="quangcao-box">
                    <a target="_blank" href="{{ $item->altlink }}">
                        <img src="{{ $item->image }}" ="{{ $item->name }}" />
                    </a>
                </div>
                @endforeach
            </section>

            <!-- Xu huong -->
            <section id="xuhuong">
                <div class="side-header">
                    <i class="fa fa-desktop"></i>  <h4>XU HƯỚNG</h4>
                </div>
                <div class="side-content">
                    <div class="featured">
                    <a href="{{ route('chitiettin',$trend_first->slug) }}" class="xuhuong-main">
                        <img class="img-fluid" src="{{ $trend_first->image }}" alt="{{ $trend_first->name }}" />
                    </a>
                    <h6>
                        <a href="{{ route('chitiettin',$trend_first->slug) }}"> {{ $trend_first->name }} </a>
                    </h6>
                </div>
                    @foreach ($sidetrend as $item)
                    <div class="item">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('chitiettin',$item->slug) }}" >
                                    <img class="img-fluid" src="{{ $item->image }}" alt="{{ $item->name }}" />
                                </a>
                            </div>
                            <div class="col-md-8">
                                <p>  <a href="{{ route('chitiettin',$item->slug) }}">  {{ $item->name }} </a>  </p>
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
                    <h4>TUYỂN SINH</h4>
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
                    <h4 class="d-inline">GIÁO DỤC</h4>
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
                            data-width="350px" data-height="200px" data-small-header="false"
                            data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/baotuyensinh/" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/baotuyensinh/">BÁO TUYỂN SINH</a>
                            </blockquote>
                        </div>
                    </div>
                </section>
            </div>
        </div>