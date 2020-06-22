<!-- Header
================================================== -->
<header class="sticky-header full-width">
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
				<li><a href="{{ route('company.createjob') }}">{{ trans('label.addnewjobs') }} </a></li>
				<li><a href="{{ route('candidateindex') }}">{{ trans('label.candidate') }} </a></li>
				<li><a href="{{ route('jobindex') }}">{{ trans('label.jobs') }} </a></li>
			</ul>
			<ul class="float-right">
				@if (Route::has('login'))
					@auth
						<li><a href="#"><i class="fa fa-user"></i> {{ Auth::user()->name }}</a>
							<ul class="dropdown-menu">
								<!--  <li>
										<a href="{{ URL::to('cms/users/edit/' . Auth::user()->id ) }}">
												Thay đổi mật khẩu
										</a>
								</li> -->
								<li><a href="{{ route('company.profile') }}">{{ trans('label.mypage') }}</a></li>
								<li><a href="">{{ trans('label.term') }}</a></li>
								<li>
									<a href="{{ route('logout') }}"
										onclick="event.preventDefault();document.getElementById('logout-form').submit();"> {{ trans('label.logout')}}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										{{ csrf_field() }}
									</form>
								</li>
							</ul>	
						</li>
						@if($user['role'] == 3)
							<li> <a href="{{ url('/cms/users') }}"><i class="fa fa-user"></i>{{ trans('label.home') }}</a></li>
						@endif
					@else
						<!-- <li><a href="{{ route('register') }}#tab2"><i class="fa fa-user"></i> {{ trans('label.register') }}</a></li> -->
						<li><a href="{{ route('login') }}"><i class="fa fa-lock"></i> {{ trans('label.login') }}</a></li>
					@endauth
				@endif
				<li class="chosen-drop" style="padding-top: 6px;">
					<!-- multi language -->  
					<form action="{{ route('switchLang') }}" class="form-lang" method="post">
						<select class="form-control" name="locale" onchange='this.form.submit();'>
							<option value="en">{{ trans('label.lang.en') }}</option>
							<option value="vi"{{ Lang::locale() === 'vi' ? 'selected' : '' }}>{{ trans('label.lang.vi') }}
							</option>
						</select>
						{{ csrf_field() }}
					</form>
				</li>
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