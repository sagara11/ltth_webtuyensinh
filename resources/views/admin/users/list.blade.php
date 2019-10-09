@extends('adminlte::page')

@section('title', 'IndexData')

@section('content_header')
   <h1>
        Danh sách User
        <small>User</small>
      </h1>
    {{ Breadcrumbs::render('filterUser',$key) }}
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
            <h3 class="box-title">Users</h3>
        </div>
        <div class="dataTables_length">
            <div class="row">
                <form action=" {{ route('filterUser') }} " method="get" accept-charset="utf-8">
                    <div class="col-sm-1" style="margin-left: 20px">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Publish</label>
                            <select class="form-control" name="publish">
                                @if(isset($publish))
                                    @if($publish != 'All' || $publish == 0)
                                    <option style="display: none;" value="{{ $publish }}">
                                        {{ $publish == 1 ? 'ON' : 'OFF' }}
                                    </option>
                                    @endif
                                    @if($publish == 'All')
                                    <option style="display: none;" value="{{ $publish }}">
                                        --All
                                    </option>
                                    @endif
                                @endif
                                <option value="All">--All</option>
                                <option value="1">ON</option>
                                <option value="0">OFF</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1">
                        <input class="btn btn-success" style="margin-top: 25px" type="submit" value="Search">
                    </div>
                </form>
            </div>
        </div>
    <form action="{{ route('methodUser') }}" method ="post">
        @csrf
            <!-- /.box-header -->
            <div class="box-body ">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-6">
                        
                    </div>
                        <div class="col-sm-6">
                            <div id="chontacvu">
                            <label>Chọn Tác Vụ</label>
                            <select class="form-control" name="option">
                                <option value="all">All--</option>
                                <option value="activate">Activate</option>
                                <option value="delete">Delete</option>
                            </select>
                            <input class="btn btn-success" type="submit" value="OK" id="choose">
                            </div>
                        </div>
                    </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover " >
                    <thead >
                        <tr>
                            <th><input type="checkbox" name="checkall" id="checkall"></th>
                            <td>Image</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Publish</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $temp)
                            <tr id="detail">
                            <td><input type="checkbox" name="checkbox[]" class="check" value="{{ $temp->id }}"></td>
                            <td><img style="height: 80px; width: 100px;" src="{{$temp->avatar}}" alt=""></td>
                            <td>{{ $temp->name }}</td>
                            <td><a href="{{ route('editUser') }}?id={{ $temp->id }}" style="color: green">{{ $temp->email }}</a></td>
                            <td> 
                                <span style="background-color: {{ $temp->publish ? '#4caf50' : '#c41700' }}; color: white; padding: 5px 5px;">{{ $temp->publish ? 'ON' : 'OFF' }}</span>
                            </td>
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
                        <tr>{{ $users->appends($_GET)->links() }}</tr>
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- /.box-body -->
      </div>
@endsection
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/webbanhang/resources/views/style/index.css">
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>  
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
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
@endsection