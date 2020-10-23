@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Nogic Api Integrations
    </h1><br>
    <a href="{{ route('apiResources.create') }}" class="btn btn-sm btn-primary"><i class="mr-3 icon icon-lg icon-plus"></i>Add Consumable</a>
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
                        <th>URL</th>
                        <th>Method</th>
                        <th>Published</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($apiResources as $resource)
                        <tr class="gradeX">
                            <td>{{ $resource->name }}</td>
                            <td>{{ $resource->url }}</td>
                            <td>{{ $resource->method }}</td>
                            <td>{{ $resource->published == 1 ? 'Yes' : 'No' }}</td>
                            <td>
								
								<form action="{{ route('apiResources.destroy', $resource->label) }}" method="POST">
									@csrf
									@method('DELETE')
									
									<div class="btn-group float-right" role="group" aria-label="Basic example">
	                                    <a href="{{ route('apiResources.edit', $resource->label) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
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
                        <th>URL</th>
                        <th>Method</th>
                        <th>Published</th>
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