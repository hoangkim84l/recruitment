@extends('layouts.app')
@include('layouts.elements.headerEmployer')
@section('content')

  <!-- Titlebar
================================================== -->
  <div id="titlebar">
    <div class="container">
      <div class="sixteen columns">
        <h2>{{ trans('label.manager') }} Account</h2>
        <nav id="breadcrumbs">
          <ul>
            <li>You are here:</li>
            <li><a href="#">Home</a></li>
            <li>Account Dashboard</li>
          </ul>
        </nav>
      </div>
    </div>
  </div>

<div class="container">
  <div class="margin-bottom-20">
    @if ($message = Session::get('message'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
      </div>
    @endif
    </div>
  <div class="form-group">
    <!-- Tabs Navigation -->
    <div class="col-sm-3 col-md-3 tab-content-right">
		<ul class="tabs-nav">
			<li><a href="{{ route('company.profile') }}">Profile</a></li>
			<li class="active"><a href="{{ route('company.account') }}">Account</a></li>
            <li><a href="{{ route('candidateindex') }}">Candidates</a></li>
            <li><a href="{{ route('jobindex') }}">Jobs</a></li>
            <li><a href="{{ route('scouterindex') }}">Scouters</a></li>
		</ul>
    </div>

		<!-- Tabs Content -->
		<div class="col-sm-9 tab-content-left">
			<div class="tab-content" id="tab2">
        <h3 class="title-h3"> Email Setting</h3>
        <div class="margin-bottom-20"></div>
        {!! Form::open(array('method' => 'POST', 'action' => 'Companies\CompaniesController@company_account')) !!}
        <input type="hidden" name="company_change_email" id="company-change-email" value="1">
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="company-email">Email</label>                    
            <div class="col-sm-8 padding-zero">
              <div class="input text required">
                <input type="email" name="company_email" id="company-email" class="form-control registry-focus" value=""/>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="btn-save-account"></label>
            <button id="btn-save-account" class="btn col-sm-8" >Save</button>
          </div>
        {!! Form::close() !!}
        
        <div class="margin-bottom-20"></div>
        <h3 class="title-h3">Change password</h3>
        <div class="margin-bottom-20"></div>
        <div id="message-success" style="color:#26ae61;text-align:center;font-weight: bold;padding-bottom: 24px;"></div>
        {!! Form::open(array('method' => 'POST', 'action' => 'Companies\CompaniesController@company_account')) !!}
        <input type="hidden" name="company_change_pass" id="company-change-pass"   value="1">
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="company-current-pass">Current password</label>                    
            <div class="col-sm-8 padding-zero">
              <div class="input text required">
                <input type="password" name="company_current_pass" id="company-current-pass" class="form-control" required="required"/>
              </div>
            </div>
            <div id="message-cur" style="color: red;"></div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="company-new-pass">New password</label>
            <div class="col-sm-8 padding-zero">
              <div class="input text required">
                <input type="password" name="company_new_pass" id="company-new-pass" class="form-control" required="required"/>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="company-confirm-pass">Confirm password</label>                    
            <div class="col-sm-8 padding-zero">
              <div class="input text required">
                <input type="password" name="company_confirm_pass" id="company-confirm-pass" class="form-control" required="required"/>
              </div>
            </div>
            <div id="message-con" style="color: red;"></div>
          </div>
          <div class="form-group row">
            <label class="col-sm-4 control-label" for="btn-edit-pass"></label>
            <button id="btn-edit-pass" class="btn col-sm-8" >Save</button>
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
        success: function(json, status) {
          alert('Edit success!');
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
        success: function(json, status) {
          if(json['data']['ms'] == 0){
            $('#message-cur').html('Incorrect password.');
          } else if (json['data']['ms'] == 1){
            $('#message-success').html('Change password success.');
          } else {
            $('#message-con').html('The password confirmation does not match.');
          }
        },
        error: function(xhr) {
          alert('Server error.');
        }
      });
    });

    $("#file").on('change', function(e) {
      var file_data = $("#file").prop("files")[0];
      var _token = '{!! csrf_token() !!}';
      var form_data = new FormData();
      console.log(form_data);
      form_data.append("file", file_data);
      form_data.append("_token", _token);
      console.log(form_data);

      $.ajax({
        type: "get",
        url: "/scouters/getpathajax",
        dataType: 'json',
        processData: false,
        data: form_data,

        success: function(json, status) {
          alert('ok');
        },
        error: function(xhr) {
          alert('Server error.');
        }
      });
    });
  });
</script>
@endsection


