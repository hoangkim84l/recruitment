@extends('layouts.app')
@include('layouts.elements.headerEmployer')
@section('content')
    <!-- Titlebar
================================================== -->
    <div id="titlebar">
        <div class="container">
            <div class="sixteen columns">
                <h2>Job List</h2>
                <nav id="breadcrumbs">
                    <ul>
                        <li>You are here:</li>
                        <li><a href="#">Home</a></li>
                        <li>Job List</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-group">
            <div id="notification"></div>

            <div class="col-sm-3 col-md-3 tab-content-right">
                <ul class="tabs-nav">
                    <li><a href="{{ route('company.profile') }}">Profile</a></li>
                    <li><a href="{{ route('company.account') }}">Account</a></li>
                    <li><a href="{{ route('candidateindex') }}">Candidates</a></li>
                    <li class="active"><a href="{{ route('jobindex') }}">Jobs</a></li>
                    <li><a href="{{ route('scouterindex') }}">Scouters</a></li>
                </ul>
            </div>

            <div class="col-sm-9 col-md-9 tab-content-left">
                <form action="{{URL::action('Companies\JobsController@searchJob')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="col-md-6 margin-bottom-25">
                        <input type="text" name="jobNameSearch" placeholder="{{ trans('label.search_by_name') }}" >
                    </div>
                    <div class="col-md-3 margin-bottom-25">
                        <button class="button" style="height: 56px" id="searchJobsButton">{{ trans('label.search') }}</button>
                    </div>
                </form>

                <div class="col-md-3">
                    <a href="#" id="deleteJobChoice" class="pull-right" style=" margin-right: -170px; "> {{ trans('label.delete_selected') }}</a>
                </div>
                <!-- Table -->
                <div class="fourteen columns">

                    <table class="manage-table responsive-table" id="tableJob">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" style="margin-left: -20px"> {{ trans('label.job_title') }}</th>
                            <th><i class="fa fa-calendar"></i> {{ trans('label.date_posted') }}</th>
                            <th><i class="fa fa-calendar"></i> {{ trans('label.date_expires') }}</th>
                            <th><i class="fa fa-user"></i> {{ trans('label.applications') }}</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody id="bodyJobList">
                        @foreach($jobs as $job)
                            <tr id="jobRow">
                                <td class="title" id="check">
                                    <input type="checkbox" name="" value="{{$job->jobId}}" id="choice" class="cb-element">
                                    {{$job->jobTitle}}
                                    <input type="hidden" name="jobId" value="{{$job->jobId}}">
                                </td>
                                <td>{{ \Carbon\Carbon::parse($job->datePosted)->format('d/m/Y')}}</td>
                                <td>{{ \Carbon\Carbon::parse($job->dateExpire)->format('d/m/Y')}}</td>
                                <td><a href="{{ route('candidateindex') }}?jobname={{$job->jobTitle}}" class="button" target="_blank">{{ trans('label.view') }}({{$job->countApply}})</a></td>
                                <td class="action">
                                    <a href="#" class="delete" id="deleteJob"><i class="fa fa-remove"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        $(document).on("click", "#deleteJob", function () {
            var jobId = $(this).closest('#jobRow').find('input[name="jobId"]').val();
            if (confirm("Are you sure you want to delete it?")) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('deletejobajax') }}',
                    dataType: 'json',
                    data: {
                        data: jobId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response['status'] == 'success'){
                            $('#notification').addClass('alert alert-success');
                            $('#notification').text("Xoa job thanh cong");

                            // $(".container").load(location.href + " .container");
                            window.location = '{{route('jobindex')}}';
                        }
                    },
                    error: function() {
                        console.log('Server error.');
                    }
                });
            } else {
                return false;
            }
        });

        $('#checkAll').change(function () {
            $('.cb-element').attr('checked',this.checked);
        });

        $('.cb-element').change(function () {
            if ($('.cb-element').length == $('.cb-element:checked').length){
                $('#checkAll').attr('checked','checked');
            }
            else {
                $('#checkAll').removeAttr('checked');
            }
        });

        $('#deleteJobChoice').click(function (event) {
            if (confirm("Are you sure you want to delete it?")) {
                event.preventDefault();
                var idsArr = [];
                $('#tableJob').find('#check input[type=checkbox]:checked').each(function() {
                    idsArr.push(this.value);
                });
                $.ajax({
                    type: 'POST',
                    url: '{{ route('deletemultijobajax') }}',
                    dataType: 'json',
                    data: {
                        data: idsArr,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response['status'] == 'success'){
                            //location.reload();
                            window.location = '{{route('jobindex')}}';
                        }
                    },
                    error: function() {
                        console.log('Server error.');
                    }
                });
            } else {
                return false;
            }
        });
    </script>

@endsection

