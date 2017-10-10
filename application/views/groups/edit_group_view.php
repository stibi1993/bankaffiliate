<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('view_group', $this->session->permissions)){ ?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("groups") ?>
            <small><?php echo lang("edit") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo form_open('', array('class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <?php echo form_label(lang('group_name'), 'group_name'); ?>
                    <?php echo "<span class='redstar'>*</span>" ?>
                    <?php echo form_error('group_name'); ?>
                    <?php echo form_input('group_name', set_value('group_name', $group->name), 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php echo form_label(lang('group_description'), 'group_description'); ?>
                    <?php echo "<span class='redstar'>*</span>" ?>
                    <?php echo form_error('group_description'); ?>
                    <?php echo form_input('group_description', set_value('group_description', $group->description), 'class="form-control"'); ?>
                </div>
                <div class="form-group">
                    <?php
                    if (isset($permissions)) {
                        ?> <div class="form-group">
                        <?php    
                        $attr = array('class' => 'permission-left');
                        echo form_label(lang('permissions'), 'permissions[]', $attr);?> 

                        <div class="groupholder"> <?php

                        $rows_per_column = ceil((count($permissions)+1) / 3);
                        $i = 0;
                        foreach ($permissions as $permission)
                        {
                            if ($i  && ! ($i %  $rows_per_column)) echo '</div>';
	                        if (! ($i %  $rows_per_column)) echo '<div class="checkbox with-width">';
                            if (! $i)
                            {
                                echo '<input type="checkbox" class="chk_boxes" id="check_all"  /><label for="check_all">Select all</label><br>';
                                $i++;
                            }
	                        echo '<label>';
	                        echo form_checkbox('groups[]', $permission->id, set_checkbox('groups[]', $permission->id, in_array($permission->id, $group_permissions)), 'class="chk_boxes1"');
	                        echo ' ' . $permission->name;
	                        echo '</label><br>';
	                        $i++;
                        }
                            ?> </div></div></div> <?php
                    }
                    ?>
                </div>
                <?php if(in_array('edit_group', $this->session->permissions)){ echo form_hidden('group_id', set_value('group_id', $group->id)); ?>
                <?php echo form_submit('submit', lang('edit_group'), 'class="btn btn-primary btn-lg btn-block"'); ?>
                <?php echo form_close(); } ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
