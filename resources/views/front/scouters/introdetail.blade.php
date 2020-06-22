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
			@if(isset($applie))
				<h3 class="h3-detail">Theo dõi trạng thái tuyển dụng của { {{$applie->canName}} }</h3>
				<div class="margin-bottom-20"></div>

				@if($applie->stName == 'Hoàn thành')
					<div>
						<i class="fa fa-star star-style cl-format padding-i"></i>
						<p class="cl-format">dd/mm/yy</p>
						<p class="cl-format cl-ht">Hoàn thành</p>
					</div>
					
					<div>
						<i class="fa fa-circle circle-4 cl-format padding-i"></i>
						<p class="cl-format">dd/mm/yy</p>
						<p class="cl-format cl-tv">Giai đoạn thử việc</p>
					</div>

					<div>
						<i class="fa fa-circle circle-3 cl-format padding-i"></i>
						<p class="cl-format">dd/mm/yy</p>
						<p class="cl-format cl-dn">Đã được nhận</p>
					</div>

					<div>
						<i class="fa fa-circle circle-2 cl-format padding-i"></i>
						<p class="cl-format">dd/mm/yy</p>
						<p class="cl-format cl-pv">Đã phỏng vấn</p>
					</div>
					
					<div>
						<i class="fa fa-circle circle-1 cl-format padding-i"></i>
						<p class="cl-format">dd/mm/yy</p>
						<p class="cl-format cl-ut">Đã ứng tuyển</p>
					</div>
				@endif
			@endif
		</div>
  </div>
</div>
@endsection