<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Page Heading -->
<?php
if(in_array($update ? 'view_leads' : 'edit_leads', $this->session->permissions))
{?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo 'Lead adatok' ?>
            <?php
            if(in_array('edit_cases', $this->session->permissions)){?><a href="<?php echo site_url('cases/create?lead_id='.$lead->id); ?>" class="btn btn-primary"><?php echo lang("create_case") ?></a><?php } ?>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <div class="clear_float">
                <div class="details floatleft">
                    <div><span>Név:</span><?php echo $lead->name;?></div>
                    <div><span>Cím:</span><?php echo $lead->postcode . ' ' . $lead->town .', '.$lead->street;?></div>
                    <div><span>Telefonszám:</span><?php echo $lead->phone;?></div>
                    <div><span>E-mail cím:</span><?php echo $lead->email;?></div>
                    <div><span>Lead ID:</span><?php echo $lead->lead_id;?></div>
                </div>
                <div class="details floatright">
                    <div><span>Termék:</span><?php echo /*$lead->product_category;*/'LTP';?></div>
                    <div><span>Pénzintézet:</span><?php echo $lead->bank;?></div>
                    <div><span>Megjegyzés:</span><?php echo nl2br($lead->comment);?></div>
                    <div><span>Rögzítés ideje:</span><?php echo $lead->created_time;?></div>
                    <div><span>Leosztás ideje:</span><?php echo $lead->splitting_time;?></div>
                    <div><span>Hozzárendelt:</span><?php echo $lead->last_name . ' ' . $lead->first_name;?></div>
                    <div><span>Ügyletek száma:</span><?php echo $lead->case_count;?></div>
                </div>
                </div>
                <?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'create_lead_status'));?>
                <div class="form-group">
                    <?php
                    echo form_label('Státusz', 'status');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('status');
                    echo form_dropdown('status', $status_list, set_value('status', $lead_status->status),'class="form-control"');
                    ?>
                </div>
                <div class="form-group">
                        <?php
                        echo form_label('Emlékeztető ideje', '');
                        echo form_error('reminder_time');
                        echo form_input('reminder_time', set_value('reminder_time', $lead_status->reminder_time), 'class="form-control"');
                        ?>
                    </div>

                <div class="form-group">
                    <?php
                    echo form_label(lang('comments'), 'comment');
                    echo form_textarea('comment', set_value('comment', $lead_status->comment), 'class="form-control"');
                    ?>
                </div>

                <?php
                if(in_array('edit_leads', $this->session->permissions))
                {
                    echo form_hidden('id', $lead_status->id);
                    echo form_hidden('lead_id', $lead->id);
                    echo form_submit('submit', lang('enter'), 'class="btn btn-primary btn-lg btn-block"');
                    echo form_close();
                }
                if ($lead->statuses[$lead->id]['items'])
                {?>
                    <table class="table table-hover table-bordered table-condensed tablesorter"><tr><th>Dátum</th><th>Státusz</th><th>Megjegyzés</th><th>Emlékeztető dátum</th><th>Rögzítő</th></tr>
                    <?php
                    foreach ($lead->statuses[$lead->id]['items'] as $item)
                    {?>
                        <tr>
                            <td><?php echo $item->created_time;?></td>
                            <td><?php echo $status_list[$item->status];?></td>
                            <td><?php echo $item->comment;?></td>
                            <td><?php echo $item->reminder_time;?></td>
                            <td><?php echo $item->last_name . ' ' . $item->first_name;?></td>
                        </tr>
                        <?php
                    }?>
                    </table>
                    <?php
                }?>
            </div>
        </div>
    </div>
</div>
<?php
} ?>