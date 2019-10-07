	@extends('adminlte::page')

@section('title', 'CreateData')

@section('content_header')
      <h1>
        Thêm dữ liệu
        <small>Create Category</small>
      </h1>
      {{Breadcrumbs::render('editCategory')}}
@endsection
@section('content')
@include('ckfinder::setup')
@if (session('fail'))
        <div class="alert alert-danger">{{session('fail')}}</div>
@endif
    <tbody>
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update dữ liệu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        <form action="{{ route('updateCategory') }}" method="post" accept-charset="utf-8">
          @csrf
        <div class="box-body">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên danh mục</label>
                      <input type="textbox" required class="form-control" id="categories" aria-describedby="emailHelp" placeholder="Tên Danh Mục" name="name" value="{{$category->name}}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Slug</label>
                      <input required type="text" class="form-control" id="slug" value="{{$category->slug}}" name="slug">       
                    </div>
		            <label for="exampleInputEmail1">Publish</label>
		            <div>
		              <input class="form-check-input" type="checkbox" name="publish" id="inlineRadio1" checked>
		            </div>
              </div>
              <div class="col-sm-4">
          
                </div>
              </div>
            </div>
          </div>
      </tbody>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-primary" type="submit">Submit</button>
                <input type="hidden" name="getid" value="{{$id}}">
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