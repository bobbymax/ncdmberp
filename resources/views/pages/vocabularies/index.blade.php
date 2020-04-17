@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Vocabularies 
    </h1><br>
    <a href="{{ route('vocabularies.create') }}" class="btn btn-sm btn-primary">Add Vocabulary</a>
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
                        <th>Executive</th>
                        <th>Active</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($vocabularies as $vocabulary)
                        <tr class="gradeX">
                            <td>{{ $vocabulary->name }}</td> 
                            <td>{{ $vocabulary->executive !== 0 ? $vocabulary->management->name : 'None!' }}</td>
                            <td>{{ $vocabulary->active == 1 ? 'Yes!!!' : 'No!' }}</td>
                            <td class="td">
								
								<form action="{{ route('vocabularies.destroy', $vocabulary->id) }}" method="POST">
									@csrf
									@method('DELETE')
									
									<div class="btn-group float-right" role="group" aria-label="Basic example">
	                                    <a href="{{ route('vocabularies.edit', $vocabulary->id) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
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
                    <th>Executive</th>
                    <th>Active</th>
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