@extends('./layouts.appcms')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Chi Tiết <?php  if($user->role==1){   echo "Scouter";  }
                          elseif($user->role==2){  echo "Employer";   }
                          else{ echo "Admin";    }    ?></h2><hr/>
      <h3>Hồ sơ  <?php  if($user->role==1){  echo "Scouter";   }
                        elseif($user->role==2){ echo "Employer"; }
                        else{  echo "Admin"; }     ?>
    </h3>
    <form action="{{URL::action('Cms\UsersController@update')}}" method="POST">
      <input type="hidden" name="id" value="{{$user->id}}">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Họ Tên</label>
            <input type="text" value="{{$user->name}}" class="form-control" id="userName"  name="name" >
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="id_card">Số CMND</label>
            <input type="text" value="{{$scouters->id_card}}" class="form-control" id="user_id_card"  name="id_card" >
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div>
            <label for="birth_day">Ngày sinh</label>
            <input class="form-control" data-date-format="dd-mm-yyyy" id="datepicker" value="{{$scouters->birth_day}}" name="birth_day" readonly="" type="text"> 
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="phone_number">Số điện thoại</label>
            <input type="text" value="{{$scouters->phone_number}}" class="form-control" id="userphone_number"  name="phone_number" >
          </div>
        </div>
      </div>  
      <div class="form-group">
        <label for="description">Địa chỉ</label>
        <input type="text" value="{{$scouters->address}}" class="form-control" id="useraddress" name="address" >
        <br/>
        <select class="form-control" id="sel2" name="address_city_id">
        <option value="{{$cities->id}}">{{$cities->name_vi}}</option>
          @foreach($roles as $role)
          <option value="{{$role->id}}">{{$role->name_vi}}</option>
          @endForeach            

        </select>
      </div>
      @if ($errors->any())

      <div class="alert alert-danger">
        <ul>
         @foreach ($errors->all() as $error)

         <li>{{ $error }}</li>
         @endforeach

       </ul>
     </div>
     @endif

     <button type="submit" class="btn btn-primary">Lưu</button>
   </form>
   <script type="text/javascript">
    $(function () {  
      $("#datepicker").datepicker({         
        autoclose: true,         
        todayHighlight: true 
      }).datepicker('update', new Date());
    });
  </script>
  <br/>
  <hr>
  <h3>Tài khoản <?php  if($user->role==1){  echo "Scouter";   }
                        elseif($user->role==2){ echo "Employer"; }
                        else{  echo "Admin"; }     ?></h3>
  <form action="{{URL::action('Cms\UsersController@updateAccount')}}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="{{$user->id}}">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" value="{{$user->email}}" class="form-control" id="email"  name="email" >
        </div>
        <div class="form-group">
          <label for="description">Password</label>
          <input type="password" value="{{$user->password}}" class="form-control" id="newPassword" name="newPassword" >
        </div>
        <div class="form-group">
          <label for="description">Nhận newsletter</label>
          <select name="email_receive_flg" class="form-control">
            <option value="0" <?php if($scouters->email_receive_flg=="0") echo 'selected="selected"'; ?> >Nhận tin</option>
            <option value="1" <?php if($scouters->email_receive_flg=="1") echo 'selected="selected"'; ?> >Không nhận tin</option>
          </select>
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label for="description">Ảnh đại diện</label><br/>
          <center><img title="avatar" src="/files/avatar/scouter/{{$scouters->avatar_url}}" style="height: 200px; width: 200px"></center><br/>
          <input type="file"  class="form-control" name="avatar_url" value="{{$scouters->avatar_url}}">
          <input type="hidden"  class="form-control" name="avatar" value="{{$scouters->avatar_url}}">
        </div>
      </div>
    </div> 

    <button type="submit" class="btn btn-primary">Lưu</button>
  </form>
  <br/>
  <h3>Ứng cử viên đã giới thiệu</h3>
  <a href="{{url('cms/users/listApplies',[$scouters->id])}}"> Xem danh sách ứng cử viên đã giới thiệu</a>
  <br/>
</div>
</div>
</div>
@endsection