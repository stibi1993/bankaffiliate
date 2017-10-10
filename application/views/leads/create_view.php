<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Page Heading -->
<?php
if(in_array($update ? 'view_leads' : 'create_leads', $this->session->permissions))
{?>
<div class="row row_upd">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo 'Lead' ?>
            <small><?php echo lang($update ? 'edit' : 'create') ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-4 col-lg-offset-4">
                <?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'create_lead'));
                if ($source_list)
                {?>
                    <div class="form-group">
                        <?php
                        echo form_label('Forrás', 'source');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('source');
                        echo form_dropdown('source', $source_list, set_value('source', $lead->source),'class="form-control"');
                        ?>
                    </div>
                    <?php
                }
                else
                    echo form_hidden('source', ($lead->source ? $lead->source : $this->session->userdata('user_id')));
                    ?>
                <div class="form-group">
                    <?php
                    echo form_label('Név', 'name');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('name');
                    echo form_input('name', set_value('name', $lead->name), 'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Lakcím', 'address');
                    echo "<span class='redstar'>*</span><br>";
                    echo form_error('postcode');
                    echo form_input('postcode', set_value('postcode', $lead->postcode), 'class="form-control postcode" placeholder="Irányítószám" maxlength="4"');
                    echo form_error('town');
                    echo form_input('town', set_value('town', $lead->town), 'class="form-control town" placeholder="Város"');
                    echo form_error('street');
                    echo form_input('street', set_value('street', $lead->street), 'class="form-control" placeholder="Utca, házszám"');
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('Mobiltelefon', 'phone');
                    echo "<span class='redstar'>*</span><br>";
                    echo '+36 '.form_error('area_code');
                    echo form_dropdown('area_code', dropdown_data('mobile_area_code'), set_value('area_code', $lead->area_code),'class="form-control area_code"');
                    echo form_error('phone_no');
                    echo form_input('phone_no', set_value('phone_no', $lead->phone_no), 'class="form-control phone" maxlength="7"');
                    echo form_hidden('phone', set_value('phone', $lead->phone));
                    ?>
                </div>

                <div class="form-group">
                    <?php
                    echo form_label('E-mail cím', 'email');
                    echo "<span class='redstar'>*</span>";
                    echo form_error('email');
                    echo form_input('email', set_value('email', $lead->email), 'class="form-control"');
                    ?>
                </div>

                <!--div class="form-group">
                    <?php
/*                    if (isset($product_categories))
                    {?>
                        <div class="form-group">
                            <?php
                            $attr = array('class' => 'permission-left');
                            echo form_label(lang('product_categories'), 'product_categories[]', $attr);?>

                            <div class="groupholder"> <?php

                                foreach ($product_categories as $id=>$item)
                                {
                                    echo '<div class="checkbox with-width">';
                                    echo '';
                                    echo form_checkbox('product_categories[]', $id, set_checkbox('product_categories[]', $id, in_array($id, $current_product_categories)), 'class="chk_boxes1" id="chk_' . $id . '"');
                                    echo '<label for="chk_' . $id . '">' . $item . '</label>';
                                    echo '</div>';
                                }
                                ?> </div></div> <?php
                    }
  */                  ?>
                </div-->

                <div class="form-group">
                        <?php
                        echo form_label('Pénzintézet', 'bank');
                        echo form_error('bank_id');
                        echo form_dropdown('bank_id', $bank_list, set_value('bank_id',$lead->bank_id),'class="form-control"');
                        ?>
                    </div>

                <div class="form-group">
                    <?php
                    echo form_label('Mikor kereshetjük?', 'call_time');
                    echo form_error('call_time');
                    echo form_dropdown('call_time', dropdown_data('call_time'), set_value('call_time', $lead->call_time),'class="form-control"');
                    ?>
                </div>

                <div class="form-group">
                        <?php
                        echo form_label('Találkozó időpontja', '');
                        echo form_error('meeting_time');
                        echo form_input('meeting_time', set_value('meeting_time', $lead->meeting_time), 'class="form-control"');
                        ?>
                    </div>

                <div class="form-group">
                    <?php
                    echo form_label(lang('comments'), 'comment');
                    echo form_textarea('comment', set_value('comment', $lead->comment), 'class="form-control"');
                    ?>
                </div>

                    <div class="form-group lead_id_group">
                        <?php
                        echo form_label('Lead ID', 'lead_id');
                        echo "<span class='redstar'>*</span>";
                        echo form_error('lead_id');
                        echo form_input('lead_id', set_value('lead_id', $lead->lead_id), 'class="form-control"');
                        ?>
                    </div>

                <?php
                if(in_array(($update ? 'edit_leads' : 'create_leads'), $this->session->permissions))
                {
                    echo form_hidden('id', $lead->id);
                    echo form_submit('submit', lang('enter'), 'class="btn btn-primary btn-lg btn-block"');
                    echo form_close();
                } ?>
            </div>
        </div>
    </div>
</div>
<?php
} ?>