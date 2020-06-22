@extends('./layouts.appcms')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10">
			<h1>Thông tin chi tiết : {{ $user->name }}</h1>

			<div class="jumbotron text-center">
				<p>
					<strong>Username:</strong> {{ $user->name }}<br>
					<strong>Email:</strong> {{ $user->email }}
				</p>
			</div>
		</div>
	</div>
</div>
@endsection