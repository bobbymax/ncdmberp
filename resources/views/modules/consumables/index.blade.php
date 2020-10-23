@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
        {{ $resource->name }}
    </h1><br>
</div>
@stop
@section('content')
<!-- Card -->
<div class="dt-card">

    <!-- Card Body -->
    <div class="dt-card__body">
        <!-- Tables -->
        <div class="table-responsive">

            <table id="data-table" class="table table-striped table-bordered table-hover">
                <thead>
	                <tr>
                        @foreach ($resource->browseable() as $nugget)
                            <th>{{ $nugget->display_name ?? $nugget->key }}</th>
                        @endforeach
	                </tr>
                </thead>
                <tbody>
                    
                    @foreach ($response as $data)
                        <tr class="gradeX">
                            @foreach ($resource->browseable() as $nugget)
                                @if (! is_array($data[$nugget->key]))
                                    <td>{{ $data[$nugget->key]  }}</td>
                                @else
                                    <td>{{ __('Array') }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        @foreach ($resource->browseable() as $nugget)
                            <th>{{ $nugget->display_name ?? $nugget->key }}</th>
                        @endforeach
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