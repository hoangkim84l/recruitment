@extends('layouts.app')
@include('layouts.elements.headerScoter')
@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<span><a href="#">{{$jobs->name}}</a></span>
			<h2>{{$companies->name}} <span class="full-time">{{$jobtypes->name}}</span></h2>
		</div>
		<div class="six columns">
			<a href="#" class="button dark"><i class="fa fa-star"></i> Bookmark</a>
		</div>
	</div>
</div>
<!-- Content
================================================== -->
<div class="container">	
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">		
		<!-- Company Info -->
			<div class="app-content">
				<h4 style="color: red;float: left;">{{ trans('label.introducebonus') }} {{ trans('label.success') }} + {{$jobs->bonus}} $</h4>
				<div class="buttons">
					<ul class="social-icons">
						<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
						<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
						<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
					</ul>
				</div>				
			</div>
		<div class="clearfix"></div>
		<div class="company-info">
			<div class="content">
				<span><a href="#"><i class="fa fa-link"></i> {{$companies->web_url}}</a></span>
				<span><a href="#"><i class="fa fa-twitter"></i> {{$companies->phone_number}}</a></span>
				<span><a href="#">{{$jobs->salary_from}} - {{$jobs->salary_to}} $</a></span>
			</div>
			<div class="clearfix"></div>
		</div>
		@if(!isset($user)) 
			<center><a href="#small-dialog" class="popup-with-zoom-anim button">Ứng tuyển công việc này</a></center>
		@elseif($user->role==1)  
			<center><a href="#small-dialog" class="popup-with-zoom-anim button">{{ trans('label.introducethisjob') }}</a></center>
		@elseif($user->role==2) 
			<center></center>
		@endif
		<br/>
		<h4>{{ trans('label.jobdescription') }}</h4>
		<p class="margin-reset">
		{{strip_tags($jobs->description)}}
		</p>
		<br>
		<h4>{{ trans('label.jobrequiment') }}</h4>
		<p>{{strip_tags($jobs->requirement )}}</p>		
		<br>
		<h4>{{ trans('label.experiencerequi') }}</h4>
		<ul class="list-1">
			<li>{{strip_tags($jobs->experience  )}}</li>
		</ul>
		<br/>
		<h4>{{ trans('label.agerequire') }}</h4>
		<p class="margin-reset">
			{{$jobs->age_from}} - {{$jobs->age_to}}
		</p>
		<br>
		<h4>{{ trans('label.workingtime') }}</h4>
		<p class="margin-reset">
		{{$jobs->working_time }}
		</p>
		<br>

		<h4>{{ trans('label.workingaddress') }}</h4>
		<p class="margin-reset">
		{{$jobs->address  }}
		</p>
		<br>		
		<h4>{{ trans('label.benefits') }}</h4>
		<p class="margin-reset">
		{{$jobs->welfare}}
		</p>
		<br>
	</div>
	@if(!isset($user)) 
			<center><a href="#small-dialog" class="popup-with-zoom-anim button">Ứng tuyển công việc này</a></center>
		@elseif($user->role==1)  
			<center><a href="#small-dialog" class="popup-with-zoom-anim button">{{ trans('label.introducethisjob') }}</a></center>
		@elseif($user->role==2) 
			<center></center>
		@endif
	<br>
	</div>
	<!-- Widgets -->
	<div class="five columns">
		<!-- Sort by -->
		<div class="widget">
			
			<div class="job-overview">				
				<ul>
					<center><img src="/files/avatar/company/{{$companies->logo_url}}" alt="{{$companies->name}}"></center>
					<h4>{{$companies->name}}</h4>
					<li>
						<i class="fa fa-link"></i>
						<div>
							<!-- <strong>Type:</strong> -->
							<span>{{$companyTypes[$companies->company_type_id]}}</span>
						</div>
					</li>
					<li>
						<i class="fa fa-map-marker"></i>
						<div>
							<!-- <strong>Quốc gia:</strong> -->
							<span>{{$city->name_vi}}</span>
						</div>
					</li>
					<li>
						<i class="fa fa-user"></i>
						<div>
							<!-- <strong>Nhân viên:</strong> -->
							<span>{{$companies->members }}</span>
						</div>
					</li>
					<li>
						<i class="fa fa-clock-o"></i>
						<div>
							<!-- <strong>Hours:</strong> -->
							<span>{{$workingDays[$companies->work_from]}} - {{$workingDays[$companies->work_to]}}</span>
						</div>
					</li>
					<li>
						<i class="fa fa-money"></i>
						<div>
							<!-- <strong>Rate:</strong> -->
							<span>{{$overtimeTypes[$companies->overtime_id]}}</span>
						</div>
					</li>
				</ul>
				<a href="{{route('scouterindex')}}" class="popup-with-zoom-anim button">{{ trans('label.morejobofcompany') }}</a>
			</div>
		</div>
	</div>
	<!-- Widgets / End -->
</div>

<div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
	<div class="dialog-headline"></div>
	<div class="small-dialog-content">
		<p><a href="#selsect-dialog" class="popup-with-zoom-anim dialog-a">Choose friends from list</a></p>
		<p><a href="#add-dialog" class="popup-with-zoom-anim dialog-a">Add new friend</a></p>
	</div>					
</div>

<div id="selsect-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
	<div class="small-dialog-headline"><h2>Choose friends from your list</h2></div>
	<div class="small-dialog-content">
		{!! Form::open(array('method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return false')) !!}
      {{ csrf_field() }}
			<select id="email-friend" class="form-control" name="friend" required="required">
				<option value="">Choosen friend</option>
				@if(isset($friends))
					@foreach ($friends as $friend)
						<option value="{{$friend->email}}">{{$friend->name}} ({{$friend->email}})</option>
					@endforeach
				@endif
			</select>
			<div class="divider"></div>
			<button class="send" id="select-friend">Send introduction</button>
		{!! Form::close() !!}
	</div>					
</div>

<div id="add-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
	<div class="small-dialog-headline"><h2>Add new friend</h2></div>
	<div class="small-dialog-content">
		{!! Form::open(array('method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return false')) !!}
      {{ csrf_field() }}
			<input name="name" type="text" id="name-firend" placeholder="Full Name"/>
			<input name="email" type="email" id="mail-friend" placeholder="Email Address" required="required"/>
			<input name="phone" type="text" id="phone-friend" placeholder="Phone number"/>

			<label class="col-sm-4 control-label" for="City">Gender</label>
			<input class="hidden radio-label" type="radio" name="malefe" id="male-button" checked="checked" value="1"/>
			<label class="button-label" for="male-button">Male</label>
			<input class="hidden radio-label" type="radio" name="malefe" id="female-button" value="0"/>
			<label class="button-label" for="female-button">Female</label>

			<select name="cities" id="id-city" required="required">
				<option value="">Choosen city</option>
				@foreach ($cities as $citi)
					<option value="{{$citi->id}}">{{$citi->name_vi}}</option>
				@endforeach
			</select>

			<select name="tag_friend" id="name-tag" required="required">
				<option value="">Choosen IT skill</option>
				@foreach ($tags as $tag)
					<option value="{{$tag->name}}">{{$tag->name}}</option>
				@endforeach
			</select>
			
			<div class="upload-info"><strong>Upload CV (optional)</strong> <span>Max. file size: 5MB</span></div>
			<div class="clearfix"></div>

			<label class="upload-btn">
					<input type="file" id="file" multiple />
					<i class="fa fa-upload"></i> Browse
			</label>
			<span class="fake-input">No file selected</span>
			<div class="divider"></div>
			<button class="send" id="insert-friend">Send introduction</button>
		{!! Form::close() !!}
	</div>
</div>

<div id="message-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
	<div class="dialog-headline"></div>
	<div class="small-dialog-content">
		<p>Introduction has been sent successfully!</p>
		<p>Please tell your friend to check their inbox and apply though that email.</p>
	</div>					
</div>

<script type="text/javascript">
	$(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
		});

		$('#select-friend').click(function(e){
			var email = $("#email-friend option:selected" ).val();
			
			$.ajax({
				type: 'post',
				url: '/viec-lam/chi-tiet/select',
				dataType: 'json',
				data: {
					email: email,
					_token: '{!! csrf_token() !!}'
				},
				success: function(json){
					if(json.status == 'success'){
						$.magnificPopup.open({
							items: {
								src: '#message-dialog', 
								type: 'inline'
							}
						});
					}
				},
				error: function(xhr){
        }
			});
		});

		$('#insert-friend').click(function(e){
			var nameFri = $("#name-firend").val();
			var email = $("#mail-friend").val();
			var phoneFr = $("#phone-friend").val();
			var checkMale = $('#male-button').is(":checked");
			var idCity = $("#id-city option:selected" ).val();
			var nameTag = $("#name-tag option:selected").val();
			var file_data = $("#file").prop("files")[0];
      var _token = '{!! csrf_token() !!}';
			var form_data = new FormData();

			form_data.set("nameFri", nameFri);
			form_data.set("email", email);
			form_data.set("phone", phoneFr);
			form_data.set("checkMale", checkMale);
			form_data.set("idCity", idCity);
			form_data.set("nameTag", nameTag);
      form_data.set("file", file_data);
			form_data.set("_token", _token);
			
			$.ajax({
				type: 'post',
        url: '/viec-lam/chi-tiet/add',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: form_data,

				success: function(json){
					if(json.status == 'success'){
						$.magnificPopup.open({
							items: {
								src: '#message-dialog', 
								type: 'inline'
							}
						});
					}
				},
				error: function(xhr){
        }
			});
		});
	});
</script>
@endsection