@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Manage Nominations 
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
	                    <th>Training</th>
                        <th>Category</th>
                        <th>Period</th>
                        <th>Provider</th>
                        <th>Location</th>
                        <th>Nominated Staffs</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($details as $detail)
                        @if (in_array(auth()->user()->deptID(), $detail->currentDepartments()))
                            <tr class="gradeX">
                                <td>{{ $detail->training->title }}</td>
                                <td>{{ $detail->course->name }}</td>
                                <td>{{ $detail->lifecycle() }}</td>
                                <td>{{ $detail->vendor }}</td>
                                <td>{{ $detail->location }}</td>
                                <th>{{ $detail->nominations->count() }}</th>
                                <td>
                                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                                        <a href="{{ route('nominations.show', $detail->id) }}" class="btn btn-sm btn-success"><i class="icon icon-eye icon-lg"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Training</th>
                        <th>Category</th>
                        <th>Period</th>
                        <th>Provider</th>
                        <th>Location</th>
                        <th>Number of Staffs</th>
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