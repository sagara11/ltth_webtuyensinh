@extends('adminlte::page')

@section('title', 'ChangePassword')

@section('content_header')
      <h1>
        Đổi mật khẩu
        <small>Change Password</small>
      </h1>
      {{Breadcrumbs::render('change_passwordUser')}}
@endsection
@section('content')
@if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
@endif
@if (session('fail'))
        <div class="alert alert-danger">{{session('fail')}}</div>
@endif
    <tbody>
      @include('ckfinder::setup')
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Đổi mật khẩu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        <form action="{{ route('check_passwordUser') }}" method="post" accept-charset="utf-8">
          @csrf
        <div class="box-body">
            <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Current Password</label>
                    <input required="" class="form-control" id="exampleInputEmail1" type="password" placeholder="currentPassword" name="currentPassword">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">New Password</label>
                    <input required="" class="form-control" id="exampleInputEmail1" type="password" placeholder="newPassword" name="newPassword">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Confirm Password</label>
                    <input required="" class="form-control" id="exampleInputEmail1" type="password" placeholder="confirmPassword" name="confirmPassword">
                  </div>
                </div>
              </div>
          </div>
      </tbody>
              <!-- /.box-body -->
              <div class="box-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
        </form>
    </div>
@endsection
@section('css')
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity=" --><!-- sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webbanhang/resources/views/style/edit.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>  
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
    <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script> CKEDITOR.replace('editor1'); </script>
  <script>
         function openPopup() {
             CKFinder.popup( {
                 chooseFiles: true,
                 onInit: function( finder ) {
                     finder.on( 'files:choose', function( evt ) {
                         var file = evt.data.files.first();
                         document.getElementById( 'photo' ).src = file.getUrl();
                     } );
                     finder.on( 'file:choose:resizedImage', function( evt ) {
                         document.getElementById( 'photo' ).src = evt.data.resizedUrl;
                     } );
                     finder.on( 'files:choose', function( evt ) {
                         var file = evt.data.files.first();
                         document.getElementById( 'url' ).value = file.getUrl();
                     } );
                     finder.on( 'file:choose:resizedImage', function( evt ) {
                         document.getElementById( 'url' ).value = evt.data.resizedUrl;
                     } );
                 }
             } );
         }
</script>
@endsection