@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Update Qualification 
    </h1><br>
</div>
@stop
@section('content')

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('qualifications.update', $qualification->label) }}" method="POST">
			@csrf
			@method('PATCH')
			
			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="name">Qualification Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Qualification Name" value="{{ $qualification->name ?? old('name') }}" id="name">

						@error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="period">Period</label>
						<input type="number" name="period" class="form-control @error('period') is-invalid @enderror" placeholder="Enter Period" value="{{ $qualification->period ?? old('period') }}" id="period">

						@error('period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>


				<div class="col-4">
					<div class="form-group">
						<label for="status">Status</label>
						<select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
							
							<option value="">Active</option>
							<option value="1" {{ $qualification->status == 1 ? ' selected' : '' }}>Yes</option>
							<option value="0" {{ $qualification->status == 0 ? ' selected' : '' }}>No</option>

						</select>

						@error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<label for="description">Description</label>
						<textarea name="description" id="description" rows="5" class="form-control @error('description') is-invalid @enderror">{!! $qualification->description ?? old('description') !!}</textarea>

						@error('description')
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
                        <a href="{{ route('qualifications.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg mr-3"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg mr-3"></i> Update Qualification</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop