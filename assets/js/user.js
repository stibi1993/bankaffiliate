jq(function ($) {
    var structureId = $('select[name="structure_id"]').val();
    var level = $('select[name="level"]').val();
    var userId = $('input[name="user_id"]').val();

    $('.categories').hide();
    if (structureId !== '')
    {
        sendAjax("json", "structures/get", "POST", "application/json", structureId, "structure");
        $('input[name="product_categories[]"]').each(function()
        {
            if (this.checked)
                $('#sales_code_cat_' + $(this).val()).show();
        });
    }
//    if ((structureId !== '') && (level !== ''))
//        sendAjax("json", "users/get_possible_superiors", "POST", "application/json", {structureId: structureId, level: level, ownId: userId}, "possible_superiors");

    $(document).on('change', 'select[name="structure_id"]', function () {
        structureId = $(this).val();
        $('.categories').hide();
        $('.cat_chk').attr('checked', false);
        if (structureId !== '')
        {
            sendAjax("json", "structures/get", "POST", "application/json", structureId, "structure");
            if (level !== '')
                sendAjax("json", "users/get_possible_superiors", "POST", "application/json", {structureId: structureId, level: level, ownId: userId}, "possible_superiors");
        }
    });

    $(document).on('change', 'select[name="level"]', function () {
        level = $(this).val();
        if ((structureId !== '') && (level !== ''))
            sendAjax("json", "users/get_possible_superiors", "POST", "application/json", {structureId: structureId, level: level, ownId: userId}, "possible_superiors");
    });

    $(document).on('click', '#new_sales_code_toggle', function()
    {
        $('#new_sales_code_form').slideToggle();
    });

    $('input[name="iranyitoszam"]').keyup(function ()
    {
        SetSettlementByPostCode($(this).val(), $('input[name="varos"]'));
    });
    $('input[name="levelezes_iranyitoszam"]').keyup(function ()
    {
        SetSettlementByPostCode($(this).val(), $('input[name="levelezes_varos"]'));
    });

    $(document).on('change', 'select[name="company"]', function()
    {
        var companyId = $(this).val();
        if (companyId !== '')
        {
            sendAjax("json", "companies/get", "POST", "application/json", companyId, "company");
            $('.billing').prop('readonly', true);
            $('input[name="new_company"]').val('');
        }
    });
    $(document).on('blur', 'input[name="new_company"]', function()
    {
        var company = $(this).val().trim();
        $('.billing').prop('readonly', company === '');
        if (company)
        {
            if ($('select[name="company"]').val() !== '')
            {
                $('select[name="company"]').val('');
                $('.billing').val('');
            }
            $('input[name="company_name"]').val(company);
        }
    });
    $('input[name="new_company"]').trigger('blur');
    $('select[name="company"]').trigger('change');

    $('#create_user').submit(function()
    {
        $('input[name="mobiltelefonszam"]').val('+36' + $('select[name="area_code"]').val() + $('input[name="phone_no"]').val());
    });

});


