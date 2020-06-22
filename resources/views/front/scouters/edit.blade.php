@extends('layouts.app')
@include('layouts.elements.headerScoter')

<div class="container">
  <div class="margin-bottom-20"></div>
  <div>
    <!-- Tabs Navigation -->
		<ul class="tabs-nav col-sm-3">
			<li><a href="{{ route('profile') }}">Profile</a></li>
			<li><a href="{{ route('account') }}">Account</a></li>
			<li class="active"><a href="{{ route('friend') }}">Friends list</a></li>
      <li><a href="">Introduction list</a></li>
			<li><a href="">Browse jobs</a></li>
		</ul>

		<!-- Tabs Content -->
		<div class="col-sm-9 tab-content-left">
			<div class="tab-content">
        <div id="page-wrapper" style="padding: 0">
					{!! Form::open(array('method' => 'POST', 'enctype' => 'multipart/form-data')) !!}
						<div class="form-group row">
							<label class="col-sm-4 control-label" for="">Full name</label>                    
							<div class="col-sm-8">
								<div class="input text required">
									<input type="text" name="user_name" id="user-name" class="form-control registry-focus" value="{{$friend->name}}"/>
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-4 control-label" for="">Email</label>                    
							<div class="col-sm-8">
								<div class="input text required">
									<input type="email" name="email_friend" id="card-number" class="form-control" value="{{$friend->email}}"/> 
								</div>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-4 control-label" for="">Phone number</label>                    
							<div class="col-sm-8">
								<input type="number" name="phone_number" id="phone-number" class="form-control" value="{{$friend->phone_number}}"/>
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4 control-label" for="">Gender</label>                    
							<div class="col-sm-8">
								@if ($friend->gender == 1)
									<input class="hidden radio-label" type="radio" name="malefe" id="male-button" value="1" checked="checked"/>
									<label class="button-label" for="male-button">Male</label>
									<input class="hidden radio-label" type="radio" name="malefe" id="female-button" value="0"/>
									<label class="button-label" for="female-button">Female</label>
								@else
									<input class="hidden radio-label" type="radio" name="malefe" id="male-button" value="1"/>
									<label class="button-label" for="male-button">Male</label>
									<input class="hidden radio-label" type="radio" name="malefe" id="female-button" value="0" checked="checked"/>
									<label class="button-label" for="female-button">Female</label>
								@endif
							</div>
						</div>
						
						<div class="form-group row">
							<label class="col-sm-4 control-label" for="paid-question">City</label>
							<div class="col-sm-8">
								<select class="form-control" name="cities" id="paid-question" required="required">
									<option value="{{$city->id}}">{{$city->name_vi}}</option>
									@foreach($cities as $citi)
										<option value="{{$citi->id}}">{{$citi->name_vi}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label class="col-sm-4 control-label" for="paid-question">IT Skill</label>
							<div class="col-sm-8">
								<select class="form-control" name="tag_friend" id="paid-question" required="required">
									<option value="{{$friend->tags}}">{{$friend->tags}}</option>
									@foreach ($tags as $tag)
										<option value="{{$tag->name}}">{{$tag->name}}</option>
									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
						<label class="col-sm-4 control-label" for="itskill">CV (optional)</label>
							<div class="col-sm-8">
								<input id="result" type="text" style="width: 333px;" placeholder="{{$friend->cv_url}}"/>
								<div class="input_file">
									<input type="file" name="file" id="file" onchange="getValue(this)"/>
									<span class="btn btn-brown">Browser</span>
								</div>
							</div>
						</div>

						<div class="form-group row padd-bottom">
							<label class="col-sm-4 control-label" for="member-user-name"></label>
							<button type="submit" data-target="#add-update-confirm" class="btn col-sm-8" >Save</button>
						</div>
					{!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
