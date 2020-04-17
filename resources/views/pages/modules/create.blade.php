@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Add Module 
    </h1><br>
</div>
@stop
@section('content')

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('modules.store', $application->code) }}" method="POST" enctype="multipart/form-data">
			@csrf
			
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Module Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Module Name" value="{{ old('name') }}" id="name">

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
						<input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Module Code" value="{{ old('code') }}" id="code">

						@error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="icon">Icon</label>
						<input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="Enter Application Icon" value="{{ old('icon') }}" id="icon">

						@error('icon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-6">
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

				<div class="col-12">
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror">{!! old('description') !!}</textarea>

						@error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>



				<div class="col-12">
					<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('modules.index', $application->code) }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg mr-3"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg mr-3"></i> Add Module</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop