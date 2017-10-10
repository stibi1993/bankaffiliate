<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('view_languages', $this->session->permissions)){ ?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("languages") ?>
            <small><?php echo lang("edit") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo form_open('',array('class'=>'form-horizontal'));
                ?>
                <div class="form-group">
                    <?php
                    echo form_label(lang('language_name'),'language_name');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('language_name');
                    echo form_input('language_name',set_value('language_name',$language->language_name),'class="form-control"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label(lang('language_slug'),'language_slug');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('language_slug');
                    echo form_input('language_slug',set_value('language_slug',$language->slug),'class="form-control"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label(lang('language_directory'),'language_directory');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('language_directory');
                    echo form_input('language_directory',set_value('language_directory',$language->language_directory),'class="form-control"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label(lang('language_code'),'language_code');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('language_code');
                    echo form_input('language_code',set_value('language_code',$language->language_code),'class="form-control"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    echo form_label(lang('default_language'),'default');
                    echo form_dropdown('default',array('0' => lang('language_default_no'), '1'=> lang('language_default_yes')),set_value('default',$language->default),'class="form-control"');
                    ?>
                </div>
                <?php if(in_array('edit_languages', $this->session->permissions)){ echo form_error('language_id');?>
                <?php echo form_hidden('language_id',$language->id);?>
                <?php echo form_submit('submit', lang('edit_language'), 'class="btn btn-primary btn-lg btn-block"');?>
                <?php echo form_close(); } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
