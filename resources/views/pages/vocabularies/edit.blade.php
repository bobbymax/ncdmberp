@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Update Vocabulary 
    </h1>
</div>
@stop
@section('content')

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('vocabularies.update', $vocabulary->id) }}" method="POST">
			@csrf
			@method('PATCH')
			
			<div class="row">
				<div class="col-3">
					<div class="form-group">
						<label for="name">Vocabulary Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Vocabulary Name" value="{{ $vocabulary->name ?? old('name') }}" id="name">

						@error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="code">Short Name</label>
						<input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Enter Short Name" value="{{ $vocabulary->code ?? old('code') }}" id="code">

						@error('code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="executive">Management</label>
						<select name="executive" class="form-control @error('executive') is-invalid @enderror" id="executive">
							<option value="">Select Top Management</option>
							<option value="0" {{ $vocabulary->executive == 0 ? ' selected' : '' }}>None</option>
							@foreach ($grades as $grade)
								<option value="{{ $grade->id }}" {{ $vocabulary->executive == $grade->id ? ' selected' : '' }}>{{ $grade->name }}</option>
							@endforeach
						</select>

						@error('executive')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="active">Active</label>
						<select name="active" class="form-control @error('active') is-invalid @enderror" id="active">
							<option value="">Is Vocabulary Active?</option>
							<option value="0" {{ $vocabulary->active == 0 ? ' selected' : '' }}>No</option>
							<option value="1" {{ $vocabulary->active == 1 ? ' selected' : '' }}>Yes</option>
						</select>

						@error('active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-12">
					<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('vocabularies.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg"></i> Update Vocabulary</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop