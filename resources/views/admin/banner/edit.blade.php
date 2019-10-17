
@extends('adminlte::page')

@section('title', 'UpdateData')

@section('content_header')
      <h1>
        Update dữ liệu
        <small>update Banner</small>
      </h1>
      {{Breadcrumbs::render('editBanner')}}
@endsection
@section('content')
@include('ckfinder::setup')
@if (session('fail'))
        <div class="alert alert-danger">{{session('fail')}}</div>
@endif
    <tbody>
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">update dữ liệu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        <form action="{{ route('updateBanner') }}" method="post" accept-charset="utf-8">
          @csrf
        <div class="box-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên Banner</label>
                      <input type="textbox" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tên Banner" name="name" value="{{$banners->name}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">url</label>
                      <input required type="textbox" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="url" name="link" value="{{$banners->link}}">       
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nội Dung Banner </label>
                      <textarea required class="form-control" id="editor" aria-describedby="emailHelp" name="description" placeholder="Nội dung Banner" value="{{$banners->description}}">{{$banners->description}}</textarea>
                    </div>
                  <div class="card">
                      <div class="card-body">
                            <div class="form-group">
                              <label for="exampleFormControlSelect2">Vị Trí</label>
                              <select data-toggle="dropdown" id="exampleFormControlSelect2" name ="position" class="form-control">
                                  <option style="display: none" class="dropdown-item" value="{{$banners->position}}">{{$banners->position}}</option>
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
              @if($banners->publish == 1)
                  <input checked="" class="form-check-input" type="checkbox" name="publish"checked>
              @else
                <input class="form-check-input" type="checkbox" name="publish" >
              @endif
            </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <input type="hidden" name="image" placeholder="image" id="url" value="{{$banners->image}}" id="url">
                  <div id="avatar">
                <img src="{{$banners->image}}" style="height: 200px; widt:220px " id = "photo">
                </div>
                    <button type="button" onclick="openPopup()" class="btn btn-primary" style="margin-top: 20px">Select Avatar</button>
                </div>
              </div>
            </div>
          </div>
      </tbody>
              <!-- /.box-body -->

              <div class="box-footer">
                <input type="hidden" name="getid" value="{{$id}}">
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