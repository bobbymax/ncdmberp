@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Update Course Major 
    </h1><br>
</div>
@stop
@section('content')

	<!-- Card -->
	<div class="dt-card">
	    <!-- Card Body -->
	    <div class="dt-card__body">

			<form role="form" action="{{ route('majors.update', $major->label) }}" method="POST">
				@csrf
				@method('PATCH')
				
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Course Major Name" value="{{ $major->name ?? old('name') }}" id="name">

							@error('name')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $message }}</strong>
	                            </span>
	                        @enderror
						</div>
					</div>

					<div class="col-6">
						<div class="form-group">
							<label for="active">Active</label>
							<select name="active" class="form-control @error('active') is-invalid @enderror">
								<option value="" disabled selected>=== Select Options ===</option>
								<option value="1" {{ $major->active == 1 ? ' selected' : '' }}>Yes</option>
								<option value="0" {{ $major->active == 0 ? ' selected' : '' }}>No</option>
							</select>

							@error('active')
	                            <span class="invalid-feedback" role="alert">
	                                <strong>{{ $message }}</strong>
	                            </span>
	                        @enderror
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="btn-group" role="group" aria-label="Basic example">
	                        <a href="{{ route('majors.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg"></i> Cancel</a>
	                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg"></i> Update Course Major</button>
	                    </div>
					</div>
				</div>
			</form>

	    </div>
	    <!-- End Card Body -->
	</div>
	<!-- End Card -->

@stop