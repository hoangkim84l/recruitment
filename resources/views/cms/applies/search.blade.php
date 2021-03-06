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
    @if(isset($details))    
    <form  action="{{URL::action('Cms\AppliesController@search')}}" method="POST">
      {{ csrf_field() }}
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Họ và tên</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên"><br/>
            <label for="inputEmail4">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="email"><br/>
            <label for="inputEmail4">Tên Scouter</label>  
              <input type="text" class="form-control" id="Scouter" name="scouter" placeholder="Scouter"><br/>
            <label for="inputEmail4">Công việc</label>  
              <input type="text" class="form-control" id="jobs" name="jobs" placeholder="Tìm theo tên công việc">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Ngày giới thiệu: Từ ngày</label>
            <div class='input-group date'>
              <input type='text' id='dateintrostart' class="form-control" value="" name="dateintrostart"/>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div><br/>
            <label for="inputPassword4">Đến ngày</label>
            <div class='input-group date'>
              <input type='text' id='dateintroend' class="form-control" value="" name="dateintroend"/>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div><br/>
            <button type="submit" class="btn btn-success mb-2">Tìm Kiếm</button>
          </div>          
        </div>        
      </form>
      <!-- .datepicker("setDate", new Date()) -->
      <script type="text/javascript">
      $(function () {  
        $("#dateintrostart").datepicker();
        $("#dateintroend").datepicker();
       });
       </script>
      <br/><br/>
    <hr/>
    <h3>Thông tin ứng cử viên / Kết quả tìm kiếm {{count($details)}}</h3>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Email</th>
          <th scope="col">Họ và Tên</th>
          <th scope="col">Ngày giới thiệu</th>
          <th scope="col">Scouter</th>
          <th scope="col">Tên công việc</th>
          <th scope="col">Chi tiết</th>
          <th scope="col">Xóa</th>
        </tr>   
      </thead>
      <tbody>
        @foreach($details as $user)
        <tr>
          <th scope="row">{{$user->ids}}</th>
          <td>{{$user->canEmail}}</td>
          <td>{{$user->canName}}</td>
          <td>{{$user->created}}</td>
          <td>{{$user->scouName}}</td>
          <td>{{$user->jobsName}}</td> 
        <td>
         <a href="{{ URL::to('cms/applies/edit/' . $user->ids ) }}">
           <button type="button" class="btn btn-warning">Xem</button>
         </a>
       </td>
       <td>
        <div class="btn-group" role="group" aria-label="Basic example">

         <form action="{{ URL::action('Cms\AppliesController@destroy', $user->ids ) }}" method="POST">
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

