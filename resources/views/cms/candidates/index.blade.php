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
      <h3>Danh sách ứng viên</h3>     
       <form  action="{{URL::action('Cms\CandidatesController@search')}}" method="POST">
      {{ csrf_field() }}
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Email"><br/>
            <label for="inputEmail4">Họ và tên</label>
              <input type="text" class="form-control" id="name" name="name" placeholder="Họ và tên">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Ngày tạo: Từ ngày</label>
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
       </script><a href="{{ route('candidates.export.file') }}">Xuất file csv</a>
      <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Họ và Tên</th>          
            <th scope="col">Số điện thoại</th>
            <th scope="col">Ngày tạo</th>
            <!-- <th scope="col">Chi tiết</th> -->
            <th scope="col">Xóa</th>
          </tr>
        </thead>
        <tbody>
          @foreach($candidates as $candidate)
          <tr>
            <th scope="row">{{$candidate->id}}</th>
            <td>{{$candidate->email}}</td>
            <td>{{$candidate->name}}</td>
            <td>{{$candidate->phone_number}}</td>
            <td>{{$candidate->created}}</td>
            <!-- <td><a href="{{ URL::to('cms/applies/edit/' . $candidate->id) }}">
             <button type="button" class="btn btn-warning">Xem</button>
           </a>           -->
         </td>
         <td>
         <form action="{{ URL::action('Cms\CandidatesController@destroy', $candidate->id ) }}" method="POST">
           <input type="hidden" name="_method" value="delete">
           <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <input type="submit" class="btn btn-danger" value="Xóa"/>
         </form>
       </td>
     </tr>
     @endforeach   
   </tbody>
 </table>
 {{ $candidates->links() }}
</div>
</div>
</div>          
@endsection