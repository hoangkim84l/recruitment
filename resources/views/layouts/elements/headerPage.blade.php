<!-- Header
================================================== -->
<header class="sticky-header  full-width">
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo">
			<h1><a href="{{ url('/') }}"><img src="{{asset('img/logo.png')}}" alt="Scouter Project" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">
				<li><a href="{{ url('/') }}" id="current">{{ trans('label.home') }}</a></li>
				<li><a href="#">{{ trans('label.introduce') }} </a>
					<ul>
						<li><a href="{{ route('introduce') }}">{{ trans('label.introduce') }}</a></li>
						<li><a href="{{ route('contact') }}">{{ trans('label.contact') }}</a></li>
					</ul>
				</li>
				<li><a href="{{ route('registers') }}">{{ trans('label.scouter') }} </a></li>
				<li><a href="{{ route('registere') }}">{{ trans('label.employer') }} </a></li>
			</ul>
			<ul class="float-right">			
				@if (Route::has('login'))
				@auth
					<li><a href="{{ url('/cms/homeback') }}"><i class="fa fa-user"></i>{{ trans('label.home') }}</a></li>
					@else
					<!-- <li><a href="{{ route('register') }}#tab2"><i class="fa fa-user"></i> {{ trans('label.register') }}</a></li> -->
					<li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> {{ trans('label.login') }}</a></li>
					
					@endauth				
				@endif
				
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>