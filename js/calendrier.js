$(document).ready(function () {

    alert('aaaaa');

    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
        },
        defaultView: 'month',
        editable: true,
        selectable: true,
        allDaySlot: true,
        durationEditable: true,
        eventResize: true,

        events: "reservations.pages.php?view=1",


        eventClick: function (event, jsEvent, view) {
            alert('bbb');
            endtime = $.fullCalendar.moment(event.end).format('h:mm');
            starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
            var mywhen = starttime + ' - ' + endtime;
            $('#modalTitle').html(event.title);
            $('#modalWhen').text(mywhen);
            $('#eventID').val(event.id);
            $('#calendarModal').modal();
        },

        //header and other values
        select: function (start, end, jsEvent) {
            endtime = $.fullCalendar.moment(end).format('h:mm');
            starttime = $.fullCalendar.moment(start).format('dddd, MMMM Do YYYY, h:mm');
            var mywhen = starttime + ' - ' + endtime;
            start = moment(start).format();
            end = moment(end).format();
            $('#createEventModal #startTime').val(start);
            $('#createEventModal #endTime').val(end);
            $('#createEventModal #when').text(mywhen);
            $('#createEventModal').modal('toggle');
        },
        eventDrop: function (event, delta) {
            $.ajax({
                url: '../php/reservation.traitement.php',
                data: 'action=update&title=' + event.title + '&start=' + moment(event.start).format() + '&end=' + moment(event.end).format() + '&id=' + event.id,
                type: "POST",
                success: function (json) {
                    //alert(json);
                }
            });
        },
        eventResize: function (event) {
            $.ajax({
                url: '../php/reservation.traitement.php',
                data: 'action=update&title=' + event.title + '&start=' + moment(event.start).format() + '&end=' + moment(event.end).format() + '&id=' + event.id,
                type: "POST",
                success: function (json) {
                    //alert(json);
                }
            });
        }
    });

    $('#submitButton').on('click', function (e) {
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        doSubmit();
    });

    $('#deleteButton').on('click', function (e) {
        // We don't want this to act as a link so cancel the link action
        e.preventDefault();
        doDelete();
    });

    function doDelete() {
        $("#calendarModal").modal('hide');
        var eventID = $('#eventID').val();
        $.ajax({
            url: '../php/reservation.traitement.php',
            data: 'action=delete&id=' + eventID,
            type: "POST",
            success: function (json) {
                if (json == 1)
                    $("#calendar").fullCalendar('removeEvents', eventID);
                else
                    return false;


            }
        });
    }
    function doSubmit() {
        $("#createEventModal").modal('hide');
        var commentaire = $('#commentaire').val();
        var startTime = $('#startTime').val();
        var endTime = $('#endTime').val();
        alert('bbbbb');
        alert(commentaire);

        $.ajax({
            url: '../php/reservation.traitement.php',
            data: 'action=add&commentaire=' + commentaire + '&start=' + startTime + '&end=' + endTime,
            type: "POST",
            success: function (json) {
                $("#calendar").fullCalendar('renderEvent',
                    {
                        id: json.id,
                        commentaire: commentaire,
                        start: startTime,
                        end: endTime,
                    },
                    true);
            }
        });

    }
});