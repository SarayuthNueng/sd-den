$(document).ready(function() {
	//show full calendar
	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay,listMonth'
		},
		editable: false,
		eventLimit: true, // allow "more" link when too many events
		selectable: false,
        selectHelper: true,
        timeFormat: "H:mm น.",
        defaultView: 'month',
        scrollTime: '08:00', // undo default 6am scrollTime
        eventOverlap: false,
        allDaySlot: false,
		events:{
			url:'json-event-show.php?get_json=get_json',
		}
	});
	
});

//show data for edit	
function get_modal(id){
	
	//trigger modal
	$("#trigger_modal").trigger('click');
	
	//call data from File json-event.php
	$.ajax({
		type:"POST",
		url:"json-event-show.php",
		data:{id:id},
		success:function(data){
			$("#get_calendar_show").html(data);
		}
	});
	
	return false;
}


