@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Update Location 
    </h1><br>
</div>
@stop
@section('content')

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('locations.update', $location->id) }}" method="POST">
			@csrf
			@method('PATCH')
			
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="name">Location Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Location Name" value="{{ $location->name ?? old('name') }}" id="name">

						@error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="state">State</label>
						<input type="text" name="state" class="form-control @error('state') is-invalid @enderror" placeholder="Enter Location State" value="{{ $location->state ?? old('state') }}" id="state">

						@error('state')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="inCommission">In Commission?</label>
						<select name="inCommission" class="form-control @error('inCommission') is-invalid @enderror" id="inCommission">
							<option value="">Select Building Status</option>
							<option value="0" {{ $location->inCommission == 0 ? ' selected' : '' }}>No</option>
							<option value="1" {{ $location->inCommission == 1 ? ' selected' : '' }}>Yes</option>
						</select>

						@error('inCommission')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-12">
					<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('locations.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg"></i> Update Location</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop