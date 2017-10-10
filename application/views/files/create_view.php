<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('edit_files', $this->session->permissions)){ ?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("file") ?>
            <small><?php echo lang(($update?'update_file':"create_file")) ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo form_open_multipart('files/'.($update ? 'update/'.$file->id : 'create').'?table='.$_GET['table'].'&table_id='.$_GET['table_id'], array('class'=>'form-horizontal'));?>
                <div class="form-group">
                    <?php
                    echo form_label('Dokumentum', 'file');
                    if ($update)
                        echo '<a href="'.$document_path.'" target="_blank">'.$document_path.'</a>';
                    else
                    {
                        echo "<span class='redstar'>*</span>";
                        echo form_error('file');
                        echo form_upload('file', set_value('email'), 'class="form-control"');
                    }
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Dokumentum típusa', 'document_type');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('document_type');
                    echo form_dropdown('document_type', dropdown_data($_GET['table'].'_document_type'), set_value('document_type', ($file->document_type ? $file->document_type : $_GET['document_type'])),'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label(lang('title'),'title');
                    echo form_input('title',set_value('title', $file->title),'class="form-control"');
                    ?>
                </div>
                <?php
                echo form_hidden('id', $file->id);
                echo form_error('table');
                echo form_hidden('table', $_GET['table']);
                echo form_error('table_id');
                echo form_hidden('table_id', $_GET['table_id']);
                echo form_submit('submit', lang('enter'), 'class="btn btn-primary btn-lg btn-block"');
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
