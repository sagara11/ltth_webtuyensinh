@extends('adminlte::page')

@section('title', 'CreateData')

@section('content_header')
<h1>
  Thêm dữ liệu
  <small>Create Banners</small>
</h1>
{{Breadcrumbs::render('createBanner')}}
@endsection
@section('content')
@if (session('fail'))
<div class="alert alert-danger">{{session('fail')}}</div>
@endif
<tbody>
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Thêm dữ liệu</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form action="{{ route('storeBanner') }}" method="post" accept-charset="utf-8">
      @csrf
      <div class="box-body">
        <div class="row">
          <div class="col-sm-8">
            <div class="form-group">
              <label for="exampleInputEmail1">Tên Banner</label>
              <input type="textbox" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tên Banner" name="name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">url</label>
              <input required type="textbox" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="url" name="link">       
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Nội Dung Banner </label>
              <textarea required class="form-control" id="editor" aria-describedby="emailHelp" name="description" placeholder="Nội dung Banner"></textarea>
            </div>
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleFormControlSelect2">Vị Trí</label>
                  <select data-toggle="dropdown" id="exampleFormControlSelect2" name ="position" class="form-control">
                    <option class="dropdown-item" value="Top">Top</option>
                    <option class="dropdown-item" value="Banner">Banner</option>
                    <option class="dropdown-item" value="Sidebar">Sidebar</option>
                    <option class="dropdown-item" value="Sidebar_cate">Sidebar_cate</option>
                  </select>
                </div>
              </div>
            </div>
            <label for="exampleInputEmail1">Publish</label>
            <div>
              <input class="form-check-input" type="checkbox" name="publish" id="inlineRadio1" checked>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="form-group">
              <label for="exampleInputEmail1">Image</label>
              <input type="hidden" name="image" placeholder="image" id="url">
              <div style="margin-bottom: 15px;">
                <img src="/userfiles/images/default_avatar-ea7cf6abde4eec089a4e03cc925d0e893e428b2b6971b12405a9b118c837eaa2.png" class="img-fluid" alt="" id="avatar">
              </div>
              <button type="button" onclick="openPopup()" class="btn btn-primary">Image</button>
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
<link rel="stylesheet" type="text/css" href="/css/edit.css">
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>  
<script src="https://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
<script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
<script>
 function openPopup() {
   CKFinder.popup( {
     chooseFiles: true,
     onInit: function( finder ) {
       finder.on( 'files:choose', function( evt ) {
         var file = evt.data.files.first();
         document.getElementById( 'avatar' ).src = file.getUrl();
       } );
       finder.on( 'file:choose:resizedImage', function( evt ) {
         document.getElementById( 'avatar' ).src = evt.data.resizedUrl;
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