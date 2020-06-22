@extends('layouts.app')
@include('layouts.elements.headerEmployer')
@section('content')

  <!-- Titlebar
================================================== -->
  <div id="titlebar">
    <div class="container">
      <div class="sixteen columns">
        <h2>{{ trans('label.manager') }} Profile</h2>
        <nav id="breadcrumbs">
          <ul>
            <li>You are here:</li>
            <li><a href="#">Home</a></li>
            <li>Profile Dashboard</li>
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
    <div class="col-sm-3 col-md-3 tab-content-right">
      <!-- Tabs Navigation -->
      <ul class="tabs-nav">
        <li class="active"><a href="{{ route('company.profile') }}">Profile</a></li>
        <li><a href="{{ route('company.account') }}">Account</a></li>
        <li><a href="{{ route('candidateindex') }}">Candidates</a></li>
        <li><a href="{{ route('jobindex') }}">Jobs</a></li>
        <li><a href="{{ route('scouterindex') }}">Scouters</a></li>
      </ul>
    </div>
    <!-- Tabs Content -->
   <div class="col-sm-9 col-md-9 tab-content-left">
      <div class="tab-content" id="tab1">
        <div class="" role="document">
          <div class="copyform">
            {!! Form::open(array('method' => 'POST', 'action' => 'Companies\CompaniesController@company_profile', 'enctype'=>"multipart/form-data", 'files'=> true)) !!}
            @if(isset($company_obj))
            <input type="hidden" name="company_id" id="company_id" value="{{$company_obj->id}}">
            @else
            <input name="_method" type="hidden" value="put" />
            @endif
            <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
            {{ csrf_field() }}
            <div class="">
              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Name</label>                    
                <div class="col-sm-8">
                  <div class="input text required">
                  @if (isset($company_obj))
                    <input type="text" name="company_name" id="company-name" class="form-control registry-focus" value="{{$company_obj->name}}">
                  @else
                    <input type="text" name="company_name" id="company-name" class="form-control registry-focus" value="">
                  @endif
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">CEO's Name</label>                    
                <div class="col-sm-8">
                  <div class="input text required">
                  @if (isset($company_obj))
                    <input type="text" name="company_ceo" id="company-ceo" class="form-control"  value="{{$company_obj->representative}}" />
                  @else
                    <input type="text" name="company_ceo" id="company-ceo" class="form-control"  value="" />
                  @endif
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Phone number</label>                    
                <div class="col-sm-8">
                @if (isset($company_obj))
                  <input type="tel" name="company_phone_number" id="company-phone-number" class="form-control" 
                  value="{{$company_obj->phone_number}}" />
                @else
                  <input type="tel" name="company_phone_number" id="company-phone-number" class="form-control" value="" />
                @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Address</label>                    
                <div class="col-sm-8">
                @if (isset($company_obj))
                  <input type="text" name="company_address" id="company-address" class="form-control" 
                  value="{{ $company_obj->address}}" />
                @else
                  <input type="text" name="company_address" id="company-address" class="form-control" value="" />
                @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Website</label>                    
                <div class="col-sm-8">
                @if (isset($company_obj))
                  <input type="text" name="company_website" id="company-website" class="form-control" value="{{$company_obj->web_url}}" />
                @else
                  <input type="text" name="company_website" id="company-website" class="form-control" value="" />
                @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">No. Members</label>                    
                <div class="col-sm-8">
                @if (isset($company_obj))
                  <input type="number" name="company_no_staff" id="company-no-staff" class="form-control" value="{{$company_obj->members}}"/>
                @else
                  <input type="number" name="company_no_staff" id="company-no-staff" class="form-control" value=""/>
                @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Date of Establishment</label>                    
                <div class="col-sm-8">
                @if (isset($company_obj))
                  <input type="date" name="company_date_establishment" id="company-date-establishment" class="form-control" 
                    value="{{$company_obj->foundation_date}}"/>
                @else
                  <input type="date" name="company_date_establishment" id="company-date-establishment" class="form-control" 
                    value=""/>
                @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Country</label>
                <div class="col-sm-8">
                  <select  id="company_country" name="company_country" >
                  @if (isset($company_obj))
                    @foreach ($country_objs as $contry)
                      @if ($contry->id === $company_obj->country_id)
                        <option value="{{ $contry->id }}" selected> {{ $contry->name }}</option>
                      @else
                        <option value="{{ $contry->id }}"> {{ $contry->name }}</option>
                      @endif
                    @endforeach
                  @else
                    @foreach ($country_objs as $contry)
                    <option value="{{ $contry->id }}"> {{ $contry->name }}</option>
                    @endforeach
                  @endif
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 col-md-4 control-label" for="">Workday</label>                    
                <div class="col-sm-8 col-md-8 row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for=company_"work_from">From</label>
                      <select id="company_work_from"  name="company_work_from" class="form-control">
                      @if (isset($company_obj))
                        @foreach($workingDays as $key => $workDay)
                        @if ($key === $company_obj->work_from )
                        <option value="{{$key}}" selected >{{$workDay}}</option>
                        @else
                        <option value="{{$key}}">{{$workDay}}</option>
                        @endif
                        @endForeach          
                      @else
                        @foreach($workingDays as $key => $workDay)
                        <option value="{{$key}}">{{$workDay}}</option>
                        @endForeach
                      @endif
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="company_work_to">To</label>
                      <select id="company_work_to"  name="company_work_to" class="form-control">
                      @if (isset($company_obj))
                      @foreach($workingDays as $key => $workDay)
                        @if ($key === $company_obj->work_to )
                        <option value="{{$key}}" selected >{{$workDay}} </option>
                        @else
                        <option value="{{$key}}">{{$workDay}}</option>
                        @endif
                      @endForeach          
                      @else
                      @foreach($workingDays as $key => $workDay)
                        <option value="{{$key}}">{{$workDay}}</option>
                      @endForeach
                      @endif
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Bonus OT</label>                    
                <div class="col-sm-8">
                <select  id="company_bonus_ot" name= "company_bonus_ot">
                @if (isset($company_obj))
                  @foreach ($overtimeTypes as $keyovertimeType => $overtimeType)
                    @if ($keyovertimeType === $company_obj->overtime_id)
                      <option value="{{ $keyovertimeType }}" selected> {{ $overtimeType }}</option>
                    @else
                      <option value="{{ $keyovertimeType }}"> {{ $overtimeType }}</option>
                    @endif
                  @endforeach
                @else
                  @foreach ($overtimeTypes as $keyovertimeType => $overtimeType)
                  <option value="{{ $keyovertimeType }}"> {{ $overtimeType }}</option>
                  @endforeach
                @endif
                </select>
                </div>
              </div>

              <div class="form-group row"> 
                <label class="col-sm-4 control-label" for="">Company Type</label>                    
                <div class="col-sm-8">
                <select  id="company_type" name="company_type" >
                @if (isset($company_obj))
                  @foreach ($companyTypes as $keycompanyType => $companyType)
                    @if ($keycompanyType === $company_obj->company_type_id)
                      <option value="{{ $keycompanyType }}" selected> {{ $companyType }}</option>
                    @else
                      <option value="{{ $keycompanyType }}"> {{ $companyType }}</option>
                    @endif
                  @endforeach
                @else
                  @foreach ($companyTypes as $keycompanyType => $companyType)
                  <option value="{{ $keycompanyType }}"> {{ $companyType }}</option>
                  @endforeach
                @endif
                </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">About</label>                    
                <div class="col-sm-8">
                @if (isset($company_obj))
                  <textarea id="company-about" class="form-control" rows="5" name="company_about">{{$company_obj->description}}</textarea>
                @else
                  <textarea id="company-about" class="form-control" rows="5" name="company_about"></textarea>
                @endif

                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Social Link</label>                    
                <div class="col-sm-8">
                  <label class="control-label" for="">Facebook</label>
                  @if (isset($company_obj))
                  <input type="text" name="company_facebook" id="company-facebook" class="form-control" value=""/>
                  <br/>
                  <label class="control-label" for="">Google Plus</label>
                  <input type="text" name="company_gplus" id="company-gplus" class="form-control" value=""/>
                  <br/>
                  <label class="control-label" for="">LinkedIn</label>
                  <input type="text" name="company_linkedin" id="company-linkedin" class="form-control" value=""/>
                  @else
                  <input type="text" name="company_facebook" id="company-facebook" class="form-control" value=""/>
                  <br/>
                  <label class="control-label" for="">Google Plus</label>
                  <input type="text" name="company_gplus" id="company-gplus" class="form-control" value=""/>
                  <br/>
                  <label class="control-label" for="">LinkedIn</label>
                  <input type="text" name="company_linkedin" id="company-linkedin" class="form-control" value=""/>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Banner Photo</label>                    
                <div class="col-sm-8">
                @if (isset($company_obj))
                  <img src="/files/banner/{{$company_obj->banner_url}}" id="company-banner-img" style="height:100px;">
                  <input type="text" name="company_banner" id="company-banner" class="form-control" 
                  value="{{$company_obj->banner_url}}"/>
                  <input type="file" name="company_banner_file" value="{{$company_obj->banner_url}}"/>
                @else
                  <img src="" id="company-banner-img" style="height:100px; width:100%">
                  <input type="text" name="company_banner" id="company-banner" class="form-control" value=""/>
                  <input type="file" name="company_banner_file" value=""/>
                @endif
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-4 control-label" for="">Logo</label>                    
                <div class="col-sm-8">
                @if (isset($company_obj))
                  <img src="/files/avatar/company/{{$company_obj->logo_url}}" id="company-logo-img" style="height:100px;">
                  <input type="text" name="company_logo" id="company-logo" class="form-control" 
                    value="{{$company_obj->logo_url}}"/>
                  <input type="file" name="company_logo_file" value="{{$company_obj->logo_url}}"/>
                @else
                  <img src="" id="company-logo-img" style="height:100px; width:100%">
                  <input type="text" name="company_logo" id="company-logo" class="form-control" value=""/>
                  <input type="file" name="company_logo_file" value=""/>
                @endif
                </div>
              </div>
            </div>

            <center class="form-group row">
              <div class="col-sm-6 col-md-6">
                <label class="col-sm-4 control-label" for="member-user-name"></label>
                <button type="submit" class="btn col-sm-8" >Save</button>
              </div>
              <div class="col-sm-6 col-md-6">
                <label class="col-sm-4 control-label" for="member-user-name"></label>
                <a  data-target="#company-profile-preview" data-toggle="modal" class="btn btn-warn col-sm-8 getcontent" >Preview</a>
              </div>
            </center>
            
            {!! Form::close() !!}
            <script type="text/javascript">
              CKEDITOR.replace('company_about');
            </script>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
</div>

<div id="company-profile-preview" class="modal" style="z-index:1041;">
  <div class="modal-content at-copyform">

  </div>
</div>

<!-- SUPPORT BY SUPER PHP DUY VAT -->
<script>
$(document).on('click','.getcontent', function(){
  var html = $('.copyform').html();
  $('.at-copyform').html(html);
  $('.at-copyform .getcontent').remove();
  $('.at-copyform').find('button[type="submit"]').attr('id', 'modal-submit');
  $('.at-copyform').find('input').each(function(index){
    var id_  = $(this).attr('id');
    var is_token = ($(this).attr('name')=='_token')?true:false;
    if ( (typeof id_ === "undefined") && (!is_token) ) {
      return;
    }
    var val = $('.copyform').find('input#'+id_).val();
    if(is_token) {
      val = $('.copyform').find('input[name="_token"]').val();
    }
    $(this).val(val);
    var is_hidden = ($(this).attr('type')=="hidden")?true:false;
    if(!is_hidden){
      $(this).prop('disabled', true);
    }
    
  });
  $('.at-copyform').find('select').each(function(index){
    $(this).attr('disabled', 'disabled');
    var id_  = $(this).attr('id');
    var selected_option_val = $('.copyform').find('select#'+id_).find(":selected").val();
    $(this).find("option[value='" + selected_option_val+ "']").attr("selected","selected");
  });
  $('.at-copyform').find('textarea').each(function(index){
    $(this).prop('disabled', true);
    var id_  = $(this).attr('id');
    if (typeof id_ === "undefined") return;
    find_id = 'cke_' +  id_;
    var theframe = $('.copyform').find('#'+ find_id).find('iframe')[0];
    var data = CKEDITOR.instances[id_].getData();
    $(this).next().find('iframe').contents().find('body').html(data);
  });
});

$(document).on('change','input[type="file"]', function(){
  if (this.files && this.files[0]) {
    var reader = new FileReader();
    var element = $(this);
    reader.onload = function (e,arg=element) {
        arg.parent().children('img').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
    $(this).parent().children('input[type="text"]').val(this.files[0].name);
  }
});

$(document).on('click','button#modal-submit', function(e){
  e.preventDefault();
  $('.copyform').find('button[type="submit"]').click();
  $('#company-profile-preview').modal('toggle');
});
</script>

@endsection
