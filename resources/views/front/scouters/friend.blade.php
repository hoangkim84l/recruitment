@extends('layouts.app')
@include('layouts.elements.headerScoter')

@section('content')
<div class="container">
  <div class="margin-bottom-20"></div>
  <div>
    <!-- Tabs Navigation -->
    @include('layouts.elements.menuScouter')

		<!-- Tabs Content -->
		<div class="col-sm-9 tab-content-left">
			<div class="tab-content">
        <div class="panel-heading">
            <div class="btn-group pull-right btn-group-xs">
              <button class="btn btn-info btn-xs" id="popupBtn">
                <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>Add new friends
              </button>
              <button class="btn btn-info btn-xs" id="remove-all">
                <i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>Delete choosen friends
              </button>
            </div>
        </div>
        <div class="margin-bottom-20"></div>
        
        <div class="table-responsive users-table">
          <table class="table table-striped table-condensed data-table">
            <thead>
              <tr>
                <th><input type="checkbox" id="select-all"></th>
                <th class="">Full name</th>
                <th class="">Email</th>
                <th class="">Update <i class="fa fa-pencil fa-fw" aria-hidden="true"></th>
                <th class="">Delete</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($friends as $friend)
                @if($friend->delete_flg	== 1)
                  <tr>
                    <td><input type="checkbox" id="{{$friend->id}}"></td>
                    <td>{{$friend->name}}</td>
                    <td><a href="mailto: {{$friend->email}}" title="email">{{$friend->email}}</a></td>
                    <td><a href="{{ URL::to('/scouters/danh-sach-ban-be/' . $friend->id) }}">Edit</a></td>
                    <td>
                      <a href="javascript:void(0)" class="remove-item" id="{{$friend->id}}" data-toggle="tooltip" title="Delete">
                        <i class="fa fa-trash-o fa-fw icon-color" aria-hidden="true"></i>
                      </a>
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="modal-add-friend" class="modal">
  <div class="modal-content">
    <div class="row"><div class="col-sm-2"></div><div class="col-sm-10"><span class="close">&times;</span></div></div>
    {!! Form::open(array('method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
      {{ csrf_field() }}
      <div class="form-group row">
        <label class="col-sm-4 control-label" for="">Full name</label>                    
        <div class="col-sm-8">
          <div class="input text required">
            <input type="text" name="user_name" id="user-name" class="form-control registry-focus"/>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 control-label" for="">Email</label>                    
        <div class="col-sm-8">
          <div class="input text required">
            <input type="email" name="email_friend" id="card-number" class="form-control" required="required"/>
          </div>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 control-label" for="">Phone number</label>                    
        <div class="col-sm-8">
          <input type="number" name="phone_number" id="phone-number" class="form-control"/>
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-4 control-label" for="">Gender</label>                    
        <div class="col-sm-8">
          <input class="hidden radio-label" type="radio" name="malefe" id="male-button" checked="checked" value="1"/>
          <label class="button-label" for="male-button">Male</label>
          <input class="hidden radio-label" type="radio" name="malefe" id="female-button" value="0"/>
          <label class="button-label" for="female-button">Female</label>
        </div>
      </div>
      
      <div class="form-group row">
        <label class="col-sm-4 control-label" for="City">City</label>
        <div class="col-sm-8">
          <select class="form-control" name="cities" required="required">
            <option value="">Choosen city</option>
            @foreach ($cities as $citi)
              <option value="{{$citi->id}}">{{$citi->name_vi}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 control-label" for="IT Skill">IT Skill</label>
        <div class="col-sm-8">
          <select class="form-control" name="tag_friend" required="required">
            <option value="">Choosen IT skill</option>
            @foreach ($tags as $tag)
              <option value="{{$tag->name}}">{{$tag->name}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
      <label class="col-sm-4 control-label" for="itskill">CV (optional)</label>
        <div class="col-sm-8">
          <input id="result" type="text" style="width: 418px;"/>
          <div class="input_file">
            <input type="file" name="file" id="file" onchange="getValue()" required="required"/>
            <span class="btn btn-brown">Browser</span>
          </div>
        </div>
      </div>

      <div class="form-group row padd-bottom">
        <label class="col-sm-4 control-label" for="member-user-name"></label>
        <button type="submit" class="btn col-sm-8" >Save</button>
      </div>
    {!! Form::close() !!}
  </div>
</div>

<script type="text/javascript">
  var modal = document.getElementById('modal-add-friend');
  var btn = document.getElementById("popupBtn");
  var span = document.getElementsByClassName("close")[0];
  
  // When the user clicks on the button, open the modal 
  btn.onclick = function() {
    modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
  }

  function getValue() {
    var file = document.getElementById('file').value;
    document.getElementById('result').value = file;
  }


  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#select-all').click(function(e) {
      if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
          this.checked = true;
        });
      } else {
        $(':checkbox').each(function() {
          this.checked = false;                       
        });
      }
    });

    $('#remove-all').click(function(e) {
      var dataId = [];
      $("input:checkbox").each(function(){
        var $this = $(this);
        if($this.is(":checked")){
          dataId.push($this.attr("id"));
        }
      });
      
      $.ajax({
        type: 'post',
        url: '/scouters/removecheckajax',
        dataType: 'json',
        data: {
          dataId: dataId,
          _token: '{!! csrf_token() !!}'
        },
        success: function(json){
          location.reload()
        },
        error: function(xhr){
          alert('Server error.')
        }
      });
    });

    $('.remove-item').on("click",function(){
        var id =  $(this).attr("id");

        $.ajax({
          type: 'post',
          url: '/scouters/deleteajax',
          dataType: 'json',
          data: {
            id,
            _token: '{!! csrf_token() !!}'
          },
          success: function(json){
            location.reload()
          },
          error: function(xhr){
            alert('Server error.')
          }
        })
    })
  });
</script>
@endsection
