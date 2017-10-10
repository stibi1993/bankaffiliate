<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('edit_structures', $this->session->permissions)){ ?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("structure") ?>
            <small><?php echo lang(($update?'update_structure':"create_structure")) ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                <div class="form-group">
                    <?php
                    echo form_label(lang('title'),'title');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('title');
                    echo form_input('title',set_value('title', $structure->title),'class="form-control"');
                    ?>
                </div>
                <div class="form-group">
                    <?php
                    if (isset($product_categories))
                    {?>
                        <div class="form-group">
                            <?php
                            $attr = array('class' => 'permission-left');
                            echo form_label(lang('product_categories'), 'product_categories[]', $attr);?>

                            <div class="groupholder"> <?php

                                foreach ($product_categories as $id=>$item)
                                {
                                    echo '<div class="checkbox with-width">';
                                    echo '';
                                    echo form_checkbox('product_categories[]', $id, set_checkbox('product_categories[]', $id, in_array($id, $current_product_categories)), 'class="chk_boxes1" id="chk_' . $id . '"');
                                    echo '<label for="chk_' . $id . '">' . $item . '</label>';
                                    echo '</div>';
                                }
                                ?> </div></div> <?php
                    }
                    ?>
                </div>
                <?php echo form_hidden('id',$structure->id);?>
                <?php echo form_submit('submit', lang('enter'), 'class="btn btn-primary btn-lg btn-block"');?>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
