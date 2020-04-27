<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<title>Print Staff Trainings</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<style type="text/css">
		.page-title { text-transform: uppercase; } .pull-left { float: left; } .pull-right { float: right; } .clearfix { clear: both; } .width10 { width: 10%; } .width15 { width: 15%; } .width20 { width: 20%; } .width80 { width: 80%; } .width85 { width: 85%; } .width90 { width: 90%; } .mt-15 { margin-top: 15px !important; } .strong { font-weight: bolder; } .mt-30 { margin-top : 30px  !important; } .mt-50 { margin-top : 50px  !important; } p { font-size: 18px; } .ml-30 { margin-left: 30px; } .mr-30  { margin-right: 30px; } .ml-150 { margin-left: 150px; } .mr-150 { margin-left: 150px; } .ml-40 { margin-left: 40px; } .ml-100 { margin-left: 100px; } .underline { text-decoration: underline; } .full-width { width: 100%; } table, th, td { border: 1px solid #777; } th, td {  padding: 5px; }
	</style>
</head>
<body>
	<div>
		<div class="width15 pull-left"><img src="{{ public_path('images/logo.png') }}" alt="placeholder+image"></div>
		<div class="width85 pull-right mt-15"><h3 class="page-title" style="font-weight: bolder;">nigerian content development and monitoring board</h3></div>
		<div class="clearfix"></div>
	</div>
	<div class="mt-15"><h4 style="text-align: center;" class="page-title strong">training records update</h4></div>

	<div class="mt-50">
		<p>Name <span class="ml-150">:</span> <span class="ml-30 page-title underline"><strong>{{ $staff->name }}</strong></span></p>
		<p>Directorate/Division <span class="ml-40">:</span> <span class="ml-30 page-title underline"><strong>{{ $staff->hierarchy() }}</strong></span></p>
		<p>Grade Level <span class="ml-100">:</span> <span class="ml-30 page-title underline"><strong>{{ $staff->grade_level }}</strong></span></p>
		<p>Date Joined NCDMB <span class="ml-30">:</span> <span class="ml-30 underline"><strong>{{ $staff->date_joined->format('d F, Y') }}</strong></span></p>
	</div>

	<p class="mt-50" style="font-style: italic;">Details of all relevant Workshops, Seminars, Overseas and Local Trainings attended to date.</p>

	<table class="mt-30 full-width">
		<thead style="background-color: #ecd107;">
			<tr>
				<th>S/No.</th>
				<th>Title of Programme</th>
				<th>Provider/Organizer</th>
				<th>Sponser</th>
				<th>Date</th>
			</tr>
		</thead>
		<tbody>
			@php
				$count = 1;
			@endphp
			@foreach ($staff->printable() as $detail)
				<tr>
					<td>{{ $count++ }}.</td>
					<td>{{ $detail->training->title }}</td>
					<td>{{ $detail->vendor }}</td>
					<td>{{ strtoupper($detail->sponsor )}}</td>
					<td>{{ $detail->lifecycle() }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
</body>
</html>