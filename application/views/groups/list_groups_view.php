<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('view_group', $this->session->permissions)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("groups") ?>
            <small><?php echo lang("edit_create_groups") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-12">
              <?php if(in_array('edit_users', $this->session->permissions)){ ?> <a href="<?php echo site_url('groups/create'); ?>" class="btn btn-primary"><?php echo lang("create_groups") ?></a> <?php } ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" style="margin-top: 10px;">

                <div id="pager" class="pager">
                    <form>
                        <img src="<?php echo site_url('assets/img/pager/first.png' ) ?>" class="first"/>
                        <img src="<?php echo site_url('assets/img/pager/prev.png' ) ?>" class="prev"/>
                        <input type="text" class="pagedisplay"/>
                        <img src="<?php echo site_url('assets/img/pager/next.png' ) ?>" class="next"/>
                        <img src="<?php echo site_url('assets/img/pager/last.png' ) ?>" class="last"/>
                        <select class="pagesize">
                            <option selected="selected"  value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option  value="100">100</option>
                        </select>
                    </form>
                </div>

        <?php
        if (!empty($groups)) {
	            echo '<table class="table table-hover table-bordered table-condensed tablesorter">';
	            echo '<thead><tr><th>ID</th><th>' .lang('group_name'). '</th><th>' .lang('group_description'). '</th><th>' .lang('operations'). '</th></tr></thead>';
	            foreach ($groups as $group) {
	            if ( ($group->name != "admin") or in_array('edit_self', $this->session->permissions)){

                    echo '<tr class="clickable-row">';

                    if(in_array('view_group', $this->session->permissions)){
                        $viewUrl = base_url().'groups/edit/'.$group->id;
                        echo '<td onclick=hrefClick("'.$viewUrl.'")>';
                        echo $group->id;
                        echo '</td>';
                        echo '<td onclick=hrefClick("'.$viewUrl.'")>';
                        echo anchor('users/index/' . $group->name);
                        echo '</td>';
                        echo '<td onclick=hrefClick("'.$viewUrl.'")>';
                        echo $group->description;
                        echo '</td>';

                    }else{
                        echo '<td>';
                        echo $group->id;
                        echo '</td';
                        echo '<td>';
                        echo anchor('users/index/' . $group->name);
                        echo '</td>';
                        echo '<td>';
                        echo $group->description;
                        echo '</td>';

                    }
                    echo '<td >';
	                if(in_array('view_group', $this->session->permissions)){ echo anchor('groups/edit/' . $group->id, '<span class="glyphicon glyphicon-pencil"></span>');}
	                if(in_array('edit_group', $this->session->permissions)){ echo anchor('groups/delete/' . $group->id, '<span class="red glyphicon glyphicon-remove"></span>');}
	                echo '</td>';
	                echo '</tr>';
	            }
        	}
            echo '</table>';
        }
        ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>





