@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Confirm Staffs Training
    </h1>
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
	                	<th>Staff</th>
	                    <th>Title</th>
                        <th>Start Date</th>
                        <th>Duration</th>
                        <th>Location</th>
                        <th>Certificate</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($training->certificates as $certificate)
                        <tr class="gradeX">
                        	<td>{{ $certificate->staff->name }}</td>
                            <td>{{ $certificate->parent->training->title }}</td>
                            <td>{{ $certificate->parent->lifecycle() }}</td>
                            <td>{{ $certificate->parent->duration() }}</td>
                            <td>{{ $certificate->parent->location }}</td>
                            <td><img width="400" src="{{ asset('images/certificates/'. $certificate->path) }}" alt=""></td>
                            <td>
                            	@if ($certificate->status === "pending" && $certificate->confirmed != 1)
                            		<div class="btn-group float-right" role="group" aria-label="Basic example">
	                                	<a href="{{ route('confirm.staff.training', [$certificate->id, 'denied']) }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg mr-2"></i> Deny</a>
                                        @if ($certificate->path !== null)
                                            <a href="{{ route('confirm.staff.training', [$certificate->id, 'approved']) }}" class="btn btn-sm btn-success"><i class="icon icon-eye icon-lg mr-2"></i> Confirm</a>
                                        @endif
	                                </div>
	                            @else
	                            	<span class="badge badge-{{ $certificate->status === "approved" ? 'success' : 'danger' }}">{{ ucwords($certificate->status) }}</span>
                            	@endif
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Title</th>
                        <th>Start Date</th>
                        <th>Duration</th>
                        <th>Location</th>
                        <th>Staff</th>
                        <th>Certificate</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>

            <div class="btn-group float-right" role="group" aria-label="Basic example">
                <a href="{{ route('uncategorise.trainings') }}" class="btn btn-sm btn-primary"><i class="icon icon-basic-components icon-lg mr-2"></i> Back to Training List</a>
            </div>

        </div>
        <!-- /tables -->

    </div>
    <!-- /card body -->

</div>
<!-- /card -->
@stop