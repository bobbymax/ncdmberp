$(document).ready(function() {
	$('#end_date').on('blur', function() {
		var startDate = $("#start_date").val();
		var endDate = $("#end_date").val();

		var values = getDependencies(startDate, endDate);
	});
});

function getDependencies(start, end, value = 0)
{
	$.ajax({
		url : url,
        data : { 
        	start_date : start,
            end_date : end,
            _token : token 
        },
        method : 'POST',
        success : function(data) {
            if ( data.status === 'success' ) {
                $("#qualification_id").val(data.value.name);

                $("#course_id").empty();
                $("#course_id").append('<option value="" disabled selected>=== Select Course ===</option>');

                $.each(data.value.courses, function(index, course) {
                    var current = value != 0 && value == course.id ? ' selected' : '';
                	$("#course_id").append('<option value="'+ course.id +'"'+ current +'>'+ course.name +'</option>');
                });
            }
        },
        error : function(data) {
            console.log(data);
        }
	});
}