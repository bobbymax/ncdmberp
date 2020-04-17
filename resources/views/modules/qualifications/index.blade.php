@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Training Qualifications 
    </h1><br>
    <a href="{{ route('qualifications.create') }}" class="btn btn-sm btn-primary">Add Qualification</a>
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
                        <th>Period</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($qualifications as $qualification)
                        <tr class="gradeX">
                            <td>{{ $qualification->name }}</td>
                            <td>{{ $qualification->label }}</td>
                            <td>{{ $qualification->periodspan() }}</td>
                            <td>
								
								<form action="{{ route('qualifications.destroy', $qualification->label) }}" method="POST">
									@csrf
									@method('DELETE')
									
									<div class="btn-group" role="group" aria-label="Basic example">
	                                    <a href="{{ route('qualifications.edit', $qualification->label) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
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
                        <th>Period</th>
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