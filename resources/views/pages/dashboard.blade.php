@extends('layouts.master')
@section('content')
	<div class="row">
        <!-- Grid Item -->
        <div class="col-xl-6">

            <!-- Card -->
            <div class="dt-card">

                <!-- Card Header -->
                <div class="dt-card__header px-5 pt-4 mb-4">

                    <!-- Card Heading -->
                    <div class="dt-card__heading">
                        <h3 class="dt-card__title f-12 font-weight-400">
                            <i class="icon icon-bitcoin text-primary mr-1 icon-2x"></i>
                            <span class="align-middle">Training Statistics</span>
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
                        <div class="col-12">
                            {{--  
                            <div class="d-flex align-items-center">
                                <span class="f-16 text-success mr-1">84%</span>
                                <i class="icon icon-pointer-up text-success"></i>
                            </div>
                            --}}
                            <canvas id="myChart"></canvas>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

    <script>
        var ctx = document.getElementById("myChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [],
                    backgroundColor : [
                        'rgba(39, 174, 96,1.0)',
                        'rgba(243, 156, 18,1.0)',
                        'rgba(155, 89, 182,1.0)',
                        'rgba(52, 73, 94,1.0)'
                    ]
                }],

                labels : []
            }
        });

        var updateChart = function() {
            $.ajax({
                url: "{{ route('api.chart') }}",
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    myChart.data.datasets[0].data = data.data;
                    myChart.data.labels = data.labels;
                    myChart.update();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }

        updateChart();
        setInterval(() => {
            updateChart();
        }, 10000);
    </script>

@stop