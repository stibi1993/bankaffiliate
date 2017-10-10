<div class="row row_login">
    <div class="col-xs-6 col-xs-offset-3 col-lg-4 col-lg-offset-4">
        <img class="login_banner" src="../assets/img/banner.jpeg">
        <h2 class="login_h2">Forgot password</h2>
        <?php echo $this->session->flashdata('message'); ?>
        <?php echo form_open('', array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <?php echo form_label('Email', 'identity'); ?>
            <?php echo form_error('identity'); ?>
            <?php echo form_input('identity', '', 'class="form-control"'); ?>
        </div>

        <div class="form-group">
            <label>
                <a href="<?php echo site_url('user/login') ?>">Login</a>
            </label>
        </div>

        <?php echo form_submit('submit', 'Get forgot password', 'class="btn btn-primary btn-lg btn-block"'); ?>
        <?php echo form_close(); ?>
    </div>
</div>