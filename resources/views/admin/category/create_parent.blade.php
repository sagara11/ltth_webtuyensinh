@extends('adminlte::page')

@section('title', 'CreateData')

@section('content_header')
      <h1>
        Thêm dữ liệu
        <small>Create Categories</small>
      </h1>
      {{Breadcrumbs::render('createCategory')}}
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
            <form role="form" action="{{ route('storeCategory') }}" method="post" accept-charset="utf-8">
                @csrf
              <div class="box-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên Danh Mục Cha </label>
                      <input required="" type="text" name="name" value="" class="form-control" id="categories" placeholder="Tên danh mục">
                    </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" name="slug" value="" class="form-control" id="slug" placeholder="Tên danh mục">
                      </div>
                  </div>
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Seo Title</label>
                     <textarea name="seo_title" class="form-control" id="exampleInputEmail1" placeholder="Seo_Title"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Seo Keyword</label>
                     <textarea name="seo_keyword" class="form-control" id="exampleInputEmail1" placeholder="Seo_Keyword"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Seo Description</label>
                     <textarea name="seo_description" class="form-control" id="exampleInputEmail1" placeholder="Seo Description"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Publish</label>
                    <input checked type="checkbox" name="publish">
                  </div>  
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit" name="create" value="Create" class="btn btn-success">
              </div>
            </form>
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
         $(document).ready(function(){
          $('#categories').keyup(function(){
            var temp = $('#categories').val();
              $.ajax({
                url: "{{ route('slugCategory') }}",
                type:"post",
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');
                    if (token) {
                          return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                data: { str : temp },
                success:function(data){
                    $('#slug').val(data)
                },
                error:function(){ 
                    alert('error');
                }
            }); 
          });
      });
</script>
@endsection