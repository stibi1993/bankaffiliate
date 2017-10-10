<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('view_structures', $this->session->permissions)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("structures_menu") ?>
            <small><?php echo lang("edit_create_structures") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-12">
               <?php
               if (in_array('edit_structures', $this->session->permissions))
               {?>
                   <a href="<?php echo site_url('structures/create'); ?>" class="btn btn-primary"><?php echo lang("create_structure") ?></a>
               <?php
               }?>
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
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </form>
                </div>

                <?php
                if (!empty($structures)) {
                    echo '<table class="table table-hover table-bordered table-condensed tablesorter">';
                    echo '<thead><tr><th>'.lang('title').'</th></th><th>' . lang('product_categories') . '</th><th>'.lang('operations').'</th></tr></thead>';
                    $viewUrl = '';
                    foreach ($structures as $item)
                    {
                        $current_product_categories = explode(',', $item->product_categories);
                        $current_product_category_titles = [];
                        foreach ($current_product_categories as $pc)
                            $current_product_category_titles[] = $product_categories[$pc];
                        echo '<tr class="clickable-row">';

                        if (in_array('view_structures', $this->session->permissions))
                            $viewUrl = ' onclick=hrefClick("' . base_url() . 'structures/update/' . $item->id.'")';

                        echo '<td' . $viewUrl . '>' . $item->title . '</td>';
                        echo '<td>' . implode(', ', $current_product_category_titles) . '</td>';
                        echo '<td>';
                        if (in_array('view_structures', $this->session->permissions))
                            echo anchor('structures/update/' . $item->id, '<span class="glyphicon glyphicon-pencil"></span>');
                        if (in_array('edit_structures', $this->session->permissions))
                            echo anchor('structures/delete/' . $item->id, '<span class=" red glyphicon glyphicon-remove"></span>');
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
<?php
}
