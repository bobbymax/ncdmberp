@extends('layouts.master')
@section('title', 'NCDMB | Archive Trainings')
@section('page-header')
	<div class="dt-page__header">
	    <h1 class="dt-page__title">
	       Update Training 
	    </h1><br>
	</div>
@stop
@section('content')
	
<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

	
		<form action="{{ route('trainings.update', $training->label) }}" method="POST">
			
			@csrf
			@method('PATCH')

			<div class="row">
				
				<div class="col-6 mb-5">
				
					<div class="form-group">

						<label for="title" class="mb-3">Training Title</label>
						<input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ $training->title ?? old('title') }}" id="title" placeholder="Enter Training Title" autocomplete="off">

						@error('title')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror

					</div>

				</div>

				<div class="col-6 mb-5">
				
					<div class="form-group">

						<label for="major_id" class="mb-3">Training Major</label>
						<select class="form-control form-control-lg" name="major_id" id="major_id">
							
							<option value="0" disabled selected>Select Training Major</option>
							@foreach ($majors as $major)
								<option value="{{ $major->id }}" {{ $training->major_id == $major->id ? ' selected' : '' }}>{{ $major->name }}</option>
							@endforeach

						</select>

						@error('major_id')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror

					</div>

				</div>

				<div class="col-12 mt-5">
					<div class="btn-group" role="group" aria-label="Basic example">
	                    <a href="{{ route('trainings.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg mr-3"></i> {{ strtoupper('Cancel') }}</a>
	                    <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg mr-3"></i> {{ strtoupper('Update Training') }}</button>
	                </div>
				</div>

			</div>


		</form>


    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop