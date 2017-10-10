<?php
if (isset($userdata) && count($userdata)) {
    if ($userdata->first_name) {
    	echo $userdata->first_name;
    }
    echo ' ';
    if ($userdata->last_name) {
    echo$userdata->last_name;
    }
    echo '<br/>';

} else {
    ?>
    --
<?php
}
?>