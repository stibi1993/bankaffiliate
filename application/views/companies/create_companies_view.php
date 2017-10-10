<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array(($update ? 'view_companies' : 'edit_companies'), $this->session->permissions)){ ?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("company") ?>
            <small><?php echo lang($update ? 'edit' : 'create') ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo form_open_multipart('',array('class'=>'form-horizontal', 'id' => 'create_company'));
                ?>
                <div class="form-group">
                    <?php
                    echo form_label(lang('company_name'),'company_name');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('company_name');
                    echo form_input('company_name',set_value('company_name', $company->company_name),'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Adószám', 'tax_no');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('tax_no');
                    echo form_input('tax_no', set_value('tax_no', $company->tax_no), 'class="form-control" placeholder="SSSSSSSS-S-SS" maxlength="13"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Tevékenység kezdete', 'fundation_date');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('fundation_date');
                    echo form_input('fundation_date', set_value('fundation_date', $company->fundation_date), 'class="form-control datepick" placeholder="'. lang('date_format').'" maxlength="10"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label('Székhely cím', 'szekhely');
                    echo "<span class='redstar'>*</span>".'<br>';
                    echo form_error('reg_office_postcode');
                    echo form_input('reg_office_postcode', set_value('reg_office_postcode', $company->reg_office_postcode), 'class="form-control postcode" placeholder="Irányítószám" maxlength="4"');
                    echo form_error('reg_office_town');
                    echo form_input('reg_office_town', set_value('reg_office_town', $company->reg_office_town), 'class="form-control town" placeholder="Város"');
                    echo form_error('reg_office_street');
                    echo form_input('reg_office_street', set_value('reg_office_street', $company->reg_office_street), 'class="form-control" placeholder="Utca, házszám"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Képviselő neve', 'representative_name');
                    echo form_error('representative_name');
                    echo form_input('representative_name', set_value('representative_name', $company->representative_name), 'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Képviselő születési ideje', 'representative_birth_date');
                    echo form_error('representative_birth_date');
                    echo form_input('representative_birth_date', set_value('representative_birth_date', $company->representative_birth_date), 'class="form-control datepick" placeholder="'. lang('date_format').'" maxlength="10"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Képviselő személyi igazolvány száma', 'representative_id_card_no');
                    echo form_error('representative_id_card_no');
                    echo form_input('representative_id_card_no', set_value('representative_id_card_no', $company->representative_id_card_no), 'class="form-control" placeholder="SSSSSSBB" maxlength="8"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Képviselő címe', 'representative_address');
                    echo form_error('representative_address');
                    echo form_input('representative_address', set_value('representative_address', $company->representative_address), 'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('TEÁOR besorolás', 'teaor');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('teaor');
                    echo form_input('teaor', set_value('teaor', $company->teaor), 'class="form-control" placeholder="SSSS" maxlength="4"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Céges bankszámla', 'bank_account_no');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('bank_account_no');
                    echo form_input('bank_account_no', set_value('bank_account_no', $company->bank_account_no), 'class="form-control" placeholder="SSSSSSSS-SSSSSSSS(-SSSSSSSS)"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Cégjegyzékszám', 'reg_no');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('reg_no');
                    echo form_input('reg_no', set_value('reg_no', $company->reg_no), 'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Céges telefon', 'phone');
                    echo "<span class='redstar'>*</span><br>";
                    echo '+36 '.form_error('area_code');
                    echo form_dropdown('area_code', dropdown_data('area_code'), set_value('area_code', $company->area_code),'class="form-control area_code"');
                    echo form_error('phone_no');
                    echo form_input('phone_no', set_value('phone_no', $company->phone_no), 'class="form-control phone" maxlength="7"');
                    echo form_hidden('phone', set_value('phone', $company->phone));
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Céges e-mail cím', 'email');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('email');
                    echo form_input('email', set_value('email', $company->email), 'class="form-control"');
                    ?>
                </div>
                <!--div class="form-group">
                    <?php
                    echo form_label(lang('company_description'),'company_description');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('company_description');
                    echo form_input('company_description',set_value('company_description',$company->company_description),'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                	<?php echo form_error('companyPicture'); ?>
                    <label for="companyPicture"><?php echo lang("company_logo") ?></label>
                    <input type="file" name="companyPicture" id="companyPicture" size="20" />
					<label for="missionCompanyPicture"><?php echo lang("add_mission_upload_warning") ?></label>                    
                </div>
                <div class="form-group">
                    <label for="companyPicture"><?php echo lang("current_logo") ?></label>
                    <br />
                    <?php if($company->company_logo != null){ ?>
                        <img height="50" src=<?php echo base_url("uploads/company/".$company->company_logo) ?>>
                    <?php }else{
                        echo lang('label_no_current_picture');
                    } ?>
                </div-->

                <?php echo form_hidden('id',$company->id);?>
                <?php if(in_array('edit_companies', $this->session->permissions)){ ?>
                <?php echo form_submit('submit', lang('enter'), 'class="btn btn-primary btn-lg btn-block"');?>
                <?php echo form_close();?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
