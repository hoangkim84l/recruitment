@extends('layouts.app')
@include('layouts.elements.header')
@section('content')
<!-- Slider
================================================== -->
<div class="fullwidthbanner-container">
	<div class="fullwidthbanner">
		<ul>

			<!-- Slide 1 -->
			<li data-fstransition="fade" data-transition="fade" data-slotamount="10" data-masterspeed="300">
				<img src="img/banner-02.jpg" alt="">

				<div class="caption title sfb" data-x="center" data-y="195" data-speed="400" data-start="800"  data-easing="easeOutExpo">
					<h2>Scouter Project - Người kết nối việc làm</h2>
				</div>

				<div class="caption text align-center sfb" data-x="center" data-y="270" data-speed="400" data-start="1200" data-easing="easeOutExpo">
					<p>Bạn muốn trở thành một Scouter chuyên nghiệp ?<br>
					Giúp đở bạn bè, người thân tìm được việc làm và nhận ngay<br/>
					bonus từ nhà tuyển dụng ?</p>
				</div>

				<div class="caption sfb" data-x="center" data-y="400" data-speed="400" data-start="1600" data-easing="easeOutExpo">
					<a href="#" class="slider-button btn btn-success">Đăng ký bằng Facebook</a><br/><br/><br/>
					
				</div>
			</li>
		</ul>
	</div>
</div>

<!-- Content
================================================== -->
<div class="container">	
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">
		<h3 class="margin-bottom-25">{{ trans('label.recents_jobs') }}</h3>
		<ul class="job-list">
		@foreach($jobs as $job)
			<li class="highlighted">
			<a href="{{ URL::to('/viec-lam/chi-tiet/'.$job->ids) }}" id="customaLink">
				<img src="{{$pathCompany[1]}}{{$job->logo_url}}" alt="{{$job->comName}}" title="{{$job->comName}}" id="companyLogo">
				<div class="job-list-content">
					<h4 id="nameJob">{{$job->name}} <br/></h4>
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
		<a href="{{route('scouterjobsindex')}}" class="button centered"><i class="fa fa-plus-circle"></i>{{ trans('label.show_more_jobs') }}</a>
		<div class="margin-bottom-55"></div>
	</div>
	</div>

	<!-- Job Spotlight -->
	<div class="five columns">
		<h3 class="margin-bottom-5">{{ trans('label.jobspot_light') }}</h3>

		<!-- Navigation -->
		<div class="showbiz-navigation">
			<div id="showbiz_left_1" class="sb-navigation-left"><i class="fa fa-angle-left"></i></div>
			<div id="showbiz_right_1" class="sb-navigation-right"><i class="fa fa-angle-right"></i></div>
		</div>
		<div class="clearfix"></div>
		
		<!-- Showbiz Container -->
		<div id="job-spotlight" class="showbiz-container">
			<div class="showbiz" data-left="#showbiz_left_1" data-right="#showbiz_right_1" data-play="#showbiz_play_1" >
				<div class="overflowholder">
					<ul>
					@foreach($hotJobs as $hotjob)
						<li>
							<div class="job-spotlight">
								<a href="{{ URL::to('/viec-lam/chi-tiet/'.$hotjob->ids) }}" id="customaLink"><h4>{{$hotjob->name}} <span class="part-time">{{$hotjob->typename}}</span></h4></a>
								<?php $tags_list = json_decode($hotjob->tags);?>
								<span><i class="fa fa-briefcase"></i> 
								<?php if(is_array($tags_list)):?>
										<?php foreach ($tags_list as $tagsNamehot):?>
											<?php echo $tagsNamehot ?>&nbsp;
										<?php endforeach;?>
									<?php endif;?>
								</span>
								<span><i class="fa fa-map-marker"></i> {{$hotjob->address}}</span>
								<span><i class="fa fa-money"></i> {{$hotjob->salary_from}} - {{$hotjob->salary_to}} $</span>
								<p id="customDescription">{{ strip_tags($job->description)}}</p>
								<a href="#" class="button">{{ trans('label.bonus_for_success') }} <br/> + {{$job->bonus}} $</a>
							</div>
						</li>
						@endforeach 
					</ul>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</div>
<!-- Info Banner -->
<div class="container"><hr/>
	<div class="">
		<div class="one-third column">
			<h3>Scouter Project là gì?</h3>
			<p>
			Scouter Project là một hệ thống giúp bạn có thể giới thiệu cho bạn bè những công việc phù hợp nhất với họ, đồng thời nhận bonus từ những nhà tuyển dụng.
			</p> 
			<p>Mô hình đơn giản và hiệu quả, ai cũng có thể trở thành một head-hunter chuyên nghiệp.</p>
			 <p>
			Bạn thấy ái ngại khi kiếm tiền bằng cách này? Hãy thoải mái "share" tiền bonus với người vừa được bạn giới thiệu việc làm thành công để ăn mừng nhé!
 			</p>
		</div>
		<div class="two-thirds column">
			<img src="img/whatscouter.png" alt="Scouters Project là gì ?" title="Scouters Project là gì ?">
		</div>	
	</div>
	
</div>
@endsection