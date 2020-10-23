@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">Grade Levels</h1><br>
    <a href="{{ route('grades.create') }}" class="btn btn-sm btn-primary">Add Grade Level</a>
</div>
@stop
@section('content')
<style>
		
	.td {
		padding: 0;
		width: 35%;
		max-width: 50%;
	}

</style>
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
	                    <th>Level</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($grades as $grade)
                        <tr class="gradeX">
                            <td>{{ $grade->name }}</td>
                            <td>{{ $grade->level }}</td>
                            <td class="td">
								
								<form action="{{ route('grades.destroy', $grade->id) }}" method="POST">
									@csrf
									@method('DELETE')
									
									<div class="btn-group float-right" role="group" aria-label="Basic example">
	                                    <a href="{{ route('grades.edit', $grade->id) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
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
                    <th>Level</th>
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