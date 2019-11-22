<!-- Page header -->
<header>
    <div class="container">
        <div class="row">
            <div class="header-news col-lg-9">
                @foreach ($header as $item)
                <span>
                    <b>SỰ KIỆN: </b>{{ $item->name }}
                </span>
                @endforeach
            </div>
            <div class="header-account dropdown col-lg-3">
                <div class="dropdown-toggle" data-toggle="dropdown">
                    <img class=" rounded rounded-circle" height="25px" width="25px"
                        src="http://localhost\baotuyensinhView\media\tải xuống (1).png" alt="" />
                    <p>
                        Nguyễn Văn Nam
                    </p>
                </div>
                <div class="dropdown-menu">
                    <ul>
                        <li data-toggle="modal" data-target="#signin">
                            Đăng nhập
                        </li>
                        <li data-toggle="modal" data-target="#signup">
                            Đăng ký
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Dang nhap, dang ky -->
<article class="modal fade" id="signin">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p>ĐĂNG NHẬP</p>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('signin') }}" class="form-group">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input name="email" required class="form-control" type="email" placeholder="Tên tài khoản">
                    <input name="password" required class="form-control" type="password" placeholder="Mật khẩu">
                    <input class="checkbox-btn" type="checkbox">
                    <span>
                        <button class="submit-btn" type="submit">ĐĂNG NHẬP</button>
                    </span>
                    <span>
                        <a href="">Quên mật khẩu</a>
                    </span>
                </form>
            </div>
            <div class="modal-footer">
                <p>Hoặc đăng nhập với:</p>
                <div class="social-btn">
                    <button class="facebook-btn">
                        Facebook
                    </button>
                    <button class="gmail-btn">
                        Gmail
                    </button>
                </div>
            </div>
        </div>
    </div>
</article>

<article class="modal fade" id="signup">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p>ĐĂNG KÝ</p>
            </div>
            <div class="modal-box">
                <form class="form-group" action="">
                    <input required class="form-control" type="email" placeholder="Email">
                    <input required class="form-control" type="text" placeholder="Tên tài khoản">
                    <input required class="form-control" type="password" placeholder="Mật khẩu">
                    <input required class="form-control" type="password" placeholder="Xác nhận Mật khẩu">
                </form>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-danger">
                    Đóng
                </button>

                <button type="submit" class="btn btn-success">
                    Đăng ký
                </button>
            </div>
        </div>
    </div>
</article>

<!-- Navigation -->
<nav class="container">
    <div class="nav row">
        <div class="col-lg-2 nav-logo">
            <a href="{{ route('home') }}">
                <img class="img-fluid" src="{{ asset('media/logo.png') }}" alt="" />
            </a>
        </div>
        <div class="menu col-lg-9">
            <ul class="row">
                <li class="home">
                    <a href="{{ route('home') }}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>

                @foreach ($nav_section as $item)
                <li>
                    <a href="{{ route('danhmuc',$item->slug) }}">
                        <b>{{ $item->name }}</b>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div id="search" class="col-lg-1">
            <div>
                <i onclick="openSearch()" class="fas fa-search"></i>
            </div>
            <div id="searchbar">
                <input class="form-control" type="text" placeholder="Nhập tìm kiếm...">
            </div>
        </div>
    </div>
</nav>

{{-- Mobile responsive --}}
<div class="mb-nav sticky-top">
    <div class="mb-menu">
        <a onclick="openNav()">
            <i class="fas fa-bars"></i>
        </a>
    </div>
    <div class="space">

    </div>
    <div class="logo">
        <a href="{{ route('home') }}">
            <img class="img-fluid" src="{{ asset('media/1 Trang chủ.png') }}" alt="" />
        </a>
    </div>
    <div class="mb-search">
        <div>
            <input type="text" placeholder="       Search . . ." required>
        </div>
    </div>
    <div class="mb-account">
        <a data-toggle="modal" data-target="#mb-account-modal">
            <i class="far fa-user-circle"></i>
        </a>
    </div>
</div>

{{-- Mobile modal --}}
<div class="modal fade" id="mb-account-modal">
    <div class="modal-dialog-centered modal-dialog">
        <div class="modal-content p-3">
            <h4>ĐĂNG NHẬP</h4>
            <form class="form-group" action="">
                <input class="form-control" type="text" placeholder="Tên đăng nhâp">
                <input type="password" placeholder="Mật khẩu" class="form-control">
            </form>
        </div>
    </div>
</div>

<div id="Sidenav" class="sidenav">
    <a class="closebtn" onclick="closeNav()">&times;</a>
    <ul class="list-unstyled">
        @foreach ($nav_section as $item)
        <li class="col-lg-2">
            <a href="{{ route('danhmuc', $item->id) }}"><b>{{ $item->name }}</b></a>
        </li>
        @endforeach
    </ul>
</div>