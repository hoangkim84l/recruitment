@extends('./layouts.app')
 
@section('content')
            <h1>Showing Task {{ $user->name }}</h1>
 
    <div class="jumbotron text-center">
        <p>
            <strong>Username:</strong> {{ $user->name }}<br>
            <strong>Email:</strong> {{ $user->email }}
        </p>
    </div>
@endsection