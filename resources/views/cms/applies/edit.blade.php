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
      <h2>Chi tiết ứng cử viên</h2><hr/>
      <h3>Hồ sơ ứng cử viên</h3>
      <form action="{{URL::action('Cms\AppliesController@update')}}" method="POST" enctype="multipart/form-data">
       <input type="hidden" name="id" value="{{$applies->id}}">
       {{ csrf_field() }}
       <div class="form-group">
        <label for="name">Họ tên</label>
        <input type="text" value="{{$candidates->name}}" class="form-control" id="name"  name="name" >
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" value="{{$candidates->email}}" class="form-control" id="email" name="email" >
      </div>
      <div class="form-group">
        <label for="phone_number">Số điện thoại</label>
        <input type="number" class="form-control" value="{{$candidates->phone_number}}" name="phone_number">
      </div>
      <div class="form-group">
        <label for="description">Giới tính</label>
        <select name="gender" class="form-control">
            <option value="0" <?php if($candidates->gender=="0") echo 'selected="selected"'; ?> >Nam</option>
            <option value="1" <?php if($candidates->gender=="1") echo 'selected="selected"'; ?> >Nữ</option>
        </select>
      </div>
      <div class="form-group">
        <label for="address">Địa điểm làm việc</label>
        <select class="form-control" id="sel2" name="address_city_id">
        <option value="{{$cities->id}}">{{$cities->name_vi}}</option>
          @foreach($citi as $city)
          <option value="{{$city->id}}">{{$city->name_vi}}</option>
          @endForeach            

        </select>
      </div>
      <div class="form-group">
        <label for="description">IT Skill</label>
        <select class="chosen-select form-control" multiple="" name="tags[]">
        <option value="{{$candidates->tags}}" selected>{{$candidates->tags}}</option>
          @foreach($tags as $tag)
          <option value="{{$tag->name}}">{{$tag->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="description">Download CV</label>
        <input type="file" value="$applies->cv_url" class="form-control" name="cv_url" >
        <input type="hidden"  class="form-control" name="cv_url_old" value="{{$applies->cv_url}}">
        <a href="{{$applies->cv_url}}">Dowload cv tại đây</a>
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
      <button type="submit" class="btn btn-primary">lưu</button>
    </form>
    <hr/>
    <h3>Những việc làm đã ứng tuyển</h3>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên công việc</th>
            <th scope="col">Tên công ty</th>
            <th scope="col">Ngày tạo</th>
          </tr>
        </thead>
        <tbody>
          @foreach($jobsApplies as $job)
          <tr>
            <th scope="row">{{$job->jid}}</th>
            <td><a href="{{url('cms/jobs/edit', [$job->jid])}}">{{$job->joName}}</a></td>
            <td>{{$job->comName}}</td>
            <td>{{$job->joCreated}}</td>
         </tr>
         @endforeach   
       </tbody>
     </table>
     {{ $jobsApplies->links() }}
    <hr/>    
    <h3>Scouter đã giới thiệu</h3>
    <div class="form-group">
      <label for="title">Họ tên</label>
      <input type="text" value="{{$users->name}}" readonly class="form-control" id="username"  name="username" >
    </div><hr/>
    <a href="{{url('cms/users/listApplies',[$scouters->id])}}">Xem danh sách những ứng cữ viên do người này giới thiệu</a>
    <br/><br/>
  </div>
</div>
</div>
@endsection      