/*Javascript file for dashboard page e.g. calendar and alerts*/
//actual date events load for page refresh
jq(document).ready(function ($) {
    var nowDate = $.datepicker.formatDate('yy-mm-dd', new Date());
//    getEvent(nowDate);
});

/*
 *
 * */
jq(document).on('click', '.at', function ($) {
    if($(this).html() != "&nbsp;") {
        date = $(this).data("date");
//        getEvent(date);
    }
});

jq(document).on('click', '.td', function ($) {

    if($(this).html() != "&nbsp;") {

        $('.td').removeClass("act");
        $(this).addClass("act");

        var eventLink = base_url + "events/create/";

        if ($(this).hasClass('highlight')) {
            createDate = "";

        } else {

            if ($(this).children().length >= 2) {
                createDate = $(this).children().data("date");
            } else {
                var nextlink = $('.nextcell').children().attr('href');
                var nextlinkArr = nextlink.split('/');
                var yearMonth = nextlinkArr.slice(Math.max(nextlinkArr.length - 2, 1))

                var year = yearMonth[0];
                var month = yearMonth[1];
                var day = $(this).html();

                if (month == 1) {
                    month = 12;
                } else {
                    month = month - 1;
                }

                month = month.toString();

                if (month.length == 1) {
                    month = "0" + month;
                }
                createDate = year + "-" + month + "-" + day;
            }
        }


        $('#add-new-event').attr("href", eventLink + createDate);

        if ($(this).children().length >= 2) {
            date = $(this).children().data("date");
            getEvent(date);
        }
        else {
            $("#eventtext").html("");
        }
    }
});

jq(document).on('click', '.delete_event', function (event) {
    event.preventDefault();

    var del = confirm(LANG['confirm_delete']);

    if(del) {
        id = $(this).data("eventid");
        link = window.location.href;
        var data = {id: id, link: link};
        if (id) {
            sendAjax("json", "dashboard/delete", "POST", "application/json", data, "event_delete");
        }
    }

});

function getEvent(data) {
    sendAjax("json", "events/event_list", "POST", "application/json", data, "calendar");
}

jq(document).on('click', '.table_link', function ($) {
    document.location = $(this).data('href');
});