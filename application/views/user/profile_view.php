<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('view_self', $this->session->permissions)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("profile") ?>
            <small><?php echo lang("edit") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4 double_margin">
                <h1><?php echo lang("profile_page") ?></h1>
               <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                <div class="form-group">
                    <?php
                    echo form_label(lang('first_name'),'first_name');
                    echo form_error('first_name');
                    echo form_input('first_name',set_value('first_name',$user->first_name),'class="form-control"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label(lang('last_name'),'last_name');
                    echo form_error('last_name');
                    echo form_input('last_name',set_value('last_name',$user->last_name),'class="form-control"');
                    ?>
                </div>
                <!--div class="form-group">
                <?php if ($this->ion_auth->is_admin()) { ?>

                    <?php
                        echo form_label(lang('company'), 'company');
                        echo form_dropdown('company',$companies_list,set_value('company',$user->company),'class="form-control"');
                        //echo form_input('company', set_value('company', $user->company), 'class="form-control"');
                    ?>

                <?php }else{ ?>
                    <?php
                    echo form_label(lang('company'),'company');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('company');
                    echo form_input('company',  set_value('company', $companies_list[$user->company]),'class="form-control" readonly');
                    ?>

                <?php } ?>

                </div-->

                <div class="form-group">
                    <?php
                    echo form_label(lang('phone'),'phone');
                    echo form_input('phone',set_value('phone',$user->phone),'class="form-control" readonly');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label(lang('username'),'username');
                    echo form_input('username',set_value('username',$user->username),'class="form-control" readonly');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label(lang('email'),'email');
                    echo form_input('email',set_value('email',$user->email),'class="form-control" readonly');
                    ?>
                </div>
                <!--div class="form-group">
                    <?php/*
                    echo form_label(lang('default_language'),'default_lang');
                    echo form_dropdown('default_lang',$lang_list,set_value('default_lang',$user->default_lang),'class="form-control"');
                    */?>
                </div-->
                <div class="form-group">
                    <?php
                    echo form_label(lang('change_password'),'password');
                    echo form_error('password');
                    echo form_password('password','','class="form-control"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label(lang('confirm_changed_password'),'password_confirm');
                    echo form_error('password_confirm');
                    echo form_password('password_confirm','','class="form-control"');
                    ?>
                </div>
                <?php if(in_array('edit_self', $this->session->permissions)){
					if(!$this->ion_auth->is_admin()){
					echo form_hidden('company', $user->company);
					}
				?>

                <?php echo form_submit('submit', lang('enter'), 'class="btn btn-primary btn-lg btn-block"');?>
                <?php echo form_close();?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
