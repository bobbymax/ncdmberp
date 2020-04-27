@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Trainings 
    </h1><br>
    <a href="{{ route('trainings.create') }}" class="btn btn-sm btn-primary">Add Training</a>
    <a href="{{ route('print.trainings', auth()->user()->staff_no) }}" class="btn btn-info btn-sm">Print Trainings</a>
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
	                    <th>Title</th>
                        <th>Major</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($trainings as $training)
                        @can('view', $training)
                            <tr class="gradeX">
                                <td>{{ $training->title }}</td>
                                <td>{{ $training->major->name }}</td>
                                <td>
                                    <form action="{{ route('trainings.destroy', $training->label) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                                            <a href="{{ route('trainings.show', $training->label) }}" class="btn btn-sm btn-success"><i class="icon icon-eye icon-lg"></i></a>
                                            @can('update', $training)
                                                <a href="{{ route('trainings.edit', $training->label) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
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
                        <th>Title</th>
                        <th>Major</th>
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