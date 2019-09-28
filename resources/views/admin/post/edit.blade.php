@extends('adminlte::page')

@section('title', 'CreatData')

@section('content_header')
      <h1>
        Thêm bài viết
        <small>Create Courses</small>
      </h1>
      {{Breadcrumbs::render('createPost')}}
@endsection
@include('ckfinder::setup')
@section('content')
@if (session('fail'))
  <div class="alert alert-danger">{{session('fail')}}</div>
@endif
    	<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Detail Courses</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('updatePost') }}" method="post" accept-charset="utf-8">
    			       @csrf
              <div class="box-body">
              	<div class="row">
              		<div class="col-sm-5">
                    <div class="form-group">
                        <label style="color: black;" for="exampleInputEmail1">Tên Bài Viết</label>
                        <input required style="color: black;" type="textbox" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Tên Bài Viết" name="name" value="{{$post->name}}">
                    </div>
		              	<div class="form-group">
		                  <label style="color: black;" for="exampleInputEmail1">Slug</label>
                      <input required style="color: black;" type="textbox" class="form-control" id="" placeholder="slug" name="slug" value="{{$post->slug}}">
		                </div>
                    <div class="form-group">
                      <label style="color: black;" for="exampleInputEmail1"> Miêu tả </label>
                      <textarea required style="color: black;" class="form-control" id="editor" aria-describedby="emailHelp" name="description" placeholder="Miêu tả" value="{{$post->description}}">{{$post->description}}</textarea>
                    </div>
		            </div>
                <div class="col-sm-4">
                    <div class="form-group">
                      <label style="color: black;" for="exampleInputEmail1">Mục Tin </label>
                        <select required style=" color: black ; width: 75%;"id="publish" class="form-control" name="information">
                          <option value="{{$post->categories->id}}" selected="" style="display: none;">{{$post->categories->name}}</option>
                          <option value="All">All--</option>
                            @foreach($categories as $row)
                            {
                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Publish</label>
                      <input checked type="checkbox" name="publish">
                    </div>
                </div>
		            <div class="col-sm-3">
		                <div class="form-group">
                      <label for="exampleInputEmail1">Image</label>
		                  <div id="avatar">
  		            			<img src="{{$post->image}}" class="img-fluid" alt="" id="photo">
  		            			<input required=""  type="hidden" name="image" placeholder="image" id="url" value="{{$post->image}}">
		                	</div>
		                		<button type="button" onclick="openPopup()" class="btn btn-primary" >Image</button>
            			  </div>
              	</div>
              </div>
              <div class="row">
                <div class="col-sm-9">
                      <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung bài viết</label>
                            <textarea name="content" class="form-control" id="editor1" placeholder="Content" value="{{$post->content}}">{{$post->content}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Seo Title</label>
                         <textarea name="seo_title" class="form-control" id="exampleInputEmail1" placeholder="Seo_Title" value="{{$post->seo_title}}">{{$post->seo_title}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Seo Keyword</label>
                         <textarea name="seo_keyword" class="form-control" id="exampleInputEmail1" placeholder="Seo_Keyword" value="{{$post->seo_keyword}}">{{$post->seo_keyword}}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Seo Description</label>
                         <textarea name="seo_description" class="form-control" id="exampleInputEmail1" placeholder="Seo_Content"value="{{$post->seo_description}}">{{$post->seo_description}}</textarea>
                      </div>  
                </div>
              </div>
          </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <input type="hidden" name="getid" value="{{$id}}">
              </div>
            </form>
          </div>
@endsection
@section('css')
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
<script>
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