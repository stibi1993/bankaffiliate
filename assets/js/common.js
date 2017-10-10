/*
 *ajax process
 * */
 function sendAjax(request_type,link,method,contentType,data,sender) {

     jq.ajax({
        url: base_url+link,
        type: request_type,
        method: method,
        processData: true,
        data:  {data : data},
        cache: false,
        success: function (data) {
            ajaxSuccess(data, sender);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //alert("ajax error");
           /* alert(xhr.responseText);
            alert(thrownError);
            console.log(thrownError);*/
        }
    });
}

/*
 *ajax sucess data
 * */
function ajaxSuccess(data, sender){
    if(sender === "calendar"){
        var message = "<ul id='event-list'>";
        jQuery.each(data.events, function(i, val) {

            message += "<a class='edit_event'><li class='event_title'>";
            message += val[0].title;
            message += "</li></a>";
            message += "<a class='delete_event'>";
            message += "<span class='glyphicon glyphicon-remove events_delete'></span>";
            message += "</a>";
			//message += "<a class='edit_event'>";
            //message += "<span class='glyphicon glyphicon-pencil events_delete editevent'></span>";
            //message += "</a>";
            $("#eventtext").html(message);
            $(".edit_event").attr("href", base_url + 'events/edit/' + val[0].id);
            $(".delete_event").attr("data-eventid", val[0].id);
        });
        message += "</ul>";

    }else if(sender === "missionlist-search"){
        //console.log(data);
        missionTableInsert(data);
    }else if(sender === "event_delete"){
        window.location.replace(data.link);
    }else if(sender === "edit_event"){
        window.location.replace(data.link);
    }else if(sender === "structure"){
        if (data.item)
            data = data.item.product_categories.split(',');
        else
            data = [];
        jq(data).each(function(key, val)
        {
            jq('#cat_' + val).show();
        });
    }else if(sender === "possible_superiors"){
        if (data.superiors)
        {
            data.superiors = jq.map(data.superiors, function(value, index) {
                value.key = index;
                return [value];
            });
            var options = '';
            jq(data.superiors).each(function(key, val)
            {
                options += '<option value="' + val.id + '">' + val.value + '</option>';
            });
            jq('select[name="superior_id"]').html(options);
        }
    }else if(sender === 'company')
    {
        data = data.item;
        jq('input[name="company_name"]').val(data.company_name);
        jq('input[name="tax_no"]').val(data.tax_no);
        jq('input[name="fundation_date"]').val(data.fundation_date);
        jq('input[name="reg_office_postcode"]').val(data.reg_office_postcode);
        jq('input[name="reg_office_town"]').val(data.reg_office_town);
        jq('input[name="reg_office_street"]').val(data.reg_office_street);
        jq('input[name="representative_name"]').val(data.representative_name);
        jq('input[name="representative_birth_date"]').val(data.representative_birth_date);
        jq('input[name="representative_id_card_no"]').val(data.representative_id_card_no);
        jq('input[name="representative_address"]').val(data.representative_address);
        jq('input[name="teaor"]').val(data.teaor);
        jq('input[name="bank_account_no"]').val(data.bank_account_no);
        jq('input[name="reg_no"]').val(data.reg_no);
        jq('input[name="phone"]').val(data.phone);
        jq('input[name="company_email"]').val(data.email);
    }
}
var jq = jQuery.noConflict();
jq(function ($) {
    if (typeof tablesorter !== 'undefined' && $.isFunction(tablesorter))
    {
        $(".tablesorter").tablesorter({widthFixed: true, widgets: ['zebra']});
        $(".tablesorter").tablesorterPager({container: $("#pager")});
        $(".tablesorter").tablesorter({
            sortMultiSortKey: 'ctrlKey'
        });
    }
// set up datepicker on add event page and edit event
    $('.datepick').each(function(){
        $(this).datepicker({ dateFormat: 'yy-mm-dd', changeYear: true, yearRange: '1900:2100' });
    });

    var $numeralElements = $('input.numeral');
    $numeralElements.each(function(){
        $(this).val( thousandsSeparator($(this).val()));
    });

    $numeralElements.on('blur', function ()
    {
        $(this).val( thousandsSeparator($(this).val()));
    });

    $numeralElements.on('focus', function ()
    {
        $(this).val( thousandsUnseparator($(this).val()));
    });

    $('form').submit(function()
    {
        $numeralElements.each(function(){
            $(this).val( thousandsUnseparator($(this).val()));
        });
    });

    $(":file").filestyle({
        buttonText: LANG['button_upload'],
        size: "sm",
        buttonName: "btn-default",
        buttonBefore: true,
        placeholder: LANG['button_upload_empty']
    });

    $('.form-group p').parents('fieldset').show();


//todo [CL] groups select all
    $('.chk_boxes').click(function() {
        $('.chk_boxes1').prop('checked', this.checked);
    });

//todo [CL] delete confirm
    $('.glyphicon-remove').click(function(event) {

        event.preventDefault();
        var type = $(this).data("type");
        var choice;
        if(type === "employee-delete"){
            choice = confirm(LANG['confirm_delete_employee']);
        }else if(type === "alert-delete"){
        	choice = confirm(LANG['confirm_delete_alert']);
        }else{
            choice = confirm(LANG['confirm_delete_record']);
        }

        if (choice) {
            window.location.href = (typeof($(this).attr('href')) !== 'undefined' ? $(this).attr('href') : $(this).parent().attr('href'));
        }

    });

    $(".confirm, a[href]").confirm();

    $(document).on('click', '.section_toggle', function()
    {
        if ($(this).hasClass('open'))
            $(this).removeClass('open');
        else
            $(this).addClass('open');
        $(this).next().slideToggle();
    });

    $('#create_company').submit(function()
    {
        $('input[name="phone"]').val('+36' + $('select[name="area_code"]').val() + $('input[name="phone_no"]').val());
    });
    $('input[name="reg_office_postcode"]').keyup(function ()
    {
        SetSettlementByPostCode($(this).val(), $('input[name="reg_office_town"]'));
    });


});

//full row click
function hrefClick(url){
    window.document.location = url;
}
function purifyLetters(string, extras)
{
    string = string.toLowerCase();
    var search  = 'áéíóöőúüű',
        replace = 'aeiooouuu';

    if (typeof extras !== 'undefined')
    {
        search  += extras.search;
        replace += extras.replace;
    }
    for (var i = 0; i <= search.length-1; i++)
    {
        var re = new RegExp(search[i], 'g');
        string = string.replace(re, replace[i]);
    }
    return string;
}

function SetSettlementByPostCode(postCode, $settlement)
{
    if (postCode.length === 4)
    {
        var requestSent = false;
        var filter;

        if (! requestSent)
        {
            requestSent = true;
            jQuery.ajax({
                url: base_url + "assets/js/locations.hu.json",
                dataType: 'json',
                success: function (data) {

                    jQuery.each(data, function (k, v) {
                        jQuery.each(v, function (k, v) {
                            filter = v.address.filter(function (i, n) {
                                return i.zip_code === parseInt(postCode)
                            });
                        });
                    });

                    jQuery.each(filter, function (k, v) {
                        $settlement.val(v.settlement);
                    });

                },
                complete: function () {
                    requestSent = false;
                },
                error: function (e) {
                    console.log(e);
                }
            });
        }
    }
}
function thousandsSeparator(number)
{
    if (typeof(number) === 'string')
    {
        number = number.replace(/[\D\s\._\-]+/g, "");
        number = number ? parseInt( number, 10 ) : 0;
    }
    return number.toLocaleString( "hu-HU" );
}

function thousandsUnseparator(number)
{
    return number.replace(/[\D\s\._\-]+/g, "");
}

//leave window confirmation
/*function confirm_exit() {
    var x = confirm("Do you want to leave this page without saving?");
    if (x == true) {
        return true;
    }else{
        event.preventDefault();
        return false;
    }
}*/
