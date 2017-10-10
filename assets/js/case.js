var bank360Data = [];
var selectText = '&laquo; Válasszon &raquo;';
var product,
    savingTerm,
    monthlySavings,
    accountCreationFee,
    contractAmount;

function storeBank360Data(data)
{
    bank360Data = [];
    if (data.eredmeny === "sikeres")
    {
        jq.each(data.adat, function (k, v)
        {
            if (typeof(bank360Data[v.termek]) === 'undefined')
            {
                bank360Data[v.termek] = [];
                bank360Data[v.termek]['megtakaritasi_ido_ev'] = v.megtakaritasi_ido;
                bank360Data[v.termek]['megtakaritasi_ido_ho'] = v.megtakaritasi_ido_honapban;
                bank360Data[v.termek]['szamlanyitasi_dij'] = [];
                bank360Data[v.termek]['havi_megtakaritas'] = [];
            }
            if (typeof(bank360Data[v.termek]['szamlanyitasi_dij'][v.szamlanyitasi_dij]) === 'undefined')
            {
                bank360Data[v.termek]['szamlanyitasi_dij'][v.szamlanyitasi_dij] = [];
                bank360Data[v.termek]['havi_megtakaritas'][v.havi_megtakaritas] = [];
            }
            bank360Data[v.termek]['szamlanyitasi_dij'][v.szamlanyitasi_dij]['szerzodeses_osszeg'] = v.szerzodeses_osszeg;
            bank360Data[v.termek]['havi_megtakaritas'][v.havi_megtakaritas]['szerzodeses_osszeg'] = v.szerzodeses_osszeg;
            bank360Data[v.termek]['szamlanyitasi_dij'][v.szamlanyitasi_dij]['havi_megtakaritas'] = v.havi_megtakaritas;
            bank360Data[v.termek]['havi_megtakaritas'][v.havi_megtakaritas]['szamlanyitasi_dij'] = v.szamlanyitasi_dij;
        });

        var partner_updater = (jq('input[name="partner_updater"]').val() === '1');
        var productOptions;
        if (! partner_updater)
            productOptions = '<option value="">' + selectText + '</option>';
        for (var i in bank360Data)
        {
            if ((partner_updater && (jq('input[name="temp_termekcsalad"]').val() == i))
                || ! partner_updater)
                productOptions += '<option value="' + i + '">' + i + '</option>';
/*            for (var savingTerm in bank360Data[product])
            {
                savingTermOptions += '<option value="' + savingTerm + '">' + savingTerm + ' év</option>';
                for (var accountCreationFee in bank360Data[product][savingTerm])
                {
                    accountCreationFeeOptions += '<option value="' + accountCreationFee + '">' + accountCreationFee + '</option>';
                    for (var contractAmount in bank360Data[product][savingTerm][accountCreationFee])
                    {
                        contractAmountOptions += '<option value="' + contractAmount + '">' + contractAmount + '</option>';
                    }
                }
            }*/
        }
        jq('select[name="termekcsalad"]').html(productOptions).val(jq('input[name="temp_termekcsalad"]').val());
//        jq('select[name="futamido"]').html(savingTermOptions);
//        jq('select[name="szamlanyitasi_dij"]').html(accountCreationFeeOptions);
//        jq('select[name="ltp_szerzodes_osszege"]').html(contractAmountOptions);
    }
}

jq(function ($) {
    var bank360Script = 'https://bank360.hu/api/ltp/mind';
    var requestSent = false;

    var Bank360AJAX = function (bank)
    {
        bank = purifyLetters(bank, {search:' ',replace:'_'});
        var query = '?bank_' + bank + '=true';

        if (! requestSent)
        {
            requestSent = true;

            $.ajax(
                {
                    url: bank360Script + query,
                    dataType: 'jsonp',
                    jsonpCallback: 'storeBank360Data',
                    complete: function ()
                    {
                        requestSent = false;
                    },
                    error: function (e)
                    {
                        console.log(e);
                    }
                });
        }
    };

    $('input[name="szerzodeskotes_datuma"]').datepicker('option', 'maxDate', 0);
    $('input[name="szuletesi_ido"]').datepicker('option', 'maxDate', '-14y');

    var $bank = $('select[name="bank_id"]');
    if ((typeof($bank.val()) !== 'undefined') && $bank.val() !== '')
    {
        Bank360AJAX($bank.find('option:selected').text());
    }

    var temp;
    temp = $('input[name="temp_futamido_ev"]').val();
    if (typeof temp !== 'undefined')
    {
        if (temp !== '')
            $('select[name="futamido_ev"]').html('<option value="' + temp + '">' + temp + ' év</option>');

        temp = $('input[name="temp_havi_befizetes"]').val();
        if (temp !== '')
            $('select[name="havi_befizetes"]').html('<option value="' + temp + '">' + thousandsSeparator(temp) + '</option>');

        temp = $('input[name="temp_szamlanyitasi_dij"]').val();
        if (temp !== '')
            $('select[name="szamlanyitasi_dij"]').html('<option value="' + temp + '">' + thousandsSeparator(temp) + '</option>');

        temp = $('input[name="temp_ltp_szerzodes_osszege"]').val();
        if (temp !== '')
            $('select[name="ltp_szerzodes_osszege"]').html('<option value="' + temp + '">' + thousandsSeparator(temp) + '</option>');
    }
    $(document).on('change', 'select[name="bank_id"]', function ()
    {
        if ($(this).val() !== '')
        {
            Bank360AJAX($(this).find('option:selected').text());
        }
    });

    $(document).on('change', 'select[name="termekcsalad"]', function ()
    {
        product = $(this).val();
        var savingTermOptions = '';//<option value="">' + selectText + '</option>';
        if (product !== '')
        {
//            for (var i in bank360Data[product])
                savingTermOptions += '<option value="' + bank360Data[product]['megtakaritasi_ido_ev'] + '">' + bank360Data[product]['megtakaritasi_ido_ev'] + ' év</option>';
        }
        jq('select[name="futamido_ev"]').html(savingTermOptions);

        var accountCreationFeeOptions = '<option value="">' + selectText + '</option>';
        for (var i in bank360Data[product]['szamlanyitasi_dij'])
            accountCreationFeeOptions += '<option value="' + i + '">' + thousandsSeparator(i) + '</option>';
        jq('select[name="szamlanyitasi_dij"]').html(accountCreationFeeOptions);

        var monthlySavingsOptions = '<option value="">' + selectText + '</option>';
        for (var i in bank360Data[product]['havi_megtakaritas'])
            monthlySavingsOptions += '<option value="' + i + '">' + thousandsSeparator(i) + '</option>';
        jq('select[name="havi_befizetes"]').html(monthlySavingsOptions);
    });

/*    $(document).on('change', 'select[name="futamido_ev"]', function ()
    {
        savingTerm = $(this).val();
        var accountCreationFeeOptions = '<option value="">' + selectText + '</option>';
        if (savingTerm !== '')
        {
            for (var i in bank360Data[product][savingTerm])
                accountCreationFeeOptions += '<option value="' + i + '">' + i + '</option>';
        }
        jq('select[name="szamlanyitasi_dij"]').html(accountCreationFeeOptions);
    });
*/
    $(document).on('change', 'select[name="havi_befizetes"]', function ()
    {
        monthlySavings = $(this).val();
        var contractAmountOptions = '';//'<option value="">' + selectText + '</option>';
        if (monthlySavings !== '')
        {
//            for (var i in bank360Data[product][savingTerm][accountCreationFee])
            contractAmountOptions += '<option value="' + bank360Data[product]['havi_megtakaritas'][monthlySavings]['szerzodeses_osszeg'] + '">' + thousandsSeparator(bank360Data[product]['havi_megtakaritas'][monthlySavings]['szerzodeses_osszeg']) + '</option>';
        }
        jq('select[name="ltp_szerzodes_osszege"]').html(contractAmountOptions);
        jq('select[name="szamlanyitasi_dij"]').val(bank360Data[product]['havi_megtakaritas'][monthlySavings]['szamlanyitasi_dij']);
    });

    $(document).on('change', 'select[name="szamlanyitasi_dij"]', function ()
    {
        accountCreationFee = $(this).val();
        var contractAmountOptions = '';//'<option value="">' + selectText + '</option>';
        if (accountCreationFee !== '')
        {
//            for (var i in bank360Data[product][savingTerm][accountCreationFee])
            contractAmountOptions += '<option value="' + bank360Data[product]['szamlanyitasi_dij'][accountCreationFee]['szerzodeses_osszeg'] + '">' + thousandsSeparator(bank360Data[product]['szamlanyitasi_dij'][accountCreationFee]['szerzodeses_osszeg']) + '</option>';
        }
        jq('select[name="ltp_szerzodes_osszege"]').html(contractAmountOptions);
        jq('select[name="havi_befizetes"]').val(bank360Data[product]['szamlanyitasi_dij'][accountCreationFee]['havi_megtakaritas']);
    });
    if (! $('input[name="van_kedvezmenyezett"]').prop("checked"))
    {
        $('#sub_beneficiary_data').hide();
    }
    $('input[name="van_kedvezmenyezett"]').click(function ()
    {
        $('#sub_beneficiary_data').slideToggle();
    });

    $('input[name="iranyitoszam"]').keyup(function ()
    {
        SetSettlementByPostCode($(this).val(), $('input[name="varos"]'));
    });
    $('input[name="beneficiary_iranyitoszam"]').keyup(function ()
    {
        SetSettlementByPostCode($(this).val(), $('input[name="beneficiary_varos"]'));
    });


    $('form').submit(function()
    {
        if ((Object.keys(bank360Data).length > 0) && ($('select[name="termekcsalad"]').val() != ''))
            $('input[name="futamido_ho"]').val(bank360Data[$('select[name="termekcsalad"]').val()]['megtakaritasi_ido_ho']);
        $('input[name="telefonszam"]').val('+36' + $('select[name="area_code"]').val() + $('input[name="phone_no"]').val());
        $('input[name="beneficiary_telefonszam"]').val('+36' + $('select[name="beneficiary_area_code"]').val() + $('input[name="beneficiary_phone_no"]').val());
    });
});