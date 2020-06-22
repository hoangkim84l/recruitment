@extends('layouts.app')
@include('layouts.elements.headerEmployer')
@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="sixteen columns">
			<h2>{{ trans('label.manager') }} Candidate</h2>
			<nav id="breadcrumbs">
				<ul>
					<li>You are here:</li>
					<li><a href="#">Home</a></li>
					<li>Candidate Dashboard</li>
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
				<li class="active"><a href="{{ route('candidateindex') }}">Candidates</a></li>
				<li><a href="{{ route('jobindex') }}">Jobs</a></li>
				<li><a href="{{ route('scouterindex') }}">Scouters</a></li>
			</ul>
		</div>

		<div class="col-sm-9 col-md-9 tab-content-left">
			<form action="{{URL::action('Companies\CandidatesController@searchCandidate')}}" method="POST">
				{{ csrf_field() }}
				<div class="col-md-4">
					<select class="chosen-select-no-single" id="statusSearch" name="jobStatusId">
						<option disabled hidden selected>{{ trans('label.filter_condition.001') }}</option>
						@foreach($jobStatus as $status)
							<option value="{{$status->id}}">{{$status->name}}</option>
						@endforeach
					</select>
					<div class="margin-bottom-15"></div>
				</div>

				<div class="col-md-4">
					<select class="chosen-select-no-single" name="jobNameId">
						<option disabled hidden selected>{{ trans('label.filter_condition.002') }}</option>
						@foreach($jobs as $job)
							<option value="{{$job->jobId}}">{{$job->jobName}}</option>
						@endforeach
					</select>
					<div class="margin-bottom-35"></div>
				</div>

				<div class="col-md-4">
					<select class="chosen-select-no-single" name="sort">
						<option disabled hidden selected>{{ trans('label.Sortby') }}</option>
						<option value="timeASC">{{ trans('label.sort_latest') }}</option>
						<option value="nameASC">{{ trans('label.sort_by_name') }}</option>
					</select>
					<div class="margin-bottom-35"></div>
				</div>
				<button type="submit" id="searchJob" class="button centered col-md-3 pull-right margin-bottom-30" style=" margin-right: 15px; width: 258px; text-align: center; ">{{ trans('label.search') }}</button>
			</form>
		
		
			<div class="fourteen columns" id="applyList">
				<!-- Application #1 -->
				@foreach($applies as $apply)
		
				<div class="application list" >
					<div class="app-content">
						<!-- Name / Avatar -->
						<div class="info">
							<img src={{ asset('img/resumes-list-avatar-01.png') }} alt="">
							<span>{{$apply->candidateName}}</span>
							<ul>
								<li><a href="{{$apply->cvUrl}}"><i class="fa fa-file-text"></i> Download CV</a></li>
							</ul>
						</div>
						
						<!-- Buttons -->
						<div class="buttons">
							<a href="#one-1" class="button gray app-link"><i class="fa fa-pencil"></i> {{ trans('label.edit') }}</a>
							<a href="#two-1" class="button gray app-link"><i class="fa fa-sticky-note"></i> {{ trans('label.note') }}</a>
							<a href="#three-1" class="button gray app-link"><i class="fa fa-plus-circle"></i> {{ trans('label.detail') }}</a>
						</div>
						<div class="clearfix"></div>
		
					</div>
		
					<!--  Hidden Tabs -->
					<div class="app-tabs">
		
						<a href="#" class="close-tab button gray"><i class="fa fa-close"></i></a>
						
						<!-- First Tab -->
						<div class="app-tab-content" id="one-1">
							<div class="select-grid">
								<input type="hidden" name="applyIdStatus" value="{{$apply->applyId }}">
								<select id="jobStatus" data-placeholder="Application Status" class="chosen-select-no-single">
									@foreach($jobStatus as $status)
										<option value="{{$status->id}}">{{$status->name}}</option>
									@endforeach
								</select>
							</div>

							<button href="#" id="deleteCandidate" class="button gray delete-application" style="height: 50px" >Delete this candidate</button>

							<div class="clearfix"></div>
							<button href="#" class="button margin-top-15" id="updateStatus">Save</button>
						</div>
						
						<!-- Second Tab -->
						<div class="app-tab-content" id="two-1">
							<input type="hidden" name="applyId" value="{{$apply->applyId }}">
							<textarea id="note" placeholder="Ghi chú, nhận xét của Nhà tuyển dụng. Ứng viên sẽ không thấy được ghi chú này">{{$apply->companyNote}}</textarea>
							<a href="#" class="button margin-top-15" id="addNote">Add Note</a>
						</div>
						
						<!-- Third Tab -->
						<div class="app-tab-content"  id="three-1">
							<i>Full Name:</i>
							<span>{{$apply->candidateName}}</span>
							<div>
								<div class="pull-right">
									<i>Scouter</i>
									<a href="{{route('candidateindex')}}?scoutername={{$apply->scouterName}}" class="button" style="height: 45px"><span>{{$apply->scouterName}}</span></a>
								</div>
								<div>
									<i>Email:</i>
									<span><a href="{{$apply->candidatesEmail}}">{{$apply->candidatesEmail}}</a></span>
								</div>
							</div>
							<i>Message:</i>
							<span>{{$apply->message}}</span>
						</div>
					</div>
		
					<!-- Footer -->
					<div class="app-footer">
						<div class="rating no-stars">
							<div class="star-rating"></div>
							<div class="star-bg"></div>
						</div>
						<ul>
							<li id="jobStatusText"><i class="fa fa-star"></i>{{$apply->jobStatus}}</li>
							<li><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($apply->created)->format('d/m/Y')}}</li>
						</ul>
						<div class="clearfix"></div>
					</div>

				</div>
				@endforeach
				{{$applies->links() }}
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

		$(document).on("click", "#addNote", function () {
			var applyId = $(this).closest('.app-tabs').find('input[name="applyId"]').val();
			var note = $(this).closest('.app-tabs').find('#note').val();
			var data = {applyId: applyId, note:note};
			var dataRequest = JSON.stringify(data);
			$.ajax({
				type: 'POST',
				url: '{{ route('updatenoteajax') }}',
				dataType: 'json',
				data: {
					data: dataRequest,
                    "_token": "{{ csrf_token() }}"
				},
				success: function(response) {
				    if (response['status'] == 'success'){
                        $('#notification').addClass('alert alert-success');
                        $('#notification').text("Cập nhật ghi chú thành công");
					}
				},
				error: function() {
					console.log('Server error.');
				}
			});
		});

        $(document).on("click", "#updateStatus", function () {
            var $this = $(this);
            var applyId = $this.closest('.app-tabs').find('input[name="applyIdStatus"]').val();
            var status = $this.closest('.app-tabs').find('#jobStatus').val();
            var statusText = $this.closest('.app-tabs').find('#jobStatus option:selected').text();

            var data = {applyId: applyId, statusId:status};
            var dataRequest = JSON.stringify(data);
            $.ajax({
                type: 'POST',
                url: '{{ route('updatestatusajax') }}',
                dataType: 'json',
                data: {
                    data: dataRequest,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response['status'] == 'success'){
                        $('#notification').addClass('alert alert-success');
                        $('#notification').text("Cập nhật trạng thái công việc thành công");
                        //$this.parents('.list').find('.app-footer').load(location.href + " .app-footer > *");
                        //$("#applyList").load(location.href + " #applyList > *");

                        $this.parents(".list").find("#jobStatusText").html(`
                            <i class="fa fa-star"></i>${statusText}
                        `);
                    }
                },
                error: function() {
                    return false;
                }
            });
        });

        $(document).on("click", "#deleteCandidate", function () {
            var applyId = $(this).closest('.app-tabs').find('input[name="applyIdStatus"]').val();
            if (confirm("Are you sure you want to delete it?")) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('deletecandidateajax') }}',
                    dataType: 'json',
                    data: {
                        data: applyId,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response['status'] == 'success'){
                            $('#notification').addClass('alert alert-success');
                            $('#notification').text("Xóa candidate thành công");
                            location.reload();
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
	});
</script>

@endsection