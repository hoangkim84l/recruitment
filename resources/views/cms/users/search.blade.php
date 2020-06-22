@extends('./layouts.appcms')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if ($message = Session::get('message'))
     <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
      </div>
     @endif
      <form action="{{URL::action('Cms\UsersController@search')}}" method="POST">
         {{ csrf_field() }}
        <div class="form-row">
           <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email" placeholder="email">
          </div>
          <div class="form-group col-md-6">
            <label for="name">Họ tên</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="name">
          </div>
         
          <div class="form-group col-md-6">
            <label for="inputEmail4">Role</label>
            <select class="form-control" id="role" name="role">
              <option></option>
              <option value="3">Admin</option>
              <option value="1">Scouter</option>
              <option value="3">Employer</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                   <label for="inputPassword4">Ngày tạo: Từ ngày</label>
                   <div class='input-group date' >
                      <input type='text' class="form-control" data-provide="datepicker" readonly="" value="" data-date-format="dd-mm-yyyy" id="startdate" name="created_from" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                   <label for="inputPassword4">Đến ngày</label>
                   <div class='input-group date'>
                      <input type='text' class="form-control" readonly="" value="" data-date-format="dd-mm-yyyy" id="enddate" name="created_to" />
                      <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                    </div>
                </div>
              </div>
            </div>

           </div> 
        </div>
        <button type="submit" class="btn btn-success mb-2">Tìm Kiếm</button>
      </form>
      <!-- 'update', new Date() -->
      <script type="text/javascript">
      $(function () {  
        $("#startdate").datepicker({      
                
           todayHighlight: true 
        }).datepicker();
        $("#enddate").datepicker({         
           autoclose: true,         
           todayHighlight: true 
        }).datepicker();
     });
     </script>      
    @if(isset($details))  
    <h3>Thông tin người dùng  / Kết quả tìm kiếm {{count($details)}}</h3> | <a href="{{ route('users.export.file') }}">Xuất file csv</a> 
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Email</th>
          <th scope="col">Họ và Tên</th>
          <th scope="col">Ngày tạo</th>
          <th scope="col">Role</th>
          <th scope="col">Chi tiết</th>
          <th scope="col">Xóa</th>
        </tr>   
      </thead>
      <tbody>
        @foreach($details as $user)
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td>{{$user->email}}</td>
          <td>{{$user->name}}</td>
          
          <td>{{$user->created}}</td>
          <td><?php if($user->role==1){ echo "Scouter";      }
          elseif($user->role==2){ echo "Employer";      }
          else{echo "Admin";       }         ?>           
        </td>
        <td>
         <a href="{{ URL::to('cms/users/edit/' . $user->id ) }}">
           <button type="button" class="btn btn-warning">Xem</button>
         </a>
       </td>
       <td>
        <div class="btn-group" role="group" aria-label="Basic example">

         <form action="{{ URL::action('Cms\UsersController@destroy', $user->id ) }}" method="POST">
           <input type="hidden" name="_method" value="delete">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <input type="submit" class="btn btn-danger" value="Xóa"/>
         </form>
       </div>
     </td>
   </tr>
   @endforeach
 </tbody>
</table>
@endif
</div>
</div>
</div> 
@endsection

