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
    <div style="padding: 5px 15px;" class="box">
        <div class="box-header">
            <h3 class="box-title">Users</h3>
        </div>
        <div class="dataTables_length">
            <div class="row">
                <form action=" {{ route('methodUser') }} " method="post" accept-charset="utf-8">
                    @csrf
                    <div class="col-sm-1" style="margin-left: 20px">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Publish</label>
                            <select class="form-control" name="publish">
                                @if($publish != 'All')
                                 <option style="display: none;" value="{{$publish}}">{{ $publish == 1 ? 'ON' : 'OFF' }}</option>}
                                @endif
                                <option value="All">--All--</option>
                                <option value="1">ON</option>
                                <option value="0">OFF</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-1" style="margin-left: 20px">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cấp độ</label>
                            <select class="form-control" name="phancap">
                                @if($role != 'All')
                                 <option style="display: none;" value="{{$role}}">{{ $role == 1 ? 'Admin' : 'User' }}</option>}
                                @endif
                                <option value="All">--All--</option>
                                <option value="1">Admin</option>
                                <option value="0">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <input type="text" name="search"
                            placeholder="Ten,SoDT,Email,..."
                            class="form-control"style="margin-top: 25px" value="{{isset($search) ? $search : ''}}">
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
                    <div class="col-sm-8">
                        
                    </div>
                        <div class="col-sm-4">
                            <div id="chontacvu">
                            <label>Chọn Tác Vụ</label>
                            <select class="form-control" name="option">
                                <option value="all">All--</option>
                                <option value="activate">Kích hoạt/Vô hiệu hóa</option>
                                <option value="delete">Xóa</option>
                                <option value="phancap">Phân quyền/Bỏ quyền</option>
                            </select>
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
                            <td>Image</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Phone</td>
                            <td>Publish</td>
                            <td>Cấp Độ</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $temp)
                            <tr id="detail">
                            <td><input type="checkbox" name="checkbox[]" class="check" value="{{ $temp->id }}"></td>
                            <td><img style="height: 80px; width: 100px;" src="{{$temp->avatar  ? $temp->avatar : '/userfiles/images/default_avatar-ea7cf6abde4eec089a4e03cc925d0e893e428b2b6971b12405a9b118c837eaa2.png'}}" alt=""></td>
                            <td>{{ $temp->name }}</td>
                            <td><a href="{{ route('editUser') }}?id={{ $temp->id }}" style="color: green">{{ $temp->email }}</a></td>
                            <td>{{$temp->phone}}</td>
                            <td> 
                                <span style="background-color: {{ $temp->publish ? '#4caf50' : '#c41700' }}; color: white; padding: 5px 5px;">{{ $temp->publish ? 'ON' : 'OFF' }}</span>
                            </td>
                            <td>
                                <span style="background-color: {{ $temp->role_id == 0 ? '#4caf50' : '#c41700' }}; color: white; padding: 5px 5px;">{{ $temp->role_id == 0 ? 'User' : 'Admin' }}</span>
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
    <link rel="stylesheet" type="text/css" href="/css/index.css">
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