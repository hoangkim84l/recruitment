@extends('layouts.app')
@include('layouts.elements.headerPage')
<div class="clearfix"></div>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>Employer Account</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>My Account</li>
				</ul>
			</nav>
		</div>

	</div>
</div>


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_type') ? ' has-error' : '' }}">
                            <label for="company_type" class="col-md-4 control-label">Company Type</label>

                            <div class="col-md-6">
                                <select  id="company_type" name="company_type">
                                 @foreach ($companyTypes as $companyType=>$value)
                                    <option value="{{ $companyType }}"> {{ $value }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                            <label for="company_address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6">
                                <input id="company_address" type="text" class="form-control" name="company_address" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_city') ? ' has-error' : '' }}">
                            <label for="company_city" class="col-md-4 control-label">Province/City</label>

                            <div class="col-md-6">
                                <select id="company_address_city" name="company_address_city" >
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}"> {{ $city->name_vi }}</option>
                                @endforeach
                                   
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('company_phone') ? ' has-error' : '' }}">
                            <label for="company_phone" class="col-md-4 control-label">Phone No.</label>

                            <div class="col-md-6">
                                <input id="company_phone" type="tel" class="form-control" name="company_phone" value="{{ old('company_phone') }}" required autofocus>

                                @if ($errors->has('company_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
