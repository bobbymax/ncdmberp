@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Update Application 
    </h1><br>
</div>
@stop
@section('content')

@if (session('status'))
	<div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('applications.update', $application->code) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PATCH')
			
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Application Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Department Name" value="{{ $application->name ?? old('name') }}" id="name">

						@error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="code">Code</label>
						<input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Staff Number" value="{{ $application->code ?? old('code') }}" id="code">

						@error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="icon">Icon</label>
						<input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="Enter Application Icon" value="{{ $application->icon ?? old('icon') }}" id="icon">

						@error('icon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="path">Icon Image</label>
						<input type="file" name="path" class="form-control @error('path') is-invalid @enderror" value="{{ old('path') }}" id="path">

						@error('path')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="active">Active</label>
						<select name="active" class="form-control @error('active') is-invalid @enderror" id="active">
							<option value="">Select Active State</option>
							<option value="0" {{ $application->active == 0 ? ' selected' : '' }}>Not Active</option>
							<option value="1" {{ $application->active == 1 ? ' selected' : '' }}>Active</option>
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
						<textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror">{!! $application->description ?? old('description') !!}</textarea>

						@error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

			</div>

			<div class="row mt-5">
				<div class="col-12 mb-5">
					<h3 class="mb-5">Departments</h3>
					<div class="row">
						@foreach ($departments as $department)
							<div class="col-4">
                            	<div class="form-group form-row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="{{ $department->id }}" id="department{{ $department->id }}" name="departments[]" {{ in_array($department->id, $currentDepartments) ? ' checked' : '' }}>
                                        <label class="custom-control-label" for="department{{ $department->id }}">{{ $department->name }}</label>
                                        <a href="{{ route('revoke.module.access', [$application->code, $department->id]) }}"> - revoke</a>
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
                        <a href="{{ route('applications.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg mr-3"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg mr-3"></i> Update Application</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop