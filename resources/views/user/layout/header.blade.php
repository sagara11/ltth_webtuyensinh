<!-- Page header -->
<?php
function rebuild_date( $format, $time = 0 )
{
    if ( ! $time ) $time = time();

    $lang = array();
    $lang['sun'] = 'CN';
    $lang['mon'] = 'T2';
    $lang['tue'] = 'T3';
    $lang['wed'] = 'T4';
    $lang['thu'] = 'T5';
    $lang['fri'] = 'T6';
    $lang['sat'] = 'T7';
    $lang['sunday'] = 'Chủ nhật';
    $lang['monday'] = 'Thứ hai';
    $lang['tuesday'] = 'Thứ ba';
    $lang['wednesday'] = 'Thứ tư';
    $lang['thursday'] = 'Thứ năm';
    $lang['friday'] = 'Thứ sáu';
    $lang['saturday'] = 'Thứ bảy';
    $lang['january'] = 'Tháng Một';
    $lang['february'] = 'Tháng Hai';
    $lang['march'] = 'Tháng Ba';
    $lang['april'] = 'Tháng Tư';
    $lang['may'] = 'Tháng Năm';
    $lang['june'] = 'Tháng Sáu';
    $lang['july'] = 'Tháng Bảy';
    $lang['august'] = 'Tháng Tám';
    $lang['september'] = 'Tháng Chín';
    $lang['october'] = 'Tháng Mười';
    $lang['november'] = 'Tháng M. một';
    $lang['december'] = 'Tháng M. hai';
    $lang['jan'] = 'T01';
    $lang['feb'] = 'T02';
    $lang['mar'] = 'T03';
    $lang['apr'] = 'T04';
    $lang['may2'] = 'T05';
    $lang['jun'] = 'T06';
    $lang['jul'] = 'T07';
    $lang['aug'] = 'T08';
    $lang['sep'] = 'T09';
    $lang['oct'] = 'T10';
    $lang['nov'] = 'T11';
    $lang['dec'] = 'T12';

    $format = str_replace( "r", "D, d M Y H:i:s O", $format );
    $format = str_replace( array( "D", "M" ), array( "[D]", "[M]" ), $format );
    $return = date( $format, $time );

    $replaces = array(
        '/\[Sun\](\W|$)/' => $lang['sun'] . "$1",
        '/\[Mon\](\W|$)/' => $lang['mon'] . "$1",
        '/\[Tue\](\W|$)/' => $lang['tue'] . "$1",
        '/\[Wed\](\W|$)/' => $lang['wed'] . "$1",
        '/\[Thu\](\W|$)/' => $lang['thu'] . "$1",
        '/\[Fri\](\W|$)/' => $lang['fri'] . "$1",
        '/\[Sat\](\W|$)/' => $lang['sat'] . "$1",
        '/\[Jan\](\W|$)/' => $lang['jan'] . "$1",
        '/\[Feb\](\W|$)/' => $lang['feb'] . "$1",
        '/\[Mar\](\W|$)/' => $lang['mar'] . "$1",
        '/\[Apr\](\W|$)/' => $lang['apr'] . "$1",
        '/\[May\](\W|$)/' => $lang['may2'] . "$1",
        '/\[Jun\](\W|$)/' => $lang['jun'] . "$1",
        '/\[Jul\](\W|$)/' => $lang['jul'] . "$1",
        '/\[Aug\](\W|$)/' => $lang['aug'] . "$1",
        '/\[Sep\](\W|$)/' => $lang['sep'] . "$1",
        '/\[Oct\](\W|$)/' => $lang['oct'] . "$1",
        '/\[Nov\](\W|$)/' => $lang['nov'] . "$1",
        '/\[Dec\](\W|$)/' => $lang['dec'] . "$1",
        '/Sunday(\W|$)/' => $lang['sunday'] . "$1",
        '/Monday(\W|$)/' => $lang['monday'] . "$1",
        '/Tuesday(\W|$)/' => $lang['tuesday'] . "$1",
        '/Wednesday(\W|$)/' => $lang['wednesday'] . "$1",
        '/Thursday(\W|$)/' => $lang['thursday'] . "$1",
        '/Friday(\W|$)/' => $lang['friday'] . "$1",
        '/Saturday(\W|$)/' => $lang['saturday'] . "$1",
        '/January(\W|$)/' => $lang['january'] . "$1",
        '/February(\W|$)/' => $lang['february'] . "$1",
        '/March(\W|$)/' => $lang['march'] . "$1",
        '/April(\W|$)/' => $lang['april'] . "$1",
        '/May(\W|$)/' => $lang['may'] . "$1",
        '/June(\W|$)/' => $lang['june'] . "$1",
        '/July(\W|$)/' => $lang['july'] . "$1",
        '/August(\W|$)/' => $lang['august'] . "$1",
        '/September(\W|$)/' => $lang['september'] . "$1",
        '/October(\W|$)/' => $lang['october'] . "$1",
        '/November(\W|$)/' => $lang['november'] . "$1",
        '/December(\W|$)/' => $lang['december'] . "$1" );

    return preg_replace( array_keys( $replaces ), array_values( $replaces ), $return );
}

?>
<header class="d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <ul class="left">
                    <li> {{ rebuild_date('l, d/M/Y, H:i')}} </li>
                    <li> <i class="fa fa-phone"> </i> 04 668 39 668 </li>
                    <li> <i class="fa fa-envelope"> </i> contact@webtuyensinh.edu.vn </li>
                </ul>
            </div>
            <div class="col-md-3 ">
                <div class="dropdown">
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
                            <li> <a href="{{ route('taikhoan') }}"> Tài khoản của tôi </a> </li>
                            <li> <a href="{{ route('taikhoan') }}"> Đổi mật khẩu </a> </li>
                            <li> <a href="{{ route('taikhoan') }}"> Quản lý bình luận </a> </li>
                            <li> <a href="{{ route('logout') }}"> Thoát </a> </li>
                        </ul>
                    </div>
                    @else
                    <div class="dropdown-menu">
                        <ul>
                            <li data-toggle="modal" data-target="#signin"> Đăng nhập </li>
                            <li data-toggle="modal" data-target="#signup"> Đăng ký </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Dang nhap, dang ky -->

<article class="modal fade sign" id="signin">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p>ĐĂNG NHẬP</p>
                <span id="modalclose_dangnhap" data-dismiss="modal">
                    &times;
                </span>
            </div>
            <div class="modal-body">
                <p><b>Đăng nhập với Email:</b></p>
                <input id="s-email" name="s_email" required class="form-control" type="email"
                    placeholder="Email">
                <input id="s-password" name="s_password" required class="form-control" type="password"
                    placeholder="Mật khẩu">
                <p id="s_popup"> </p>
                <input class="checkbox-btn" type="checkbox">
                <span>
                    <button id="dangnhap_submit" class="submit-btn" type="submit">ĐĂNG NHẬP</button>
                </span>
                <span id="forgotpass">
                    <a onclick="forgotpass()" data-target="#quenmatkhau" data-toggle="modal">Quên mật khẩu?</a>
                </span>
            </div>
            <div class="modal-footer">
                <p>Hoặc đăng nhập với:</p>
                <div class="social-btn">
                    <a class="facebook-btn"> <i class="fa fa-facebook-square"> </i> Facebook </a>
                    <a class="gmail-btn"> <i class="fa fa-google-plus-square"> </i> Gmail </a>
                </div>
            </div>

        </div>
    </div>
</article>


{{-- Quen mat khau modal --}}
<div class="modal fade" id="quenmatkhau">
    <div class="modal-content d-flex">
        <div style="text-align: center;">
            <p>Nhập email tài khoản để xác nhận</p>
            <input id="forgotemail" type="email" placeholder="Nhap email" name="forgotemail">
            <input id="send_email" type="submit" name="send_email" value="submit">
            <p id="email-popup"></p>
            <button onclick="close_forgot()">Thoát</button>
        </div>
    </div>
</div>

<article class="modal fade sign" id="signup">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <p> TẠO TÀI KHOẢN </p>
                <span id="modalclose_dangnhap" data-dismiss="modal">
                    &times;
                </span>
            </div>
            <div class="modal-body">
                <p><b> Tạo tài khoản với Email:</b></p>
                <input id="email" name="email" class="form-control" type="email"
                    placeholder="Email" >
                <input id="name" name="name" class="form-control" type="text"
                    placeholder="Tên tài khoản" >
                <input id="password" name="password" class="form-control" type="password"
                    placeholder="Mật khẩu" >
                <input id="confirm_password" name="confirm_password" class="form-control"
                    type="password" placeholder="Xác nhận Mật khẩu" >
                <p id="s_popup"> </p>
                <input id="register_submit" class="submit-bt" type="submit">
            </div>
            <div class="modal-footer">
                <p>Hoặc tạo tài khoản với:</p>
                <div class="social-btn">
                    <a href="/redirect/facebook" class="facebook-btn"> <i class="fa fa-facebook-square"> </i> Facebook </a>
                    <a href="/redirect/google" class="gmail-btn"> <i class="fa fa-google-plus-square"> </i> Gmail </a>
                </div>
            </div>
            <p style="color: red; text-align:center" id="register-info">

            </p>
        </div>
    </div>
</article>


<!-- Navigation -->
<nav class="nav d-none d-lg-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <a class="logo" href="{{ route('home') }}">
                    <img class="img-fluid" src="{{ asset('media/logo-main.png') }}" alt="" />
                </a>
            </div>
            <div class="menu col-lg-9">
                <ul>
                    @foreach ($nav_section as $item)
                    <li> <a href="{{ route('danhmuc',$item->slug) }}"> {{ $item->name }} </a> </li>
                    @endforeach
                    <li> <a target="_blank" href="https://hoidaptuyensinh.vn"> Hỏi Đáp </a> </li>
                    <li> <a target="_blank" href="#"> Việc Làm </a> </li>


                </ul>
            </div>
            <div class="col-lg-1">
                <div id="search">
                    <i onclick="openSearch()" class="fa fa-search"></i>
                    <form class="searchbar" method="post" action="{{ route('search') }}">
                        @csrf
                        <input class="form-control" name="name_search" type="text" placeholder="Nhập tìm kiếm...">
                    </form>
                </div>

            </div>
        </div>

    </div>

</nav>

{{-- Mobile responsive --}}
<div class="mb-nav sticky-top">
    <div class="mb-menu">
        <a onclick="openNav()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
    <div class="space">

    </div>
    <div class="logo">
        <a href="{{ route('home') }}">
            <img class="img-fluid" src="{{ asset('media/logo-main.png') }}" alt="Logo" />
        </a>
    </div>
    <div class="mb-search">
        <div>
            <input type="text" placeholder="       Search . . ." required>
        </div>
    </div>
    <div class="mb-account">
        <a data-toggle="modal" onclick="openNav()">
            <i class="fa fa-user-circle"></i>
        </a>
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
        <li> <a target="_blank" href="https://hoidaptuyensinh.vn"> Hỏi Đáp </a> </li>
        <li> <a target="_blank" href="#"> Việc Làm </a> </li>
    </ul>
    <ul class="account">
        <li class="btn btn-danger" data-toggle="modal" data-target="#signin"> Đăng nhập </li>
        <li class="btn btn-danger" data-toggle="modal" data-target="#signup"> Đăng ký </li>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<meta name="csrf_token" content="{{ csrf_token() }}" />
<script>
    $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} })
</script>

<script>
    function forgotpass(){
        $('#signin').hide();
    }
    function close_forgot(){
        location.reload();
    }
    $(document).ready(function(){
          $('#send_email').click(function(){
            var forgotemail = $('#forgotemail').val();
              $.ajax({
                url: "{{ route('forgot') }}",
                type:"post",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: { forgotemail : forgotemail},
                success:function(data){
                    if(data == "khong ton tai email nay !"){
                        $('#email-popup').text(data);
                    }
                    else{
                        location.reload();
                    }
                },
                error:function(){ 
                    alert('error');
                }
            }); 
          });
          $('#dangnhap_submit').click(function(){
            var s_email = $('#s-email').val();
            var s_password = $('#s-password').val();
              $.ajax({
                url: "{{ route('signin') }}",
                type:"post",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: { s_email : s_email, s_password : s_password },
                success:function(data){
                   
                    if(data != "Email hoặc mật khẩu không đúng"){
                        $("#modalclose_dangnhap").click();
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
          $('#register_submit').click(function(){
            var email = $('#email').val();
            var name = $('#name').val();
            var password = $('#password').val();
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
                data: { email : email, password : password, confirm_password : confirm_password, name : name },
                success:function(data){
                    if(data == "Đăng ký tài khoản thành công"){
                        window.alert(data);
                        location.reload();
                    }
                    else if(data == "Mật khẩu nhập không đúng !!!"){
                        $('#register-info').text(data);
                    }
                    else{
                        $('#register-info').text(data);
                    }
                },
                error:function(){ 
                    alert('error');
                }
            }); 
          });
      });
</script>