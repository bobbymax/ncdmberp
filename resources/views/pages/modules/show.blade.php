@extends('layouts.master')
@section('page-header')
<div class="dt-entry__header">

    <!-- Entry Heading -->
    <div class="dt-entry__heading">
        <h3 class="dt-entry__title">{{ $module->name }}</h3>
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
        <div class="col-xl-3 col-sm-6 col-12">

        <!-- Card -->
        <div class="dt-card dt-social-card animate-slide border border-w-2 border-light-green">
            <!-- Social Circle -->
            <div class="dt-social__circle bg-light-green">
                <a href="{{ route('pages.create', $module->code) }}">
                    <i class="icon icon-addnew icon-fw icon-3x text-light-green"></i>
                </a>
            </div>
            <!-- /social circle -->

            <!-- Card Body -->
            <div class="dt-card__body">
                <h3 class="font-weight-500 mb-1">Add Page</h3>
                <!-- List -->
                <ul class="dt-list dt-list-bordered dt-list-cm-0 flex-nowrap">
                    <!-- List Item -->
                    <li class="dt-list__item text-truncate">
                        <span><span class="text-dark"></span>Add new page to this Module</span>
                    </li>
                    <!-- /list item -->
                </ul>
                <!-- /list -->
            </div>
            <!-- /card body -->
        </div>
        <!-- /card -->

    </div>

    @foreach ($module->pages as $page)
        <div class="col-xl-3 col-sm-6 col-12">

        <!-- Card -->
        <div class="dt-card dt-social-card animate-slide border border-w-2 border-light-green">
            <!-- Social Circle -->
            <div class="dt-social__circle bg-light-green">
                <a href="#">
                    <i class="icon {{ $page->icon }} icon-fw icon-3x text-light-green"></i>
                </a>
            </div>
            <!-- /social circle -->

            <!-- Card Body -->
            <div class="dt-card__body">
                <h3 class="font-weight-500 mb-1">{{ $page->name }}</h3>
                <!-- List -->
                <ul class="dt-list dt-list-bordered dt-list-cm-0 flex-nowrap">
                    <!-- List Item -->
                    <li class="dt-list__item text-truncate">
                        <span><span class="text-dark"></span> view</span>
                    </li>
                    <!-- /list item -->

                    <!-- List Item -->
                    <li class="dt-list__item text-truncate">
                       <a href="{{ route('pages.edit', [$module->code, $page->label]) }}"><span><span class="text-dark"> </span> edit</span></a>
                    </li>
                    <!-- /list item -->

                    <!-- List Item -->
                    <li class="dt-list__item text-truncate">
                        <span><span class="text-dark"> </span> delete</span>
                    </li>
                    <!-- /list item -->
                </ul>
                <!-- /list -->
            </div>
            <!-- /card body -->
        </div>
        <!-- /card -->

        </div>
    @endforeach
    </div>
@stop