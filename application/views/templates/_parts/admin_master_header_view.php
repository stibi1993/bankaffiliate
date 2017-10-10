<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <script type="text/javascript">
        var base_url = "<?php echo site_url(); ?>";
    </script>

    <title><?php echo $page_title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo site_url('assets/css/sb-admin.css'); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo site_url('assets/css/plugins/morris.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo site_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!--script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script-->
    <script src="<?php echo site_url('assets/js/jquery-2.1.4.min.js') ?>"></script>
    <script src="<?php echo site_url('assets/js/jquery-ui-1.11.4.min.js') ?>"></script>

    <?php if ($language == 'fr') : ?>
        <script src="<?php echo site_url('assets/js/jquery.ui.datepicker-fr.js'); ?>"></script>
    <?php endif; ?>


    <script src="<?php echo site_url('assets/js/bootstrap.min.js') ?> "></script>
    <script src="<?php echo site_url('assets/js/bootstrap-filestyle.min.js') ?> "></script>
	<script src="<?php echo site_url("assets/js/jquery.confirm.js") ?> "></script>
    <!--link rel="stylesheet" href="/resources/demos/style.css"-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,300,600,400' rel='stylesheet' type='text/css'>


    <script src="<?php echo site_url('assets/js/common.js'); ?>"></script>

    <script>
        var LANG = <?php echo json_encode($this->lang->language); ?>;
    </script>


    <?php
    switch ($actual_page) {
        case "dashboard":
            echo '<script src='.site_url("assets/js/dashboard.js").'></script>';
        case "groups":
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.js").'></script>';
            echo '<link href='.site_url('assets/css/table/theme.blue.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.pager.js").'></script>';
            echo '<link href='.site_url('assets/css/table/jquery.tablesorter.pager.css').' rel="stylesheet">';
            break;
        case "languages":
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.js").'></script>';
            echo '<link href='.site_url('assets/css/table/theme.blue.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.pager.js").'></script>';
            echo '<link href='.site_url('assets/css/table/jquery.tablesorter.pager.css').' rel="stylesheet">';
            break;
        case "companies":
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.js").'></script>';
            echo '<link href='.site_url('assets/css/table/theme.blue.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.pager.js").'></script>';
            echo '<link href='.site_url('assets/css/table/jquery.tablesorter.pager.css').' rel="stylesheet">';
            break;
        case "users":
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.js").'></script>';
            echo '<link href='.site_url('assets/css/table/theme.blue.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.pager.js").'></script>';
            echo '<link href='.site_url('assets/css/table/jquery.tablesorter.pager.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/user.js").'></script>';
            break;
        case "structures":
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.js").'></script>';
            echo '<link href='.site_url('assets/css/table/theme.blue.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.pager.js").'></script>';
            echo '<link href='.site_url('assets/css/table/jquery.tablesorter.pager.css').' rel="stylesheet">';
            break;
        case "cases":
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.js").'></script>';
            echo '<link href='.site_url('assets/css/table/theme.blue.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.pager.js").'></script>';
            echo '<link href='.site_url('assets/css/table/jquery.tablesorter.pager.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/case.js").'></script>';
            break;
        case "leads":
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.js").'></script>';
            echo '<link href='.site_url('assets/css/table/theme.blue.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery.tablesorter.pager.js").'></script>';
            echo '<link href='.site_url('assets/css/table/jquery.tablesorter.pager.css').' rel="stylesheet">';
            echo '<script type="text/javascript" src='.site_url("assets/js/jquery-ui-timepicker-addon.js").'></script>';
            echo '<script type="text/javascript" src='.site_url("assets/js/lead.js").'></script>';
            break;
    }
    ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php echo $before_head; ?>


</head>
<body>

<div id="wrapper">
    <?php
    if ($this->ion_auth->logged_in()) {
        ?>
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right top-nav">
                    <?php if ($this->session->company_logo) { ?>
                        <img class="img-thumbnail cola_logo"
                             src="<?php echo base_url("uploads/company/" . $this->session->company_logo) ?>" alt="">
                    <?php } else { ?>

                    <?php } ?>
                </ul>

                <div class="profile_holder">
<!--	                <?php if ( isset($this->session->userdata['user_picture'])) {
						  	if($this->session->userdata['user_picture'] != null){ ?>
	                      <img class="profile-img" width="100" height="100" class="img-thumbnail user_pic"
	                            src="<?php echo base_url("uploads/user/" . $this->session->userdata['user_picture']) ?>" alt="">
	                <?php    }else{?>
								<img class="profile-img" width="100" height="100" class="img-thumbnail user_pic"
	                            src="<?php echo base_url("uploads/user/no_profile_image.jpg") ?>" alt="">
 	                <?php  }} ?>
-->                    <a class="navbar-brand"
                       href="<?php echo site_url('user/profile'); ?>"><?php echo $this->session->userdata['username'] ?></a>
                    <a class="navbar-brand logout"
                       href="<?php echo site_url('user/logout'); ?>"><?php echo lang("logout") ?></a>
                </div>
            </div>
            <!-- Top Menu Items -->

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <?php $class = "active"; ?>
                    <?php
                    if (in_array('view_dash', $this->session->permissions))
                    {?>
                        <li class="<?php if ($actual_page == "dashboard") echo $class; ?>">
                            <a href="<?php echo site_url('dashboard'); ?>"><i
                                    class="fa fa-tachometer"></i> <?php echo lang("dashboard_menu") ?></a>
                        </li>
                    <?php
                    }
/*                    if (in_array('list_languages', $this->session->permissions)){
                    ?>

                    <li class="<?php if ($actual_page == "languages") echo $class; ?>">
                        <a href="<?php echo site_url('languages'); ?>"><i class="fa fa-fw fa-gear"></i>
                            <?php echo lang("languages_menu") ?></a>
                    </li>
                    <?php
                    }*/
                    if (in_array('view_users', $this->session->permissions))
                    {?>
                        <li class="<?php if ($actual_page == "users") echo $class; ?>">
                            <a href="<?php echo site_url('users'); ?>"><i
                                    class="fa fa-fw fa-users"></i> <?php echo lang("users_menu") ?></a>
                            <ul>
                        <?php
                        if (in_array('view_group', $this->session->permissions))
                        {?>
                            <li class="<?php if ($actual_page == "groups") echo $class; ?>">
                                <a href="<?php echo site_url('groups'); ?>"><i
                                            class="fa fa-fw fa-group"></i> <?php echo lang("permissions_menu") ?></a>
                            </li>
                            <?php
                        }
                        if (in_array('view_structures', $this->session->permissions))
                        {?>
                                <li class="<?php if ($actual_page == "structures") echo $class; ?>">
                                    <a href="<?php echo site_url('structures'); ?>"><i
                                                class="fa fa-fw fa-group"></i> <?php echo lang("structures_menu") ?></a>
                                </li>
                        <?php
                        }
                        if (in_array('view_companies', $this->session->permissions))
                        {?>
                                <li class="<?php if ($actual_page == "companies") echo $class; ?>">
                                    <a href="<?php echo site_url('companies'); ?>"><i class="fa fa-fw fa-gear"></i>
                                        <?php echo lang("companies_menu") ?></a>
                                </li>
                        <?php
                        }?>

                            </ul>
                        </li>
                    <?php
                    }?>

                    <?php if (in_array('view_cases', $this->session->permissions))
                    { ?>
                        <li class="<?php if ($actual_page == "cases") echo $class; ?>">
                            <span><i class="fa fa-fw fa-users"></i> <?php echo lang("cases_menu") ?></span>
                            <ul>
                                <?php if (in_array('edit_cases', $this->session->permissions))
                                { ?>
                                <li class="<?php if ($actual_page == "cases") echo $class; ?>">
                                    <a href="<?php echo site_url('cases/create'); ?>"><i
                                                class="fa fa-fw fa-users"></i> <?php echo lang("cases_create_menu") ?></a>
                                </li>
                                <?php
                                }?>
                                <li class="<?php if ($actual_page == "cases") echo $class; ?>">
                                    <a href="<?php echo site_url('cases'); ?>"><i
                                                class="fa fa-fw fa-users"></i> <?php echo lang("cases_browse_menu") ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php
                    } ?>
                    <?php if (in_array('view_leads', $this->session->permissions))
                    { ?>
                        <li class="<?php if ($actual_page == "leads") echo $class; ?>">
                            <span><i class="fa fa-fw fa-users"></i> <?php echo 'Leadek' ?></span>
                            <ul>
                                <?php if (in_array('edit_leads', $this->session->permissions))
                                { ?>
                                    <li class="<?php if ($actual_page == "leads") echo $class; ?>">
                                        <a href="<?php echo site_url('leads/create'); ?>"><i
                                                    class="fa fa-fw fa-users"></i> <?php echo 'Lead rögzítés' ?></a>
                                    </li>
                                    <?php
                                }?>
                                <li class="<?php if ($actual_page == "leads") echo $class; ?>">
                                    <a href="<?php echo site_url('leads/split'); ?>"><i
                                                class="fa fa-fw fa-users"></i> <?php echo 'Lead leosztás' ?></a>
                                </li>
                                <li class="<?php if ($actual_page == "leads") echo $class; ?>">
                                    <a href="<?php echo site_url('leads'); ?>"><i
                                                class="fa fa-fw fa-users"></i> <?php echo 'Leadek megtekintés' ?></a>
                                </li>
                            </ul>
                        </li>
                        <?php
                    } ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <?php
        //var_dump($actual_page);

            if ($this->session->flashdata('message')) {
                ?>
                <div class="container">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                </div>
        <?php
            }

        ?>
    <?php
    }
    ?>
    <div id="page-wrapper">
        <div class="container-fluid">
