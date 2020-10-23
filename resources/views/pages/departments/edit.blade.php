@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Update Department 
    </h1><br>
</div>
@stop
@section('content')

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('departments.update', $department->id) }}" method="POST">
			@csrf
			@method('PATCH')
			
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Department Name" value="{{ $department->name ?? old('name') }}" id="name">

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
						<input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Staff Number" value="{{ $department->code ?? old('code') }}" id="code">

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
								<option value="{{ $vocabulary->id }}" {{ $department->vocabulary_id == $vocabulary->id ? ' selected' : '' }}>{{ $vocabulary->name }}</option>
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
							<option value="0" {{ $department->parent == 0 ? ' selected' : '' }}>None</option>
							@foreach ($departments as $d)
								<option value="{{ $d->id }}" {{ $department->parent == $d->id ? ' selected' : '' }}>{{ $d->name }}</option>
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
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg"></i> Update Department Record</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop