@extends('adminlte::page')

@section('title', 'IndexData')

@section('content_header')
   <h1>
        Danh sách bài viết
        <small>Post</small>
      </h1>
      {{ Breadcrumbs::render('filterPost',$key) }}
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
            <h3 class="box-title">Post</h3>
        </div>
        <div class="dataTables_length">
            <div class="row">
                <div class="col-lg-1">
                    <form style="padding-left: 20px; padding-top: 25px;" action="{{ route('createPost') }}" method="get" accept-charset="utf-8">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-plus"> </i></button>
                    </form>
                </div> 
                <div class="col-lg-11">
                    <form action="{{ route('methodPost') }}" method="post" accept-charset="utf-8">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                    <label for="exampleInputEmail1">Tìm Kiếm</label>
                                    <input value="{{ isset($search) ? $search : '' }}"  name="search" type="text" class="form-control" id="name" aria-describedby="emailHelp" placeholder="">
                              </div>
                            </div>
                            <div class="form-group col-md-2">
                               <label style="color: black;" for="exampleInputEmail1">Mục Tin </label>
                                    <select style=" color: black ; width: 100%;"id="publish" class="form-control" name="categories">
                                        <option selected style="display: none" class="dropdown-item" value="{{ $id }}">{{ $id }}</option>
                                        <option value="All">All</option>
                                        @foreach($categories as $row)
                                        {
                                            <option value="{{ $row->id }}">{{ $row->name }}</option>
                                        }
                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputState">Updated_at</label>
                                <input value="" id="daterange" type="text" class="form-control" name="date">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" type="submit" id="search" value="Search" style="margin-top: 24px; padding: 10px 12px; border: 0px" class=" animation-on-hover" type="submit"><i class="fa fa-search"> </i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    <form action="{{ route('methodPost')}}" method ="post">
        @csrf
            <!-- /.box-header -->
            <div class="box-body ">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-lg-9">
                        
                    </div>
                    <div class="col-lg-3">
                        <label>Chọn Tác Vụ</label>
                        <select name="option" class="form-control">
                            <option value="all">All--</option>
                            <option value="activate">Activate</option>
                            <option value="delete">Delete</option>
                        </select>
                        <input class="btn btn-primary" type="submit" value="OK" style="margin-left: 20px">
                    </div>
                </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover " >
                    <thead >
                        <tr>
                            <th><input type="checkbox" name="checkall" id="checkall"></th>
                            <th>Ảnh</th>
                            <th>Bài Viết</th>
                            <th>Mô Tả</th>
                            <th>Publish</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $temp)
                            <td><input type="checkbox" name="checkbox[]" class="check" value="{{ $temp['id'] }}"></td>
                               <td>
                                <div style="width: 90px;height: 90px;">
                                    <img style="max-width: 100%; max-height: 100%" src="{{$temp['image']}}" alt="">
                                </div>
                                </td>
                                <td><a href="{{ route('editPost') }}?id={{ $temp['id'] }}" style="color: green">{{ $temp['name'] }}</a></td>
                                <td>{{$temp['description']}}</td>
                                <td> 
                                    <span style="background-color: {{ $temp['publish'] ? '#4caf50' : '#c41700' }}; color: white; padding: 5px 5px;">{{ $temp['publish'] ? 'ON' : 'OFF' }}</span>
                                </td>
                                <td>{{ $temp['updated_at'] }}</td>
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
         <meta name="csrf_token" content="{{ csrf_token() }}" />
        <script>$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')} })
        </script>
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
@endsection