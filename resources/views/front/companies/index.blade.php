<!-- this is the home company -->
@extends('layouts.app')
@include('layouts.elements.header')

<div class="container">
		<h3 class="title-name">Welcome {{ $user['name'] }} </h3>
		<div class="margin-bottom-20"></div>
		<div class="text-info-user">
			<p>Welcome {{ $user['name'] }} to become Employer!<br>
				Your account needs to be verified, please check your inbox, 
				then follow the intructions to finish setting up your Scouter account.<br>
				Thank you!
			</p>
			<p><a href="">Find jobs to introduce</a></p>
			<p><a href="/companies/profile">Go to My page</a></p>
		</div>
</div>