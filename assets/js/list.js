//search button
$(document).on('click', '#list-search-button', function () {
    var limit = $("#list-show-number").val();
    var SearchString = $("#list-search-input").val();
    active_filter = $('input:radio[name=mission-filter]:checked').val();
    var data = {SearchString:SearchString, ActiveFilter:active_filter, Page:1, Limit: limit};
        if(SearchString.length >= 2 || SearchString.length == 0) {
        search(data);
    }else{
        alert(LANG['alert_search_minimum']);
    }
});

//search enter
$( document ).ready(function() {
    $('#list-search-input').keypress(function (e) {
        if (e.which == 13) {
            var limit = $("#list-show-number").val();
            var SearchString = $("#list-search-input").val();
            active_filter = $('input:radio[name=mission-filter]:checked').val();
            var data = {SearchString:SearchString, ActiveFilter:active_filter, Page:1, Limit: limit};
            if(SearchString.length >= 2 || SearchString.length == 0) {
                search(data);
            }else{
                alert(LANG['alert_search_minimum']);
            }
        }
    });
});

//limit button
$(document).on('click', '#list-show-number-btn', function () {
    var limit = $("#list-show-number").val();
    var SearchString = $("#list-search-input").val();
    active_filter = $('input:radio[name=mission-filter]:checked').val();
    var data = {SearchString:SearchString, ActiveFilter:active_filter, Page:1, Limit: limit};
    if(SearchString.length >= 2 || SearchString.length == 0) {
        search(data);
    }else{
        alert(LANG['alert_search_minimum']);
    }
});

//pager
$(document).on('click', '.pagerli', function () {
    var limit = $("#list-show-number").val();
    var SearchString = $("#list-search-input").val();
    active_filter = $('input:radio[name=mission-filter]:checked').val();
    var page = $(this).html();
    var data = {SearchString:SearchString, ActiveFilter:active_filter, Page:page, Limit: limit};
    if(SearchString.length >= 2 || SearchString.length == 0) {
        search(data);
    }else{
        alert(LANG['alert_search_minimum']);
    }
});
//cancel button
$(document).on('click', '#cancel-export', function () {
    $("#popup_missions").hide();
});
//export button
$(document).on('click', '#selected-columns', function () {
     $("#popup_missions").show();
});

$(function() {
    $('#mission-export-tab').tabs();
})

$(function() {
    search();
})

//export button
$(document).on('click', '#export-list-btn', function () {
	
	$("#popup_missions").hide();

	var name = $('input:checkbox[name=chk_name]:checked').val();
	var first_name = $('input:checkbox[name=chk_first_name]:checked').val();
	var home_country = $('input:checkbox[name=chk_home_country]:checked').val();
	var home_company = $('input:checkbox[name=chk_home_company]:checked').val();
	var host_country = $('input:checkbox[name=chk_host_country]:checked').val();
	var host_city = $('input:checkbox[name=chk_host_city]:checked').val();
	var host_company = $('input:checkbox[name=chk_host_company]:checked').val();
	var start_of_assingnment = $('input:checkbox[name=chk_start_of_assingnment]:checked').val();
	var project_end_of_assingnment = $('input:checkbox[name=chk_project_end_of_assingnment]:checked').val();
	var actual_end_of_assignment = $('input:checkbox[name=chk_actual_end_of_assignment]:checked').val();
	var e_mail = $('input:checkbox[name=chk_e_mail]:checked').val();
	var family_composition = $('input:checkbox[name=chk_family_composition]:checked').val();
       
    active_filter = $('input:radio[name=mission-filter]:checked').val();
        //alert(checkedMissions);
    var limit = $("#list-show-number").val();
    var SearchString = $("#list-search-input").val();
    var active_filter = $('input:radio[name=mission-filter]:checked').val();
    var mission_start = $('[name=mission-start]').val();
    var mission_end = $('[name=mission-end]').val();
    var data = {
        SearchString:SearchString,
        ActiveFilter:active_filter,
        Page:1,
        Limit: limit,
        MissionStart: mission_start,
        MissionEnd: mission_end,


        Name: name,
        First_name: first_name,
        Home_country: home_country,
        Home_company: home_company,
        Host_country: host_country,
        Host_city: host_city,
        Host_company: host_company,
        Start_of_assingnment: start_of_assingnment,
        Project_end_of_assingnment: project_end_of_assingnment,
        Actual_end_of_assignment: actual_end_of_assignment,
        E_mail: e_mail,
        Family_composition: family_composition,

        // export employee
        export_employee_name: $('[name="export_employee_name"]:checked').val(),
        export_employee_first_name: $('[name="export_employee_first_name"]:checked').val(),
        export_employee_title: $('[name="export_employee_title"]:checked').val(),
        export_employee_serial_number: $('[name="export_employee_serial_number"]:checked').val(),
        export_employee_vip: $('[name="export_employee_vip"]:checked').val(),
        export_employee_office_phone: $('[name="export_employee_office_phone"]:checked').val(),
        export_employee_mobile_phone: $('[name="export_employee_mobile_phone"]:checked').val(),
        export_employee_email: $('[name="export_employee_email"]:checked').val(),
        export_employee_comments: $('[name="export_employee_comments"]:checked').val(),
        ////////////// export employee

        // export companies ///
        export_companies_company_name: $('[name="export_companies_company_name"]:checked').val(),
        export_companies_company_description: $('[name="export_companies_company_description"]:checked').val(),
        ////// export companies

        // export family //////
        export_family_name: $('[name="export_family_name"]:checked').val(),
        export_family_first_name: $('[name="export_family_first_name"]:checked').val(),
        export_family_relation: $('[name="export_family_relation"]:checked').val(),
        export_family_birthday: $('[name="export_family_birthday"]:checked').val(),
        export_family_tax_dependent: $('[name="export_family_tax_dependent"]:checked').val(),
        export_family_on_assignment: $('[name="export_family_on_assignment"]:checked').val(),
        ////// export family


        nonenone: ''
    };

    if(SearchString.length >= 2 || SearchString.length == 0) {
        exportData(data);
    }else{
        alert(LANG['alert_search_minimum']);
    }
});


//filters
$(document).ready(function(){
    $("#mission-filter-form .target").change(function () {
        var limit = $("#list-show-number").val();
        var SearchString = $("#list-search-input").val();
        var active_filter = $('input:radio[name=mission-filter]:checked').val();
        var mission_start = $('[name=mission-start]').val();
        var mission_end = $('[name=mission-end]').val();

        /*if(active_filter == "all"){
            $("#table-title-all").fadeIn();
            $("#table-title-current").hide();
        }else{
            $("#table-title-all").hide();
            $("#table-title-current").fadeIn();
        }*/

        var data = {
            SearchString:   SearchString,
            ActiveFilter:   active_filter,
            Page:   1,
            Limit: limit,
            MissionStart: mission_start,
            MissionEnd: mission_end,

            none: null
        };
        if(SearchString.length >= 2 || SearchString.length == 0) {
            search(data);
        }else{
            alert(LANG['alert_search_minimum']);
        }
    });
});

function search(data){
    sendAjax("json", "listing/search", "POST", "application/json", data, "missionlist-search");
}
function exportData(data){
    document.location.href = base_url+'listing/export?' + jQuery.param( data );
}

$( document ).ready(function() {
    $('[name="name"]').keyup(function(){
        value = $(this).val();
        UppercasedVal = capitalizeFirstLetter(value);
        $(this).val(UppercasedVal);
    });
});

$( document ).ready(function() {
    $('[name="first_name"]').keyup(function(){
        value = $(this).val();
        UppercasedVal = capitalizeFirstLetter(value);
        $(this).val(UppercasedVal);
    });
});

/*First letter capital*/
function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function missionTablePagerGenerate(total, page){
    message = "";
    $('.pagerli').remove();
    for (i = 1; i <= total; i++) {
        if(i == page) {
            liclass = "pagerli active";
        }else{
            liclass = "pagerli";
        }

        message += '<li class="'+liclass+'">'+i+'</li>';

    }

    $("#pager").html(message);
}

function missionTableInsert(data){
    $('#mission-table-container').fadeOut("fast");
    $('#mission-table-container').html(data);
    $('#mission-table-container').fadeIn("fast");
}

function switch_check_on_all(set) {
    var input = $('#mission-export-tab input[type="checkbox"]');
    input.prop('checked', set);
}

