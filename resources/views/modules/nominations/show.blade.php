@extends('layouts.master')
@section('page-header')
<div class="dt-page__header">
    <h1 class="dt-page__title">
       Manage Nominations 
    </h1>
</div>
@stop
@section('content')
	<div class="row">
		<div class="col-6">
			<div class="dt-card">
				<!-- Card Body -->
	    		<div class="dt-card__body">
					<h2 class="card-title">{{ $nomination->training->title }}</h2>
					<h4 class="mb-5 card-subtitle">Facilitator: {{ $nomination->vendor }}</h4>

					<p class="card-text">
						The following staffs have been nomited to attend the above named training on your approval.
					</p>

					<ul class="list-group">
						<li class="list-group-item">Qualification: {{ $nomination->qualification->name }}</li>
						<li class="list-group-item">Course: {{ $nomination->course->name }}</li>
						<li class="list-group-item">Major: {{ $nomination->training->major->name }}</li>
						<li class="list-group-item">Resident: {{ ucfirst($nomination->resident) }}</li>
						<li class="list-group-item">Location: {{ $nomination->location }}</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="dt-card">
				<!-- Card Header -->
                <div class="dt-card__header">

                    <!-- Card Heading -->
                    <div class="dt-card__heading">
                        <h3 class="dt-card__title">Nominated Staffs</h3>
                    </div>
                    <!-- /card heading -->

                </div>
                <!-- /card header -->
				<!-- Card Body -->
	    		<div class="dt-card__body">
					<!-- Accordion -->
                    <div class="accordion" id="accordion-example">
                    	@foreach ($nomination->nominations as $data)
                    		@if (auth()->user()->deptID() == $data->staff->deptID())
                    			<div class="card">
		                            <div class="card-header" id="headingOne">
		                                <h5 class="mb-0">
		                                    <button class="btn btn-link" type="button" data-toggle="collapse"
		                                            data-target="#collapse-{{ $data->id }}"
		                                            aria-expanded="true" aria-controls="collapse-{{ $data->id }}">
		                                        {{ $data->staff->name }}
		                                    </button>
		                                </h5>
		                            </div>

		                            <div id="collapse-{{ $data->id }}" class="collapse" aria-labelledby="headingOne"
		                                 data-parent="#accordion-example">
		                                <div class="card-body">
		                                	@if ($data->state === "pending" && $data->remark == null)
		                                		<form action="{{ route('nomination.decision', $data->id) }}" method="POST">
			                                    	@csrf

													<div class="form-group">
														<label for="approval">Decision</label>
														<select class="form-control @error('approval') is-invalid @enderror" name="approval" id="approval{{ $data->staff->staff_no }}">
															<option>Make a Decision</option>
															@foreach ($data->decisions() as $key => $decision)
																<option value="{{ $key }}" {{ old('approval') == $key ? ' selected' : '' }}>{{ $decision }}</option>
															@endforeach
														</select>

														@error('approval')
									                        <span class="invalid-feedback" role="alert">
									                            <strong>{{ $message }}</strong>
									                        </span>
									                    @enderror
													</div>

													<div class="form-group">
														<label for="remark">Comment</label>
														<textarea class="form-control @error('remark') is-invalid @enderror" rows="5" name="remark">{!! old('remark') !!}</textarea>

														@error('remark')
									                        <span class="invalid-feedback" role="alert">
									                            <strong>{{ $message }}</strong>
									                        </span>
									                    @enderror
													</div>

													<div class="btn-group" role="group" aria-label="Basic example">
									                    <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg mr-3"></i> {{ strtoupper('Submit') }}</button>
									                </div>

			                                    </form>
			                                @else
			                                	<p class="mb-3">{{ $data->remark }}</p>
			                                	<span class="badge badge-{{ $data->approval === 1 ? 'success' : 'danger' }} mb-1 mr-1">{{ $data->state }}</span>
		                                	@endif
		                                </div>
		                            </div>
		                        </div>
                    		@endif
                    	@endforeach
                    </div>
                    <!-- /accordion -->
				</div>
			</div>
		</div>

		<div class="col-12">
			<a href="{{ route('manage.nominations') }}" class="mt-5 btn btn-info">Go Back</a>
		</div>
	</div>
@stop