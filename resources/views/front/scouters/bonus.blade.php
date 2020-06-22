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
			<h1 class="h1-total">1.230 USD</h1>
			<h3>Bonus history</h3>
			<div class="margin-bottom-20"></div>
			<div class="row">
				<div class="col-sm-7">
					<p><i class="fa fa-money"></i> 20-05-2018 - Finished introduction {Java} - {Thanh}</p>
				</div>

				<div class="col-sm-5">
					<p>+ 200 USD</p>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-7">
					<p><i class="fa fa-briefcase"></i> 20-05-2018 - Transfered money</p>
				</div>

				<div class="col-sm-5">
					<p>- 550 USD</p>
				</div>
			</div>
		</div>
  </div>
</div>
@endsection