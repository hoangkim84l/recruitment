@extends('layouts.app')
@include('layouts.elements.header')
@section('content')
<!-- Titlebar
    ================================================== -->
    <div id="titlebar">
        <div class="container">
            <div class="ten columns">
                <span><a href="browse-jobs.html">{{$job->name}}</a><span>
                <h2>{{$company->name}}<span class="{{ config('master.JOB_TYPES.'.$job->job_type_id) }}">{{ trans("common.JobTypes.".$jobtype->name) }}</span></h2>
            </div>
            <div class="six columns">
                <a href="#" class="button dark"><i class="fa fa-star"></i> Bookmark</a>
            </div>
        </div>
    </div>
    <!-- Content
    ================================================== -->
    <div class="container">
        <!-- Recent Jobs -->
        <div class="eleven columns">
        <div class="padding-right">
            <!-- Company Info -->
            <?php if (isset($user) && $user->role == 1) {?>
            <div class="app-content" style="padding:0;">
                <h4 style="color: red;">{{ trans('label.introducebonus') }} {{ trans('label.success') }}</h4>
                <div class="buttons">
                    <ul class="social-icons-1">
                        <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                        <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                        <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="company-info">
                <div class="content">
                    <span><a href="#"><i class="fa fa-link"></i> {{$company->web_url}}</a></span>
                    <span><a href="#"><i class="fa fa-twitter"></i> {{$company->phone_number}}</a></span>
                    <span><a href="#"><i class="fa fa-link"></i> {{$job->salary_from}} - {{$job->salary_to}} $</a></span>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php }else {?>
            <div class="app-content-1">
                <div class="company-info-1">
                    <span><a href="#"><i class="fa fa-link"></i> {{$company->web_url}}</a></span>
                    <span><a href="#"><i class="fa fa-twitter"></i> {{$company->phone_number}}</a></span>
                    <span><a href="#"><i class="fa fa-link"></i> {{$job->salary_from}} - {{$job->salary_to}} $</a></span>
                    <div class="social-buttons-1">
                        <ul class="social-icons-1">
                            <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                            <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                            <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php }?>
            <!-- content -->
            <?php if(isset($user) && $user->role==1){ ?>
                <center><a href="#small-dialog" class="popup-with-zoom-anim button">{{ trans('label.introducethisjob') }}</a></center>
            <?php }else{ ?>
                <center><a href="#small-dialog" class="popup-with-zoom-anim button">{{ trans('label.job_detail.001') }}</a></center>
            <?php } ?>
            <br/>
            <h4>{{ trans('label.jobdescription') }}</h4>
            <p class="margin-reset">
                {!! nl2br(strip_tags($job->description)) !!}
            </p>
            <br/>
            <h4>{{ trans('label.jobrequiment') }}</h4>
            <p>{{strip_tags($job->requirement)}}</p>
            <br/>
            <h4>{{ trans('label.experiencerequi') }}</h4>
            <ul class="list-1">
                 <li>{{strip_tags($job->experience)}}</li>
            </ul>
            <br/>
            <h4>{{ trans('label.agerequire') }}</h4>
            <p class="margin-reset">
                {{$job->age_from}} - {{$job->age_to}}
            </p>
            <br>
            <h4>{{ trans('label.workingtime') }}</h4>
            <p class="margin-reset">
                {{$job->working_time}}
            </p>
            <br/>
            <h4>{{ trans('label.workingaddress') }}</h4>
            <p class="margin-reset">
                {{$job->address}}
            </p>
            <br/>
            <h4>{{ trans('label.benefits') }}</h4>
            <p class="margin-reset">
                {{$job->welfare}}
            </p>
            <br>
        </div>
        <?php if(isset($user) && $user->role==1){ ?>
            <center><a href="#small-dialog" class="popup-with-zoom-anim button">{{ trans('label.introducethisjob') }}</a></center>
        <?php }else{ ?>
            <center><a href="#small-dialog" class="popup-with-zoom-anim button">{{ trans('label.job_detail.001') }}</a></center>
        <?php } ?>
        <br>
        </div>
        <!-- Widgets -->
        <div class="five columns">
            <!-- Sort by -->
            <div class="widget">

                <div class="job-overview">
                    <ul>
                        <center><img src="/files/avatar/company/{{$company->logo_url}}" alt="{{$company->name}}"></center>
                        <h4>{{$company->name}}</h4>
                        <li>
                            <i class="fa fa-link"></i>
                            <div>
                                <!-- <strong>Type:</strong> -->
                                <span>{{$companyTypes[$company->company_type_id]}}</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-map-marker"></i>
                            <div>
                                <!-- <strong>Quốc gia:</strong> -->
                                <span>{{$city->name_vi}}</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-user"></i>
                            <div>
                                <!-- <strong>Nhân viên:</strong> -->
                                <span>{{$company->members}}</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-clock-o"></i>
                            <div>
                                <!-- <strong>Hours:</strong> -->
                                <span>{{$workingDays[$company->work_from]}} - {{$workingDays[$company->work_to]}}</span>
                            </div>
                        </li>
                        <li>
                            <i class="fa fa-money"></i>
                            <div>
                                <!-- <strong>Rate:</strong> -->
                                <span>{{$overtimeTypes[$company->overtime_id]}}</span>
                            </div>
                        </li>
                    </ul>
                    <a href="#small-dialog" class="popup-with-zoom-anim button">{{ trans('label.morejobofcompany') }}</a>
                    <div id="small-dialog" class="zoom-anim-dialog mfp-hide apply-popup">
                        <div class="small-dialog-headline">
                            <h2>Apply For This Job</h2>
                        </div>
                        <div class="small-dialog-content">
                            <form action="#" method="get" >
                                <input type="text" placeholder="Full Name" value=""/>
                                <input type="text" placeholder="Email Address" value=""/>
                                <textarea placeholder="Your message / cover letter sent to the employer"></textarea>

                                <!-- Upload CV -->
                                <div class="upload-info"><strong>Upload your CV (optional)</strong> <span>Max. file size: 5MB</span></div>
                                <div class="clearfix"></div>

                                <label class="upload-btn">
                                    <input type="file" multiple />
                                    <i class="fa fa-upload"></i> Browse
                                </label>
                                <span class="fake-input">No file selected</span>

                                <div class="divider"></div>

                                <button class="send">Send Application</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Widgets / End -->
    </div>
@endsection
<script type="text/javascript">
 $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('#select-friend').click(function(e){
   var email = $("#email-friend option:selected" ).val();
   
   $.ajax({
    type: 'post',
    url: '/viec-lam/chi-tiet/select',
    dataType: 'json',
    data: {
     email: email,
     _token: '{!! csrf_token() !!}'
    },
    success: function(json){
     if(json.status == 'success'){
      $.magnificPopup.open({
       items: {
        src: '#message-dialog', 
        type: 'inline'
       }
      });
     }
    },
    error: function(xhr){
        }
   });
  });

  $('#insert-friend').click(function(e){
   var nameFri = $("#name-firend").val();
   var email = $("#mail-friend").val();
   var phoneFr = $("#phone-friend").val();
   var checkMale = $('#male-button').is(":checked");
   var idCity = $("#id-city option:selected" ).val();
   var nameTag = $("#name-tag option:selected").val();
   var file_data = $("#file").prop("files")[0];
      var _token = '{!! csrf_token() !!}';
   var form_data = new FormData();

   form_data.set("nameFri", nameFri);
   form_data.set("email", email);
   form_data.set("phone", phoneFr);
   form_data.set("checkMale", checkMale);
   form_data.set("idCity", idCity);
   form_data.set("nameTag", nameTag);
      form_data.set("file", file_data);
   form_data.set("_token", _token);
   
   $.ajax({
    type: 'post',
        url: '/viec-lam/chi-tiet/add',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: form_data,

    success: function(json){
     if(json.status == 'success'){
      $.magnificPopup.open({
       items: {
        src: '#message-dialog', 
        type: 'inline'
       }
      });
     }
    },
    error: function(xhr){
        }
   });
  });
 });
</script>
