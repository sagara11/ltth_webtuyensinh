@extends('adminlte::page')

@section('title', 'IndexData')

@section('content_header')
   <h1>
        Danh sách Banners
        <small>Banners</small>
      </h1>
      {{ Breadcrumbs::render('filterBanner',$key) }}
@endsection
@section('content')
@if (session('success'))
        <div class="alert alert-success">{{session('success')}}</div>
@endif
@if (session('delete'))
        <div class="alert alert-success">{{session('delete')}}</div>
@endif
@if (session('fail'))
        <div class="alert alert-danger">{{session('fail')}}</div>
@endif
@if (session('search'))
        <div class="alert alert-danger">{{session('search')}}</div>
@endif
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Banners</h3>
        </div>
        <div class="dataTables_length">
            <div class="row">
                <div class="col-lg-1">
                    <form style="padding-left: 20px; padding-top: 25px;" action="{{ route('createBanner') }}" method="get" accept-charset="utf-8">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"> </i></button>
                    </form>
                </div> 
                <!-- /.filter -->
                <div class="col-lg-9">
                    <form action="{{ route('methodBanner') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label for="exampleInputEmail1">Tìm Kiếm</label>
                                <input value="{{ isset($search) ? $search : '' }}"  name="name" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Tên Banner...">
                              </div>
                            </div>
                            <div class="form-group col-md-2">
                               <label for="inputState">Position</label>
                                  <select id="postion" class="form-control" name="position">
                                    @if($position!='All')
                                    <option style="display: none;" value="{{$position}}">{{$position}}</option>
                                    @endif
                                    <option class="dropdown-item" value="All">All</option>
                                    <option class="dropdown-item" value="Top">Top</option>
                                    <option class="dropdown-item" value="Banner">Banner</option>
                                    <option class="dropdown-item" value="Sidebar">SideBar</option>
                                    <option class="dropdown-item" value="Sidebar_cate">SideBar_cate</option>
                                  </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">Publish</label>
                                <select class="form-control"  name="publish">
                                    @if($publish!='All')
                                    <option style="display: none;" value="{{$publish}}">{{$publish ? 'ON' : 'OFF'}}</option>
                                    @endif
                                    <option class="dropdown-item" value="All">All</option>
                                    <option class="dropdown-item" value="1">ON</option>
                                    <option class="dropdown-item" value="0">OFF</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary" type="submit" id="search" value="Search" style="margin-top: 24px; padding: 10px 12px; border: 0px" class=" animation-on-hover" type="submit"><i class="fa fa-search"> </i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
<!-- /.method -->
    <form action="{{ route('methodBanner')}}" method ="post">
        @csrf
            <!-- /.box-header -->
            <div style="padding: 0px 28px;" class="box-body ">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-lg-9">
                        
                    </div>
                    <div style="display: flex;" class="col-lg-3">
                        <div>
                            <label>Chọn Tác Vụ</label>
                            <select id="select" name="option" class="form-control">
                                <option value="all">All--</option>
                                <option value="activate">Kích hoạt/Vô hiệu hóa</option>
                                <option value="delete">Xóa</option>
                            </select>
                        </div>
                        <div style="padding-top: 24px;">
                            <input onclick="confirm()" class="btn btn-primary" id="confirm-btn" type="button" value="OK" name="confirm1">
                        </div>
                    </div>
                </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover " >
                    <thead >
                        <tr>
                            <th><input type="checkbox" name="checkall" id="checkall"></th>
                            <th>Ảnh</th>
                            <th>Tên banners</th>
                            <th>Vị Trí</th>
                            <th>Publish</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $row)
                           <tr  id="detail_{{ $row->id }}">
                            <td><input type="checkbox" name="checkbox[]" class="check" value="{{ $row->id }}"></td>   
                            <td style="width: 20%;">
                                <div>
                                    <img style=" max-width: 60%;" src="{{ $row->image }}" alt="">
                                </div>
                            </td>
                            <td><a href="{{ route('editBanner') }}?id={{ $row->id }}" style="color: green">{{ $row->name }}</a></td>
                            <td>{{ $row->position }}</td>
                            <td> 
                                <span style="background-color: {{ $row->publish ? '#4caf50' : '#c41700' }}; color: white; padding: 5px 5px;">{{ $row->publish ? 'ON' : 'OFF' }}</span>
                            </td>
                            <td>{{ $row->updated_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </form>
          </div>
      </div>
        <div class="row">
            <div class="col-sm-5">
                <div class="dataTables_info" id="example1_info" role="status" aria-live="polite"></div>
            </div>
            <div class="col-sm-7">
                <div class="pagination">
                        <tr>{{ $banners->appends($_GET)->links() }}</tr>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="/css/index.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>  
        <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
        <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
        <script>
            $('#checkall').change(function(){
                $(".check").prop("checked",$(this).prop("checked"))
            })
            $(".check").change(function(){
                if($(this).prop("checked")==false){
                    $("#checkall").prop("checked",false)
                }
                if($(".check:checked").length==$(".check").length){
                    $("#checkall").prop("checked",true)
                }
            })
        </script>
        <script type="text/javascript">
            $('#daterange').daterangepicker();
        </script>
        <script>
             $(document).ready(function(){
                $('#destroy').click(function(){
                    Swal.fire(
                      'Oop!!!',
                      'Bạn nên chọn bất kì 1 ô nào đó',
                      'question'
                    )
                });
             });
        </script>
         <script type="text/javascript">
            var checkbox = document.getElementsByClassName('check');
            var confirm_btn = document.getElementById('confirm-btn');
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
                            confirm_btn.type = "submit";
                            $("#confirm-btn").click();
                            $(".swal2-container").css("display","none");
                        })
                        $(".swal2-confirm.swal2-styled").on('click', function() {
                            confirm_btn.type = "button";
                        })
                        }
                     } 
        </script>
@endsection