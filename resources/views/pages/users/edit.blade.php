@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Update Staff Record
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

		<form role="form" action="{{ route('staffs.update', $staff->staff_no) }}" method="POST" enctype="multipart/form-data">
			@csrf
			@method('PATCH')

			<div class="row">
				<div class="col-4">
					<div class="form-group">
						<label for="name">Full Name (Surname first)</label>
						<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Staff Name" value="{{ $staff->name ?? old('name') }}" id="name">

						@error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="email">Email Address</label>
						<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" value="{{ $staff->email ?? old('email') }}" id="email" {{ $staff->email !== null ? ' readonly' : '' }}>

						@error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="staff_no">Staff Number</label>
						<input type="text" name="staff_no" class="form-control @error('staff_no') is-invalid @enderror" placeholder="Enter Staff Number" value="{{ $staff->staff_no ?? old('staff_no') }}" id="staff_no">

						@error('staff_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="grade_level">Grade Level</label>

						<select name="grade_level" class="form-control @error('grade_level') is-invalid @enderror" id="grade_level">
							<option value="">Select Grade Level</option>
							@foreach ($grades as $grade)
								<option value="{{ $grade->level }}" {{ $staff->grade_level === $grade->level ? ' selected' : '' }}>{{ $grade->level }}</option>
							@endforeach
						</select>

						@error('grade_level')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="location">Location</label>

						<select name="location" class="form-control @error('location') is-invalid @enderror" id="location">
							<option value="">Select Location</option>
							@foreach ($locations as $location)
								<option value="{{ $location->label }}"  {{ $staff->location === $location->label ? ' selected' : '' }}>{{ $location->name }}</option>
							@endforeach
						</select>

						@error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="mobile">Mobile Number</label>
						<input type="number" name="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter Mobile Number" value="{{ $staff->mobile ?? old('mobile') }}" id="mobile">

						@error('mobile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="office_no">Office Number</label>
						<input type="number" name="office_no" class="form-control @error('office_no') is-invalid @enderror" placeholder="Enter Office Number" value="{{ $staff->office_no ?? old('office_no') }}" id="office_no">

						@error('office_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="type">Employment Type</label>
						<select name="type" class="form-control @error('type') is-invalid @enderror" id="type">
							<option value="">Select Employment Type</option>
							<option value="permanent" {{ $staff->type === "permanent" ? ' selected' : '' }}>Permanent</option>
							<option value="contract" {{ $staff->type === "contract" ? ' selected' : '' }}>Contract</option>
							<option value="secondee" {{ $staff->type === "secondee" ? ' selected' : '' }}>Secondment</option>
							<option value="transfer" {{ $staff->type === "transfer" ? ' selected' : '' }}>Transfer of Service</option>
						</select>

						@error('type')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="avatar">Avatar</label>
						<input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" id="avatar">

						@error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="date_joined">Date Joined</label>
						<input type="date" name="date_joined" class="form-control @error('date_joined') is-invalid @enderror" value="{{ $staff->date_joined ?? old('date_joined') }}" id="date_joined">

						@error('date_joined')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-3">
					<div class="form-group">
						<label for="status">Employment Status</label>
						<select name="status" class="form-control @error('status') is-invalid @enderror" id="status">
							<option value="">Select Employment Type</option>
							<option value="available" {{ $staff->status === "available" ? ' selected' : '' }}>Available</option>
							<option value="leave" {{ $staff->status === "leave" ? ' selected' : '' }}>Leave</option>
							<option value="secondment" {{ $staff->status === "secondment" ? ' selected' : '' }}>Secondment</option>
							<option value="training" {{ $staff->status === "training" ? ' selected' : '' }}>Training</option>
						</select>

						@error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-12 mb-5">

					<div class="row">
						<div class="col-4">
							<label for="directorate">Directorate</label>
							<select class="form-control" name="departments[]" id="directorate">
								<option value="">Select Directorate</option>
								@foreach ($departments as $directorate)
									@if ($directorate->vocabulary->label === "directorate")
										<option value="{{ $directorate->id }}" {{ in_array($directorate->id, $currentDepartments) ? ' selected' : '' }}>{{ $directorate->name }}</option>
									@endif
								@endforeach
							</select>
						</div>

						<div class="col-4">
							<label for="division">Division</label>
							<select class="form-control" name="departments[]" id="division">
								<option value="" disabled>Select Division</option>
								<option value="0" selected>None</option>
								@foreach ($departments as $division)
									@if ($division->vocabulary->label === "division")
										<option value="{{ $division->id }}" {{ in_array($division->id, $currentDepartments) ? ' selected' : '' }}>{{ $division->name }}</option>
									@endif
								@endforeach
							</select>
						</div>

						<div class="col-4">
							<label for="department">Department</label>
							<select class="form-control" name="departments[]" id="department">
								<option value="">Select Department</option>
								@foreach ($departments as $department)
									@if ($department->vocabulary->label === "department")
										<option value="{{ $department->id }}" {{ in_array($department->id, $currentDepartments) ? ' selected' : '' }}>{{ $department->name }}</option>
									@endif
								@endforeach
							</select>
						</div>
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
                                        <input type="checkbox" class="custom-control-input" value="{{ $role->id }}" id="role{{ $role->id }}" name="roles[]" {{ in_array($role->id, $currentRoles) ? ' checked' : '' }}>
                                        <label class="custom-control-label" for="role{{ $role->id }}">{{ $role->name }}</label>
                                        <a href="{{ route('roles.revoked', [$staff->staff_no, $role->id]) }}"> - revoke</a>
                                    </div>
                                </div>
                            </div>
						@endforeach

					</div>

				</div>
			</div>

			<div class="row mt-5 mb-5">
				<div class="col-12">
					<div class="btn-group" role="group" aria-label="Basic example">
                        <a href="{{ route('staffs.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg"></i> Cancel</a>
                        <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg"></i> Update Staff Record</button>
                    </div>
				</div>
			</div>
		</form>

    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop
