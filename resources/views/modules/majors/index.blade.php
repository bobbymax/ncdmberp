@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Course Majors
    </h1><br>
    <a href="{{ route('majors.create') }}" class="btn btn-sm btn-primary">Add Course Major</a>
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
                        <th>Status</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($majors as $major)
                        <tr class="gradeX">
                            <td>{{ $major->name }}</td>
                            <td>{{ $major->state() }}</td>
                            <td>
								
								<form action="{{ route('majors.destroy', $major->label) }}" method="POST">
									@csrf
									@method('DELETE')
									
									<div class="btn-group float-right" role="group" aria-label="Basic example">
	                                    <a href="{{ route('majors.edit', $major->label) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
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