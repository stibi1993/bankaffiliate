<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('view_leads', $this->session->permissions)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo 'Leadek' ?>
            <small><?php echo lang("edit_create_leads") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-12">
            <!-- pre><?php //var_dump($users);?></pre -->
                <?php 
                if(in_array('create_leads', $this->session->permissions)){?><a href="<?php echo site_url('leads/create'); ?>" class="btn btn-primary"><?php echo lang("create_lead") ?></a><?php } ?>
            </div>
        </div>
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
                    echo '<table class="table table-hover table-bordered table-condensed tablesorter">';
                    echo '<thead><tr><th>Forrás</th></th><th>Leosztás dátum</th><th>Hozzárendelt</th><th>Ügyfél</th><th>Státusz</th><th>'.lang('phone').'</th>
<th>Város</th>
<th>Következő akció</th>
<th>Státusz dátum</th>
<th>Rögzítés</th>
<th>'.lang('operations').'</th></tr></thead>';
                    foreach ($leads as $item)
                    {
                        echo '<tr class="clickable-row'.((! $item->statuses['items']) || (! $item->statuses['latest_reminder']) || ($item->statuses['latest_reminder'] < $now) ? ' warning' : '').'">';

                        $viewUrl = base_url().'leads/status/'.$item->id;

                        echo '<td>' . $user_list[$item->source] . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->splitting_time . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->last_name . ' '. $item->first_name . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->name . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . ($item->statuses['items'] ? $status_list[$item->statuses['items'][0]->status] : '') . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->phone . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->town. (strtolower($item->town) == 'budapest' ? ' '.substr($item->postcode, 1, 2) : '') . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->statuses['next_action_time'] . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . ($item->statuses['items'] ? $item->statuses['items'][0]->created_time : '')  . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->created_time . '</td>
                        ';

                        echo '<td>';

                        if(in_array('view_leads', $this->session->permissions)){
                            echo anchor('leads/update/' . $item->id, '<span class="glyphicon glyphicon-pencil"></span>');
                        }
                        if(in_array('delete_leads', $this->session->permissions)) {
                            echo anchor('leads/delete/' . $item->id, '<span class="red glyphicon glyphicon-remove"></span>');
                        }

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
