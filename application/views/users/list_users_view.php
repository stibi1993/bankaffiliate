<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('view_users', $this->session->permissions)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("users") ?>
            <small><?php echo lang("edit_create_users") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-12">
            <!-- pre><?php //var_dump($users);?></pre -->
                <?php 
                if(in_array('create_users', $this->session->permissions)){?><a href="<?php echo site_url('users/create'); ?>" class="btn btn-primary"><?php echo lang("create_user") ?></a><?php } ?>
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
                
                if (!empty($users)) {
                    echo '<table class="table table-hover table-bordered table-condensed tablesorter">';
                    echo '<thead><tr><!--th>ID</th--><th>'.lang('username').'</th><th>'.lang('structure').'</th><th>'.lang('level').'</th><th>'.lang('company').'</th><th>'.lang('name').'</th><th>'.lang('email').'</th><th>'.lang('group').'</th><th>'.lang('last_login').'</th><th>'.lang('operations').'</th></tr></thead>';
                    foreach ($users as $user) {
                        //var_dump($user);
                    	if ( ($user->username != "admin") or in_array('edit_self', $this->session->permissions)){

                            echo '<tr class="clickable-row">';

                            if(in_array('view_users', $this->session->permissions)){

                                $viewUrl = base_url().'users/edit/'.$user->id;

                                echo '<!--td onclick=hrefClick("'.$viewUrl.'")>' . $user->id . '</td-->
                                <td onclick=hrefClick("'.$viewUrl.'")>' . $user->username . '</td>
                                <td>' . $user->structure . '</td>
                                <td>' . $user->level . '</td>
                                <td onclick=hrefClick("'.$viewUrl.'")>';
                                if(isset($user->company_name))
                                    echo($user->company_name);
                                echo '</td>
                                <td onclick=hrefClick("'.$viewUrl.'")>' . $user->last_name . ' ' . $user->first_name . '</td>
                                </td><td onclick=hrefClick("'.$viewUrl.'")>' . $user->email . '</td>';

                                echo '<td onclick=hrefClick("'.$viewUrl.'")>';
                                foreach ($user->group as $g){
                                    echo "   ".$g->description."   ";
                                }
                                echo '</td>';


                                echo '<td onclick=hrefClick("'.$viewUrl.'")>' . date('Y-m-d H:i:s', $user->last_login) . '</td>';



                            }else{
                                echo '<!--td>' . $user->id . '</td-->
                                <td>' . $user->username . '</td>
                                <td>';
                                if(isset($user->company_name))
                                    echo($user->company_name);
                                echo '</td>
                                <td>' . $user->first_name . ' ' . $user->last_name . '</td>
                                </td><td>' . $user->email . '</td>';

                                echo '<td>';
                                foreach ($user->group as $g){
                                    echo "   ".$g->description."   ";
                                }
                                echo '</td>';

                                echo '<td>' . date('d-m-Y H:i:s', $user->last_login) . '</td>';
                            }


                            echo '<td>';

	                        if(in_array('view_users', $this->session->permissions)){ 
	                        	//if(($current_user->id != $user->id) or (in_array('edit_self', $this->session->permissions)))
	                        		echo anchor('users/edit/' . $user->id, '<span class="glyphicon glyphicon-pencil"></span>');
	                       	}
	                        if(in_array('delete_users', $this->session->permissions)) {
                                if (($current_user->id != $user->id) /*or (in_array('edit_self', $this->session->permissions))*/)
                                {
                                    echo anchor('users/delete/' . $user->id, '<span class="red glyphicon glyphicon-remove"></span>');
                                }
                            }

                    	}
                        else echo '&nbsp;';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</table>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
