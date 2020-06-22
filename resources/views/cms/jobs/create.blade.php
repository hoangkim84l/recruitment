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
      <h2>Chi tiết việc làm</h2>
      <hr/>
      <h3>Công ty</h3>
      <form action="{{URL::action('Cms\JobsController@create')}}" method="POST">
       <input type="hidden" name="id" value="{{$companies->id}}">
       {{ csrf_field() }}
       <div class="form-group">
        <label for="title">Tên công ty</label>
        <input type="text" value="{{$companies->name}}" class="form-control" id="nameComp"  name="nameComp" >
      </div>
      <div class="form-group">
        <label for="representative">Người đại diện</label>
        <input type="text" value="{{$companies->representative }}" class="form-control" id="representative" name="representative" >
      </div>
      <hr/>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="name">Tên công việc</label>
            <input type="text" value="{{$jobs->name}}" class="form-control" id="name" name="name" >
          </div>
        </div>    
        <div class="col-md-6">
          <div class="form-group">
            <label for="description">Loại hình công việc</label>
            <select class="form-control" name="job_type_id">
            <option value="{{$jobtypes->id}}">{{$jobtypes->name}}</option>
              @foreach($jobstypes as $jobstype)
              <option value="{{$jobstype->id}}">{{$jobstype->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="description">Job tags</label>
        <select class="chosen-select form-control" multiple="" name="tags[]">
        <option value="{{$jobs->tags}}" selected>{{$jobs->tags}}</option>
          @foreach($tags as $tag)
          <option value="{{$tag->name}}">{{$tag->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label for="description">Mô tả công việc</label>
        <textarea class="form-control" id="description" name="description">{{$jobs->description}}</textarea>
      </div>
      <div class="form-group">
        <label for="requirement">Yêu cầu công việc</label>
        <textarea class="form-control" id="requirement" name="requirement">{{$jobs->requirement}}</textarea>
      </div>
      <div class="form-group">
        <label for="experience">Yêu cầu kinh nghiệm</label>
        <textarea class="form-control" id="experience" name="experience">{{$jobs->experience}}</textarea>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="age_from">Yêu cầu độ tuổi: Từ</label>
            <input type="text" value="{{$jobs->age_from}}" class="form-control" id="age_from" name="age_from" >
          </div>
        </div>    
        <div class="col-md-6">
          <div class="form-group">
            <label for="age_to">Đến</label>
            <input type="text" value="{{$jobs->age_to}}" class="form-control" id="age_to" name="age_to" >
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="working_time">Thời gian làm việc</label>
        <textarea class="form-control" name="working_time">{{$jobs->working_time}}</textarea>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="address">Địa điểm làm việc</label>
            <input type="text" value="{{$jobs->address}}" class="form-control" id="address" name="address" >
          </div>
        </div>    
        <div class="col-md-6">
          <div class="form-group">
            <label for="description">Địa điểm làm việc</label>
            <select class="form-control" name="address_city_id" id="address_city_id">
            <option value="{{$city->id}}">{{$city->name_vi}}</option>
              @foreach($cities as $citi)
              <option value="{{$citi->id}}">{{$citi->name_vi}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>      
      <div class="form-group">
        <label for="welfare">Chế độ phúc lợi</label>
        <textarea class="form-control" name="welfare">{{$jobs->welfare}}</textarea>
      </div>
      <div class="form-group">
        <label for="email_receive">Email nhận thông tin ứng tuyển</label>
        <input type="email" value="{{$jobs->email_receive}}" class="form-control" id="email_receive" name="email_receive" >
      </div>
      <div class="form-group">
        <label for="expire_date">Ngày hết hạn</label>
        <input type="text" value="{{$jobs->expire_date}}" class="form-control" id="datepicker1" readonly="" name="expire_date" >
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
      <button type="submit" class="btn btn-default">Xóa</button>
    </form><br/>
    <script type="text/javascript">
      CKEDITOR.replace('description');
      CKEDITOR.replace('requirement');
      CKEDITOR.replace('experience');
      $(function () {  
        $("#datepicker1").datepicker({         
         autoclose: true,         
         todayHighlight: true 
       }).datepicker();
      });
    </script>
    <br/>
  </div>
</div>
</div>
@endsection    