@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Nominations 
    </h1>
</div>
@stop
@section('content')
	@if (session('status'))
		<div class="alert alert-success">
	        {{ session('status') }}
	    </div>
	@endif
	<div class="row">
		<div class="col-6">
			<div class="dt-card">
				<!-- Card Body -->
	    		<div class="dt-card__body">
					<h2 class="card-title">{{ $nomination->training->title }}</h2>
					<h4 class="mb-5 card-subtitle">Facilitator: {{ $nomination->vendor }}</h4>

					<p class="card-text">
						The following staffs have been nomited to attend the above named training on your approval.
					</p>

					<ul class="list-group">
						<li class="list-group-item">Qualification: {{ $nomination->qualification->name }}</li>
						<li class="list-group-item">Course: {{ $nomination->course->name }}</li>
						<li class="list-group-item">Major: {{ $nomination->training->major->name }}</li>
						<li class="list-group-item">Resident: {{ ucfirst($nomination->resident) }}</li>
						<li class="list-group-item">Location: {{ $nomination->location }}</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="dt-card">
				<!-- Card Header -->
                <div class="dt-card__header">

                    <!-- Card Heading -->
                    <div class="dt-card__heading">
                        <h3 class="dt-card__title">Nominated Staffs</h3>
                    </div>
                    <!-- /card heading -->

                </div>
                <!-- /card header -->
				<!-- Card Body -->
	    		<div class="dt-card__body">
	    			<ul class="list-group">
	    				@foreach ($nomination->nominations as $data)
							<li class="list-group-item">
								<i class="icon icon-user icon-lg mr-2"></i>
								{{ $data->staff->name }}

								@if ($data->state !== "approved")
									<a href="{{ route('remove.staff.nomination', [$data->staff->staff_no, $data->detail->id]) }}" class="float-right text-danger"><i class="icon icon-trash"></i></a>
								@else
									<span class="float-right badge badge-sm badge-success">{{ $data->state }}</span>
								@endif
							</li>
						@endforeach
	    			</ul>
				</div>
			</div>
		</div>

		<div class="col-12">
			<a href="{{ route('hr.nominations') }}" class="mt-5 btn btn-info btn-sm">Go Back</a>
			@if ($nomination->nominated() === $nomination->responded())
				<a href="{{ route('schedule.training', $nomination->id) }}" class="mt-5 btn btn-success btn-sm">Schedule Training</a>
			@endif
		</div>
	</div>
@stop