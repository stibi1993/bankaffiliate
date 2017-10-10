<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (in_array('edit_custom_labels', $this->session->permissions)) { ?>
    <?php $class = "active menuitem"; ?>
    <div class="row">
        <h1 class="page-header">
            <?php echo lang("labels") ?>
            <small><?php echo lang("edit") ?></small>
        </h1>

    </div>
<?php } ?>


<?php echo form_open('', array('class' => 'form-horizontal')); ?>

    <h2><?php echo lang("employee_page") ?></h2>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 double_margin" style="margin-top: 10px;">

            <?php foreach ($employee_labels as $labels) { ?>
                <div class="form-group">
                    <?php
                    echo $labels->label_code . " (" . $this->session->language . ")";
                    echo form_input($labels->label_code, set_value($labels->label_code, $labels->custom_label), 'class="form-control"');
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <h2><?php echo lang("family_page") ?></h2>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 double_margin" style="margin-top: 10px;">
            <?php foreach ($family_labels as $labels) { ?>
                <div class="form-group">
                    <?php
                    echo $labels->label_code . " (" . $this->session->language . ")";
                    echo form_input($labels->label_code, set_value($labels->label_code, $labels->custom_label), 'class="form-control"');
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <h2><?php echo lang("mission_home_page") ?></h2>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 double_margin" style="margin-top: 10px;">
            <?php foreach ($mission_home_labels as $labels) { ?>
                <div class="form-group">
                    <?php
                    echo $labels->label_code . " (" . $this->session->language . ")";
                    echo form_input($labels->label_code, set_value($labels->label_code, $labels->custom_label), 'class="form-control"');
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <h2><?php echo lang("mission_host_page") ?></h2>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 double_margin" style="margin-top: 10px;">
            <?php foreach ($mission_host_labels as $labels) { ?>
                <div class="form-group">
                    <?php
                    echo $labels->label_code . " (" . $this->session->language . ")";
                    echo form_input($labels->label_code, set_value($labels->label_code, $labels->custom_label), 'class="form-control"');
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <h2><?php echo lang("mission_general_page") ?></h2>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 double_margin" style="margin-top: 10px;">
            <?php foreach ($mission_general_labels as $labels) { ?>
                <div class="form-group">
                    <?php
                    echo $labels->label_code . " (" . $this->session->language . ")";
                    echo form_input($labels->label_code, set_value($labels->label_code, $labels->custom_label), 'class="form-control"');
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <h2><?php echo lang("mission_social_page") ?></h2>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 double_margin" style="margin-top: 10px;">
            <?php foreach ($mission_social_labels as $labels) { ?>
                <div class="form-group">
                    <?php
                    echo $labels->label_code . " (" . $this->session->language . ")";
                    echo form_input($labels->label_code, set_value($labels->label_code, $labels->custom_label), 'class="form-control"');
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <h2><?php echo lang("mission_relocation_page") ?></h2>
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 double_margin" style="margin-top: 10px;">
            <?php foreach ($mission_relocation_labels as $labels) { ?>
                <div class="form-group">
                    <?php
                    echo $labels->label_code . " (" . $this->session->language . ")";
                    echo form_input($labels->label_code, set_value($labels->label_code, $labels->custom_label), 'class="form-control"');
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php echo form_submit('submit', lang('save_labels'), 'class="btn btn-primary btn-lg btn-block"'); ?>
    <?php echo form_close(); ?>
