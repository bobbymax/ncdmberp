@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Update Course
    </h1><br>
</div>
@stop
@section('content')

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('courses.update', $course->label) }}" method="POST">
			@csrf
			@method('PATCH')
			
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Course Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Course Name" value="{{ $course->name ?? old('name') }}" id="name">

						@error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>


				<div class="col-6">
					<div class="form-group">
						<label for="active">Status</label>
						<select name="active" class="form-control @error('active') is-invalid @enderror" id="active">
							
							<option value="">Active</option>
							<option value="1" {{ $course->active == 1 ? ' selected' : '' }}>Yes</option>
							<option value="0" {{ $course->active == 0 ? ' selected' : '' }}>No</option>

						</select>

						@error('active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror">{!! $course->description ?? old('description') !!}</textarea>

						@error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
			</div>

			<div class="row mb-5 mt-5">
				<div class="col-12">
					<h3 class="mb-5">Qualifications</h3>
					
					<div class="row">
						
						@foreach ($qualifications as $qualification)
                            <div class="col-2">
                            	<div class="form-group form-row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="{{ $qualification->id }}" id="qualification{{ $qualification->id }}" name="qualifications[]" {{ in_array($qualification->id, $course->currentQualifications()) ? ' checked' : '' }}>
                                        <label class="custom-control-label" for="qualification{{ $qualification->id }}">{{ $qualification->name }}</label>
                                    </div>
                                </div>
                            </div>
						@endforeach

					</div>

				</div>
			</div>


			<div class="row mt-5">
				<div class="col-12">
					<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('courses.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg mr-3"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg mr-3"></i> Update Course</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop