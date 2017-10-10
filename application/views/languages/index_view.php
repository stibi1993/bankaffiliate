<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if (in_array('view_languages', $this->session->permissions)) { ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <?php echo lang("languages") ?>
                <small><?php echo lang("edit_create_languages") ?></small>
            </h1>
            <div class="row">
                <div class="col-lg-12">
                    <?php if (in_array('edit_users', $this->session->permissions)) { ?> <a
                        href="<?php echo site_url('languages/create'); ?>"
                        class="btn btn-primary"><?php echo lang("add_language") ?></a> <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" style="margin-top: 10px;">

                    <div id="pager" class="pager">
                        <form>
                            <img src="<?php echo site_url('assets/img/pager/first.png') ?>" class="first"/>
                            <img src="<?php echo site_url('assets/img/pager/prev.png') ?>" class="prev"/>
                            <input type="text" class="pagedisplay"/>
                            <img src="<?php echo site_url('assets/img/pager/next.png') ?>" class="next"/>
                            <img src="<?php echo site_url('assets/img/pager/last.png') ?>" class="last"/>
                            <select class="pagesize">
                                <option selected="selected" value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </form>
                    </div>

                    <?php
                    echo '<table class="table table-hover table-bordered table-condensed tablesorter">';

                    echo '<thead><tr>';
                    //echo '<th>ID</th>';
                    echo '<th>' . lang('language_name') . '</th>';
                    echo '<th>' . lang('slug') . '</th>';
                    echo '<th>' . lang('language_directory') . '</th>';
                    echo '<th>' . lang('language_code') . '</th>';
                    echo '<th>' . lang('default') . '</th>';
                    echo '<th>' . lang('operations') . '</th>';
                    echo '</tr></thead>';

                    if (!empty($languages)) {
                        foreach ($languages as $lang) {

                            echo '<tr class="clickable-row">';

                            if (in_array('view_languages', $this->session->permissions)) {
                                $viewUrl = base_url() . 'languages/update/' . $lang->id;
                                //echo '<td onclick=hrefClick("' . $viewUrl . '")>' . $lang->id . '</td>';

                            echo '<td onclick=hrefClick("' . $viewUrl . '")>' . $lang->language_name . '</td>
                            <td onclick=hrefClick("' . $viewUrl . '")>' . $lang->slug . '</td>
                            <td onclick=hrefClick("' . $viewUrl . '")>' . $lang->language_directory . '</td>
                            <td onclick=hrefClick("' . $viewUrl . '")>' . $lang->language_code . '</td>';
                                echo '<td onclick=hrefClick("' . $viewUrl . '")>';
                                echo ($lang->default == '1') ? '<span class="glyphicon glyphicon-ok"></span>' : '&nbsp;';
                                echo '</td>';
                            } else {
                                //echo '<td>' . $lang->id . '</td>';
                            echo '<td>' . $lang->language_name . '</td>
                            <td>' . $lang->slug . '</td>
                            <td>' . $lang->language_directory . '</td>
                            <td>' . $lang->language_code . '</td>';
                                echo '<td>';
                                echo ($lang->default == '1') ? '<span class="glyphicon glyphicon-ok"></span>' : '&nbsp;';
                                echo '</td>';
                            }

                            if (in_array('view_languages', $this->session->permissions)) {
                                echo '<td>' . anchor('languages/update/' . $lang->id, '<span class="glyphicon glyphicon-pencil"></span>');
                            }
                            if (in_array('edit_languages', $this->session->permissions)) {
                                echo anchor('languages/delete/' . $lang->id, '<span class="red glyphicon glyphicon-remove"></span>') . '</td>';
                            }
                            echo '</tr>';
                        }
                    }
                    echo '</table>';
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
