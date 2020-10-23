@extends('layouts.master')
@section('title', 'NCDMB | Archive Trainings')
@section('page-header')
	<div class="dt-page__header">
	    <h1 class="dt-page__title">
	       Nominate Staff for Training 
	    </h1><br>
	</div>
@stop
@section('content')
	
<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

	
		<form action="{{ route('nominations.store') }}" method="POST">
			
			@csrf

			<h3 class="mb-5">Training</h3>

			<div class="row">
				
				<div class="col-4">
				
					<div class="form-group">

						<label for="title">Training Title</label>
						<input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" placeholder="Enter Training Title" autocomplete="off">

						@error('title')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror

					</div>

				</div>

				<div class="col-4">
				
					<div class="form-group">

						<label for="major">Training Major</label>
						<select class="form-control" name="major" id="major">
							
							<option value="0" disabled selected>Select Training Major</option>
							@foreach ($majors as $major)
								<option value="{{ $major->label }}">{{ $major->name }}</option>
							@endforeach

						</select>

						@error('major')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror

					</div>

				</div>


				<div class="col-4">
					<div class="form-group">
						<label for="vendor">Provider</label>
						<input type="text" name="vendor" class="form-control @error('vendor') is-invalid @enderror" placeholder="Enter Training Provider" value="{{ old('vendor') }}">

						@error('vendor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>


				<div class="col-3">
					<div class="form-group">
						<label for="location">Location</label>
						<input type="text" name="location" class="form-control @error('location') is-invalid @enderror" placeholder="Enter Training Location" value="{{ old('location') }}">

						@error('location')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-3">

                    <!-- Form Group -->
                    <div class="form-group">
                    	<label for="start_date">Start Date</label>
                        <div class="input-group date" id="date-time-picker-7"
                             data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('start_date') is-invalid @enderror" data-target="#date-time-picker-7" name="start_date" id="start_date" placeholder="Enter Start Date" value="{{ old('start_date') }}">
                            <div class="input-group-append" data-target="#date-time-picker-7"
                                 data-toggle="datetimepicker">
                                <div class="input-group-text"><i class="icon icon-calendar"></i>
                                </div>
                            </div>
                        </div>
                        @error('start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- /form group -->

                </div>

                <div class="col-3">

                    <!-- Form Group -->
                    <div class="form-group">
                    	<label for="end_date">End Date</label>
                        <div class="input-group date" id="date-time-picker-8"
                             data-target-input="nearest">
                            <input type="text" class="form-control datetimepicker-input @error('end_date') is-invalid @enderror" data-target="#date-time-picker-8" name="end_date" id="end_date" placeholder="Enter End Date" value="{{ old('end_date') }}">
                            <div class="input-group-append" data-target="#date-time-picker-8"
                                 data-toggle="datetimepicker" id="ender">
                                <div class="input-group-text"><i class="icon icon-calendar"></i>
                                </div>
                            </div>
                        </div>
                        @error('end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- /form group -->

                </div>

                <div class="col-3">
					<div class="form-group">
						<label for="qualification_id">Qualification</label>
						<input type="text" name="qualification_id" class="form-control" value="{{ old('qualification_id') }}" id="qualification_id" readonly>

						@error('qualification_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="course_id">Course</label>
						<select class="form-control @error('course_id') is-invalid @enderror" name="course_id" id="course_id">
							<option value="" disabled selected>=== Select Course ===</option>
						</select>

						@error('course_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="sponsor">Training Sponsor</label>
						<select class="form-control @error('sponsor') is-invalid @enderror" name="sponsor" id="sponsor">
							<option value="">Select Sponsor</option>
							@foreach ($training->sponsors()['sponsors'] as $key => $sponsor)
								<option value="{{ $key }}">{{ $sponsor }}</option>
							@endforeach
						</select>

						@error('sponsor')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>

				<div class="col-4">
					<div class="form-group">
						<label for="resident">Training Residence</label>
						<select class="form-control @error('resident') is-invalid @enderror" name="resident" id="resident">
							<option value="">Select Residence</option>
							@foreach ($training->sponsors()['types'] as $key => $sponsor)
								<option value="{{ $key }}">{{ $sponsor }}</option>
							@endforeach
						</select>

						@error('resident')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
			</div>

			<h3 class="mb-5 mt-5">Staffs</h3>
			<div class="row mt-3">
				<div class="col-12">
					<div class="form-group">
						<input type="text" name="staffs" class="@error('staffs') is-invalid @enderror" placeholder="Select staffs to nominate" value="{{ old('staffs') }}" id="staffs">

						@error('staffs')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
					</div>
				</div>
				<div class="col-12 mt-5">
					<div class="btn-group" role="group" aria-label="Basic example">
	                    <a href="{{ route('trainings.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg mr-3"></i> {{ strtoupper('Cancel') }}</a>
	                    <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg mr-3"></i> {{ strtoupper('Create Training') }}</button>
	                </div>
				</div>
			</div>



		</form>


    </div>
    <!-- End Card Body -->
</div>
<!-- End Card -->

@stop

@section('scripts')

	<script>
		var url = "{{ route('get.dependencies') }}";
		var token = "{{ csrf_token() }}";
		var path = "{{ route('autocomplete') }}";
		var address = "{{ route('populate.existing') }}";
		var token = "{{ csrf_token() }}";
		var place = "{{ route('get.staffs') }}";
	</script>

	<script src="/js/scripts.js"></script>

	<script>

		var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
                  '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';
		
		$(document).ready(function() {

			$('#staffs').selectize({
				plugins: ['remove_button'],
				delimiter: ',',
			    persist: false,
			    valueField: 'email',
			    labelField: 'name',
			    searchField: ['name', 'email'],
			    load: function(query, callback) {
			    	if (!query.length && query.length < 3) return callback();
			    	$.ajax({
	                    url: place,
	                    type: 'POST',
	                    dataType: 'json',
	                    data: {
	                    	_token: token 
	                    },
	                    error: function() {
	                        callback();
	                    },
	                    success: function(results) {
	                        callback(results);
	                    }
	                });
			    },
			    options: [],
			    render: {
			        item: function(item, escape) {
			            return '<div>' +
			                (item.name ? '<span class="name">' + escape(item.name) + '</span>' : '') +
			                (item.email ? '<span class="email">' +  escape(item.email) + '</span>' : '') +
			            '</div>';
			        },
			        option: function(item, escape) {
			            var label = item.name || item.email;
			            var caption = item.name ? item.email : null;
			            return '<div class="p-3">' +
			                '<span class="label">' + escape(label) + '</span>' +
			                (caption ? '<span class="caption">' + " - " + escape(caption) + '</span>' + '<br><br>' : '') +
			            '</div>';
			        }
			    },
			    createFilter: function(input) {
			        var match, regex;

			        // email@address.com
			        regex = new RegExp('^' + REGEX_EMAIL + '$', 'i');
			        match = input.match(regex);
			        if (match) return !this.options.hasOwnProperty(match[0]);

			        // name <email@address.com>
			        regex = new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i');
			        match = input.match(regex);
			        if (match) return !this.options.hasOwnProperty(match[2]);

			        return false;
			    },
			    create: function(input) {
			        if ((new RegExp('^' + REGEX_EMAIL + '$', 'i')).test(input)) {
		            return {email: input};
		        }
		        var match = input.match(new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i'));
		        if (match) {
		            return {
		                email : match[2],
		                name  : $.trim(match[1])
		            };
		        }
		        alert('Invalid email address.');
		        return false;
			    }
			});

			$('#title').typeahead({
	            minLength: 2,
	            source: function (query, process) {
	                return $.get(path, {query: query}, function (data) {
	                    return process(data);
	                });
	            }
	        });

	        $('#title').on('change', function() {
				var title = $('#title').val();

				$.ajax({
					url : address,
			        data : { 
			        	title : title,
			            _token : token 
			        },
			        method : 'POST',
			        success : function(data) {
			            if ( data.status === 'success' ) {
			                $("#major_id").val(data.value);
			            }
			        },
			        error : function(data) {
			            console.log(data);
			        }
				});
			});

		});

	</script>

@stop