<?php

if (isset($file) && count($file)) {
	foreach ($file as $f){
    ?>
    <div id="date-"<?php $f->document_type ?>>
            <?php echo $f->upload_date?>
    </div>

<?php }
} else {
    ?>
    <div id="date-"<?php $file->document_type ?>>--</div>
<?php
}
?>