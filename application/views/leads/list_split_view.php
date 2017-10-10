<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('split_leads', $this->session->permissions)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo 'Lead leosztás' ?>
        </h1>
        <div class="row">
            <div class="col-lg-12" style="margin-top: 10px;">

                <div id="pager" class="pager">
                    <form>
                        <img src="<?php echo site_url('assets/img/pager/first.png' ) ?>" class="first"/>
                        <img src="<?php echo site_url('assets/img/pager/prev.png' ) ?>" class="prev"/>
                        <input class="pagedisplay"/>
                        <img src="<?php echo site_url('assets/img/pager/next.png' ) ?>" class="next"/>
                        <img src="<?php echo site_url('assets/img/pager/last.png' ) ?>" class="last"/>
                        <select class="pagesize">
                            <option selected  value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option  value="100">100</option>
                        </select>
                    </form>
                </div>

                <?php
                
                if (!empty($leads))
                {
//                    var_dump($structures_agents);
                    echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'split_lead'));
                    echo '<table class="table table-hover table-bordered table-condensed tablesorter">';
                    echo '<thead><tr><th>Hozzárendelés</th><th>Forrás</th></th><th>Ügyfél</th><th>'.lang('phone').'</th><th>Város</th><th>Pénzintézet</th><th>Rögzítő</th><th>Rögzítés</th>
</tr></thead>';
                    foreach ($leads as $item)
                    {
                        echo '<tr>';

                        $source = $item->source;
                        if (substr($source, 0, 2) == 'U_')
                            $source = $user_list[substr($source, 2)];
                        elseif (ctype_digit($source))
                            $source = $structure_list[$source];

                        echo '<td>' . form_dropdown('lead_'.$item->id, dropdown_data('agent', null, $structures_agents[$item->structure_id]), [] ,'class="form-control"'). '</td>';


                        echo '<td>' . $source . '</td>
                        <td>' . $item->name . '</td>
                        <td>' . $item->phone . '</td>
                        <td>' . $item->town. (strtolower($item->town) == 'budapest' ? ' '.substr($item->postcode, 1, 2) : '') . '</td>
                        <td>' . $item->bank . '</td>
                        <td>' . $item->last_name . ' '. $item->first_name . '</td>
                        <td>' . $item->created_time . '</td>
                        ';

                        echo '</tr>';
                    }
                    echo '</table>';
                    if(in_array('edit_leads', $this->session->permissions))
                    {
                        echo form_submit('submit', lang('enter'), 'class="btn btn-primary btn-lg btn-block"');
                    }
                    echo form_close();
                }?>
            </div>
        </div>
    </div>
</div>
<?php } ?>
