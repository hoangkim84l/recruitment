<!-- Footer
================================================== -->
<div class="margin-top-15"></div>

<div id="footer">
	<!-- Main -->
	<div class="container">

		<div class="seven columns">
			<h4>Scouter Project</h4>
			<p>{{ trans('label.anybody') }}</p>
			<a href="#" class="button">{{ trans('label.get_started') }}</a>
			<br/><h4>{{ trans('label.connect_withus') }}</h4>
		</div>

		<div class="three columns">
			<h4>{{ trans('label.it_jobs_by_skill') }}</h4>
			<ul class="footer-links">
				<li><a href="#">JAVA</a></li>
				<li><a href="#">PHP</a></li>
				<li><a href="#">.NET</a></li>
				<li><a href="#">Android</a></li>
				<li><a href="#">iOS</a></li>
				<li><a href="#">Xem tất cả</a></li>
			</ul>
		</div>
		
		<div class="three columns">
			<h4>{{ trans('label.it_jobs_by_city') }}</h4>
			<ul class="footer-links">
				<li><a href="#">Hồ Chí Minh</a></li>
				<li><a href="#">Hà Nội</a></li>
				<li><a href="#">Đà Nẵng</a></li>
				<li><a href="#">Cần Thơ</a></li>
				<li><a href="#">Bà Rịa - Vũng Tày</a></li>
				<li><a href="#">Xem tất cả</a></li>
			</ul>
		</div>		

		<div class="three columns">
			<h4>{{ trans('label.policies_and_regulations') }}</h4>
			<ul class="footer-links">
				<li><a href="#">{{ trans('label.term') }}</a></li>
				<li><a href="#">{{ trans('label.complain') }}</a></li>
				<li><a href="#">{{ trans('label.faqs') }}</a></li>
				<li><a href="#">Sitemap</a></li>

			</ul>
		</div>
		<center>			
				<input type="text" name="reemail" style="max-width: 50%;float: left;margin-left: 27%;padding: 10px;" placeholder="{{ trans('label.inputemail') }}"> 
				<a href="#" style="max-width: 50%;float: left;margin:1px;"  class="button"> {{ trans('label.send') }} </a>
			</center>
	</div>

	<!-- Bottom -->
	<div class="container">
		<div class="footer-bottom">
			<div class="sixteen columns">
				<h4>{{ trans('label.follow_us') }}</h4>
				<ul class="social-icons">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
				</ul>
				<div class="copyrights">© 2018 {{ trans('label.copy_right') }} <a href="#">Prime Capital Partners</a>. {{ trans('label.Developed_by') }} <a href="#">Primelabo</a>.</div>
			</div>
		</div>
	</div>

</div>