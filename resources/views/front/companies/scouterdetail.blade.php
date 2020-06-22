@extends('layouts.app')
@include('layouts.elements.headerEmployer')
@section('content')
<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="ten columns">
			<h2><img src="img/company-logo.png" alt="">{{ trans('label.manager') }} Scouter</h2>
		</div>
		<div class="six columns">
			<a href="#" class="button dark"><i class="fa fa-plus-circle"></i> {{ trans('label.addnewjobs') }}</a>
		</div>
	</div>
</div>
<!-- Content
================================================== -->
<div class="container">	
	<!-- Table -->
	<div id="notification"></div>

	<div class="sixteen columns">
		<p class="margin-bottom-25">
			<h4>Scouter {{$users->name}}</h4>
			{{ trans('label.introduceforyou') }}
		</p>

		<table class="manage-table resumes responsive-table">
			<tr>
				<th>No.</th>
				<th>{{ trans('label.candidate') }}</th>
				<th>{{ trans('label.jobsname') }}</th>
				<th>{{ trans('label.bonusstatus') }}</th>
			</tr>
			<!-- Item #1 -->
			@foreach($jobs as $job)
			<tr id="rowCadidate">
				<td>
					<input type="hidden" id="applyId" value="{{$job->applyId}}">
					<input type="hidden" id="scouterId" value="{{$job->ids}}">
					<input type="hidden" id="bonusMoney" value="{{$job->bonusMoney}}">
					<input type="hidden" id="bonusHistoryId" value="{{$job->bonusHisId}}">
					{{$loop->index + 1}}
				</td>
				<td class="title"><a href="#">{{$job->canName}}</a></td>
				<td>{{$job->jobName}}</td>
				<td>
					<div class="widget">
						<!-- Select -->
						@if(isset($bonus))
						<select id="bonusStatus" class="chosen-select-no-single">
							@foreach($bonus as $bonu=> $value)
								@if(isset($job->bonusStatusId))
									@if($job->bonusStatusId === $bonu)
										<option value="{{ $bonu }}" selected > {{ $value }}</option>
									@else
										<option value="{{ $bonu }}"> {{ $value }}</option>
									@endif
								@else
									<option value="{{ $bonu }}"> {{ $value }}</option>
								@endif
							@endforeach
						</select>
						@endif
					</div>
				</td>
			</tr>
			@endforeach
		</table>
		<br>
		<div class="clearfix"></div>
		<div class="pagination-container">                                             
		{{$jobs->links() }}
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

        $(document).on("change", "#bonusStatus", function () {
            var $this = $(this);
            var apply_id = $this.closest('#rowCadidate').find('#applyId').val();
            var scouter_id = $this.closest('#rowCadidate').find('#scouterId').val();
            var bonusstatus_id = $this.val();
            var bonus_money = $this.closest('#rowCadidate').find('#bonusMoney').val();
            var bonus_history_id = $this.closest('#rowCadidate').find('#bonusHistoryId').val();

            var data = {apply_id: apply_id, scouter_id: scouter_id, bonusstatus_id: bonusstatus_id, bonus_money: bonus_money, bonus_history_id: bonus_history_id};
            var dataRequest = JSON.stringify(data);

            $.ajax({
                type: 'POST',
                url: '{{ route('updatebonusstatus') }}',
                dataType: 'json',
                data: {
                    data: dataRequest,
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response['status'] == 'success'){
                        $('#notification').addClass('alert alert-success');
                        $('#notification').text("Cập nhật Bonus status thành công");
                    }
                },
                error: function () {
                    return false;
                }
            });
        });
    });
</script>



@endsection