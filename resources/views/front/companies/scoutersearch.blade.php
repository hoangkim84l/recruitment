@extends('layouts.app')
@include('layouts.elements.headerEmployer')
@section('content')
    <!-- Titlebar
================================================== -->
    <div id="titlebar">
        <div class="container">
            <div class="sixteen columns">
                <h2>{{ trans('label.manager') }} Scouter</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li>You are here:</li>
                        <li><a href="#">Home</a></li>
                        <li>Scouter</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Content
    ================================================== -->
    <div class="container">
        <div class="form-group">
            <div id="notification"></div>

            <div class="col-sm-3 col-md-3 tab-content-right">
                <ul class="tabs-nav">
                    <li><a href="{{ route('company.profile') }}">Profile</a></li>
                    <li><a href="{{ route('company.account') }}">Account</a></li>
                    <li><a href="{{ route('candidateindex') }}">Candidates</a></li>
                    <li><a href="{{ route('jobindex') }}">Jobs</a></li>
                    <li class="active"><a href="{{ route('scouterindex') }}">Scouters</a></li>
                </ul>
            </div>

            <div class="col-sm-9 col-md-9 tab-content-left">
                <form action="{{URL::action('Companies\ScoutersController@searchScouter')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-6 margin-bottom-25">
                        <input type="text" name="scouterNameSearch" placeholder="{{ trans('label.searchbyname') }}" >
                    </div>
                    <div class="col-md-3 margin-bottom-25">
                        <button class="button" style="height: 56px">{{ trans('label.search') }}</button>
                    </div>
                </form>

                <div class="fourteen columns">

                    <table class="manage-table responsive-table">
                        <thead>
                        <tr>
                            <th> No.</th>
                            <th> {{ trans('label.Name') }}</th>
                            <th> {{ trans('label.email') }}</th>
                            <th> {{ trans('label.number') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td class="title">{{$loop->index + 1}}</td>
                                <td>{{$job->scouName}}</td>
                                <td>{{$job->scouEmail}}</td>
                                <td><a href="{{ URL::to('/companies/quan-ly-scouters/chi-tiet/'.$job->ids) }}" class="button">{{ trans('label.view') }}({{$job->countIntro}})</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>

@endsection