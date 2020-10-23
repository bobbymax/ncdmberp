@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Applications 
    </h1><br>
    @can('manipulate', App\Application::class)
        <a href="{{ route('applications.create') }}" class="btn btn-sm btn-primary">Create Application</a>
    @endcan
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
                        <th>Code</th>
                        <th>Status</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($applications as $application)
                        @can('accessible', $application)
                            <tr class="gradeX">
                                <td>{{ $application->name }}</td>
                                <td>{{ $application->code ?? 'Not Set' }}</td>
                                <td>{{ $application->active == 1 ? 'Active!' : 'Not Active' }}</td>
                                <td>
                                    
                                    <form action="{{ route('applications.destroy', $application->code) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                                            <a href="{{ route('applications.show', $application->code) }}" class="btn btn-sm btn-success"><i class="icon icon-eye icon-lg"></i></a>
                                            @can('manipulate', $application)
                                                <a href="{{ route('applications.edit', $application->code) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="icon icon-trash icon-lg"></i></button>
                                            @endcan
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endcan
                        
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
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