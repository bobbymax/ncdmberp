@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Add Department 
    </h1><br>
</div>
@stop
@section('content')

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('departments.store') }}" method="POST">
			@csrf
			
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Department Name" value="{{ old('name') }}" id="name">

						@error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="code">Department Code</label>
						<input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Staff Number" value="{{ old('code') }}" id="code">

						@error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="vocabulary_id">Department Type</label>

						<select name="vocabulary_id" class="form-control @error('vocabulary_id') is-invalid @enderror" id="vocabulary_id">
							<option value="">Select Type</option>
							@foreach ($vocabularies as $vocabulary)
								<option value="{{ $vocabulary->id }}">{{ $vocabulary->name }}</option>
							@endforeach
						</select>

						@error('vocabulary_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-6">
					<div class="form-group">
						<label for="parent">Department Parent</label>

						<select name="parent" class="form-control @error('parent') is-invalid @enderror" id="parent">
							<option value="">Select Parent</option>
							<option value="0">None</option>
							@foreach ($departments as $department)
								<option value="{{ $department->id }}">{{ $department->name }}</option>
							@endforeach
						</select>

						@error('parent')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>




				<div class="col-12">
					<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('departments.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg"></i> Add Department</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop