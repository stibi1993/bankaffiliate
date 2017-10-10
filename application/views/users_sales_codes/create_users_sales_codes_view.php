<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('edit_users', $this->session->permissions)){ ?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo 'Ügynök kód' ?>
            <small><?php echo 'Módosítás' ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo form_open_multipart('',array('class'=>'form-horizontal'));?>
                <div class="form-group">
                    <?php
                    echo form_label('LTP / hitelintézet', 'hitelintezet');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('bank_id');
                    echo form_dropdown('bank_id', $bank_list, set_value('bank_id', $users_sales_code->bank_id),'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Kapcsolattartó fiók neve', 'kapcsolattarto_fiok_neve');
                    echo form_input('kapcsolattarto_fiok_neve', set_value('kapcsolattarto_fiok_neve', $users_sales_code->kapcsolattarto_fiok_neve), 'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Kapcsolattartó fiók kódja', 'kapcsolattarto_fiok_kodja');
                    echo form_input('kapcsolattarto_fiok_kodja', set_value('kapcsolattarto_fiok_kodja', $users_sales_code->kapcsolattarto_fiok_kodja), 'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Kapcsolattartó fiók címe', 'kapcsolattarto_fiok_cime');
                    echo form_input('kapcsolattarto_fiok_cime', set_value('kapcsolattarto_fiok_cime', $users_sales_code->kapcsolattarto_fiok_cime), 'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Dátum', 'datum');
                    echo form_error('datum');
                    echo form_input('datum', set_value('datum', $users_sales_code->datum), 'class="form-control target datepick" placeholder="'. lang('date_format').'"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Azonosító', 'azonosito');
                    echo form_error('azonosito');
                    echo form_input('azonosito', set_value('azonosito', $users_sales_code->azonosito), 'class="form-control"');
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
                            echo '<div class="checkbox with-width categories" id="sales_code_cat_'. $id .'">';
                            echo '';
                            echo form_checkbox('product_categories[]', $id, set_checkbox('product_categories[]', $id, in_array($id, $current_product_categories)), 'class="chk_boxes1 sales_code_cat_chk" id="sales_code_chk_' . $id . '"');
                            echo '<label for="sales_code_chk_' . $id . '">' . $item . '</label>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <?php echo form_hidden('id',$users_sales_code->id);?>
                <?php echo form_submit('submit', lang('enter'), 'class="btn btn-primary btn-lg btn-block"');?>
                <?php echo form_submit('cancel', lang('cancel'), 'class="btn btn-primary btn-lg btn-block"');?>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
