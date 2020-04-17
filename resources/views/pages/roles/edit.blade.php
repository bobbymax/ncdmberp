@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Update Role 
    </h1><br>
</div>
@stop
@section('content')

<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

		<form role="form" action="{{ route('roles.update', $role->id) }}" method="POST">
			@csrf
			@method('PATCH')
			
			<div class="row">
				<div class="col-6">
					<div class="form-group">
						<label for="name">Role Name</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Role Name" value="{{ $role->name ?? old('name') }}" id="name">

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
						<select class="form-control" name="active" id="active">
							<option>Select Active State</option>
							<option value="1" {{ $role->active == 1 ? ' selected' : '' }}>Yes</option>
							<option value="0" {{ $role->active == 0 ? ' selected' : '' }}>No</option>
						</select>

						@error('active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
			</div>

			<div class="row mb-5 mt-5">
				<div class="col-12">
					<h3 class="mb-5">Permissions</h3>
					
					<div class="row">
						
						@foreach ($permissions as $permission)
                            <div class="col-2">
                            	<div class="form-group form-row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" value="{{ $permission->id }}" id="permission{{ $permission->id }}" name="permissions[]" {{ in_array($permission->id, $currentPermissions) ? ' checked' : '' }}>
                                        <label class="custom-control-label" for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                                    </div>
                                </div>
                            </div>
						@endforeach

					</div>

				</div>
			</div>

			<div class="row">

				<div class="col-12">
					<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('roles.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg"></i> Update Role</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop