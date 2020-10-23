@extends('layouts.master')
@section('content')
	<div class="row">
		<!-- Grid Item -->
        <div class="col-xl-4">

            <!-- Card -->
            <div class="dt-card">

                <!-- Card Header -->
                <div class="dt-card__header px-5 pt-4 mb-4">

                    <!-- Card Heading -->
                    <div class="dt-card__heading">
                        <h3 class="dt-card__title f-12 font-weight-400">
                            <i class="icon icon-bitcoin text-primary mr-1 icon-2x"></i>
                            <span class="align-middle">No. of Trainings</span>
                        </h3>
                    </div>
                    <!-- /card heading -->

                    <div id="chart" style="height: 300px;"></div>

                </div>
                <!-- /card header -->

                <!-- Card Body -->
                <div class="dt-card__body px-5 pb-4">
                    <!-- Grid -->
                    <div class="row no-gutters">

                        <!-- Grid Item -->
                        <div class="col-6">
                        	{{--  
                            <div class="d-flex align-items-center">
                                <span class="f-16 text-success mr-1">84%</span>
                                <i class="icon icon-pointer-up text-success"></i>
                            </div>
                            --}}
                            <span class="display-4 font-weight-500 text-dark">{{ auth()->user()->details->count() }}</span>
                        </div>
                        <!-- /grid item -->

                        <!-- Grid Item -->
                        <div class="col-6">

                            <!-- Chart Body -->
                            <div class="dt-chart__body">
                                <div id="ct-widget-line-chart"
                                     class="height-100 stroke-w-3 drop-shadow stroke-primary mt-n8 mb-n2"></div>
                            </div>
                            <!-- /chart body -->

                        </div>
                        <!-- /grid item -->

                    </div>
                    <!-- /grid -->

                </div>
                <!-- /card body -->

            </div>
            <!-- /card -->

        </div>
        <!-- /grid item -->

        <!-- Grid Item -->
        <div class="col-xl-4">

            <!-- Card -->
            <div class="dt-card">

                <!-- Card Header -->
                <div class="dt-card__header px-5 pt-4 mb-4">

                    <!-- Card Heading -->
                    <div class="dt-card__heading">
                        <h3 class="dt-card__title f-12 font-weight-400">
                            <i class="icon icon-etherium text-primary mr-1 icon-2x"></i>
                            <span class="align-middle">No. of Uncategorised Trainings</span>
                        </h3>
                    </div>
                    <!-- /card heading -->

                </div>
                <!-- /card header -->

                <!-- Card Body -->
                <div class="dt-card__body px-5 pb-4">
                    <!-- Grid -->
                    <div class="row no-gutters">

                        <!-- Grid Item -->
                        <div class="col-6">
                        	{{--  
                            <div class="d-flex align-items-center text-success">
                                <span class="f-16 mr-1">07%</span>
                                <i class="icon icon-pointer-up"></i>
                            </div>
                            --}}
                            <span class="display-4 font-weight-500 text-dark">{{ auth()->user()->details->where('categorised', 0)->count() }}</span>
                        </div>
                        <!-- /grid item -->

                        <!-- Grid Item -->
                        <div class="col-6">

                            <!-- Chart Body -->
                            <div class="dt-chart__body">
                                <div id="ct-widget-line-chart2"
                                     class="height-100 stroke-w-3 drop-shadow stroke-success mt-n8 mb-n2"></div>
                            </div>
                            <!-- /chart body -->

                        </div>
                        <!-- /grid item -->

                    </div>
                    <!-- /grid -->

                </div>
                <!-- /card body -->

            </div>
            <!-- /card -->

        </div>
        <!-- /grid item -->

        <!-- Grid Item -->
        <div class="col-xl-4">

            <!-- Card -->
            <div class="dt-card">

                <!-- Card Header -->
                <div class="dt-card__header px-5 pt-4 mb-4">

                    <!-- Card Heading -->
                    <div class="dt-card__heading">
                        <h3 class="dt-card__title f-12 font-weight-400">
                            <i class="icon icon-ripple text-primary mr-1 icon-2x"></i>
                            <span class="align-middle">Proposed Trainings</span>
                        </h3>
                    </div>
                    <!-- /card heading -->

                </div>
                <!-- /card header -->

                <!-- Card Body -->
                <div class="dt-card__body px-5 pb-4">
                    <!-- Grid -->
                    <div class="row no-gutters">

                        <!-- Grid Item -->
                        <div class="col-6">
                        	{{--  
                            <div class="d-flex align-items-center text-danger">
                                <span class="f-16 mr-1">08%</span>
                                <i class="icon icon-pointer-down"></i>
                            </div>
                            --}}
                            <span class="display-4 font-weight-500 text-dark">{{ auth()->user()->nominations->count() }}</span>
                        </div>
                        <!-- /grid item -->

                        <!-- Grid Item -->
                        <div class="col-6">

                            <!-- Chart Body -->
                            <div class="dt-chart__body">
                                <div id="ct-widget-line-chart3"
                                     class="height-100 stroke-w-3 drop-shadow stroke-secondary mt-n8 mb-n2"></div>
                            </div>
                            <!-- /chart body -->

                        </div>
                        <!-- /grid item -->

                    </div>
                    <!-- /grid -->

                </div>
                <!-- /card body -->

            </div>
            <!-- /card -->

        </div>
        <!-- /grid item -->
	</div>
@stop
@section('scripts')

    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "{{ route('charts.trainings') }}",
        });
    </script>

@stop