@extends('adminlte::page')

@section('title', 'UpdateData')

@section('content_header')
    	<h1>
        Update dữ liệu
        <small>Create User</small>
      </h1>
  {{Breadcrumbs::render('editUser')}}
@endsection
@section('content')
    <tbody>
    	@include('ckfinder::setup')
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm dữ liệu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
    <form action="{{ route('updateUser') }}" method="post" accept-charset="utf-8">
    			@csrf
        <div class="box-body">
            <div class="row">
              	<div class="col-sm-8">
	              	<div class="form-group">
	                  <label for="exampleInputEmail1">Name</label>
	                  <input class="form-control" id="exampleInputEmail1" type="text" placeholder="name" value="{{$data->name}}" name="name">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Email address</label>
	                  <input class="form-control" id="exampleInputEmail1" type="email" placeholder="Enter email" value="{{$data->email}}" name="email">
	                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input required="" class="form-control" id="exampleInputEmail1" type="text" placeholder="Phone" value="{{$data->phone}}" name="phone">
                  </div>
                  <div class="checkbox">
                    @if($data->publish == 1)
                    <label>
                    <input checked="" type="checkbox" name="publish"> Publish </label>
                    @else
                      <label>
                      <input type="checkbox" name="publish"> Publish </label>
                    @endif
                  </div> 
          		</div>
              <div class="col-sm-4">
                <div class="col-sm-4">
                <div class="form-group">
                  <label for="exampleInputEmail1">Image</label>
                  <input type="hidden" name="image" placeholder="image" id="url">
                  <div>
                <img style="height: 200px;" src="{{$data->avatar ? $data->avatar : '/userfiles/images/default_avatar-ea7cf6abde4eec089a4e03cc925d0e893e428b2b6971b12405a9b118c837eaa2.png' }}" alt="" id="avatar">
                </div>
                    <button style="margin-top: 20px;" type="button" onclick="openPopup()" class="btn btn-primary">Select Avatar</button>
                </div>
              </div>
         	</div>
	        </div>
	    	</tbody>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                <input type="hidden" name="getid" value="{{$id}}">
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
  	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script> CKEDITOR.replace('editor1'); </script>
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