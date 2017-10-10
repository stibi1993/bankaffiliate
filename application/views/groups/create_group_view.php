<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('edit_group', $this->session->permissions)){ ?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("groups") ?>
            <small><?php echo lang("create") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo $this->session->flashdata('message'); ?>
                <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <?php echo form_label(lang('group_name'), 'group_name'); ?>
                    <?php echo "<span class='redstar'>*</span>" ?>
                    <?php echo form_error('group_name'); ?>
                    <?php echo form_input('group_name', '', 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label(lang('group_description'), 'group_description'); ?>
                    <?php echo "<span class='redstar'>*</span>" ?>
                    <?php echo form_error('group_description'); ?>
                    <?php echo form_input('group_description', '', 'class="form-control"'); ?>
                </div>
                <?php echo form_submit('submit', lang('create_group'), 'class="btn btn-primary btn-lg btn-block"'); ?>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>