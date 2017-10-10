<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Page Heading -->
<?php if(in_array('view_companies', $this->session->permissions)){ ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <?php echo lang("companies") ?>
            <small><?php echo lang("edit_create_companies") ?></small>
        </h1>
        <div class="row">
            <div class="col-lg-12">
               <?php if(in_array('edit_companies', $this->session->permissions)){ ?><a href="<?php echo site_url('companies/create'); ?>" class="btn btn-primary"><?php echo lang("create_company") ?></a> <?php } ?>
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

                <?php //<th>'.lang('company_description').'</th>
                if (!empty($companies)) {
                    echo '<table class="table table-hover table-bordered table-condensed tablesorter">';
                    echo '<thead><tr><!--th>ID</th--><th>'.lang('company_name').'</th></th><th>'.lang('operations').'</th></tr></thead>';
                    foreach ($companies as $company) {
                    	if ( ($company->company_name != "--") or in_array('edit_self', $this->session->permissions)){

                            echo '<tr class="clickable-row">';

                            if(in_array('view_companies', $this->session->permissions)){
                                $viewUrl = base_url().'companies/update/'. $company->id;
                                echo '<!--td onclick=hrefClick("'.$viewUrl.'")>';
                                echo $company->id;
                                echo '</td-->';
                                echo '<td onclick=hrefClick("'.$viewUrl.'")>';
                                echo  $company->company_name; //anchor('companies/index/' . $company->company_name);
                                echo '</td>';
                               /* echo '<td onclick=hrefClick("'.$viewUrl.'")>';
                                echo $company->company_description;
                                echo '</td>';*/

                            }else{
                                echo '<!--td>';
                                echo $company->id;
                                echo '</td-->';
                                echo '<td>';
                                echo  $company->company_name; //anchor('companies/index/' . $company->company_name);
                                echo '</td>';
                                echo '<td>';
                                echo $company->company_description;
                                echo '</td>';

                            }
                            echo '<td>';
	                      if(in_array('view_companies', $this->session->permissions)){ echo anchor('companies/update/' . $company->id, '<span class="glyphicon glyphicon-pencil"></span>'); }
	                      if(in_array('edit_companies', $this->session->permissions)){ echo anchor('companies/delete/' . $company->id, '<span class=" red glyphicon glyphicon-remove"></span>'); }
	                        echo '</td>';
	                        echo '</tr>';
                    	}
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
?>
