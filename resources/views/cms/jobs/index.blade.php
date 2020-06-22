@extends('./layouts.appcms')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
      @endif
      <h3>Quản lý việc làm</h3>
      <form action="{{URL::action('Cms\JobsController@search')}}" method="POST">
        {{ csrf_field() }}
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Tên việc làm</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Tên việc làm">
          </div>
          <div class="form-group col-md-6">
            <label for="company">Công ty</label>
            <input type="text" class="form-control" id="company" name="company" placeholder="Tên công ty">
          </div>

          <div class="form-group col-md-6">
            <label for="tags">Skill</label>
            <select class="form-control" id="tags" name="tags">
              <option value=""></option>
              @foreach($tags as $tag)
              <option value="{{$tag->name}}">{{$tag->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Ngày tạo: Từ ngày</label>
            <div class='input-group date' >
               <input type='text' id='datestart' class="form-control" value="" name="datestart"/>
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>

          <div class="form-group col-md-6">
            <label for="inputEmail4">Địa điểm</label>
            <select class="form-control" id="sel2" name="cities">
              <option value=""></option>
              @foreach($cities as $city)
              <option value="{{$city->name_vi}}">{{$city->name_vi}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Đến ngày</label>
            <div class='input-group date'>
               <input type='text' id='enddate' class="form-control" value="" name="enddate"/>
              
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-success mb-2">Tìm Kiếm</button>
      </form>
       <script type="text/javascript">
      $(function () {  
        $("#datestart").datepicker();
        $("#enddate").datepicker();
       });
       </script> <a href="{{ route('jobs.export.file') }}">Xuất file csv</a> 
      <br/>
      <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Tên công việc</th>
            <th scope="col">Tên công ty</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Skill</th>
            <th scope="col">Địa điểm</th>
            <th scope="col">Xóa</th>
          </tr>
        </thead>
        <tbody>
          @foreach($jobs as $job)
          <tr>
            <th scope="row">{{$job->ids}}</th>
            <td><a href="{{url('cms/jobs/edit', [$job->ids])}}">{{$job->name}}</a></td>
            <td>{{$job->comName}}</td>
            <td>{{$job->created}}</td>
            <?php $tags_list = json_decode($job->tags);?>
            <td>
            <?php if(is_array($tags_list)):?>
										<?php foreach ($tags_list as $img):?>
											<?php echo $img?> &nbsp;
										<?php endforeach;?>
									<?php endif;?>
            </td>
            <td>{{$job->citiName}}</td>
            <td>        
              <form action="{{ URL::action('Cms\JobsController@destroy', $job->ids ) }}" method="POST">
               <input type="hidden" name="_method" value="delete">
               <input type="hidden" name="_token" value="{{ csrf_token() }}">
               <input type="submit" class="btn btn-danger" value="Xóa"/>
             </form>
           </td>
         </tr>
         @endforeach   
       </tbody>
     </table>
     {{ $jobs->links() }}
   </div>
 </div>
</div>
@endsection
<script type="text/javascript">
  $(function () {
    $('#datetimepicker1').datetimepicker();
  });
</script>