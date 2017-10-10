<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php if (in_array('view_dash', $this->session->permissions)) { ?>
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">

                    <?php echo lang("dashboard") ?>
                <!--<small><?php //echo lang("statistics") ?> <?php //echo lang("overview") ?></small>-->

            </h1>
            <div class="row-fluid">
                <div class="row">
                    
                    <div class="col-lg-8">
                        <a class="alert_text"><?php echo lang('dashboard_today') ?></a>
                    <table class="dash_table">
                            <thead class="dash_thead">
                            <tr class="dash_tr">
                                    <th class="dash_th"><?php echo lang('dashboard_type') ?></th>
                                    <th class="dash_th"><?php echo lang('dashboard_name') ?></th>
                                    <th class="dash_th"><?php echo lang('dashboard_date') ?></th>
                                    <th class="dash_th"><?php echo lang('dashboard_action') ?></th>
                            </tr>
                            </thead>
                            <?php if ($alerts_daily1 or $alerts_daily2 or $alerts_daily3) {
                                     	if ($alerts_daily1){
	                                     	foreach ($alerts_daily1 as $al) {
												$phpdate = strtotime($al->projected_end_assignment);
												$proj_end_ass = date('d-m-Y', $phpdate);
												
	                                            $color = '#eb6b56!important';
	                                            $type = lang('dashboard_end_of_assignment');
	                                            echo    '<tbody class="dash_tbody">'
                                                            . '<tr class="dash_tr mobile_botmargin">'
                                                            . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/general/' . $al->employee_id . '/' . $al->mission_id . '">' . $type . '</td>'
                                                            . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/general/' . $al->employee_id . '/' . $al->mission_id . '">' . $al->employee_name . '</td> 
	                                            		<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/general/' . $al->employee_id . '/' . $al->mission_id . '">' . 
	                                            		$proj_end_ass .  '</td>'
                                                            . '<td class="dash_td" style="color:' . $color . '">'; 
	                                            if (in_array('edit_dash', $this->session->permissions)) {
	                                                echo anchor('dashboard/delete_alert/' . $al->mission_id . '/' . $this->session->userdata['user_id'].'/'.ALERTS_TYPE_ASSIGMENT, '<span data-type="alert-delete" class="red glyphicon glyphicon-remove alerts_delete"></span>');
	                                            }
                                                        echo '</td>'
                                                            . '</tr>'
                                                            . '</tbody>'; 
                                                        }
                                     	}
                                     	if ($alerts_daily2){
                                     		foreach ($alerts_daily2 as $al) {
                                     			if($al->type_expiry_date != '0000-00-00' and $al->type_expiry_date != null){
														$phpdate = strtotime($al->type_expiry_date);
														$type_exp_date = date('d-m-Y', $phpdate);
                                     				$expiry = $type_exp_date;
                                     			}else{
                                     				$expiry = 'No date';
                                     			}
                                     			$color = '#449d44!important';
                                     			$type = lang('dashboard_end_of_detachment_certificate');
                                                    echo    '<tbody class="dash_tbody">'
                                                            . '<tr class="dash_tr mobile_botmargin">'
                                                            . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/social/' . $al->employee_id . '/' . $al->mission_id . '">' . $type . '</td>'
                                                                . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/social/' . $al->employee_id . '/' . $al->mission_id . '">' . $al->employee_name . '</td>'
                                                                . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/social/' . $al->employee_id . '/' . $al->mission_id . '">' .
                                     					$expiry .  '</td>'
                                     			. '<td class="dash_td" style="color:' . $color . '">';
                                     			if (in_array('edit_dash', $this->session->permissions)) {
                                     				echo anchor('dashboard/delete_alert/' . $al->mission_id . '/' . $this->session->userdata['user_id'].'/'.ALERTS_TYPE_CERTIFICATE, '<span data-type="alert-delete" class="red glyphicon glyphicon-remove alerts_delete"></span>');
                                     			}
                                                        echo '</td>'
                                                            . '</tr>'
                                                            . '</tbody>'; 
                                                        }
                                     	}
                                     	if ($alerts_daily3){
                                     		foreach ($alerts_daily3 as $al) {
                                     			if($al->work_expiry_date != '0000-00-00' and $al->work_expiry_date != null){
														$phpdate = strtotime($al->work_expiry_date);
														$work_exp_date = date('d-m-Y', $phpdate);
                                     				$expiry = $work_exp_date;
                                     			}else{
                                     				$expiry = null;
                                     			}
                                     			if($al->residence_expiry_date != '0000-00-00' and $al->residence_expiry_date != null){
														$phpdate = strtotime($al->residence_expiry_date);
														$res_expiry = date('d-m-Y', $phpdate);
                                     				$residence_expiry = $res_expiry;
                                     			}else{
                                     				$residence_expiry = null;
                                     			}
                                     			if($expiry != null){
                                     				$exp = $expiry;
                                     			}else{
                                     				$exp = $residence_expiry;
                                     			}
                                     			
												 $color = '#286090!important';
                                     			 $type = lang('dashboard_immigration');
                                                     echo    '<tbody class="dash_tbody">'
                                                            . '<tr class="dash_tr mobile_botmargin">'
                                                             . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/relocation/' . $al->employee_id . '/' . $al->mission_id . '">' . $type . '</td>'
                                                                . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/relocation/' . $al->employee_id . '/' . $al->mission_id . '">' . $al->employee_name . '</td>'
                                                                . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/relocation/' . $al->employee_id . '/' . $al->mission_id . '">' .
                                     					$exp .  '</td>'
                                                                .'<td class="dash_td mobile_botmargin" style="color:' . $color . '">';
                                     			if (in_array('edit_dash', $this->session->permissions)) {
                                     				echo anchor('dashboard/delete_alert/' . $al->mission_id . '/' . $this->session->userdata['user_id'].'/'.ALERTS_TYPE_IMMIGARTION, '<span data-type="alert-delete" class="red glyphicon glyphicon-remove alerts_delete"></span>');
                                     			}
                                                        echo '</td>'
                                                            . '</tr>'
                                                            . '</tbody>'; 
                                                        }
                                     	}

                            }else{
                                    echo    '<tbody class="dash_tbody">'
                                            . '<tr class="dash_tr nohover mobile_botmargin">'
                                            . '<td class="dash_td dash_nothint_text">' . lang('dashboard_nothing_to_worry_about') . '</td>'
                                            . '</tr>'
                                            . '</tbody>';
                            }
?>
                    </table>
						
                            <a class="alert_text"><?php echo lang('dashboard_monthly') ?></a>
													
                            <table class="dash_table">
                            <thead class="dash_thead">
                            <tr class="dash_tr">
                                <th class="dash_th"><?php echo lang('dashboard_type') ?></th>
                                <th class="dash_th"><?php echo lang('dashboard_name') ?></th>
                                <th class="dash_th"><?php echo lang('dashboard_date') ?></th>
                                <th class="dash_th"><?php echo lang('dashboard_action') ?></th>
                            </tr>    
                            </thead>
                            <tbody class="dash_tbody">
                            <?php if ($alerts_monthly1 or $alerts_monthly2 or $alerts_monthly3) {
                                     	if ($alerts_monthly1){
                                     		foreach ($alerts_monthly1 as $al) {
												$phpdate = strtotime($al->projected_end_assignment);
												$proj_end_ass2 = date('d-m-Y', $phpdate);
	                                            $color = '#eb6b56!important';
	                                            $type = lang('dashboard_end_of_assignment');
	                                            echo    '<tbody class="dash_tbody">'
                                                            . '<tr class="dash_tr mobile_botmargin">'
                                                            . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/general/' . $al->employee_id . '/' . $al->mission_id . '"> ' . $type . '</td>'
                                                            . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/general/' . $al->employee_id . '/' . $al->mission_id . '">' . $al->employee_name . '</td>'
                                                            . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/general/' . $al->employee_id . '/' . $al->mission_id . '">' . 
	                                            		$proj_end_ass2 .  '</td>'
                                                            . '<td class="dash_td" style="color:' . $color . '">';
	                                            if (in_array('edit_dash', $this->session->permissions)) {
	                                                echo anchor('dashboard/delete_alert/' . $al->mission_id . '/' . $this->session->userdata['user_id'].'/'.ALERTS_TYPE_ASSIGMENT, '<span data-type="alert-delete" class="red glyphicon glyphicon-remove alerts_delete"></span>');
	                                            }
                                                        echo '</td>'
                                                            . '</tr>'
                                                            . '</tbody>'; 
                                                        }
                                     	}
                                     	
                                     	?>
                                     	<?php 
                                     	if ($alerts_monthly2){
                                     		foreach ($alerts_monthly2 as $al) {
                                     			if($al->type_expiry_date != '0000-00-00' and $al->type_expiry_date != null){
														$phpdate = strtotime($al->type_expiry_date);
														$type_expiry_date2 = date('d-m-Y', $phpdate);
												
                                     				$expiry = $type_expiry_date2;
                                     			}else{
                                     				$expiry = 'No date';
                                     			}
                                     			$color = '#449d44!important';
                                     			$type = lang('dashboard_end_of_detachment_certificate');
                                                        echo    '<tbody class="dash_tbody">'
                                                                . '<tr class="dash_tr mobile_botmargin">'
                                                                . '<td class="dash_td table_link" data-href="missions/social/' . $al->employee_id . '/' . $al->mission_id . '"" style="color:' . $color . '">' . $type . '</td>'
                                                                . '<td class="dash_td table_link" data-href="missions/social/' . $al->employee_id . '/' . $al->mission_id . '"" style="color:' . $color . '">' . $al->employee_name . '</td>'
                                                                . '<td class="dash_td table_link" data-href="missions/social/' . $al->employee_id . '/' . $al->mission_id . '"" style="color:' . $color . '">' . $expiry .  '</td>'
                                                                . '<td class="dash_td mobile_botmargin" style="color:' . $color . '">';
                                     			if (in_array('edit_dash', $this->session->permissions)) {
                                     				echo anchor('dashboard/delete_alert/' . $al->mission_id . '/' . $this->session->userdata['user_id'].'/'.ALERTS_TYPE_CERTIFICATE, '<span data-type="alert-delete" class="red glyphicon glyphicon-remove alerts_delete"></span>');
                                     			}
                                                        echo '</td>'
                                                            . '</tr>'
                                                            . '</tbody>'; 
                                                        }
                                     	}
                                     	
                                     	?>
                                     	<?php if ($alerts_monthly3){
                                     		foreach ($alerts_monthly3 as $al) {
                                     			if($al->work_expiry_date != '0000-00-00' and $al->work_expiry_date != null){
														$phpdate = strtotime($al->work_expiry_date);
														$work_expiry_date2 = date('d-m-Y', $phpdate);
														
                                     				$expiry = $work_expiry_date2;
                                     			}else{
                                     				$expiry = null;
                                     			}
                                     			if($al->residence_expiry_date != '0000-00-00' and $al->residence_expiry_date != null){
                                     				$residence_expiry = $al->residence_expiry_date;
                                     			}else{
                                     				$residence_expiry = null;
                                     			}
                                     			if($expiry != null){
                                     				$exp = $expiry;
                                     			}else{
                                     				$exp = $residence_expiry;
                                     			}
                                     			
												 $color = '#286090!important';
                                     			 $type = lang('dashboard_immigration');
                                     			echo    '<tbody class="dash_tbody">'
                                                                . '<tr class="dash_tr mobile_botmargin">'
                                                                . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/relocation/' . $al->employee_id . '/' . $al->mission_id . '">' . $type . '</td>'
                                                                . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/relocation/' . $al->employee_id . '/' . $al->mission_id . '">' . $al->employee_name . '</td>'
                                                                . '<td class="dash_td table_link" style="color:' . $color . '" data-href="missions/relocation/' . $al->employee_id . '/' . $al->mission_id . '">' .
                                     					$exp . '</td>'
                                     							. '<td class="dash_td" style="color:' . $color . '">';
                                     			if (in_array('edit_dash', $this->session->permissions)) {
                                     				 echo anchor('dashboard/delete_alert/' . $al->mission_id . '/' . $this->session->userdata['user_id'].'/'.ALERTS_TYPE_IMMIGARTION, '<span data-type="alert-delete" class="red glyphicon glyphicon-remove alerts_delete"></span>');
                                     			}
                                                        echo '</td>'
                                                            . '</tr>'
                                                            . '</tbody>'; 
                                                        }
                                     	}
                                     	
                                     }else{
                                    echo    '<tbody class="dash_tbody">'
                                            . '<tr class="dash_tr nohover mobile_botmargin">'
                                            . '<td class="dash_td dash_nothint_text">'. lang('dashboard_nothing_to_worry_about') .'</td>'
                                            . '</tr>'
                                            . '</tbody>';
                            }?>
                            </tbody>
                    </table>
                    </div>
                </div>
            </div>

        </div>
    </div>





<?php } ?>

