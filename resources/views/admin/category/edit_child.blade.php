@extends('adminlte::page')

@section('title', 'CreateData')

@section('content_header')
      <h1>
        Thêm dữ liệu
        <small>Create Categories</small>
      </h1>
      {{Breadcrumbs::render('editCategory')}}
@endsection
@section('content')
@include('ckfinder::setup')
@if (session('fail'))
        <div class="alert alert-danger">{{session('fail')}}</div>
@endif
    <tbody>
      <!-- /.box-body -->
         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm Danh Mục</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('updateCategory') }}" method="post" accept-charset="utf-8">
                @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-6">
                    <label style="color: black;" for="exampleInputEmail1">Danh mục cha </label>
                    <select  style=" color: black ; width: 100%;" class="form-control" name="category_parent">
                        <option style="display: none;" value="{{$category->parent_category->id}}">{{$category->parent_category->name}}</option>
                        <option value="All">All</option>
                        @foreach($categories as $row)
                        {
                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                        }
                        @endforeach
                    </select>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Tên Danh Mục Con </label>
                        <input type="text" name="name" class="form-control" id="categories" placeholder="Tên danh mục" value="{{$category->name}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" name="slug" class="form-control" id="slug" placeholder="Tên danh mục" value="{{$category->slug}}">
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Seo Title</label>
                     <textarea name="seo_title" class="form-control" id="exampleInputEmail1" placeholder="Seo_Title">{{$category->seo_title}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Seo Keyword</label>
                     <textarea name="seo_keyword" class="form-control" id="exampleInputEmail1" placeholder="Seo_Keyword">{{$category->seo_keyword}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Seo Description</label>
                     <textarea name="seo_description" class="form-control" id="exampleInputEmail1" placeholder="Seo Description">{{$category->seo_description}}</textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Publish</label>
                    @if($category->publish == 1)
                    <input checked type="checkbox" name="publish">
                    @else
                    <input type="checkbox" name="publish">
                    @endif
                  </div>  
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit" name="update" value="Update" class="btn btn-success">
                <input type="hidden" name="getid" value="{{$id}}">
              </div>
            </form>
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
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <script>$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} })</script>
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