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
      <div class="row">
        <div class="col-sm-8">
          {!! Form::open(array('method' => 'POST', 'class' => 'searchbox', 'action' => 'Scouters\ScoutersController@search')) !!}
            <input type="search" name="name" placeholder="Search by name, job title">
          {!! Form::close() !!}
        </div>
      </div>

      <div class="tab-content">
        <div class="table-responsive users-table">
          <table class="table table-striped table-condensed data-table">
            <thead>
              <tr>
                <th style="width: 8%;"></th>
                <th>Full name</th>
                <th>Job title</th>
                <th style="width: 25%;">Status <i class="fa fa-fw fa-sort"></i></th>
              </tr>
            </thead>

            <tbody>
              @if(isset($app_search))
                @foreach($app_search as $applie)
                  <tr>
                    <td></td>
                    <td>{{$applie->canName}}</td>
                    <td>{{$applie->canTag}}</td>
                    <td>{{$applie->stName}}</td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
		</div>
  </div>
</div>
@endsection