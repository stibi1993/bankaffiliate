<?php if (isset($file) && count($file)) { 
	foreach ($file as $f){?>	
    <div id="<?php echo $f->document_type ?>-action-delete">
        <a href="#" class="delete_file_link" data-file_id="<?php echo $f->id?>">Delete</a>
    </div>
<?php } ?>
<div id="<?php echo $file[0]->document_type ?>-action-form">
	<form method="post" action="" id="upload_file_<?php echo $file[0]->document_type ?>" data-mission-id="<?php echo $file[0]->mission_id ?>">
	<label for="userfile_<?php echo $file[0]->document_type ?>">File</label>
	<input type="file" name="userfile_<?php echo $file[0]->document_type ?>" id="userfile_<?php echo $file[0]->document_type ?>" size="20" />
	<input type="submit" name="submit" id="submit" />
	</form>
</div>

<?php }else{ ?>
    <div id="<?php echo $file->document_type ?>-action-form">
        <form method="post" action="" id="upload_file_<?php echo $file->document_type ?>" data-mission-id="<?php echo $file->mission_id ?>">
            <label for="userfile_<?php echo $file->document_type ?>">File</label>
            <input type="file" name="userfile_<?php echo $file->document_type ?>" id="userfile_<?php echo $file->document_type ?>" size="20" />
            <input type="submit" name="submit" id="submit" />
        </form>
    </div>
<?php } ?>