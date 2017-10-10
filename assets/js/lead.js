
jq(function ($) {

    $('input[name="meeting_time"], input[name="reminder_time"]').datetimepicker({ dateFormat: 'yy-mm-dd', timeFormat: 'HH:mm:ss', changeYear: true, yearRange: '1900:2100' });

    if ( $('select[name="source"]').val() !== 'Bank360')
        $('.lead_id_group').hide();
    $(document).on('change', 'select[name="source"]', function ()
    {
        if ($(this).val() === 'Bank360')
            $('.lead_id_group').show();
        else
            $('.lead_id_group').hide();
    });

    $('input[name="postcode"]').keyup(function ()
    {
        SetSettlementByPostCode($(this).val(), $('input[name="town"]'));
    });


    $('#create_lead').submit(function()
    {
        $('input[name="phone"]').val('+36' + $('select[name="area_code"]').val() + $('input[name="phone_no"]').val());
    });
});