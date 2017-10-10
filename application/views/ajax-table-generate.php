<div class="row">
    <!--div class="col-lg-3 col-md-6">
        <div class="form-group">
            <label class="shownumber">Number to show:</label>
            <select id="list-show-number" class="form-control">
                <option value="10" <?php if($limit == "10") echo "selected" ?> >10</option>
                <option value="20" <?php if($limit == "20") echo "selected" ?> >20</option>
                <option value="50" <?php if($limit == "50") echo "selected" ?> >50</option>
                <option value="999999" <?php if($limit == "999999") echo "selected" ?> ><?php echo lang('all') ?></option>
            </select>
            <button type="button" id="list-show-number-btn" class="btn btn-primary"><?php echo lang('ok') ?></button>
        </div>
    </div-->
    <!--div class="col-lg-3 col-md-6">
    </div-->
    <!--div class="col-lg-3 col-md-6">
    </div-->
    <!--div class="col-lg-3 col-md-6">
        <div class="form-group">
            <label class="shownumber">Page:</label>
            <ul id="pager">
                <?php
                for( $i= 1 ; $i <= $total ; $i++ )
                {
                    if($i == $page) {
                        $class="pagerli active";
                    }else{
                        $class="pagerli";
                    }

                    echo '<li class="'.$class.'">'.$i.'</li>';
                }
                ?>
            </ul>
        </div>
    </div-->
</div>

<div class="row">
    <div class="col-lg-12" style="margin-top: 10px;">
        <?php if($filter == "all"){ ?>
            <div id="table-title-all"><h3><?php echo lang('all_assigness') ?> </h3></div>

        <?php }else{ ?>
            <div id="table-title-current" style="display: block;"><h3><?php echo lang('current_assigness') ?> </h3></div>

        <?php } ?>



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
        echo '<table id="mission-table" class="table table-hover table-bordered table-condensed table-striped tablesorter">';
        echo '<thead><tr id="mission-table-header">
                                <th>'.lang("name").'</th>
                                <th>'.lang("first_name").'</th>
                                <th>'.lang("home_country").'</th>
                                <th>'.lang("home_company").'</th>
                                <th>'.lang("host_country").'</th>
                                <th>'.lang("host_city").'</th>
                                <th>'.lang("host_company").'</th>
                                <th>'.lang("start_of_assingnment").'</th>
                                <th>'.lang("project_end_of_assingnment").'</th>
                                <th>'.lang("actual_end_of_assignment").'</th>
                                <th>'.lang("e_mail").'</th>
                                <th>'.lang("family_composition").'</th>
                                <th>'.lang("action").'</th>
                            </tr></thead><tbody>';

        if (!empty($missions)) {
            foreach ($missions as $mission) {
                if(!isset($mission->home_country_label)){
                    $mission->home_country_label = "--";
                }
                if(!isset($mission->home_company_label)){
                    $mission->home_company_label = "--";
                }
                if(!isset($mission->host_country_label)){
                    $mission->host_country_label = "--";
                }
                if(!isset($mission->host_city_label)){
                    $mission->host_city_label = "--";
                }
                if(!isset($mission->host_company_label)){
                    $mission->host_company_label = "--";
                }
                if(in_array('view_mission', $this->session->permissions)) {
                    $data_href = 'data-href="missions/general/' . $mission->employee_id . '/' . $mission->mission_id . '"';

                } else {
                    $data_href = '';
                }             
                echo '<tr id="mission-list-tr" class="clickable-row dash_tr" data-href="' . site_url("employees/edit/" . $mission->id) . '" data-empid="' . $mission->id . '">';
                echo   '<td class="mission_link" '. $data_href . '>' . $mission->name . '</td>
                                    <td class="mission_link" '. $data_href . '>' . $mission->first_name . '</td>
                                    <td class="mission_link" '. $data_href . '>' . $mission->home_country_label . '</td>
                                    <td class="mission_link" '. $data_href . '>' . $mission->home_company_label . '</td>
                                    <td class="mission_link" '. $data_href . '">' . $mission->host_country_label . '</td>
                                    <td class="mission_link" '. $data_href . '">' . $mission->host_city_label . '</td>
                                    <td class="mission_link" '. $data_href . '>' . $mission->host_company_label . '</td>
                                    <td class="mission_link" '. $data_href . '>' . ($mission->start_assignment == '0000-00-00' ? '' :  date('d-m-Y', strtotime($mission->start_assignment))) . '</td>
                                    <td class="mission_link" '. $data_href . '">' . ($mission->projected_end_assignment == '0000-00-00' ? '' :  date('d-m-Y', strtotime($mission->projected_end_assignment))). '</td>
                                    <td class="mission_link" '. $data_href . '">' .    ($mission->actual_end_assignment == '0000-00-00' ? '' :  date('d-m-Y', strtotime($mission->actual_end_assignment))) . '</td>
                                    <td class="mission_link" '. $data_href . '">' . $mission->email . '</td>
                                    <td class="mission_link" '. $data_href . '">' . lang($mission->family_composition) . '</td>';

                //var_dump($mission);
                echo '<td>';
                if(in_array('view_mission', $this->session->permissions)){ echo anchor('missions/general/'.$mission->employee_id.'/'.$mission->mission_id,'<span class="glyphicon glyphicon-pencil"></span>');}
                if(in_array('edit_mission', $this->session->permissions)){ echo anchor('missions/delete_from_list/'.$mission->mission_id,'<span class="glyphicon red glyphicon-remove"></span>');}
                if(in_array('view_mission', $this->session->permissions)){ echo anchor('missions/general/'.$mission->employee_id.'/'.$mission->mission_id.'/true', '<img style="margin-left: 20px;" src="' . site_url('assets/img/icon-pdf-16x16.png' ) .'"/>', ['target' => '_blank']);}
                echo '</td>';

                echo '</tr>';
            }

        }else{

            echo   '<td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>
                                    <td>' . lang("no_mission") . '</td>';
        }

        echo '</tbody></table>';

        if (!empty($missions)) { ?>
            <button type="button" id="selected-columns" class="btn btn-primary"><?php echo lang("export") ?></button>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".tablesorter").tablesorter({widthFixed: true, widgets: ['zebra']});
        $(".tablesorter").tablesorterPager({container: $("#pager")});
        $(".tablesorter").tablesorter({
            sortMultiSortKey: 'ctrlKey'
        });
    });
    //todo [CL] delete confirm
    $(function() {
        $('.glyphicon-remove').click(function(event) {
            event.preventDefault();
            var choice = confirm(LANG['confirm_delete_record']);
            if (choice) {
                window.location.href = $(this).parent().attr('href');
            }
            return false;
        });
    });
</script>