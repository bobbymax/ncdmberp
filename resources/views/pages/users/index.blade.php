@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Staffs 
    </h1><br>
    <a href="{{ route('staffs.create') }}" class="btn btn-sm btn-primary">Add Staff</a>
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
        <!-- Tables -->
        <div class="table-responsive">

            <table id="data-table" class="table table-striped table-bordered table-hover">
                <thead>
	                <tr>
	                    <th>Staff Number</th>
                        <th>Name</th>
	                    <th>Grade Level</th>
                        <th>Location</th>
                        <th>Employment Type</th>
                        <th>Status</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($staffs as $staff)
                        <tr class="gradeX">
                            <td>{{ $staff->staff_no ?? 'Not Issued' }}</td>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->grade_level ?? 'Not Set' }}</td>
                            <td>{{ ucwords($staff->location) ?? 'Not Set' }}</td>
                            <td>{{ ucwords($staff->type) }}</td>
                            <td>{{ ucwords($staff->status) }}</td>
                            <td>

                                <div class="btn-group float-right" role="group" aria-label="Basic example">
                                    <a href="{{ route('staffs.show', $staff->staff_no) }}" class="btn btn-sm btn-success"><i class="icon icon-eye icon-lg"></i></a>
                                    <a href="{{ route('staffs.edit', $staff->staff_no) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
                                </div>

                                {{--  
								
								<form action="{{ route('staffs.destroy', $staff->staff_no) }}" method="POST">
									@csrf
									@method('DELETE')
									
									<div class="btn-group float-right" role="group" aria-label="Basic example">
                                        <a href="{{ route('staffs.show', $staff->staff_no) }}" class="btn btn-sm btn-success"><i class="icon icon-eye icon-lg"></i></a>
	                                    <a href="{{ route('staffs.edit', $staff->staff_no) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
                                        @if ($staff->id !== auth()->user()->id) 
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="icon icon-trash icon-lg"></i></button>
                                        @endif
	                                </div>
								</form>
                                --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Staff Number</th>
                        <th>Name</th>
                        <th>Grade Level</th>
                        <th>Location</th>
                        <th>Employment Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

        </div>
        <!-- /tables -->

    </div>
    <!-- /card body -->

</div>
<!-- /card -->
@stop