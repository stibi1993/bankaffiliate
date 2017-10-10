<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('view_cases', $this->session->permissions)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("cases") ?>
            <small><?php echo lang("edit_create_cases") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-12">
            <!-- pre><?php //var_dump($users);?></pre -->
                <?php 
                if(in_array('create_cases', $this->session->permissions)){?><a href="<?php echo site_url('cases/create'); ?>" class="btn btn-primary"><?php echo lang("create_case") ?></a><?php } ?>
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
                
                if (!empty($cases))
                {
                    echo '<div id="sum_contract_amount">Szerződéses összegek összesen: '.money_formatter($sum_contract_amount).'</div>';
                    echo '<table class="table table-hover table-bordered table-condensed tablesorter">';
                    echo '<thead><tr><th>Fizetési mód</th></th><th>Szerződésszám</th><th>Ügyfél forrás</th><th>'.lang('name').'</th><th>'.lang('phone').'</th><th>Szerződéses módozat</th>
<th>Szerződéses összeg</th>
<th>Havi betét</th>
<th>Számlanyitási díj</th>
<th>Szerződéskötés dátuma</th>
<th>Ügyfél címe</th>
<th>E-mail cím</th>
<th>Ügynök</th>
<th>Szint</th>
<th>Felettes</th>
<th>Struktúravezető</th>
<th>Várható indulás</th>
<th>'.lang('operations').'</th></tr></thead>';
                    foreach ($cases as $item)
                    {
                        echo '<tr class="clickable-row">';

                        $viewUrl = base_url().'cases/update/'.$item->id;

                        echo '<td onclick=hrefClick("'.$viewUrl.'")>' . $befizetes_modja[$item->befizetes_modja] . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->szerzodes_szam . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->client_data->ugyfel_forras . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->client_data->nev . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->client_data->telefonszam . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'") title="'.$item->termekcsalad.'">' . string_cut_at_word($item->termekcsalad, 25) . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . money_formatter($item->ltp_szerzodes_osszege) . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . money_formatter($item->havi_befizetes) . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . money_formatter($item->szamlanyitasi_dij) . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->szerzodeskotes_datuma . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->client_data->iranyitoszam . ' ' . $item->client_data->varos . ', ' . $item->client_data->utca_hazszam . '</td>
                        <td><a href="mailto:'.$item->client_data->email.'">'. $item->client_data->email.'</a></td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->last_name . ' '. $item->first_name . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $item->level . '</td>
                        <td onclick=hrefClick("'.$viewUrl.'")>' . $superiors[$item->user_id]['superior']->last_name . ' ' . $superiors[$item->user_id]['superior']->first_name . '</td>
                        <td>' . $superiors[$item->user_id]['top_superior']->last_name . ' ' . $superiors[$item->user_id]['top_superior']->first_name . '</td>
                        <td>' . $item->varhato_indulas_datuma . '</td>
                        ';

                        echo '<td>';

                        if(in_array('view_cases', $this->session->permissions)){
                            echo anchor('cases/update/' . $item->id, '<span class="glyphicon glyphicon-pencil"></span>');
                        }
                        if(in_array('delete_cases', $this->session->permissions)) {
                            echo anchor('cases/delete/' . $item->id, '<span class="red glyphicon glyphicon-remove"></span>');
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
