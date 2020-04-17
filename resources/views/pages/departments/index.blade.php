@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Departments 
    </h1><br>
    <a href="{{ route('departments.create') }}" class="btn btn-sm btn-primary">Add Department</a>
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
	                    <th>Name</th>
                        <th>Type</th>
	                    <th>Executive</th>
                        <th>Code</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($departments as $department)
                        <tr class="gradeX">
                            <td>{{ $department->name }}</td>
                            <td>{{ $department->vocabulary->name }}</td>
                            <td>{{ $department->vocabulary->executive !== 0 ? $department->vocabulary->management->name : 'None' }}</td>
                            <td>{{ $department->code }}</td>
                            <td>
								
								<form action="{{ route('departments.destroy', $department->id) }}" method="POST">
									@csrf
									@method('DELETE')
									
									<div class="btn-group float-right" role="group" aria-label="Basic example">
	                                    <a href="{{ route('departments.edit', $department->id) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="icon icon-trash icon-lg"></i></button>
	                                </div>
								</form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Executive</th>
                        <th>Code</th>
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