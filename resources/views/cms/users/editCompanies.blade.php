@extends('./layouts.appcms')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2>Chi tiết Nhà tuyển dụng / Công ty</h2><hr>
      <h3>Hồ sơ <?php if($user->role==1){  echo "Scouter"; }  
      elseif($user->role==2){   echo "Công ty";      }
      else{ echo "Admin";   }     ?></h3>

      <form action="{{URL::action('Cms\UsersController@update')}}" method="POST" enctype="multipart/form-data">
       <input type="hidden" name="id" value="{{$user->id}}">
       {{ csrf_field() }}
       <div class="form-group">
        <label for="name">Tên công ty</label>
        <input type="text" value="{{$companies->name}}" class="form-control" id="userTitle"  name="name" >
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="representative">Người đại diện</label>
            <input type="text" value="{{$companies->representative}}" class="form-control" id="representative"  name="representative" >
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="phone_number">Điện thoại di động</label>
            <input type="text" value="{{$companies->phone_number}}" class="form-control" id="phone_number"  name="phone_number" >
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="address">Địa chỉ</label>
        <input type="text" value="{{$companies->address}}" class="form-control" id="address"  name="address" >
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="title">Website</label>
            <input type="text" value="{{$companies->web_url}}" class="form-control" id="web_url"  name="web_url" >
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="members">Số nhân viên</label>
            <input type="text" value="{{$companies->members}}" class="form-control" id="members"  name="members" >
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="foundation_date">Ngày thành lập</label>
            <input type="text" value="{{$companies->foundation_date}}" class="form-control" readonly="" data-date-format="dd-mm-yyyy" id="datepicker" name="foundation_date" >
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="country_id">Quốc gia</label>
            <select id="country_id" name="country_id" class="form-control">
            <option value="{{$countries->id}}">{{$countries->name}}</option>
              @foreach($contrys as $contry)
              <option value="{{$contry->id}}">{{$contry->name}}</option>
              @endForeach          
            </select>
            </div>
        </div>
      </div>
      <div class="form-group">
        <label for="work_from">Ngày làm việc</label>
         <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="work_from">Từ</label>
                <select id="work_from"  name="work_from" class="form-control">
                <option value="{{$companies->work_from}}">{{$workingDays[$companies->work_from]}}</option>
                  @foreach($workingDays as $key => $workingDay)
                  <option value="{{$key}}">{{$workingDay}}</option>
                  @endForeach          
                </select>
                </div>
            </div>
            <div class="col-md-6">
             <div class="form-group">
              <label for="work_to">Đến</label>
              <select id="work_to"  name="work_to" class="form-control">
              <option value="{{$companies->work_to}}">{{$workingDays[$companies->work_to]}}</option>
                  @foreach($workingDays as $keys => $workDay)
                  <option value="{{$keys}}">{{$workDay}}</option>
                  @endForeach          
              </select>
            </div>
          </div>  
        </div>
      </div>   
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="overtime_id">Thưởng tăng ca</label>
            <select id="overtime_id"  name="overtime_id" class="form-control">
                <option value="{{$companies->overtime_id}}">{{$overtimeTypes[$companies->overtime_id]}}</option>
                  @foreach($overtimeTypes as $keyovertime => $overtime)
                  <option value="{{$keyovertime}}">{{$overtime}}</option>
                  @endForeach          
            </select>
          </div>
        </div>
        <div class="col-md-6">
         <div class="form-group">
          <label for="company_type_id">Loại hình công ty</label>
          <select id="company_type_id"  name="company_type_id" class="form-control">
                <option value="{{$companies->company_type_id}}">{{$companyTypes[$companies->company_type_id]}}</option>
                  @foreach($companyTypes as $keycompany => $company)
                  <option value="{{$keycompany}}">{{$company}}</option>
                  @endForeach          
          </select>
        </div>
      </div>  
    </div>    
    <div class="form-group">
      <label for="description">Về công ty</label>
      <textarea class="form-control" name="description" id="description">{{$companies->description}}</textarea>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="banner_url">Banner photo</label><br/>
          <img src="/files/banner/{{$companies->banner_url}}" style="height: 200px;width: 100%"><br/>
          <br/> 
          <input type="file" name="banner_url" value="{{$companies->banner_url}}">
          <input type="hidden" name="banner" value="{{$companies->banner_url}}">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="logo_url">Company photo</label><br/>
          <img src="/files/avatar/company/{{$companies->logo_url}}" style="height: 200px;width: 200px"><br/>
          <br/> 
          <input type="file" name="logo_url" value="{{$companies->logo_url}}">
          <input type="hidden" name="logo" value="{{$companies->logo_url}}">
        </div>
      </div>
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
  CKEDITOR.replace('description'); 
  </script>
  <br/>
  <hr>
  <h3>Tài khoản <?php if($user->role==1){  echo "Scouter"; }
                      elseif($user->role==2){  echo "Công ty"; }
                      else{ echo "Admin"; } ?></h3>

  <form action="{{URL::action('Cms\UsersController@updateAccount')}}" method="POST">
   <input type="hidden" name="id" value="{{$user->id}}">
   {{ csrf_field() }}
   <div class="form-group">
    <label for="title">Email</label>
    <input type="email" value="{{$user->email}}" class="form-control" id="email"  name="email" >
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" value="{{$user->password}}" class="form-control" id="newPassword" name="newPassword" >
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
<br/>
</div>
</div>
</div>
@endsection