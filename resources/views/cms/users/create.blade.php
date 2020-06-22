@extends('./layouts.appcms')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Thông tin quản trị</h1>
      <hr>
      {!! Form::open(array('route' => 'cms/users/store','method'=>'POST')) !!}

      {{ csrf_field() }}
      <div class="form-group">
        <label for="title">User Name</label>
        <input type="text" class="form-control" id="UserTitle"  name="name">
      </div>
      <div class="form-group">
        <label for="description">User Email</label>
        <input type="email" class="form-control" id="UserDescription" name="email">
      </div>
      <div class="form-group">
        <label for="description">Password</label>
        <input type="password" class="form-control" id="UserDescription" name="password">
      </div>
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <button type="submit" class="btn btn-primary">Submit</button>
      {!! Form::close() !!}

    </div>
  </div>
</div> 
@endsection