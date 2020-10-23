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


		<form action="{{ route('details.update', [$training->label, $detail->id]) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PATCH')

			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="vendor">Provider</label>
						<input type="text" name="vendor" class="form-control @error('vendor') is-invalid @enderror" placeholder="Enter Training Provider" value="{{ $detail->vendor ?? old('vendor') }}">

						@error('vendor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-6">
					<div class="form-group">
						<label for="location">Location</label>
						<input type="text" name="location" class="form-control @error('location') is-invalid @enderror" placeholder="Enter Training Location" value="{{ $detail->location ?? old('location') }}">

						@error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-4">

                    <!-- Form Group -->
                    <div class="form-group">
                    	<label for="start_date">Start Date</label>
                        <div class="input-group date" id="date-time-picker-7"
                             data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('start_date') is-invalid @enderror" data-target="#date-time-picker-7" name="start_date" id="start_date" placeholder="Enter Start Date" value="{{ $detail->start_date->format('m/d/Y h:i A') ?? old('start_date') }}">
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

                <div class="col-4">

                    <!-- Form Group -->
                    <div class="form-group">
                    	<label for="end_date">End Date</label>
                        <div class="input-group date" id="date-time-picker-8"
                             data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('end_date') is-invalid @enderror" data-target="#date-time-picker-8" name="end_date" id="end_date" placeholder="Enter End Date" value="{{ $detail->end_date->format('m/d/Y h:i A') ?? old('end_date') }}">
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

                <div class="col-4">
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

				<div class="col-3">
					<div class="form-group">
						<label for="sponsor">Training Sponsor</label>
						<select class="form-control @error('sponsor') is-invalid @enderror" name="sponsor" id="sponsor">
							<option value="">Select Sponsor</option>
							@foreach ($training->sponsors()['sponsors'] as $key => $sponsor)
								<option value="{{ $key }}" {{ $detail->sponsor === $key ? ' selected' : '' }}>{{ $sponsor }}</option>
							@endforeach
						</select>

						@error('sponsor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="resident">Training Residence</label>
						<select class="form-control @error('resident') is-invalid @enderror" name="resident" id="resident">
							<option value="">Select Residence</option>
							@foreach ($training->sponsors()['types'] as $key => $type)
								<option value="{{ $key }}" {{ $detail->resident === $key ? ' selected' : '' }}>{{ $type }}</option>
							@endforeach
						</select>

						@error('resident')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="certificate">Upload Certificate (if any)</label>
						<input type="file" name="certificate" class="form-control @error('certificate') is-invalid @enderror" id="certificate" {{ $detail->fetchCertificate() }}>

						@error('certificate')
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
                        <a href="{{ route('trainings.show', $training->label) }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg"></i> Cancel</a>
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