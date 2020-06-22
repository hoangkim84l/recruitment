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
          {!! Form::open(array('method' => 'POST', 'action' => 'Scouters\ScoutersController@profile')) !!}
            {{ csrf_field() }}
            <div class="form-group row">
              <label class="col-sm-4 control-label" for="">Full name</label>                    
              <div class="col-sm-8">
                <div class="input text required">
                  <input type="text" name="user_name" id="user-name" class="form-control registry-focus" value="{{$username}}"/>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 control-label" for="">Indentity card number</label>                    
              <div class="col-sm-8">
                <div class="input text required">
                  <input type="text" name="card_number" id="card-number" class="form-control" value="{{$scouter->id_card}}"/>
                </div>
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-sm-4 control-label" for="member-user-email">Date of birth</label>
              <div class="col-sm-8">
                <div id="datepicker" class="input-group date" data-date-format="dd-mm-yyyy"> 
                  <input class="form-control" type="text" name="date_of_birth" value="{{$birth_day}}"> 
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-4 control-label" for="">Phone number</label>                    
              <div class="col-sm-8">
                <input type="number" name="phone_number" id="phone-number" class="form-control" value="{{$scouter->phone_number}}"/>
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-sm-4 control-label" for="">Address</label>                    
              <div class="col-sm-8">
                <input type="text" name="address_user" id="address-user" class="form-control" value="{{$scouter->address}}"/>
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-sm-4 control-label" for="paid-question"></label>
              <div class="col-sm-8">
                <select class="form-control" name="cities" id="paid-question">
                  <option value="{{$city->id}}">{{$city->name_vi}}</option>
                  @foreach($cities as $citi)
                    <option value="{{$citi->id}}">{{$citi->name_vi}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <!-- /div.modal-body -->

            <div class="form-group row padd-bottom">
              <label class="col-sm-4 control-label" for="member-user-name"></label>
              <button type="submit" data-target="#add-update-confirm" class="btn col-sm-8" >Save</button>
            </div>
          {!! Form::close() !!}
			</div>
		</div>
  </div>
</div>
@endsection
