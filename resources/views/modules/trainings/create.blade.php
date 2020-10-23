@extends('layouts.master')
@section('title', 'NCDMB | Archive Trainings')
@section('page-header')
	<div class="dt-page__header">
	    <h1 class="dt-page__title">
	       Archive Training 
	    </h1><br>
	</div>
@stop
@section('content')
	
<!-- Card -->
<div class="dt-card">
    <!-- Card Body -->
    <div class="dt-card__body">

	
		<form action="{{ route('trainings.store') }}" method="POST">
			
			@csrf

			<div class="row">
				
				<div class="col-6 mb-5">
				
					<div class="form-group">

						<label for="title" class="mb-3">Training Title</label>
						<input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" id="title" placeholder="Enter Training Title" autocomplete="off">

						@error('title')
	                        <span class="invalid-feedback" role="alert">
	                            <strong>{{ $message }}</strong>
	                        </span>
	                    @enderror

					</div>

				</div>

				<div class="col-6 mb-5">
					<div class="form-group">
						<label for="major" class="mb-3">Training Major</label>
						<input type="text" class="form-control form-control-lg @error('major') is-invalid @enderror" name="major" id="major" autocomplete="off" placeholder="Enter Training Major">

						@error('major')
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
							</span>
						@enderror
					</div>
				</div>

				<div class="col-12 mt-5">
					<div class="btn-group" role="group" aria-label="Basic example">
	                    <a href="{{ route('trainings.index') }}" class="btn btn-sm btn-danger"><i class="icon icon-settings icon-lg mr-3"></i> {{ strtoupper('Cancel') }}</a>
	                    <button type="submit" class="btn btn-sm btn-success"><i class="icon icon-send icon-lg mr-3"></i> {{ strtoupper('Create or Add Item') }}</button>
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

		var path = "{{ route('autocomplete') }}";
		var url = "{{ route('populate.existing') }}";
		var majorPath = "{{ route('check.major') }}";
		var token = "{{ csrf_token() }}";
		
		$(document).ready(function() {

			$('#title').typeahead({
	            minLength: 2,
	            source: function (query, process) {
	                return $.get(path, {query: query}, function (data) {
	                    return process(data);
	                });
	            }
	        });

	        $('#major').typeahead({
	        	minLength: 1,
	        	source: function (query, process) {
	        		return $.get(majorPath, {query: query}, function (data) {
	        			return process(data);
	        		});
	        	}
	        });

	        $('#title').on('change', function() {
				var title = $('#title').val();

				$.ajax({
					url : url,
			        data : { 
			        	title : title,
			            _token : token 
			        },
			        method : 'POST',
			        success : function(data) {
			            if ( data.status === 'success' ) {
			                $("#major").val(data.value.name);
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