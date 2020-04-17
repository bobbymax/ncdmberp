@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Categorise Trainings for {{ $staff->name }}
    </h1>
</div>
@stop
@section('content')
@if (session('status'))
	<div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div class="row">
	@foreach ($trainings as $training)
		<!-- Grid Item -->
        <div class="col-xl-4 col-sm-6 dt-masonry__item">
            <!-- Card -->
            <div class="card">
                <!-- Card Body -->
                <div class="card-body">
                	<span class="badge badge-primary mb-5">{{ ucfirst($training->training_type) }}</span>
                	<span class="badge badge-success mb-5">{{ $training->category->name }}</span>
                    <!-- Card Title-->
                    <h2 class="card-title">{{ $training->title }}</h2>
                    <!-- Card Title-->
                    <p class="card-text">{{ $training->provider }}</p>
                    <!-- /card text-->
                </div>
                <!-- /card body -->

                <!-- List Group -->
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Category:</strong> {{ $training->categoryType->name . " / " . $training->topicArea->name }}</li>
                    <li class="list-group-item"><strong>Location:</strong> {{ $training->location }}</li>
                    <li class="list-group-item"><strong>Duration:</strong> {{ $training->lifecycle() }}</li>
                </ul>
                <!-- /list group-->

                <!-- Card Body -->
                <div class="card-body">

                    <!-- Card Button-->
                    <a href="{{ route('confirm.category', $training->label) }}" class="btn btn-primary btn-sm">Confirm &amp; Archive</a>
                    <!-- /card button-->

                </div>
                <!-- /card body -->

            </div>
            <!-- /card -->

        </div>
        <!-- /grid item -->
	@endforeach

	<div class="col-12 mt-3">
		<a href="{{ route('categorise.trainings') }}" class="btn btn-danger btn-sm">Go Back</a>
	</div>
</div>
@stop