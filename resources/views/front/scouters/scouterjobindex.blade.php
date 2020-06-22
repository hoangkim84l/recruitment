@extends('layouts.app')
@include('layouts.elements.headerScoter')
@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<span>{{ trans('label.have') }} {{count($jobs)}} {{ trans('label.jobs') }}</span>
			<h2>{{ trans('label.jobs') }} {{ trans('label.it') }}</h2>
		</div>
	</div>
</div>
<!-- Content
================================================== -->
<div class="container">
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">		
		<form action="{{route('scouterjobsearch')}}" method="get" class="list-search" style="margin-bottom: 0px !important;">			
			<div class="double-third column widget" style="padding-top: 57px;">
				<input type="text" name="name" title="Nhập IT Skill, Tên việc làm, Tên công ty" placeholder="Nhập tên việc làm" value=""  style="height: 47px;"/>				
			</div>
			<!-- Location -->
			<div class="double-third column widget" style="padding-top:57px;">	
			<input type="text" name="city" title="Nhập thành phố" placeholder="Nhập thành phố" value=""  style="height: 47px;"/>
			</div>	
			<button type="submit" class="btn btn-success mb-2" style="padding-top: 10px; height: 45px; width: 100px; margin-top: 0px;">{{ trans('label.search') }}</button>
			<!-- <a href="{{URL::action('Scouters\JobsController@search')}}" type="submit" class="button" style="padding-top:10px;margin-top: 3px;">{{ trans('label.search') }}</a>			 -->
				<div class="clearfix"></div>
		</form>
		<ul class="job-list full">
			@foreach($jobs as $job)
			<li><a href="{{ URL::to('/viec-lam/chi-tiet/'.$job->ids) }}" id="customaLink">
				<img src="{{$pathCompany[1]}}{{$job->logo_url}}" alt="{{$job->comName}}" title="{{$job->comName}}" id="companyLogo">
				<div class="job-list-content">
					<h4 id="nameJob">{{$job->name}}<br/></h4>
						<h4><span class="full-time">{{$job->typename}}</span></h4>
						<div class="job-icons">
						<?php $tags_list = json_decode($job->tags);?>
							<span><i class="fa fa-briefcase"></i> 
							<?php if(is_array($tags_list)):?>
									<?php foreach ($tags_list as $tagsName):?>
											<?php echo $tagsName?>&nbsp;
											<?php endforeach;?>
							<?php endif;?>
							</span>
							<span><i class="fa fa-map-marker"></i> {{$job->address}}</span>
							<span><i class="fa fa-money"></i>{{$job->salary_from}} - {{$job->salary_to}} $</span>
						</div>
					<p id="customDescription">{{ strip_tags($job->description)}}</p>
				</div>
				</a>
				<span id="customBonus">
					{{ trans('label.introducebonus') }}<br/> {{ trans('label.success') }}<br/>
					+ {{$job->bonus}} $
					<br/>
					<br/>
					<h4><span class="freelance">Bookmarrk</span></h4>
				</span>	
				<div class="clearfix"></div>
			</li>
			@endforeach
		</ul>
		<div class="clearfix"></div>

		<div class="pagination-container">
		{{ $jobs->links() }}
		</div>

	</div>
	</div>
	<!-- Widgets -->
	<div class="five columns">
		<!-- Sort by -->
		<div class="widget">
			<h4>{{ trans('label.Sortby') }}</h4>
			<!-- Select -->
			<select data-placeholder="Choose Category" name="sortBy" id="elementId" class="chosen-select-no-single">
				<option  value="newest">{{ trans('label.newest') }}</option>
				<option value="oldest">{{ trans('label.oldest') }}</option>
				<option value="hightsalary">{{ trans('label.hightsalary') }}</option>
				<option value="hightbonus">{{ trans('label.hightbonus') }}</option>
			</select>
		</div>
		<!-- Rate/Hr -->
		<div class="widget">
			<h4>{{ trans('label.jobstype') }}</h4>
			{!! Form::open(array('method' => 'get', 'onsubmit' => 'return false')) !!}
			<ul class="checkboxes">
				<li>
					<input id="check-6" type="checkbox" name="check[]" value="0" checked>
					<label for="check-6">All ({{count($jobs)}})</label>
				</li>
				<li>
					<input id="check-7" type="checkbox" name="check[]" value="1">
					<label for="check-7">Full-time <span>({{count($jobtypesFulltime)}})</span></label>
				</li>
				<li>
					<input id="check-8" type="checkbox" name="check[]" value="2">
					<label for="check-8">Part-time <span>({{count($jobtypesParttime)}})</span></label>
				</li>
				<li>
					<input id="check-9" type="checkbox" name="check[]" value="3">
					<label for="check-9">Internship <span>({{count($jobtypesInternship)}})</span></label>
				</li>
				<li>
					<input id="check-10" type="checkbox" name="check[]" value="4">
					<label for="check-10">Freelance <span>({{count($jobtypesFreelance)}})</span></label>
				</li>
			</ul>
			{!! Form::close() !!}
		</div>
	</div>
	<!-- Widgets / End -->
</div>
<!-- Call Ajax  -->
<script type="text/javascript">
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });	
    var check = [];
	var sortNew = $(document).on('change', '#elementId', function(){
						return $(this).val();
					});

    // Listen for 'change' event, so this triggers when the user clicks on the checkboxes labels
    $('input[name="check[]"], #elementId').on('change', function (e) {	
		var sortNew =  $("#elementId").val();
        e.preventDefault();
        check = []; // reset 
		getList(check,sortNew);
        	
     });	  	 
  });
function getList(check,sortNew){
	$('input[name="check[]"]:checked').each(function()
        {		
            check.push(this.value);
		});	
			$.ajax({
                url: '/scouters/tim-viec/',
                type: 'get',
                data: {check:check,sortNew:sortNew},
                dataType: 'json',
                success: function(response){  
					//console.log(typeof response.jobs.data); 					
					var html = loadJobs(response.jobs.data);				
					$('.job-list').html(html);               
                },
				error: function(xhr) {
					console.log(xhr);
					}
            });	
}  
function loadJobs(data){
	var html = '';
	var getUrl = "{{ URL::to('/viec-lam/chi-tiet/') }}";
	for(var i in data){
		html += '<li>';
		html += '<a href="'+getUrl+"/"+data[i].ids+'" id="customaLink">';
		html += '		<img src="{{$pathCompany[1]}}'+data[i].logo_url+'" alt="'+data[i].name+'" title="'+data[i].name+'" id="companyLogo">';
		html += '		<div class="job-list-content">';
		html += '			<h4 id="nameJob">'+data[i].name+' <br></h4>';
		html += '				<h4><span class="full-time">'+data[i].typename+'</span></h4>';
		html += '				<div class="job-icons"><span><i class="fa fa-briefcase"></i>'+data[i].tags+'</span>';
		html += '					<span><i class="fa fa-map-marker"></i>'+data[i].citiName_vi+'</span>';
		html += '					<span><i class="fa fa-money"></i> '+data[i].salary_from+' ~ '+data[i].salary_to+'$</span>';
		html += '				</div>';
		html += '			<p id="customDescription">'+data[i].description+'</p>';
		html += '		</div>';
		html += '		</a>';
		html += '		<span id="customBonus">';
		html += '            Introduction<br> successful<br>+ '+data[i].bonus+'$<br>';
		html += '			<br>';
		html += '			<h4><span class="freelance">Bookmarrk</span></h4>';
		html += '		</span>	';
		html += '		<div class="clearfix"></div>';
		html += '	</li>';
		// console.log(data[i]);
	}
	return html;
}

</script>
@endsection
