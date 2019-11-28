<!-- Page header -->
<header>
    <div class="container">
        <div class="row">
            <div class="sukien">
                <i class="far fa-edit"></i>
                <b>TIN MỚI: </b>
            </div>
            <div class="header-news">
                @foreach ($header as $item)
                <span>
                    {{ $item->name }}
                </span>
                @endforeach
            </div>
            <div class="header-account dropdown">
                <div class="dropdown-toggle" data-toggle="dropdown">
                    @if (Auth::check())
                    <img class=" rounded rounded-circle" height="25px" width="25px" src="{{ Auth::user()->avatar }}"
                        alt="" />
                <p>{{ Auth::user()->name }}</p>
                    @else
                    <p>Tài khoản</p>
                    @endif
                </div>
                @if (Auth::check())
                <div class="dropdown-menu">
                    <ul>
                        <li>
                            <a href="{{ route('taikhoan') }}">
                                Tài khoản của tôi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('taikhoan') }}">
                                Đổi mật khẩu
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('taikhoan') }}">
                                Quản lý bình luận
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}">
                                Thoát
                            </a>
                        </li>
                    </ul>
                </div>
                @else
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
                @endif
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
                <input id="s-email" name="email" required class="form-control" type="email" placeholder="Tên tài khoản">
                <input id="s-pass" name="password" required class="form-control" type="password" placeholder="Mật khẩu">
                <input class="checkbox-btn" type="checkbox">
                <span>
                    <button id="dangnhap_submit" class="submit-btn" type="submit">ĐĂNG NHẬP</button>
                </span>
                <span>
                    <a href="">Quên mật khẩu</a>
                </span>
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
            <button id="modalclose2" data-dismiss="modal">
                close
            </button>
            <p id="s_popup">

            </p>
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
                <input id="email" name="email" required class="form-control" type="email" placeholder="Email">
                <input id="name" name="name" required class="form-control" type="text" placeholder="Tên tài khoản">
                <input id="password" name="password" required class="form-control" type="password" placeholder="Mật khẩu">
                <input id="confirm_password" name="confirm_password" required class="form-control" type="password"
                    placeholder="Xác nhận Mật khẩu">
            </div>
            <div class="modal-footer">
                <button id="modalclose" data-dismiss="modal" class="btn btn-danger">
                    Đóng
                </button>

                <input id="register_submit" type="submit" placeholder="đăng ký">
            </div>
            <p id="popup">
                
            </p>
        </div>
    </div>
</article>

<!-- Navigation -->
<nav class="container">
    <div class="nav row">
        <div class="col-lg-2 nav-logo">
            <a href="{{ route('home') }}">
                <img class="img-fluid" src="{{ asset('media/logo-main.png') }}" alt="" />
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
                <form method="post" action="{{ route('search') }}">
                    @csrf
                    <input class="form-control" name="name_search" type="text" placeholder="Nhập tìm kiếm...">
                    <button type="submit" id="search-submit">
                        Tìm kiếm
                    </button>
                </form>
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
            <a href="{{ route('danhmuc',$item->slug) }}"><b>{{ $item->name }}</b></a>
        </li>
        @endforeach
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>  
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
  	<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <script>$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} })</script>

<script>
         $(document).ready(function(){
          $('#register_submit').click(function(){
            var email = $('#email').val();
            var password = $('#password').val();
            var name = $('#name').val();
            var confirm_password = $('#confirm_password').val();
              $.ajax({
                url: "{{ route('register') }}",
                type:"post",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: { email : email,password : password , name : name ,confirm_password : confirm_password },
                success:function(data){
                   
                    if(data == "Đăng ký tài khoản thành công"){
                        $("#modalclose").click();
                    }
                    else{
                        $('#popup').text(data);
                    }
                },
                error:function(){ 
                    alert('error');
                }
            }); 
          });
          $('#dangnhap_submit').click(function(){
            var s_email = $('#s-email').val();
            var s_pass = $('#s-pass').val();
              $.ajax({
                url: "{{ route('signin') }}",
                type:"post",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: { email : s_email,password : s_pass },
                success:function(data){
                   
                    if(data != "Email hoặc mật khẩu không đúng"){
                        $("#modalclose2").click();
                        location.reload();
                    }
                    else{
                        $('#s_popup').text(data);
                    }
                },
                error:function(){ 
                    alert('error');
                }
            }); 
          });
      });
</script>