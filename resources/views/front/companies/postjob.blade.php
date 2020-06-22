@extends('layouts.app')
@include('layouts.elements.headerEmployer')
<div class="clearfix"></div>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
	<div class="container">

		<div class="sixteen columns">
			<h2>POST JOB</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>New Job</li>
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
                <div class="panel-body copyform">
                    <form class="form-horizontal" method="post" action="{{ route('company.createjob') }}">
                        {{ csrf_field() }}
                        @if(!isset($job_obj))
                        <input name="_method" type="hidden" value="put" />
                        @endif
                        @if(isset($job_obj))
                        <input type="hidden" name="job_id" value="{{$job_obj->id}}">
                        @endif

                        <input type="hidden" name="company_id" value="{{$company_obj->id}}">
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="job_title" class="col-md-4 control-label">Job Title</label>

                            <div class="col-md-12">
                                @if(isset($job_obj))
                                <input id="job_title" type="text" class="form-control" name="job_title"  value="{{ $job_obj->name }}" required autofocus>
                                @else
                                <input id="job_title" type="text" class="form-control" name="job_title"  value="{{ old('job_title') }}" required autofocus>
                                @endif
                                

                                @if ($errors->has('job_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_type') ? ' has-error' : '' }}">
                            <label for="job_type" class="col-md-4 control-label">Job Type</label>

                            <div class="col-md-12"  class="form-control" >
                                <select  id="job_type" name="job_type">
                                @foreach ($jobtypes as $jobtype)
                                @if(isset($job_obj))
                                    @if($job_obj->job_type_id === $jobtype->id)
                                    <option value="{{ $jobtype->id }}" selected > {{ $jobtype->name }}</option>
                                    @else
                                    <option value="{{ $jobtype->id }}"> {{ $jobtype->name }}</option>
                                    @endif
                                @else
                                    <option value="{{ $jobtype->id }}"> {{ $jobtype->name }}</option>
                                @endif
                                @endforeach
                                </select>

                                @if ($errors->has('job_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_tag') ? ' has-error' : '' }}">
                            <label for="job_tag" class="col-md-4 control-label">Job Tags</label>

                            <div class="col-md-12">
                                <select  id="job_tag" name="job_tag">
                                @foreach ($tags as $tag)
                                @if(isset($job_obj))
                                    @if($job_obj->tags == $tag->id))
                                    <option value="{{ $tag->id }}" selected > {{ $tag->name }}</option>
                                    @else
                                    <option value="{{ $tag->id }}" > {{ $tag->name }}</option>
                                    @endif
                                @else
                                <option value="{{ $tag->id }}" > {{ $tag->name }}</option>
                                @endif
                                @endforeach
                                </select>
                                @if ($errors->has('job_tag'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_tag') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_description') ? ' has-error' : '' }}">
                            <label for="job_description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-12">
                            @if(isset($job_obj))
                                <textarea id="job_description" class="form-control" rows="5" name="job_description" required>{{$job_obj->description}}</textarea>
                            @else
                                <textarea id="job_description" class="form-control" rows="5" name="job_description" required></textarea>
                            @endif
                                @if ($errors->has('job_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('job_requirement') ? ' has-error' : '' }}">
                            <label for="job_requirement" class="col-md-4 control-label">Requirement</label>
                            
                            <div class="col-md-12">
                            @if(isset($job_obj))
                                <textarea id="job_requirement" class="form-control" rows="5" name="job_requirement" required>{{$job_obj->requirement}}</textarea>
                            @else
                                <textarea id="job_requirement" class="form-control" rows="5" name="job_requirement" required></textarea>
                            @endif
                                @if ($errors->has('job_requirement'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_requirement') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_experience') ? ' has-error' : '' }}">
                            <label for="job_experience" class="col-md-4 control-label" >Experience</label>

                            <div class="col-md-12">
                            @if(isset($job_obj))
                                <textarea id="job_experience" class="form-control" rows="4" name="job_experience" required>{{$job_obj->experience}}</textarea>
                            @else
                                <textarea id="job_experience" class="form-control" rows="4" name="job_experience" required></textarea>
                            @endif
                                @if ($errors->has('job_experience'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_experience') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_age') ? ' has-error' : '' }}">
                            <label class="col-md-12 control-label">Age</label>
                                
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2" >
                                        <label for="job_age_from"  class="control-label">From</label>
                                    </div>
                                    
                                    <div class="col-md-6">
                                    @if(isset($job_obj))
                                        <input id="job_age_from" type="number" class="form-control" name="job_age_from" value="{{ $job_obj->age_from }}" required autofocus>
                                    @else
                                        <input id="job_age_from" type="number" class="form-control" name="job_age_from" value="{{ old('job_age_from') }}" required autofocus>
                                    @endif
                                        @if ($errors->has('job_age_from'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('job_age') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <p class="control-label" >Age</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2" >
                                        <label for="job_age_to"  class="control-label">To</label>
                                    </div>
                                    <div class="col-md-6">
                                    @if(isset($job_obj))
                                        <input id="job_age_to" type="number" class="form-control" name="job_age_to" value="{{ $job_obj->age_to }}" required autofocus>
                                    @else
                                        <input id="job_age_to" type="number" class="form-control" name="job_age_to" value="{{ old('job_age_to') }}" required autofocus>
                                    @endif
                                        @if ($errors->has('job_age_to'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('job_age_to') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <p class="control-label">Age</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_worktime') ? ' has-error' : '' }}">
                            <label for="job_worktime" class="col-md-4 control-label">WorkTime</label>

                            <div class="col-md-12">
                            @if(isset($job_obj))
                                <textarea id="job_worktime" class="form-control" rows="5" name="job_worktime" required >{{ $job_obj->working_time }} </textarea>
                            @else
                                <textarea id="job_worktime" class="form-control" rows="5" name="job_worktime" required></textarea>
                            @endif
                                @if ($errors->has('job_worktime'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_worktime') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_address') ? ' has-error' : '' }}">
                            <label for="job_address" class="col-md-4 control-label">Address</label>
                            <div class="col-md-12 row">
                                <div class="col-md-6">
                                @if(isset($job_obj))
                                    <textarea id="job_address" class="form-control" rows="5" name="job_address" required>{{ $job_obj->address }}</textarea>
                                @else
                                    <textarea id="job_address" class="form-control" rows="5" name="job_address" required></textarea>
                                @endif
                                    @if ($errors->has('job_address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('job_address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                <select  id="job_address_city" name="job_address_city">
                                    @foreach ($cities as $city)
                                    @if(isset($job_obj))
                                    @if($job_obj->address_city_id === $city->id)
                                        <option value="{{ $city->id }}" selected > {{ $city->name_vi }}</option>
                                    @else
                                        <option value="{{ $city->id }}"> {{ $city->name_vi }}</option>
                                    @endif
                                    @else
                                        <option value="{{ $city->id }}"> {{ $city->name_vi }}</option>
                                    @endif
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_salary') ? ' has-error' : '' }}">
                            <label class="col-md-12 control-label">Salary</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2" >
                                        <label for="job_salary_from"  class="control-label">From</label>
                                    </div>
                                    <div class="col-md-6">
                                    @if(isset($job_obj))
                                        <input id="job_salary_from" type="number" class="form-control" name="job_salary_from" value="{{ $job_obj->salary_from }}" required autofocus>
                                    @else
                                        <input id="job_salary_from" type="number" class="form-control" name="job_salary_from" value="{{ old('job_salary_from') }}" required autofocus>
                                    @endif
                                        @if ($errors->has('job_salary_from'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('job_salary_from') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <p class="control-label">USD</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2" >
                                        <label for="job_salary_to"  class="control-label">To</label>
                                    </div>
                                    <div class="col-md-6">
                                    @if(isset($job_obj))
                                        <input id="job_salary_to" type="number" class="form-control col-md-6" name="job_salary_to" value="{{ $job_obj->salary_to }}" required autofocus>
                                    @else
                                        <input id="job_salary_to" type="number" class="form-control col-md-6" name="job_salary_to" value="{{ old('job_salary_to') }}" required autofocus>
                                    @endif
                                        @if ($errors->has('job_salary_to'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('job_salary_to') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <p class="control-label">USD</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_bonus') ? ' has-error' : '' }}">
                            <label class="col-md-12 control-label">Bonus</label>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2" >
                                        <label for="job_bonus_from"  class="control-label">From</label>
                                    </div>
                                    <div class="col-md-6">
                                    @if(isset($job_obj))
                                        <input id="job_bonus_from" type="number" class="form-control" name="job_bonus_from" value="{{ $job_obj->bonus_from }}" required autofocus>
                                    @else
                                        <input id="job_bonus_from" type="number" class="form-control" name="job_bonus_from" value="{{ old('job_bonus_from') }}" required autofocus>
                                    @endif
                                        @if ($errors->has('job_bonus_from'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('job_bonus_from') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <p class="control-label">USD</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2" >
                                        <label for="job_bonus_to"  class="control-label">To</label>
                                    </div>
                                    <div class="col-md-6">
                                    @if(isset($job_obj))
                                        <input id="job_bonus_to" type="number" class="form-control col-md-6" name="job_bonus_to" value="{{ $job_obj->bonus_to }}" required autofocus>
                                    @else
                                        <input id="job_bonus_to" type="number" class="form-control col-md-6" name="job_bonus_to" value="{{ old('job_bonus_to') }}" required autofocus>
                                    @endif
                                        @if ($errors->has('job_bonus_to'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('job_bonus_to') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2">
                                        <p class="control-label">USD</p>
                                    </div>
                                </div>
                            </div>    
                        </div>

                        <div class="form-group{{ $errors->has('job_welfare') ? ' has-error' : '' }}">
                            <label for="job_welfare" class="col-md-4 control-label">Welfare</label>

                            <div class="col-md-12">
                            @if(isset($job_obj))
                                <textarea id="job_welfare" class="form-control" rows="5" name="job_welfare" required>{{ $job_obj->welfare }}</textarea>
                            @else
                                <textarea id="job_welfare" class="form-control" rows="5" name="job_welfare" required></textarea>
                            @endif
                                @if ($errors->has('job_welfare'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_welfare') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_email') ? ' has-error' : '' }}">
                            <label for="job_email" class="col-md-4 control-label">Email to Receive Job</label>

                            <div class="col-md-12">
                            @if(isset($job_obj))
                                <input id="job_email" type="email" class="form-control" name="job_email" value="{{  $job_obj->email_receive }}" >
                            @else
                                <input id="job_email" type="email" class="form-control" name="job_email" value="{{ old('job_email') }}" >
                            @endif
                                @if ($errors->has('job_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('job_expired') ? ' has-error' : '' }}">
                            <label for="job_expired" class="col-md-4 control-label">Expired Date</label>

                            <div class="col-md-12">
                            @if(isset($job_obj))
                                <input id="job_expired" type="date" class="form-control" name="job_expired" value="{{ $job_obj->expire_date }}" required>
                            @else
                                <input id="job_expired" type="date" class="form-control" name="job_expired" value="{{ old('job_expired') }}" required>
                            @endif
                                @if ($errors->has('job_expired'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('job_expired') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <center>
                                <div class="col-sm-6 col-md-6">
                                    <label class="col-sm-4 control-label" ></label>
                                    <button type="submit" class="btn col-sm-8 btn-primary" >Save</button>
                                </div>
                                <div class="col-sm-6 col-md-6">
                                    <a data-target="#company-postjob-preview" data-toggle="modal" class="btn col-sm-8 btn-info open-modal getcontent" >Preview</a>
                                </div>
                            </center>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="company-postjob-preview" class="modal" style="z-index:1041;">
  <div class="modal-content at-copyto">

  </div>
</div>

<script type="text/javascript">
    CKEDITOR.replace('job_description');
    CKEDITOR.replace('job_requirement');
    CKEDITOR.replace('job_experience');
    CKEDITOR.replace('job_worktime');
    CKEDITOR.replace('job_welfare');
    CKEDITOR.replace('job_address');
</script>

<!-- SUPPORT BY SUPER PHP DUY VAT -->
<script>
$(document).on('click','.getcontent', function(){
  var html = $('.copyform').html();
  $('.at-copyto').html(html);
  $('.at-copyto .getcontent').remove();
  $('.at-copyto').find('button[type="submit"]').attr('id', 'modal-submit');
  $('.at-copyto').find('input').each(function(index){
    $(this).prop('disabled', true);
    var id_  = $(this).attr('id');
    if (typeof id_ === "undefined") return;
    var val = $('.copyform').find('input#'+id_).val();
    $(this).val(val);
  });
  $('.at-copyto').find('select').each(function(index){
    $(this).prop('disabled', true);
    var id_  = $(this).attr('id');
    var selected_option_val = $('.copyform').find('select#'+id_).find(":selected").val();
    $(this).find("option[value='" + selected_option_val+ "']").attr("selected","selected");
  });
//   $('.at-copyto').find('textarea').each(function(index){
//     $(this).prop('disabled', true);
//     var name_  = $(this).attr('name');
//     if (typeof id_ === "undefined") return;
//     var val = $('.copyform').find('input#'+id_).val();
//     var data = CKEDITOR.instances[id_].getData();
//     console.log(data);
//     // $(this).text($('.copyform').find('textarea#'+id_).text());
//   });
  $('.at-copyto').find('textarea').each(function(index){
    $(this).prop('disabled', true);
    var id_  = $(this).attr('id');
    if (typeof id_ === "undefined") return;
    find_id = 'cke_' +  id_;
    var theframe = $('.copyform').find('#'+ find_id).find('iframe')[0];
    var data = CKEDITOR.instances[id_].getData();
    $(this).next().find('iframe').contents().find('body').html(data);
  });
});

$(document).on('click','button#modal-submit', function(e){
  e.preventDefault();
  $('.copyform').find('button[type="submit"]').click();
  $('#company-postjob-preview').modal('toggle');
});

</script>

@endsection
