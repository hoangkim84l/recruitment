@extends('./layouts.appcms')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>Hồ sơ <?php  if($user->role==1){ echo "Scouter";   }
      elseif($user->role==2){ echo "Employer"; }
      else{ echo "Admin";   }   ?></h3>
      <hr>
      <form action="{{URL::action('Cms\UsersController@update')}}" method="POST">
       <input type="hidden" name="id" value="{{$user->id}}">
       {{ csrf_field() }}
       <div class="form-group">
        <label for="title">Họ Tên</label>
        <input type="text" value="{{$user->name}}" class="form-control" id="userTitle"  name="name" >
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
    </form>

    <br/>
    <hr>
    <h3>Tài khoản <?php  if($user->role==1){ echo "Scouter";}
    elseif($user->role==2){ echo "Employer"; }
    else{ echo "Admin";} ?></h3>

    <form action="{{URL::action('Cms\UsersController@updateAccount')}}" method="POST">
     <input type="hidden" name="id" value="{{$user->id}}">
     {{ csrf_field() }}
     <div class="form-group">
      <label for="title">Email</label>
      <input type="email" value="{{$user->email}}" class="form-control" id="email"  name="email" >
    </div>
    <div class="form-group">
      <label for="description">Password</label>
      <input type="password" value="{{$user->password}}" class="form-control" id="newPassword" name="newPassword" >
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
  </form>
</div>
</div>
</div>
@endsection