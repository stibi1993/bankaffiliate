<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Page Heading -->
<?php
if(in_array($update ? 'view_cases' : 'create_cases', $this->session->permissions))
{?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("case") ?>
            <small><?php echo lang($update ? 'edit' : 'create') ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'create_case'));?>
                <div id="base_data_toggle" class="section_toggle">Alapadatok<i></i></div>
                <fieldset id="base_data">

                    <div class="form-group">
                        <?php
                        echo form_label('Szerződéses összeg emelése', 'szerzodeses_osszeg_emeles');
                        echo form_checkbox('szerzodeses_osszeg_emeles', 1, set_checkbox('szerzodeses_osszeg_emeles', 1, (bool)$case->szerzodeses_osszeg_emeles), 'class="chk_boxes1" id="szerzodeses_osszeg_emeles"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Pénzintézet', 'bank');
                        echo form_error('bank_id');
                        echo form_dropdown('bank_id', $bank_list, set_value('bank_id',($case->bank_id ? $case->bank_id : 7)),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        echo form_hidden('partner_updater', $partner_updater);
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Szerződésszám', '');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('szerzodes_szam');
                        echo form_input('szerzodes_szam', set_value('szerzodes_szam', $case->szerzodes_szam), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <!--div class="form-group">
                        <?php/*
                        echo form_label('Közvetítői adatlap sorszáma', 'ugyfelelegedettsegi_lap_sorszama');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('ugyfelelegedettsegi_lap_sorszama');
                        echo form_input('ugyfelelegedettsegi_lap_sorszama', set_value('ugyfelelegedettsegi_lap_sorszama', $case->ugyfelelegedettsegi_lap_sorszama), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        */?>
                    </div-->

                    <!--div class="form-group">
                        <?php/*
                        echo form_label('Közvetítői adatlap beérkezése', 'ugyfelelegedettsegi_lap_beerkezese');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('ugyfelelegedettsegi_lap_beerkezese');
                        echo form_input('ugyfelelegedettsegi_lap_beerkezese', set_value('ugyfelelegedettsegi_lap_beerkezese', $case->ugyfelelegedettsegi_lap_beerkezese), 'class="form-control target datepick" placeholder="'. lang('date_format').'" maxlength="10"'.($partner_updater ? ' readonly' : ''));
                        */?>
                    </div-->

                    <div class="form-group">
                        <?php
                        echo form_label('Szerződéskötés dátuma', 'szerzodeskotes_datuma');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('szerzodeskotes_datuma');
                        echo form_input('szerzodeskotes_datuma', set_value('szerzodeskotes_datuma', $case->szerzodeskotes_datuma), 'class="form-control target datepick" placeholder="'. lang('date_format').'" maxlength="10"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Várható indulás dátuma', 'varhato_indulas_datuma');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('varhato_indulas_datuma');
                        echo form_input('varhato_indulas_datuma', set_value('varhato_indulas_datuma', $case->varhato_indulas_datuma), 'class="form-control target datepick" placeholder="'. lang('date_format').'" maxlength="10"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Befizetés állapota', 'befizetes_allapota');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('befizetes_allapota');
                        echo form_dropdown('befizetes_allapota', dropdown_data('befizetes_allapota'), set_value('befizetes_allapota', $case->befizetes_allapota),'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Termékcsalád', 'termekcsalad');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('termekcsalad');
                        echo form_dropdown('termekcsalad', array(), set_value('termekcsalad', $case->termekcsalad),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        echo form_hidden('temp_termekcsalad', set_value('termekcsalad', $case->termekcsalad));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Futamidő', 'futamido_ev');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('futamido_ev');
                        echo form_dropdown('futamido_ev', array(), set_value('futamido_ev', $case->futamido_ev),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        echo form_hidden('temp_futamido_ev', set_value('futamido_ev', $case->futamido_ev));
                        echo form_hidden('futamido_ho', set_value('futamido_ho', $case->futamido_ho));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Havi befizetés', 'havi_befizetes');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('havi_befizetes');
//                        echo form_input('havi_befizetes', set_value('havi_befizetes', $case->havi_befizetes), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        echo form_dropdown('havi_befizetes', array(), set_value('havi_befizetes', $case->havi_befizetes),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        echo form_hidden('temp_havi_befizetes', set_value('havi_befizetes', $case->havi_befizetes));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Számlanyitási díj', 'szamlanyitasi_dij');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('szamlanyitasi_dij');
                        echo form_dropdown('szamlanyitasi_dij', array(), set_value('szamlanyitasi_dij', $case->szamlanyitasi_dij),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        echo form_hidden('temp_szamlanyitasi_dij', set_value('szamlanyitasi_dij', $case->szamlanyitasi_dij));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Számlavezetési díj', 'szamlavezetesi_dij');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('szamlavezetesi_dij');
                        echo form_input('szamlavezetesi_dij', set_value('szamlavezetesi_dij', ($case->szamlavezetesi_dij ? $case->szamlavezetesi_dij : 1500)), 'class="form-control numeral"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('LTP szerződés összege', 'ltp_szerzodes_osszege');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('ltp_szerzodes_osszege');
                        echo form_dropdown('ltp_szerzodes_osszege', array(), set_value('ltp_szerzodes_osszege', $case->ltp_szerzodes_osszege),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        echo form_hidden('temp_ltp_szerzodes_osszege', set_value('ltp_szerzodes_osszege', $case->ltp_szerzodes_osszege));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Befizetés módja', 'befizetes_modja');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('befizetes_modja');
                        echo form_dropdown('befizetes_modja', dropdown_data('befizetes_modja'), set_value('befizetes_modja', $case->befizetes_modja),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('comments'), 'megjegyzes');
                        echo form_textarea('megjegyzes', set_value('megjegyzes', $case->megjegyzes), 'class="form-control"');
                        ?>
                    </div>
                </fieldset>

                <div id="bank360_data_toggle" class="section_toggle">Ügyfél adatok<i></i></div>
                <fieldset id="bank360_data">

                    <div class="form-group">
                        <?php
                        echo form_label('Ügyfél forrás', 'ugyfel_forras');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('ugyfel_forras');
                        echo form_dropdown('ugyfel_forras', dropdown_data('ugyfel_forras'), set_value('ugyfel_forras', $case->client_data->ugyfel_forras),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Ügyfél típusa', 'ugyfel_tipus');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('ugyfel_tipusa');
                        echo form_dropdown('ugyfel_tipusa', dropdown_data('ugyfel_tipus'), set_value('ugyfel_tipusa', ($case->client_data->ugyfel_tipusa ? $case->client_data->ugyfel_tipusa : 'TE')),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Név', 'nev');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('nev');
                        echo form_input('nev', set_value('nev', $case->client_data->nev), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Cég képviselőjének neve', 'ceg_kepviselojenek_neve');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('ceg_kepviselojenek_neve');
                        echo form_input('ceg_kepviselojenek_neve', set_value('ceg_kepviselojenek_neve', $case->client_data->ceg_kepviselojenek_neve), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Születési név', 'szuletesi_nev');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('szuletesi_nev');
                        echo form_input('szuletesi_nev', set_value('szuletesi_nev', $case->client_data->szuletesi_nev), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Anyja születési neve', 'anyja_szuletesi_neve');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('anyja_szuletesi_neve');
                        echo form_input('anyja_szuletesi_neve', set_value('anyja_szuletesi_neve', $case->client_data->anyja_szuletesi_neve), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Születési hely', 'szuletesi_hely');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('szuletesi_hely');
                        echo form_input('szuletesi_hely', set_value('szuletesi_hely', $case->client_data->szuletesi_hely), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Születési idő', 'szuletesi_ido');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('szuletesi_ido');
                        echo form_input('szuletesi_ido', set_value('szuletesi_ido', $case->client_data->szuletesi_ido), 'class="form-control target datepick" placeholder="'. lang('date_format').'" maxlength="10"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Adóazonosító jel', 'adoszam');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('adoszam');
                        echo form_input('adoszam', set_value('adoszam', $case->client_data->adoszam), 'class="form-control" maxlength="10" placeholder="8SSSSSSSSS"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Azonosító okmány típusa', 'azonosito_okmany_tipusa');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('azonosito_okmany_tipusa');
                        echo form_dropdown('azonosito_okmany_tipusa', dropdown_data('okmany_tipus'), set_value('azonosito_okmany_tipusa', $case->client_data->azonosito_okmany_tipusa),'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Azonosító okmány száma', 'azonosito_okmany_szama');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('azonosito_okmany_szama');
                        echo form_input('azonosito_okmany_szama', set_value('azonosito_okmany_szama', $case->client_data->azonosito_okmany_szama), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Lakcímkártya száma', 'lakcimkartya_szama');
                        echo form_error('lakcimkartya_szama');
                        echo form_input('lakcimkartya_szama', set_value('lakcimkartya_szama', $case->client_data->lakcimkartya_szama), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Állampolgárság', 'allampolgarsag');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('allampolgarsag');
                        echo form_input('allampolgarsag', set_value('allampolgarsag', ($case->client_data->allampolgarsag ? $case->client_data->allampolgarsag : 'magyar')), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Lakcím', 'address');
                        echo "<span class='redstar'>*</span><br>";
                        echo form_error('iranyitoszam');
                        echo form_input('iranyitoszam', set_value('iranyitoszam', $case->client_data->iranyitoszam), 'class="form-control postcode" placeholder="Irányítószám" maxlength="4"'.($partner_updater ? ' readonly' : ''));
                        echo form_error('varos');
                        echo form_input('varos', set_value('varos', $case->client_data->varos), 'class="form-control town" placeholder="Város"'.($partner_updater ? ' readonly' : ''));
                        echo form_error('utca_hazszam');
                        echo form_input('utca_hazszam', set_value('utca_hazszam', $case->client_data->utca_hazszam), 'class="form-control" placeholder="Utca, házszám"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Levelezési cím', 'levelezesi_cim');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('levelezesi_cim');
                        echo form_input('levelezesi_cim', set_value('levelezesi_cim', $case->client_data->levelezesi_cim), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Telefonszám', 'telefonszam');
                        echo "<span class='redstar'>*</span><br>";
                        echo '+36 '.form_error('area_code');
                        echo form_dropdown('area_code', dropdown_data('area_code'), set_value('area_code', $case->client_data->area_code),'class="form-control area_code"'.($partner_updater ? ' readonly' : ''));
                        echo form_error('phone_no');
                        echo form_input('phone_no', set_value('phone_no', $case->client_data->phone_no), 'class="form-control phone" maxlength="7"'.($partner_updater ? ' readonly' : ''));
                        echo form_hidden('telefonszam', set_value('telefonszam', $case->client_data->telefonszam));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('E-mail cím', 'email');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('email');
                        echo form_input('email', set_value('email', $case->client_data->email), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Épület címe', 'epulet_cime');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('epulet_cime');
                        echo form_input('epulet_cime', set_value('epulet_cime', $case->client_data->epulet_cime), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Lakások száma', 'lakasok_szama');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('lakasok_szama');
                        echo form_input('lakasok_szama', set_value('lakasok_szama', $case->client_data->lakasok_szama), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                </fieldset>

                <div id="beneficiary_data_toggle" class="section_toggle">Kedvezményezett adatok<i></i></div>
                <fieldset id="beneficiary_data">

                    <div class="form-group">
                        <?php
                        echo form_label('Van kedvezményezett?', 'van_kedvezmenyezett');
                        echo form_checkbox('van_kedvezmenyezett', 1, set_checkbox('van_kedvezmenyezett', 1, (bool)$case->beneficiary->van_kedvezmenyezett), 'class="chk_boxes1" id="chk_van_kedvezmenyezett"');
                        ?>
                    </div>
                    <div id="sub_beneficiary_data">
                    <div class="form-group">
                        <?php
                        echo form_label('Név', 'nev');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('beneficiary_nev');
                        echo form_input('beneficiary_nev', set_value('beneficiary_nev', $case->beneficiary->nev), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Születési név', 'szuletesi_nev');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('beneficiary_szuletesi_nev');
                        echo form_input('beneficiary_szuletesi_nev', set_value('beneficiary_szuletesi_nev', $case->beneficiary->szuletesi_nev), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Anyja születési neve', 'anyja_szuletesi_neve');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('beneficiary_anyja_szuletesi_neve');
                        echo form_input('beneficiary_anyja_szuletesi_neve', set_value('beneficiary_anyja_szuletesi_neve', $case->beneficiary->anyja_szuletesi_neve), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Születési hely', 'szuletesi_hely');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('beneficiary_szuletesi_hely');
                        echo form_input('beneficiary_szuletesi_hely', set_value('beneficiary_szuletesi_hely', $case->beneficiary->szuletesi_hely), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Születési idő', 'szuletesi_ido');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('beneficiary_szuletesi_ido');
                        echo form_input('beneficiary_szuletesi_ido', set_value('beneficiary_szuletesi_ido', $case->beneficiary->szuletesi_ido), 'class="form-control target datepick" placeholder="'. lang('date_format').'" maxlength="10"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Adóazonosító jel', 'adoazonosito_jel');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('beneficiary_adoazonosito_jel');
                        echo form_input('beneficiary_adoazonosito_jel', set_value('beneficiary_adoazonosito_jel', $case->beneficiary->adoazonosito_jel), 'class="form-control" placeholder="8SSSSSSSSS" maxlength="10"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Állampolgárság', 'allampolgarsag');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('beneficiary_allampolgarsag');
                        echo form_input('beneficiary_allampolgarsag', set_value('beneficiary_allampolgarsag', $case->beneficiary->allampolgarsag), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Lakcím', 'address');
                        echo "<span class='redstar'>*</span><br>";
                        echo form_error('beneficiary_iranyitoszam');
                        echo form_input('beneficiary_iranyitoszam', set_value('beneficiary_iranyitoszam', $case->beneficiary->iranyitoszam), 'class="form-control postcode" placeholder="Irányítószám" maxlength="4"'.($partner_updater ? ' readonly' : ''));
                        echo form_error('beneficiary_varos');
                        echo form_input('beneficiary_varos', set_value('beneficiary_varos', $case->beneficiary->varos), 'class="form-control town" placeholder="Város"'.($partner_updater ? ' readonly' : ''));
                        echo form_error('beneficiary_utca_hazszam');
                        echo form_input('beneficiary_utca_hazszam', set_value('beneficiary_utca_hazszam', $case->beneficiary->utca_hazszam), 'class="form-control" placeholder="Utca, házszám"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Levelezési cím', 'levelezesi_cim');
                        echo form_error('beneficiary_levelezesi_cim');
                        echo form_input('beneficiary_levelezesi_cim', set_value('beneficiary_levelezesi_cim', $case->beneficiary->levelezesi_cim), 'class="form-control"'.($partner_updater ? ' readonly' : ''));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Telefonszám', 'telefonszam');
                        echo '+36 '.form_error('beneficiary_area_code');
                        echo form_dropdown('beneficiary_area_code', dropdown_data('area_code'), set_value('beneficiary_area_code', $case->beneficiary->area_code),'class="form-control area_code"'.($partner_updater ? ' readonly' : ''));
                        echo form_error('beneficiary_phone_no');
                        echo form_input('beneficiary_phone_no', set_value('beneficiary_phone_no', $case->beneficiary->phone_no), 'class="form-control phone" maxlength="7"'.($partner_updater ? ' readonly' : ''));
                        echo form_hidden('beneficiary_telefonszam', set_value('beneficiary_telefonszam', $case->beneficiary->telefonszam));
                        ?>
                    </div>
                </div>
                </fieldset>
                <div id="attachment_toggle" class="section_toggle">Mellékletek<i></i></div>
                <fieldset id="attachment">
                        <table class="table table-hover table-bordered table-condensed">
                            <?php
                            foreach ($document_types as $key => $item)
                            {
                                if (! $key) continue;
                                if ($case->documents[$key])
                                {
                                    foreach ($case->documents[$key] as $doc)
                                    {
                                ?>
                                <tr>
                                    <td><?php echo anchor('files/update/' . $doc->id . '?table=cases&table_id='.$case->id, $item);?></td>
                                    <td><?php echo $doc->title;?></td>
                                    <td><?php echo anchor(base_url().'uploads/case/'.$doc->filename, $doc->filename);?></td>
                                    <td><?php echo anchor('files/delete/' . $doc->id . '?table=cases&table_id='.$case->id, 'Törlés', 'class="glyphicon-remove"');?></td>
                                </tr>
                                <?php
                                    }
                                }
                                else
                                {?>
                                    <tr>
                                        <td><?php echo $item;?></td>
                                        <td><?php echo form_input('file_title_'.$key, set_value('file_title_'.$key), 'class="form-control file_title"');?></td>
                                        <td colspan="2"><?php echo form_upload('file_'.$key, set_value('file_'.$key), 'class="form-control"');?></td>
                                    </tr>
                                   <?php
                                }
                            }
                            ?>
                        </table>
                </fieldset>
                <?php
                if(in_array(($update ? 'edit_cases' : 'create_cases'), $this->session->permissions))
                {
					echo form_hidden('case_id', $case->id);
                    echo form_hidden('lead_id', $case->lead_id);
                    echo form_submit('submit', lang('enter'), 'class="btn btn-primary btn-lg btn-block"');
                    echo form_close();
                } ?>
            </div>
        </div>
    </div>
</div>
<?php
} ?>