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
        <h3 class="title-h3">Email Setting</h3>
        <div id="edit-success" style="color:#26ae61;text-align:center;font-weight: bold;"></div>
        <div class="margin-bottom-20"></div>
        
        {!! Form::open(array('method' => 'POST', 'onsubmit' => 'return false')) !!}
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="member-user-name">Email</label>                    
            <div class="col-sm-8 padding-zero">
              <div class="input text required">
                <input type="email" name="user_email" id="user-email" class="form-control registry-focus" value="{{$mail}}"/>
              </div>
            </div>
          </div>
          <div class="form-group row pd-none mr-top-bottom">
            <label class="col-sm-4 control-label" for="member-user-name">Receive newsletter</label>
            <label class="switch col-sm-8">
              @if($scouter->email_receive_flg == 1)
                <input id="switch-collapse" type="checkbox" class="btn btn-info" name="checkonoff" checked="checked">
              @else
                <input id="switch-collapse" type="checkbox" class="btn btn-info" name="checkonoff">
              @endif
              <span class="slider round"></span>
            </label>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="member-user-name"></label>
            <button id="btn-account" class="btn col-sm-8" >Save</button>
          </div>
        {!! Form::close() !!}
        
        <div class="margin-bottom-20"></div>
        <h3 class="title-h3">Change password</h3>
        <div id="message-success" style="color:#26ae61;text-align:center;font-weight: bold;"></div>
        <div class="margin-bottom-20"></div>
        
        {!! Form::open(array('method' => 'POST', 'onsubmit' => 'return false')) !!}
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="member-user-name">Current password</label>                    
            <div class="col-sm-8 padding-zero">
              <div class="input text required">
                <input type="password" name="cur_pass" id="current-pass" class="form-control" required="required"/>
              </div>
            </div>
            <div id="message-cur" style="color: red;"></div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="member-user-name">New password</label>
            <div class="col-sm-8 padding-zero">
              <div class="input text required">
                <input type="password" name="new_pass" id="new-pass" class="form-control" required="required"/>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="member-user-name">Confirm password</label>                    
            <div class="col-sm-8 padding-zero">
              <div class="input text required">
                <input type="password" name="conf_pass" id="confirm-pass" class="form-control" required="required"/>
              </div>
            </div>
            <div id="message-con" style="color: red;"></div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="member-user-name"></label>
            <button id="edit-pass" class="btn col-sm-8" >Save</button>
          </div>
        {!! Form::close() !!}
        
        <div class="margin-bottom-20"></div>
        <h3 class="title-h3"> Profile picture</h3>
        {!! Form::open(array('method' => 'POST', 'onsubmit' => 'return false')) !!}
          <div class="form-group row">
            <div class="col-sm-7">
              <div class="margin-bottom-20"></div>
              <input id="result" type="text" />
              <div class="input_file">
                <input type="file" name="avatar" id="file"/>
                <span class="btn btn-brown">Browser</span>
              </div>
            </div>
            <div class="col-sm-5">
              @if($file == 1)
                <img src="{{'/UserProfiles/' . $user->id . '/img/profile-image.png'.'?'.time()}}" id='preview_link_img'>
              @else
                <img src="/img/default-avatar.png" id='preview_link_img'>
              @endif
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="member-user-name"></label>
            <button id="upload-image" class="btn col-sm-8" >Save</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#btn-account").click(function(e) {
      var email = $('#user-email').val();
      var check = $('#switch-collapse').is(":checked");
      
      $.ajax({
        type: 'post',
        url: '/scouters/accountajax',
        dataType: 'json',
        data: {
          email: email,
          check: check,
          _token: '{!! csrf_token() !!}',
        },
        success: function(json) {
          $('#edit-success').html('Edit success.');
          $("#edit-success").css("display", "inline").fadeOut(5000);
        },
        error: function(xhr) {
          alert('Server error.');
        }
      });
    });

    $("#edit-pass").click(function(e) {
      var current_pass = $('#current-pass').val();
      var new_pass = $('#new-pass').val();
      var confirm_pass = $('#confirm-pass').val();
      
      $.ajax({
        type: 'post',
        url: '/scouters/editpassajax',
        dataType: 'json',
        data: {
          current_pass: current_pass,
          new_pass: new_pass,
          confirm_pass: confirm_pass,
          _token: '{!! csrf_token() !!}'
        },
        success: function(json) {
          if(json['data']['ms'] == 3){
            $('#message-cur').html('Incorrect password.');
            $("#message-cur").css("display", "inline").fadeOut(5000);
          } else if (json['data']['ms'] == 1){
            $('#message-success').html('Change password success.');
            $("#message-success").css("display", "inline").fadeOut(5000);
          } else {
            if(json['data']['ms'] == 2){
              $('#message-con').html('The password confirmation does not match.');
              $("#message-con").css("display", "inline").fadeOut(5000);
            }
          }
        },
        error: function(xhr) {
          alert('Server error.');
        }
      });
    });

    $("#file").on('change', function(e) {
      var file = document.querySelector('input[type=file]').files[0];
      var reader = new FileReader();
      reader.onloadend = function() {
        $('#preview_link_img').attr('src', reader.result);
      };
      if (file) {
        reader.readAsDataURL(file);
      }
    });

    $("#upload-image").click(function(e) {
      var file_data = $("#file").prop("files")[0];
      var _token = '{!! csrf_token() !!}';
      var form_data = new FormData();
      form_data.set("file", file_data);
      form_data.set("_token", _token);
      
      $.ajax({
        type: 'post',
        url: '/scouters/fileupajax',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: form_data,
        success: function(json) {
          
        },
        error: function(xhr) {
          
        }
      });
    });
  });
</script>
@endsection


