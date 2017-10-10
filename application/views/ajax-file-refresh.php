<?php

if (isset($file) && count($file)) {
	foreach ($file as $f){
    ?>
    <ul>
        <li class="image_wrap">
            <div class="open_pdf" url="<?php echo site_url() . FILE_UPLOAD_PATH ?>/<?php echo $f->filename?>"><?php echo $f->title?></div>
        </li>
    </ul>
<?php }
} else {
    ?>
    <p>No Files Uploaded</p>
<?php
}
?>