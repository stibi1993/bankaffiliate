<?php
if (isset($cities) && count($cities)) {
?>
    <div class="form-group">
        <label for="mission_host_host_city">Host city</label>
        <select name="host_city" class="form-control">
            <option value="" selected="selected"><?php echo lang('select_please_select_country') ?></option>
            <?php
            foreach ($cities as $k => $v){
                ?>
                <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
<?php
}else{
    ?>
    <div class="form-group">
        <label for="mission_host_host_city">Host city</label>
        <select name="host_city" class="form-control">
            <option disabled value="" selected="selected">Empty</option>
        </select>
    </div>
<?php
}
?>