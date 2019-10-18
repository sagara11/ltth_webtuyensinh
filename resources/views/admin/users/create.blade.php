@extends('adminlte::page')

@section('title', 'CreateData')

@section('content_header')
    	<h1>
        Thêm dữ liệu
        <small>Create Teachers</small>
      </h1>
      {{Breadcrumbs::render('createUser')}}
@endsection
@section('content')
@if (session('fail'))
        <div class="alert alert-danger">{{session('fail')}}</div>
@endif
    <tbody>
    	@include('ckfinder::setup')
    <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm dữ liệu</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
        <form action="{{ route('storeTeachers') }}" method="post" accept-charset="utf-8">
    			@csrf
        <div class="box-body">
            <div class="row">
              	<div class="col-sm-8">
	              	<div class="form-group">
	                  <label for="exampleInputEmail1">Name</label>
	                  <input class="form-control" id="exampleInputEmail1" type="text" placeholder="name" name="name">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Email address</label>
	                  <input class="form-control" id="exampleInputEmail1" type="email" placeholder="Enter email" name="email">
	                </div>
	                <div class="form-group">
	                	<label for="exampleInputEmail1">Gender</label>
	                  	<div>
						  <input type="radio" id="male" name="gender" value="Male"
						         checked>
						  <label for="male">Male</label>
				
						  <input type="radio" id="female" name="gender" value="Female">
						  <label for="female">Female</label>
					
						  <input type="radio" id="other" name="gender" value="other">
						  <label for="other">Other</label>
						</div>
	            	</div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Evaluation</label>
	                  <input class="form-control" id="" type="text" placeholder="Enter email" name="evaluation">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Phone</label>
	                  <input class="form-control" id="" type="number" placeholder="Enter email" name="phone">
	                </div>
          		</div>
          		<div class="col-sm-4">
          			<div class="form-group">
		            	<label for="exampleInputEmail1">Image</label>
		            	<input type="hidden" name="image" placeholder="image" id="url">
		            	<div>
	        			<img src="/userfiles/images/default_avatar-ea7cf6abde4eec089a4e03cc925d0e893e428b2b6971b12405a9b118c837eaa2.png" class="img-fluid" alt="" id="avatar">
		        		</div>
		              	<button type="button" onclick="openPopup()" class="btn btn-primary">Select Avatar</button>
            		</div>
          		</div>
         	</div>
         		<div class="form-group">
	                 <label for="exampleInputEmail1">Description</label>
	                 <textarea name="description" id="editor1"></textarea>
                <div class="checkbox">
                  <label>
                    <input checked="" type="checkbox" name="publish"> Publish
                  </label>
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