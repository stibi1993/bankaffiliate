<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Page Heading -->
<?php
if(in_array($update ? 'view_users' : 'create_users', $this->session->permissions))
{?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("user") ?>
            <small><?php echo lang($update ? 'edit' : 'create') ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'create_user'));?>
                <div id="base_data_toggle" class="section_toggle">Alapadatok<i></i></div>
                <fieldset id="base_data">

                    <div class="form-group">
                        <?php
                        if (isset($groups))
                        {
                            echo form_label(lang('groups'), 'groups[]');
                            echo form_error('groups[]');
                            echo form_dropdown('groups[]', dropdown_data('group', $groups), set_value('groups[]', $usergroups),'class="form-control"');
                        }
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('company'), 'company');
                        echo form_error('company');
                        echo form_dropdown('company',$companies_list,set_value('company',$user->company),'class="form-control"');
                        echo '<div><strong>Vagy új cég:</strong> '.form_input('new_company', set_value('new_company'), 'class="form-control"').'</div>';
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('last_name'), 'last_name');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('last_name');
                        echo form_input('last_name', set_value('last_name', $user->last_name), 'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('first_name'), 'first_name');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('first_name');
                        echo form_input('first_name', set_value('first_name', $user->first_name), 'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('activity_status'), 'activity_status');
                        echo form_error('status');
                        echo form_dropdown('status', dropdown_data('user_status'), set_value('status', $user->status),'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('legal_relation'), 'legal_relation');
                        echo form_error('legal_relation');
                        echo form_dropdown('legal_relation', dropdown_data('legal_relation'), set_value('legal_relation', $user->legal_relation),'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Születési hely', 'birth_place');
                        echo form_error('birth_place');
                        echo form_input('birth_place', set_value('birth_place', $user->birth_place), 'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Születési idő', 'birth_date');
                        echo form_error('birth_date');
                        echo form_input('birth_date', set_value('birth_date', $user->birth_date), 'class="form-control target datepick" placeholder="'. lang('date_format').'" maxlength="10"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('mothers_name'), 'mothers_name');
                        echo form_error('mothers_name');
                        echo form_input('mothers_name', set_value('mothers_name', $user->mothers_name), 'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('id_card_no'), 'id_card_no');
                        echo form_error('id_card_no');
                        echo form_input('id_card_no', set_value('id_card_no', $user->id_card_no), 'class="form-control" placeholder="SSSSSSBB" maxlength="8"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('address_card_no'), 'address_card_no');
                        echo form_error('address_card_no');
                        echo form_input('address_card_no', set_value('address_card_no', $user->address_card_no), 'class="form-control" placeholder="SSSSSSBB" maxlength="8"');
                        ?>
                    </div>

                    <!--div class="form-group">
                        <?php
                        echo form_label(lang('company_reg_no'), 'company_reg_no');
                        echo form_error('company_reg_no');
                        echo form_input('company_reg_no', set_value('company_reg_no', $user->company_reg_no), 'class="form-control" placeholder="SS-SS-SSSSSS vagy BB-SSSSSS" maxlength="12"');
                        ?>
                    </div-->

                    <div class="form-group">
                        <?php
                        echo form_label('Adóazonosító jel', 'tax_id');
                        echo form_error('tax_id');
                        echo form_input('tax_id', set_value('tax_id', $user->tax_no), 'class="form-control" placeholder="8SSSSSSSSS" maxlength="10"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('education'), 'education');
                        echo form_error('education');
                        echo form_dropdown('education', dropdown_data('education'), set_value('education', $user->education),'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('education_date'), 'education_date');
                        echo form_error('education_date');
                        echo form_input('education_date', set_value('education_date', $user->education_date), 'class="form-control target datepick" placeholder="'. lang('date_format').'" maxlength="10"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('mnb_no'), 'mnb_no');
                        echo form_error('mnb_no');
                        echo form_input('mnb_no', set_value('mnb_no', $user->mnb_no), 'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('comments'), 'comment');
                        echo form_textarea('comment', set_value('comment', $user->comment), 'class="form-control"');
                        ?>
                    </div>
                </fieldset>
                <!--div class="form-group">
                    <?php/*
                    echo form_label(lang('default_language'),'default_lang');
                    echo form_dropdown('default_lang',$lang_list,set_value('default_lang',$user->default_lang),'class="form-control"');
                    */?>
                </div-->
                <div id="bank360_data_toggle" class="section_toggle">Bank360 belső adatok<i></i></div>
                <fieldset id="bank360_data">
                <?php
                if ($update)
                {?>
                    <div class="form-group">
                        <?php
                        echo form_label(lang('username'), 'username');
                        echo form_error('username');
                        echo form_input('username', set_value('username', $user->username), 'class="form-control"'.($this->ion_auth->is_admin() ? '' : ' readonly'));
                        ?>
                    </div>
                <?php
                }?>
                    <div class="form-group">
                        <?php
                        echo form_label(lang($update ? 'change_password' : 'password'), 'password');
                        echo form_error('password');
                        echo form_password('password', '', 'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('confirm_password'), 'password_confirm');
                        echo form_error('password_confirm');
                        echo form_password('password_confirm', '', 'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('structure'), 'structure');
                        echo form_error('structure_id');
                        echo form_dropdown('structure_id', $structures_list, set_value('structure_id', $user->structure_id),'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('product_categories'), 'product_categories');
                        echo form_error('product_categories[]');
                        ?>
                        <div class="groupholder">
                            <?php
                            foreach ($product_categories as $id=>$item)
                            {
                                echo '<div class="checkbox with-width categories" id="cat_'. $id .'">';
                                echo '';
                                echo form_checkbox('product_categories[]', $id, set_checkbox('product_categories[]', $id, in_array($id, $current_product_categories)), 'class="chk_boxes1 cat_chk" id="chk_' . $id . '"');
                                echo '<label for="chk_' . $id . '">' . $item . '</label>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('level'), 'level');
                        echo form_error('level');
                        echo form_dropdown('level', dropdown_data('level'), set_value('level', $user->level),'class="form-control"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('superior'), 'superior');
                        echo form_error('superior_id');
                        echo form_dropdown('superior_id', $superiors_list, set_value('superior_id', $user->superior_id),'class="form-control"');
                        ?>
                    </div>
                </fieldset>

                <div id="contact_data_toggle" class="section_toggle">Elérhetőség<i></i></div>
                <fieldset id="contact_data">
                    <div class="form-group">
                        <?php
                        echo form_label('Lakcím', 'address').'<br>';
                        echo form_error('iranyitoszam');
                        echo form_input('iranyitoszam', set_value('iranyitoszam', $user->iranyitoszam), 'class="form-control postcode" placeholder="Irányítószám" maxlength="4"');
                        echo form_error('varos');
                        echo form_input('varos', set_value('varos', $user->varos), 'class="form-control town" placeholder="Város"');
                        echo form_error('utca_hazszam');
                        echo form_input('utca_hazszam', set_value('utca_hazszam', $user->utca_hazszam), 'class="form-control" placeholder="Utca, házszám"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Levelezési cím', 'address');
                        echo form_checkbox('levelezesi_cim_is', 1, set_checkbox('levelezesi_cim_is', 1, (bool)$user->levelezesi_cim_is), 'class="chk_boxes1" id="chk_levelezesi_cim_is"');
                        echo '<label for="chk_levelezesi_cim_is">Levelezési cím megegyezik?</label><br>';
                        echo form_error('levelezes_iranyitoszam');
                        echo form_input('levelezes_iranyitoszam', set_value('levelezes_iranyitoszam', $user->levelezes_iranyitoszam), 'class="form-control postcode" placeholder="Irányítószám" maxlength="4"');
                        echo form_error('levelezes_varos');
                        echo form_input('levelezes_varos', set_value('levelezes_varos', $user->levelezes_varos), 'class="form-control town" placeholder="Város"');
                        echo form_error('levelezes_utca_hazszam');
                        echo form_input('levelezes_utca_hazszam', set_value('levelezes_utca_hazszam', $user->levelezes_utca_hazszam), 'class="form-control" placeholder="Utca, házszám"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label(lang('phone'), 'phone').'<br>';
                        echo '+36 '.form_error('area_code');
                        echo form_dropdown('area_code', dropdown_data('mobile_area_code'), set_value('area_code', $user->area_code),'class="form-control area_code"');
                        echo form_error('phone_no');
                        echo form_input('phone_no', set_value('phone_no', $user->phone_no), 'class="form-control phone" maxlength="7"');
                        echo form_hidden('mobiltelefonszam', set_value('mobiltelefonszam', $user->mobiltelefonszam));
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Privát e-mail cím', 'email');
                        echo form_error('email_privat');
                        echo form_input('email_privat', set_value('email_privat', $user->email_privat), 'class="form-control"');
                        ?>
                    </div>
                <?php
                if ($update)
                {?>
                    <div class="form-group">
                        <?php
                        echo form_label('Céges e-mail cím', 'email');
                        echo form_error('email');
                        echo form_input('email', set_value('email', $user->email), 'class="form-control"'.($this->ion_auth->is_admin() ? '' : ' readonly'));
                        ?>
                    </div>
                <?php
                }
                ?>
                </fieldset>

                <div id="billing_data_toggle" class="section_toggle">Számlázási adatok<i></i></div>
                <fieldset id="billing_data">
                    <div class="form-group">
                        <?php
                        echo form_label('Cégnév', 'company_name');
                        echo form_error('company_name');
                        echo form_input('company_name', set_value('company_name', $company->company_name), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Adószám', 'tax_no');
                        echo form_error('tax_no');
                        echo form_input('tax_no', set_value('tax_no', $company->tax_no), 'class="form-control billing" readonly placeholder="SSSSSSSS-S-SS" maxlength="13"');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Tevékenység kezdete', 'fundation_date');
                        echo form_error('fundation_date');
                        echo form_input('fundation_date', set_value('fundation_date', $company->fundation_date), 'class="form-control billing" readonly');
                        ?>
                    </div>
                    <div class="form-group">
                        <?php
                        echo form_label('Székhely cím', 'szekhely');
                        echo form_error('reg_office_postcode');
                        echo form_input('reg_office_postcode', set_value('reg_office_postcode', $company->reg_office_postcode), 'class="form-control postcode billing" readonly');
                        echo form_error('reg_office_town');
                        echo form_input('reg_office_town', set_value('reg_office_town', $company->reg_office_town), 'class="form-control town billing" readonly');
                        echo form_error('reg_office_street');
                        echo form_input('reg_office_street', set_value('reg_office_street', $company->reg_office_street), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Képviselő neve', 'representative_name');
                        echo form_error('representative_name');
                        echo form_input('representative_name', set_value('representative_name', $company->representative_name), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Képviselő születési ideje', 'representative_birth_date');
                        echo form_error('representative_birth_date');
                        echo form_input('representative_birth_date', set_value('representative_birth_date', $company->representative_birth_date), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Képviselő személyi igazolvány száma', 'representative_id_card_no');
                        echo form_error('representative_id_card_no');
                        echo form_input('representative_id_card_no', set_value('representative_id_card_no', $company->representative_id_card_no), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Képviselő címe', 'representative_address');
                        echo form_error('representative_address');
                        echo form_input('representative_address', set_value('representative_address', $company->representative_address), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('TEÁOR besorolás', 'teaor');
                        echo form_error('teaor');
                        echo form_input('teaor', set_value('teaor', $company->teaor), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Céges bankszámla', 'bank_account_no');
                        echo form_error('bank_account_no');
                        echo form_input('bank_account_no', set_value('bank_account_no', $company->bank_account_no), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Cégjegyzékszám', 'reg_no');
                        echo form_error('reg_no');
                        echo form_input('reg_no', set_value('reg_no', $company->reg_no), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Céges telefon', 'phone');
                        echo form_error('phone');
                        echo form_input('phone', set_value('phone', $company->phone), 'class="form-control billing" readonly');
                        ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo form_label('Cég e-mail cím', 'company_email');
                        echo form_error('company_email');
                        echo form_input('company_email', set_value('copmany_email', $company->email), 'class="form-control billing" readonly');
                        ?>
                    </div>
                </fieldset>

                <div id="attachment_toggle" class="section_toggle">Mellékletek<i></i></div>
                <fieldset id="attachment">
                    <table class="table table-hover table-bordered table-condensed">
                        <?php
                        foreach ($document_types as $key => $item)
                        {
                            if (! $key) continue;
                            if ($user->documents[$key])
                            {
                                foreach ($user->documents[$key] as $doc)
                                {
                                    ?>
                                    <tr>
                                        <td><?php
                                            if (in_array(($update ? 'edit_users' : 'create_users'), $this->session->permissions) && in_array('edit_files', $this->session->permissions))
                                                echo anchor('files/update/' . $doc->id . '?table=users&table_id='.$user->id, $item);
                                            else echo $item;?>
                                        </td>
                                        <td><?php echo $doc->title;?></td>
                                        <td><?php echo anchor(base_url().'uploads/user/'.$doc->filename, $doc->filename);?></td>
                                        <td><?php if (in_array('edit_users', $this->session->permissions) && in_array('edit_files', $this->session->permissions))
                                            echo anchor('files/delete/' . $doc->id . '?table=users&table_id='.$user->id, 'Törlés', 'class="glyphicon-remove"');?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {?>
                                <tr>
                                    <td><?php echo $item;?></td>
                                    <?php
                                        if (in_array(($update ? 'edit_users' : 'create_users'), $this->session->permissions) && (in_array('edit_files', $this->session->permissions)))
                                            echo '
                                    <td>'.form_input('file_title_'.$key, set_value('file_title_'.$key), 'class="form-control file_title"').'</td>

                                    <!--td colspan="2" id="package-action-form">
                        <form method="post" action="" id="upload_file_package" data-mission-id="'.$mission_id.'">
                            <input type="file" name="userfile_package" id="userfile_package" size="20"/>
                            <input type="submit" name="submit" id="submit" value="'. lang('label_button_upload_file').'"/>
                        </form>
                    </td-->
                                    <td colspan="2">'.form_upload('file_'.$key, set_value('file_'.$key), 'class="form-control"').'</td>';
                                        else
                                            echo '<td colspan="3"></td>';?>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </table>
                </fieldset>
                <div id="sales_codes_toggle" class="section_toggle">Értékesítési kódok<i></i></div>
                <fieldset id="sales_codes_data">
                    <?php
                if ($update && $user->active)
                {
                    if ($user->sales_codes)
                    {?>
                    <table class="table table-hover table-bordered table-condensed">
                        <thead><tr><th>Pénzintézet</th><th>Azonosító</th><th>Termékek</th><th><?php echo lang('operations');?></th></tr></thead>
                    <?php
                        foreach ($user->sales_codes as $item)
                        {
                            $current_product_categories = explode(',', $item->product_categories);
                            $current_product_category_titles = [];
                            foreach ($current_product_categories as $pc)
                                $current_product_category_titles[] = $product_categories[$pc];
                            ?>
                            <tr>
                                <td><?php echo $item->bank;?></td>
                                <td><?php echo $item->azonosito;?></td>
                                <td><?php echo implode(', ', $current_product_category_titles);?></td>
                                <td><?php
                                    if (in_array('edit_users', $this->session->permissions))
                                        echo anchor('users_sales_codes/update/' . $item->id, '<span class="glyphicon glyphicon-pencil"></span>').
                                        anchor('users_sales_codes/delete/' . $item->id, '<span class=" red glyphicon glyphicon-remove"></span>');?>
                                </td>
                            </tr>
                        <?php
                        }
                    ?>
                    </table>
                    <?php
                    }
                    if (in_array('edit_users', $this->session->permissions))
                        echo '<div><button type="button" id="new_sales_code_toggle" class="btn btn-primary">Új értékesítési kód</button></div>';?>
                    <div id="new_sales_code_form">
                        <div class="form-group">
                            <?php
                            echo form_label('LTP / hitelintézet', 'hitelintezet');
                            echo form_error('bank_id');
                            echo form_dropdown('bank_id', $bank_list, set_value('bank_id'),'class="form-control"');
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                            echo form_label('Kapcsolattartó fiók neve', 'kapcsolattarto_fiok_neve');
                            echo form_input('kapcsolattarto_fiok_neve', set_value('kapcsolattarto_fiok_neve'), 'class="form-control"');
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                            echo form_label('Kapcsolattartó fiók kódja', 'kapcsolattarto_fiok_kodja');
                            echo form_input('kapcsolattarto_fiok_kodja', set_value('kapcsolattarto_fiok_kodja'), 'class="form-control"');
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                            echo form_label('Kapcsolattartó fiók címe', 'kapcsolattarto_fiok_cime');
                            echo form_input('kapcsolattarto_fiok_cime', set_value('kapcsolattarto_fiok_cime'), 'class="form-control"');
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                            echo form_label('Dátum', 'datum');
                            echo form_error('datum');
                            echo form_input('datum', set_value('datum'), 'class="form-control target datepick" placeholder="'. lang('date_format').'"');
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                            echo form_label('Azonosító', 'azonosito');
                            echo form_error('azonosito');
                            echo form_input('azonosito', set_value('azonosito'), 'class="form-control"');
                            ?>
                        </div>

                        <div class="form-group">
                            <?php
                            echo form_label(lang('product_categories'), 'product_categories');
                            echo form_error('sales_code_product_categories[]');
                            ?>
                            <div class="groupholder">
                                <?php
                                foreach ($product_categories as $id=>$item)
                                {
                                    echo '<div class="checkbox with-width categories" id="sales_code_cat_'. $id .'">';
                                    echo '';
                                    echo form_checkbox('sales_code_product_categories[]', $id, set_checkbox('sales_code_product_categories[]', $id), 'class="chk_boxes1 sales_code_cat_chk" id="sales_code_chk_' . $id . '"');
                                    echo '<label for="sales_code_chk_' . $id . '">' . $item . '</label>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }?>
                </fieldset>
                <?php
                if(in_array(($update ? 'edit_users' : 'create_users'), $this->session->permissions))
                {
					echo form_hidden('user_id', $user->id);
                    if ((! $user->active) || ! $update)
                    {
                        echo form_submit('temp_submit', lang('temp_edit_user'), 'class="btn btn-primary btn-lg btn-block"');
                        echo form_submit('perm_submit', lang('perm_edit_user'), 'class="btn btn-primary btn-lg btn-block"');
                    }
                    else
                        echo form_submit('submit', lang('edit_user'), 'class="btn btn-primary btn-lg btn-block"');
                    echo form_close();
                } ?>
            </div>
        </div>
    </div>
</div>
<?php
} ?>
