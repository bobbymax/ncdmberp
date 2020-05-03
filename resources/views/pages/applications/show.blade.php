@extends('layouts.master')
@section('page-header')
<div class="dt-entry__header">

    <!-- Entry Heading -->
    <div class="dt-entry__heading">
        <h3 class="dt-entry__title">{{ $application->name }}</h3>
    </div>
    <!-- /entry heading -->

</div>
@stop
@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="row">
    <div class="col-12 mb-3">
        <a href="{{ route('modules.create', $application->code) }}" class="btn btn-primary btn-sm">Add Module</a>
    </div>
</div>
<div class="row">
    @foreach ($application->modules as $module)
        @can('accessible', $module)
            <div class="col-3 col-sm-3">
                <!-- Card -->
                <div class="card dt-card__full-height bg-gradient-blue text-white">

                    <!-- Card Body -->
                    <div class="card-body p-6">
                        <div class="d-flex flex-wrap mb-3">
                            <ion-icon name="albums-outline" size="large"></ion-icon>
                            <a class="text-white ml-auto" href="{{ route('modules.show', [$application->code, $module->code]) }}"><i class="icon icon-arrow-right icon-2x"></i></a>
                        </div>

                        <p class="display-3 mb-2 font-weight-500">{{ strtoupper($module->code) }}</p>
                        <p class="card-text">{{ $module->name }}  | <a href="{{ route('modules.edit', [$application->code, $module->code]) }}">edit</a></p>
                    </div>
                    <!-- /card body -->

                </div>
                <!-- /card -->

            </div>
        @endcan
    @endforeach
</div>
@stop