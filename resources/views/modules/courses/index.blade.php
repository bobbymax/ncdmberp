@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
        Courses
    </h1><br>
    <a href="{{ route('courses.create') }}" class="btn btn-sm btn-primary">Add Course</a>
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
                        <th>Label</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($courses as $course)
                        <tr class="gradeX">
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->label }}</td>
                            <td>
								
								<form action="{{ route('courses.destroy', $course->label) }}" method="POST">
									@csrf
									@method('DELETE')
									
									<div class="btn-group" role="group" aria-label="Basic example">
	                                    <a href="{{ route('courses.edit', $course->label) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
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
                        <th>Label</th>
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