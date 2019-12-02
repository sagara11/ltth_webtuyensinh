@extends('adminlte::page')

@section('title', 'IndexData')

@section('content_header')
<h1>
  Danh sách Comment
  <small>Comment</small>
</h1>
{{Breadcrumbs::render('index_newComment')}}
@endsection
@section('content')
@if (session('success'))
<div class="alert alert-success">{{session('success')}}</div>
@endif
@if (session('fail'))
<div class="alert alert-danger">{{session('fail')}}</div>
@endif
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Comment</h3>
  </div>
  <div class="dataTables_length">
    <div class="row">
      <div class="col-lg-1">

      </div> 
      <div class="col-lg-9">
        <form action="{{ route('index_newComment') }}" method="get" accept-charset="utf-8">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="exampleInputEmail1">Phần bình luận của bài báo : </label>
                <select name="post_id" class="form-control">
                  <option style="display: none;" value="{{$name ? $name : 'All'}}">{{$name ? $name : 'All'}}</option>
                  <option value="All">--All--</option>
                  @foreach($post as $row)
                  <option value="{{$row->id}}">{{$row->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <button class="btn btn-primary" type="submit" id="search" value="Search" style="margin-top: 24px; padding: 10px 12px; border: 0px" class=" animation-on-hover" type="submit"><i class="fa fa-search"> </i></button>
            </div>
          </div>
        </form>
      </div>
      <form action="{{ route('activate_newComment')}}" method ="post">
        @csrf
        <div class="col-lg-2">
          <div style="width: 100%;">
            <input onclick="confirm()" style="margin-top: 20px" class="btn btn-primary" type="button" id="activate" value="Kích hoạt/Vô Hiệu Hóa">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- comment -->
  <div>
    <div>
      <p style="display: none;">{{$i=1}}</p>
      @foreach($comments as $rows)
      <div style="border-top: 1px solid rgb(220,220,220); padding: 5px 0px" class=" father-contain">
        
        <div style="display: flex; justify-content: space-between;"> 
          <div>
            <b>
              {{ $rows->user->name }}
            </b>
          </div>
          <div class="likes-reply">
            <p>
              <span>
                {{$rows->created_at}}
              </span>
            </p>
          </div>
          <div style="background-color: {{ $rows->publish ? '#4caf50' : '#c41700' }}; color: white; padding: 5px 5px;">{{ $rows->publish ? 'ON' : 'OFF' }}</div>

        </div>
        <div style="display: flex;"class="comment">
          <input style="margin-right: 5px;" type="checkbox" name="checkbox[]" id="checkall{{$i}}" class="checkall checkall{{$i}}" data-number="{{$i}}" value="{{$rows->id}}"> 
          <div style="width: fit-content;">
            <img style="border-radius: 20px;" 
            height="40px"
            width="40px" 
            class="father-img"
            src="{{ $rows->user->avatar }}"
            alt=""
            />
          </div>
          <div style="width: 80%;">
            <div style="margin-right:10px;padding: 5px 10px; border-radius: 15px; background-color: rgb(220, 220, 220);" class="content1">
              <p style="font-size: 20px; margin: 0px 0px">
                {{ $rows->comment }}
              </p>
            </div>
            <div>
              <p>
                <small><b>Bài viết:</b> {{ $rows->post->name }}</small>
              </p>
            </div>
          </div>
          <!-- <div style="position: absolute; left: 700px; background-color: {{ $rows->publish ? '#4caf50' : '#c41700' }}; color: white; padding: 5px 5px;">{{ $rows->publish ? 'ON' : 'OFF' }}</div> -->
        </div>
      <input type="hidden" name="id" value="{{$rows->post_id ? $rows->post_id : ''}}">
      <p style="display: none;">{{$i++}}</p>
      <p style="display: none;">{{$x++}}</p>
      @endforeach
    </form>
  </div>
  </div>
</div>
<div class="row">
  <div class="col-sm-5">
    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite"></div>
  </div>
  <div class="col-sm-7">
    <div class="pagination">
      <tr>{{ $comments->appends($_GET)->links() }}</tr>
    </div>
  </div>
</div>
</div>
</div>
<!-- /.box-body -->
</div>
@endsection
@section('css')
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
/>
   <!--  <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous"
            /> -->
            <link rel="stylesheet" type="text/css" href="/css/list-comment3.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            @endsection

            @section('js')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>  
            <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
            <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
            <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
            <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"
            ></script>
            <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"
            ></script>
            <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"
            ></script>
            <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
            <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
            <script>
              var number = 0;
              var childnumber = 0;

              $('.content').on('click', '.checkall', function getNumber (){
                number = this.dataset.number;
                $(".check"+number).prop("checked",$(this).prop("checked"))

              });



            // $('#checkall').change(function(){
            //     $(".check").prop("checked",$(this).prop("checked"))
            // })

            $('.content').on('click', '.check', function deselectCheckall (){
              childnumber = this.dataset.childnumber;
              if($(this).prop("checked")==false){
                $(".checkall"+childnumber).prop("checked",false)
              }
              if($(".check:checked").length==$(".check").length){
                $(".checkall"+childnumber).prop("checked",true)
              }
            });

            // $(".check").change(function(){
            //     if($(this).prop("checked")==false){
            //         $("#checkall").prop("checked",false)
            //     }
            //     if($(".check:checked").length==$(".check").length){
            //         $("#checkall").prop("checked",true)
            //     }
            // })

          </script>
          <script type="text/javascript">
            $('#daterange').daterangepicker();
          </script>
          <script type="text/javascript">
            var checkbox = document.getElementsByClassName('check');
            var activate = document.getElementById('activate');
            var values = new Array();
            
            function confirm(){
              values = [];
              $.each($("input[name='checkbox[]']:checked"), function() {
                values.push($(this).val());
              });
              if(values.length == 0){
                Swal.fire({
                  type: 'error',
                  title: 'Lỗi...',
                  text: 'Bạn chưa chọn ô nào',
                })
              }
              else{
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Confirm'
                }).then((result) => {
                  if (result.value) {
                    Swal.fire(
                      'Completed!',
                      'success'
                      )
                  }
                  else if (result.dismiss === Swal.DismissReason.cancel) {

                  }
                })
                $(".swal2-confirm.swal2-styled").on('click', function() {
                  activate.type = "submit";
                  $("#activate").click();
                  $(".swal2-container").css("display","none");
                })
                $(".swal2-confirm.swal2-styled").on('click', function() {
                  activate.type = "button";
                })
              }
            } 
          </script>
          @endsection