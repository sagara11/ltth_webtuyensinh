@extends('adminlte::page')

@section('title', 'CreatData')

@section('content_header')
      <h1>
        Thêm bài viết
        <small>Create Courses</small>
      </h1>
      {{Breadcrumbs::render('createPost')}}
@endsection
@section('content')
@include('ckfinder::setup')
@if (session('fail'))
  <div class="alert alert-danger">{{session('fail')}}</div>
@endif
    	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Courses</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('storePost') }}" method="post" accept-charset="utf-8">
    			       @csrf
              <div class="box-body">
              	<div class="row">
              		<div class="col-sm-5">
                    <div class="form-group">
                        <label style="color: black;" for="exampleInputEmail1">Tên Bài Viết</label>
                        <input required style="color: black;" type="textbox" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Tên Bài Viết" name="name">
                    </div>
		              	<div class="form-group">
		                  <label style="color: black;" for="exampleInputEmail1">Slug</label>
                      <input required style="color: black;" type="textbox" class="form-control" id="slug" placeholder="slug" name="slug">
		                </div>
                    <div class="form-group">
                      <label style="color: black;" for="exampleInputEmail1"> Miêu tả </label>
                      <textarea required style="color: black;" class="form-control" id="editor" aria-describedby="emailHelp" name="description" placeholder="Miêu tả"></textarea>
                    </div>
		            </div>
                <div class="col-sm-4">
                    <div class="form-group">
                      <label style="color: black;" for="exampleInputEmail1">Mục Tin </label>
                        <select required id="publish" class="form-control" name="information">
                          <option value="All" selected="">All--</option>
                            @foreach($categories as $row)
                            {
                                <option style="color: red;" value="{{ $row->id }}">----{{ $row->name }}</option>
                                @if(isset($row->child_category))
                                @foreach ($row->child_category as $column)
                                  <option value="{{ $column->id }}">{{ $column->name }}</option>
                                @endforeach
                                @endif
                            }
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Publish</label>
                      <input checked type="checkbox" name="publish">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Trend</label>
                      <input type="checkbox" name="trend">
                    </div>
                </div>
		            <div class="col-sm-3">
		                <div class="form-group">
                      <label for="exampleInputEmail1">Image</label>
		                  <div>
  		            			<img src="/userfiles/images/default_avatar-ea7cf6abde4eec089a4e03cc925d0e893e428b2b6971b12405a9b118c837eaa2.png" class="img-fluid" alt="" id="avatar">
  		            			<input type="hidden" name="image" placeholder="image" id="url">
		                	</div>
		                		<button type="button" onclick="openPopup()" class="btn btn-primary" >Image</button>
            			  </div>
              	</div>
              </div>
              <div class="row">
                <div class="col-sm-9">
                  <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung bài viết</label>
                        <textarea name="content" class="form-control" id="editor1" placeholder="Content"></textarea>
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
                </div>
              </div>
          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
@endsection
@section('css')
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
<script>
         function Popup() {
             CKFinder.popup( {
                 chooseFiles: true,
                 onInit: function( finder ) {
                     finder.on( 'files:choose', function( evt ) {
                         var file = evt.data.files.first();
                         document.getElementById( 'imaging' ).src = file.getUrl();
                     } );
                     finder.on( 'file:choose:resizedImage', function( evt ) {
                         document.getElementById( 'imaging' ).src = evt.data.resizedUrl;
                     } );
                     finder.on( 'files:choose', function( evt ) {
                         var file = evt.data.files.first();
                         document.getElementById( 'link' ).value = file.getUrl();
                     } );
                     finder.on( 'file:choose:resizedImage', function( evt ) {
                         document.getElementById( 'link' ).value = evt.data.resizedUrl;
                     } );
                 }
             } );
         }
         $(document).ready(function(){
          $('#name').keyup(function(){
            var temp = $('#name').val();
              $.ajax({
                url: "{{ route('slugPost') }}",
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
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script> CKEDITOR.replace('editor1'); </script>
@endsection