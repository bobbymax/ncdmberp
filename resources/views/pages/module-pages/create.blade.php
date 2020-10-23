@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Create Page 
    </h1><br>
</div>
@stop
@section('content')

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('pages.store', $module->code) }}" method="POST" enctype="multipart/form-data">
			@csrf
			
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="name">Page Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Page Name" value="{{ old('name') }}" id="name">

						@error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="route">Route</label>
						<input type="text" name="route" class="form-control @error('route') is-invalid @enderror" placeholder="Enter Route" value="{{ old('route') }}" id="route">

						@error('route')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="icon">Icon</label>
						<input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" placeholder="Enter Page Icon" value="{{ old('icon') }}" id="icon">

						@error('icon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="url">Page URL</label>
						<input type="text" name="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}" id="url" placeholder="Page Optional URL">

						@error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="menu">Menu</label>
						<select name="menu" class="form-control @error('menu') is-invalid @enderror" id="menu">
							
							<option value="">Add Page to Menu</option>
							<option value="1">Yes</option>
							<option value="0">No</option>

						</select>

						@error('menu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="is_published">Publish</label>
						<select name="is_published" class="form-control @error('is_published') is-invalid @enderror" id="is_published">
							
							<option value="">Publish Page?</option>
							<option value="1">Yes</option>
							<option value="0">No</option>

						</select>

						@error('is_published')
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
			</div>

			<div class="row mb-5 mt-5">
				<div class="col-12">
					<h3 class="mb-5">Roles</h3>
					
					<div class="row">
						
						@foreach ($roles as $role)
                            <div class="col-2">
                            	<div class="form-group form-row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="{{ $role->id }}" id="role{{ $role->id }}" name="roles[]">
                                        <label class="custom-control-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                    </div>
                                </div>
                            </div>
						@endforeach

					</div>

				</div>
			</div>

			<div class="row mb-5 mt-5">
				<div class="col-12">
					<h3 class="mb-5">Departments</h3>
					
					<div class="row">
						
						@foreach ($departments as $department)
                            <div class="col-2">
                            	<div class="form-group form-row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="{{ $department->id }}" id="department{{ $department->id }}" name="departments[]">
                                        <label class="custom-control-label" for="department{{ $department->id }}">{{ $department->name }}</label>
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
                        <a href="{{ route('modules.show', [$module->application->code, $module->code]) }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg mr-3"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg mr-3"></i> Create Page</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop