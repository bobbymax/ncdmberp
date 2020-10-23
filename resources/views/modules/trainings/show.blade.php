@extends('layouts.master')
@section('title', 'NCDMB | Archive Trainings')
@section('page-header')
	<div class="dt-page__header">
	    <h1 class="dt-page__title">
	       {{ $training->title }} 
	    </h1>
	    <a href="{{ route('details.create', $training->label) }}" class="btn btn-success btn-sm"><i class="icon icon-info icon-lg mr-3"></i>{{ strtoupper('Add New Details') }}</a>
	</div>
@stop
@section('content')
	@if (session('status'))
		<div class="alert alert-success">
	        {{ session('status') }}
	    </div>
	@endif
	<!-- Grid -->
    <div class="row">
    	@foreach ($training->details as $detail)
    		<!-- Grid Item -->
	        <div class="col-xl-3 col-sm-6">

	            <!-- Card -->
	            <div class="dt-card overflow-hidden">

	                <!-- Card Header -->
	                <div class="dt-card__header mb-4">

	                    <!-- Card Heading -->
	                    <div class="dt-card__heading">
	                        <h3 class="dt-card__title">{{ $detail->course->name }}</h3>
	                    </div>
	                    <!-- /card heading -->

	                    <!-- Card Tools -->
	                    <div class="dt-card__tools">
	                        <a class="text-light-gray" href="javascript:void(0)" data-container="body"
	                           data-toggle="popover"
	                           data-placement="top"
	                           data-content="{{ $training->title }}">
	                            <i class="icon icon-info icon-lg"></i> 
	                        </a>

	                        @if ($detail->status !== "scheduled")
	                        	<!-- Dropdown -->
		                        <div class="dropdown d-inline-block">
		                            <a class="dropdown-toggle no-arrow text-light-gray" href="#"
		                               data-toggle="dropdown"
		                               aria-haspopup="true" aria-expanded="false"> <i
		                                    class="icon icon-chevrolet-down icon-lg"></i> </a>

		                            <div class="dropdown-menu dropdown-menu-right">
		                                <a class="dropdown-item" href="{{ route('details.edit', [$training->label, $detail->id]) }}">Edit</a>
		                            </div>
		                        </div>
		                        <!-- /dropdown -->
	                        @endif
	                    </div>
	                    <!-- /card tools -->

	                </div>
	                <!-- /card header -->

	                <!-- Card Body -->
	                <div class="dt-card__body">
						<span class="badge badge-{{ $detail->categorised == 1 ? 'success' : 'primary' }} mb-5 mr-1">{{ $detail->categorised == 1 ? "categorised" : "uncategorised" }}</span>
	                	<!-- Project Title -->
                        <h3>{{ $detail->lifecycle() }}</h3>
                        <!-- /project title -->

                        <div class="justify-content-between">
                            <p class="text-muted f-12 mb-1"><strong>Provider:</strong> {{ $detail->vendor }}</p>
                            <p class="text-muted f-12 mb-1"><strong>Location:</strong> {{ $detail->location }}</p>
                            <p class="text-muted f-12 mb-1"><strong>Qualification:</strong> {{ $detail->qualification->name }}</p>
                            <p class="text-muted f-12 mb-1"><strong>Duration:</strong> {{ $detail->duration() }}</p>
                            <p class="text-muted f-12 mb-5"><strong>Sponsor:</strong> {{ strtoupper($detail->sponsor) }}</p>
                        </div>

	                    <div class="text-center">
	                        <div class="d-flex align-items-center">
	                            <!-- Project Team -->
	                            <ul class="dt-list dt-list-stack">
	                            	@foreach($detail->staffs as $staff)
	                                <li class="dt-list__item">
	                                    <!-- Avatar -->
	                                    <a class="dt-avatar size-30" href="javascript:void(0)"
	                                       data-hover="thumb-card"
	                                       data-thumb="{{ $staff->avatar !== null ? asset('images/staffs/'.$staff->avatar) : 'https://via.placeholder.com/150x150' }}"
	                                       data-name="{{ $staff->name }}">
	                                        <img src="{{ $staff->avatar !== null ? asset('images/staffs/'.$staff->avatar) : 'https://via.placeholder.com/150x150' }}"
	                                             alt="{{ $staff->name }}">
	                                    </a>
	                                    <!-- /avatar -->
	                                </li>
	                                @endforeach
	                            </ul>
	                            <!-- /project team -->

	                            <a href="javascript:void(0)" class="d-inline-block text-muted ml-4">
	                            	{{ $detail->staffs->count() }} Participant{{ $detail->staffs->count() > 1 ? 's' : '' }}
	                        	</a>
	                        </div>
	                    </div>

	                </div>
	                <!-- /card body -->
	                {{--  
	                <!-- Button -->
	                <a href="{{ !in_array(auth()->user()->id, $detail->attendees()) ? route('add.attendee', $detail->id) : 'javascript:void(0)' }}" class="btn btn-success btn-sm btn-block rounded-0" disabled>
	                	@if (! in_array(auth()->user()->id, $detail->attendees()))
	                		Add me to actual class
	                	@else
	                		{{ $detail->completed === 1 ? 'Already Attended' : 'Yet to Complete' }}
	                	@endif
	            	</a>
	                <!-- /button -->
	                --}}
	                <a href="javascript:void(0)" class="btn btn-success btn-block rounded-0 {{ in_array(auth()->user()->id, $detail->attendees()) ? ' disabled' : '' }}" data-toggle="modal" data-target="#exampleModalCenter{{ $detail->id }}">
					  	@if (! in_array(auth()->user()->id, $detail->attendees()))
	                		Add me to actual class
	                	@elseif(\Carbon\Carbon::now() < Carbon\Carbon::parse($detail->end_date))
	                		{{ __('Yet to Complete') }}
	                	@else
	                		{{ __('Already Attended') }}
	                	@endif
					</a>

					@include('modals.certificate')

	            </div>
	            <!-- /card -->

	        </div>
	        <!-- /grid item -->
    	@endforeach
    </div>
	<!-- end grid -->
@stop