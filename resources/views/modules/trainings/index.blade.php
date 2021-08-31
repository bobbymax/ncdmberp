@extends('layouts.master')
@section('page-header')
@if (session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Trainings 
    </h1><br>
    <a href="{{ route('trainings.create') }}" class="btn btn-sm btn-primary">Add Training</a>
    @if (auth()->user()->details->where('completed', 1)->where('categorised', 1)->count() > 0)
        <a href="{{ route('print.trainings', auth()->user()->staff_no) }}" class="btn btn-secondary btn-sm">Default Print Trainings</a><br><br>

        <div class="dt-card">
            <div class="dt-card__body">
                <form action="{{ route('printables') }}" method="POST">
                    @csrf
                    <h3 class="mb-5">Print Options</h3>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label for="course_id">Category</label>
                                <select name="course_id" class="form-control" id="">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="resident">Resident</label>
                                <select name="resident" class="form-control" id="">
                                    <option value="">Select Resident</option>
                                    <option value="local">Local</option>
                                    <option value="international">International</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="sponsor">Training Sponsor</label>
                                <select name="sponsor" class="form-control" id="">
                                    <option value="">Select Sponsor</option>
                                    <option value="ncdmb">NCDMB</option>
                                    <option value="previous-employer">Previous Employer</option>
                                    <option value="personal">Personal</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" class="form-control" id="">
                                    <option value="">Select Status</option>
                                    <option value="archived">Archived</option>
                                    <option value="pending">Unarchived</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mb-5 mt-5">
                            <h3 class="mb-5">Display Columns</h3>
                            <div class="row">
                                @foreach ($columns as $key => $column)
                                    <div class="col-2">
                                        <div class="form-group form-row">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" value="{{ $key }}" id="columns{{ $key }}" name="columns[]" checked>
                                                <label class="custom-control-label" for="columns{{ $key }}">{{ $column }}</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-info float-right">Print Trainings</button>
                            </div>
                        </div>
                    </div>      
                </form>
            </div>
        </div>
    @endif
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
                                                @can('delete', $training)
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="icon icon-trash icon-lg"></i></button>
                                                @endcan
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