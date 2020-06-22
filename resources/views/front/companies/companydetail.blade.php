@extends('layouts.app')
@include('layouts.elements.headerScoter')
@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<h2><a href="#"><img src="{{ $company->company_banner_url }}" alt="{{ $company->company_name }}"></a></h2>
		</div>
	</div>
</div>
<!-- Content
================================================== -->
<div class="container">	
	<!-- Table -->
	<div class="sixteen columns">
		<div class="row">
			<div class="col-sm-3"><img src="{{ $company->company_logo_url }}" alt="{{ $company->company_name }}"></div>
			<div class="col-sm-6">
				<h3>{{ $company->company_name }}</h3>
				<div class="row">
					<div class="col-sm-5"><i class="fa fa-link"></i>{{ trans("common.CompanyTypes.".$company->company_type_id) }}</div>
					<div class="col-sm-7"><i class="fa fa-map-marker"></i>{{ $company->country_name }}</div>
				</div>
				<div class="row">
					<div class="col-sm-5"><i class="fa fa-user"></i> {{ !empty($company->company_members)?$company->company_members: 'xxx' }} {{ trans('label.companies_detail.003') }}</div>
					<div class="col-sm-7"><i class="fa fa-clock-o"></i> Thứ {{ $company->company_work_from }}- Thứ {{ $company->company_work_to }}</div>
				</div>
				<div class="row">
					<div class="col-sm-12"><i class="fa fa-money"></i> {{ !empty($company->company_overtime_id)?config('common.OvertimeTypes.'.$company->company_overtime_id):'' }} </div>
				</div>
			</div>
			<div class="col-sm-3">
			<div class="row">
					<div class="col-sm-12">
						<div class="buttons">
							<ul class="social-icons">
								<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
								<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
								<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
							</ul>
					</div>
					</div>
			</div>
			<div class="row">
					<div class="col-sm-12">
						<a href="#small-dialog" class="popup-with-zoom-anim button">{{ trans('label.companies_detail.004') }}</a>
					</div>
			</div>	
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="sixteen">
		<p class="margin-bottom-25">
			<h4>{{ trans('label.companies_detail.001') }}</h4>
		</p>
        <p>{!! nl2br(strip_tags($company->company_description)) !!}</p
		<br/>
		
	</div>
	<h4>{{ trans('label.companies_detail.002') }}</h4>
	<ul class="job-list full">
        <?php foreach($jobs as $k => $job){ ?>
        <li><a href="job-page.html" style="height:auto;">
            <img src="images/job-list-logo-01.png" alt="{{ $job->name }}">
            <div class="job-list-content">
                <h4>{{ $job->name }} <span class="{{ config('master.JOB_TYPES.'.$job->job_type_id) }}">{{ trans("common.JobTypes.".$job->jobtype_name) }}</span></h4>
                <div class="job-icons">
                    <span><i class="fa fa-briefcase"></i>{{ $job->tags }}</span>
                    <span><i class="fa fa-map-marker"></i>{{ $job->address }}</span><!-- -->
                    <span><i class="fa fa-money"></i>{{$job->salary_from}} - {{$job->salary_to}} $</span>
                </div>
                <p>{!! nl2br(strip_tags($job->description)) !!}</p>
            </div>
            </a>
            <div class="clearfix"></div>
        </li>
        <?php } ?>
    </ul>
    <div class="clearfix"></div>
    <h4>{{ trans('label.companies_detail.002') }}</h4>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.327642481451!2d106.6894782150204!3d10.786198492314886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f33afdba7af%3A0x420aaa5f7e2e1a99!2zNjMgUGjhuqFtIE5n4buNYyBUaOG6oWNoLCBwaMaw4budbmcgNiwgUXXhuq1uIDMsIEjhu5MgQ2jDrSBNaW5oLCBWaWV0bmFt!5e0!3m2!1sen!2s!4v1526371686962" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
@endsection