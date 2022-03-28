    var calendar;
    var Calendar = FullCalendar.Calendar;
    var events = [];
    $(function() {
        if (!!scheds) {
            Object.keys(scheds).map(k => {
                var row = scheds[k]
                events.push({ id: row.id, title: row.title_dentist, start: row.start_datetime, end: row.end_datetime,procedure_color: row.procedure_color,patient_name: row.patient_name,patient_tel: row.patient_tel });
            })
        }
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        calendar = new Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'prev,next today',
                right: 'dayGridMonth,dayGridWeek,timeGridDay,list',
                center: 'title',
            },
            selectable: true,
            themeSystem: 'bootstrap',
            showNonCurrentDates: true, // แสดงที่ของเดือนอื่นหรือไม่
            locale: 'th',
            dayMaxEventRows: true, // allow "more" link when too many events
            firstDay: 0, // กำหนดวันแรกในปฏิทินเป็นวันอาทิตย์ 0 เป็นวันจันทร์ 1
            hour: 'numeric',
            minute: '2-digit',
            meridiem: false,
            // timeZone:UTC,
            //Random default events
            events: events,
            eventClick: function(info) {
                var _details = $('#event-details-modal')
                var id = info.event.id
                if (!!scheds[id]) {
                    _details.find('#title_dentist').text(scheds[id].title_dentist)
                    _details.find('#description').text(scheds[id].description)
                    _details.find('#start').text(scheds[id].sdate)
                    _details.find('#end').text(scheds[id].edate)
                    _details.find('#procedure_color').text(scheds[id].procedure_color)
                    _details.find('#patient_name').text(scheds[id].patient_name)
                    _details.find('#patient_tel').text(scheds[id].patient_tel)
                    _details.find('#edit,#delete').attr('data-id', id)
                    _details.modal('show')
                } else {
                    alert("Event is undefined");
                }
            },
            eventDidMount: function(info) {
                // Do Something after events mounted
            },
            editable: true
        });

        calendar.render();

        // Form reset listener
        $('#schedule-form').on('reset', function() {
            $(this).find('input:hidden').val('')
            $(this).find('input:visible').first().focus()
        })

        // Edit Button
        $('#edit').click(function() {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _form = $('#schedule-form')
                console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"))
                _form.find('[name="id"]').val(id)
                _form.find('[name="title_dentist"]').val(scheds[id].title_dentist)
                _form.find('[name="description"]').val(scheds[id].description)
                _form.find('[name="start_datetime"]').val(String(scheds[id].start_datetime).replace(" ", "T"))
                _form.find('[name="end_datetime"]').val(String(scheds[id].end_datetime).replace(" ", "T"))
                _form.find('[name="procedure_color"]').val(scheds[id].procedure_color)
                _form.find('[name="patient_name"]').val(scheds[id].patient_name)
                _form.find('[name="patient_tel"]').val(scheds[id].patient_tel)
                $('#event-details-modal').modal('hide')
                _form.find('[name="title_dentist"]').focus()
            } else {
                alert("Event is undefined");
            }
        })

        // Delete Button / Deleting an Event
        $('#delete').click(function() {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _conf = confirm("Are you sure to delete this scheduled event?");
                if (_conf === true) {
                    location.href = "./delete_schedule.php?id=" + id;
                }
            } else {
                alert("Event is undefined");
            }
        })
    })