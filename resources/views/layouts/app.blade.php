<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="{{ app()->getLocale() }}"> <!--<![endif]-->
<head>
@include('layouts.elements.head')
    <script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/ckfinder/ckfinder.js') }}"></script>
</head>

<body>
<div id="wrapper">
<!-- Content
================================================== -->

@yield('content')

@include('layouts.elements.footer')
<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->
@extends('layouts.elements.js')


</body>
<!-- Scripts
================================================== -->

<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/jquery.superfish.js') }}"></script>
<script src="{{ asset('js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('js/jquery.themepunch.showbizpro.min.js') }}"></script>
<script src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
<script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('js/waypoints.min.js') }}"></script>
<script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('js/jquery.jpanelmenu.js') }}"></script>
<script src="{{ asset('js/stacktable.js') }}"></script>
<script src="{{ asset('js/headroom.min.js') }}"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
  $(function () {  
    $("#datepicker").datepicker({         
      autoclose: true,         
      todayHighlight: true 
    }).datepicker();
  });

  $(function(){
    var path = window.location.href;
    
    $('#menu-scouter a').each(function() {
      if (this.href === path) {
        $(this).addClass('active');
      }
    });
  })
</script>
</html>