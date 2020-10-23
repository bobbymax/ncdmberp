@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Nominations 
    </h1><br>
    <a href="{{ route('nominations.create') }}" class="btn btn-sm btn-primary">Nominate Staffs</a>
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
	                    <th>Training</th>
                        <th>Category</th>
                        <th>Period</th>
                        <th>Provider</th>
                        <th>Location</th>
                        <th>Nominated Staffs</th>
                        <th>Action</th>
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($details as $detail)
                        <tr class="gradeX">
                            <td>{{ $detail->training->title }}</td>
                            <td>{{ $detail->course->name }}</td>
                            <td>{{ $detail->lifecycle() }}</td>
                            <td>{{ $detail->vendor }}</td>
                            <td>{{ $detail->location }}</td>
                            <th>{{ $detail->nominations->count() }}</th>
                            <td>
                                <form action="{{ route('nominations.destroy', $detail->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                                        <a href="{{ route('hr.show.nominations', $detail->id) }}" class="btn btn-sm btn-success"><i class="icon icon-eye icon-lg"></i></a>

                                        @if ($detail->action === "pending")
                                            <a href="{{ route('nominations.edit', $detail->id) }}" class="btn btn-sm btn-info"><i class="icon icon-settings icon-lg"></i></a>
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="icon icon-trash icon-lg"></i></button>
                                        @endif
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Training</th>
                        <th>Category</th>
                        <th>Period</th>
                        <th>Provider</th>
                        <th>Location</th>
                        <th>Number of Staffs</th>
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