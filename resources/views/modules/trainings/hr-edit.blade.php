@extends('layouts.master')
@section('title', 'NCDMB | Archive Trainings')
@section('page-header')
	<div class="dt-page__header">
	    <h1 class="dt-page__title">
	       Update details for {{ $training->title }} training
	    </h1>
	</div>
@stop
@section('content')
<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">


		<form action="{{ route('hr.details.update', [$training->label, $detail->id]) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PATCH')

			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<label for="vendor">Training Title</label>
						<input type="text" name="vendor" class="form-control" value="{{ $detail->training->title }}" readonly>
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="major_id">Training Major</label>
						<select class="form-control @error('major_id') is-invalid @enderror" name="major_id" id="major_id">
							<option value="" disabled selected>=== Select Major ===</option>
							@foreach ($majors as $major)
								<option value="{{ $major->id }}" {{ $detail->training->major->id === $major->id ? ' selected' : '' }}>{{ $major->name }}</option>
							@endforeach
						</select>

						@error('major_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="vendor">Provider</label>
						<input type="text" name="vendor" class="form-control @error('vendor') is-invalid @enderror" placeholder="Enter Training Provider" value="{{ $detail->vendor ?? old('vendor') }}" readonly>

						@error('vendor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-4">
					<div class="form-group">
						<label for="location">Location</label>
						<input type="text" name="location" class="form-control @error('location') is-invalid @enderror" placeholder="Enter Training Location" value="{{ $detail->location ?? old('location') }}" readonly>

						@error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-3">

                    <!-- Form Group -->
                    <div class="form-group">
                    	<label for="start_date">Start Date</label>
                        <div class="input-group date" id="date-time-picker-7"
                             data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('start_date') is-invalid @enderror" data-target="#date-time-picker-7" name="start_date" id="start_date" placeholder="Enter Start Date" value="{{ $detail->start_date->format('m/d/Y h:i A') ?? old('start_date') }}" disabled>
                            <div class="input-group-append" data-target="#date-time-picker-7"
                                 data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="icon icon-calendar"></i>
                                </div>
                            </div>
                        </div>
                        @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- /form group -->

                </div>

                <div class="col-3">

                    <!-- Form Group -->
                    <div class="form-group">
                    	<label for="end_date">End Date</label>
                        <div class="input-group date" id="date-time-picker-8"
                             data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('end_date') is-invalid @enderror" data-target="#date-time-picker-8" name="end_date" id="end_date" placeholder="Enter End Date" value="{{ $detail->end_date->format('m/d/Y h:i A') ?? old('end_date') }}" disabled>
                            <div class="input-group-append" data-target="#date-time-picker-8"
                                 data-toggle="datetimepicker" id="ender">
                                <div class="input-group-text"><i class="icon icon-calendar"></i>
                                </div>
                            </div>
                        </div>
                        @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- /form group -->

                </div>

                <div class="col-3">
					<div class="form-group">
						<label for="qualification_id">Qualification</label>
						<input type="text" name="qualification_id" class="form-control" value="{{ $detail->qualification->name ?? old('qualification_id') }}" id="qualification_id" readonly>

						@error('qualification_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="course_id">Course</label>
						<select class="form-control @error('course_id') is-invalid @enderror" name="course_id" id="course_id">
							<option value="" disabled selected>=== Select Course ===</option>
						</select>

						@error('course_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-12">
					<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('uncategorise.trainings') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg"></i> Update Details</button>
                    </div>
				</div>
			</div>

		</form>


    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->
@stop

@section('scripts')

	<script>
		var url = "{{ route('get.dependencies') }}";
		var token = "{{ csrf_token() }}";
		var start = "{{ $detail->start_date }}";
		var end = "{{ $detail->end_date }}";
		var current = "{{ $detail->course_id }}";
	</script>

	<script src="/js/scripts.js"></script>

	<script>
		$(document).ready(function() {
			window.onload = getDependencies(start, end, current);	
		});
	</script>

@stop