<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tmt.my</title>

    <link type="text/css" href="<?php echo base_url('assets/css/redactor.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url ('assets/css/bootstrap.min.css')?>" rel="stylesheet"/>
    <link href="<?php echo base_url ('assets/font-awesome/css/font-awesome.css')?>" rel="stylesheet"/>
   	<link href="<?php echo base_url ('assets/css/plugins/iCheck/custom.css')?>" rel="stylesheet"/>
	<link href="<?php echo base_url ('assets/css/animate.css')?>" rel="stylesheet"/>
	<link href="<?php echo base_url ('assets/css/style.css')?>" rel="stylesheet"/>
	<link type="text/css" href="<?php echo base_url('assets/css/redactor.css');?>" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url('assets/css/jquery.timepicker.css');?>" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url('assets/css/fullcalendar.print.css');?>" rel="stylesheet" media="print" />
	<link type="text/css" href="<?php echo base_url('assets/css/fullcalendar.css');?>" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url('assets/css/plugins/summernote/summernote.css');?>" rel="stylesheet" />
	<link type="text/css" href="<?php echo base_url('assets/css/plugins/summernote/summernote-bs3.css');?>" rel="stylesheet" />
	

</head>
<?php $admin_url = site_url($this->config->item('admin_folder')).'/';?>
<body>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">
                    <!--div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/profile_small.jpg') ?>" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="login.html">Logout</a></li>
                        </ul>
                    </div-->
                    <div class="logo-element">
                        TMT
                    </div>
                </li>
                
                
                
                <li>
                    <a href="<?php echo $admin_url;?>"><i class="fa fa-diamond"></i> <span class="nav-label"><?php echo lang('common_home');?></span></a>
                </li>   
                <li>
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('common_leave_app') ?><span class="fa arrow"></span></a>
  
                    <ul class="nav nav-second-level">
                        
                            <li><a href="<?php echo $admin_url;?>leaves" ><?php echo lang('common_leave') ?></a></li>
                        	<li><a href="<?php echo $admin_url;?>leaves/form" ><?php echo lang('common_apply_leave') ?></a></li>
                    </ul>
                </li>
                <!--li>
               <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang( 'common_language') ?><span class="fa arrow"></span></a>               
                    <ul class="nav nav-second-level">
                      <li><a href="<?php echo site_url($this->config->item('admin_folder').'/lang/change_lang/english')?>">English</a></li>
							<li><a href="<?php echo site_url($this->config->item('admin_folder').'/lang/change_lang/chinese')?>">Chinese</a></li>
                    </ul>
                </li-->
         <!--li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang( 'common_actions') ?><span class="fa arrow"></span></a> 

                    <ul class="nav nav-second-level">
                 <li>  <a href="<?php echo site_url();?>"><?php echo lang('common_front_end') ?></a><li>
     
                    </ul>
                    </li-->
                
                
          <!--li>
             <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang( 'common_content') ?><span class="fa arrow"></span></a> 
              <ul class="nav nav-second-level">
                  <li><a href="<?php echo $admin_url;?>pages"><?php echo lang('common_pages') ?></a></li>
                  <li><a href="<?php echo $admin_url;?>galleries"><?php echo lang('common_gallery') ?></a></li>
                    </ul>  
            </li-->
            <li>
             <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo lang('common_administrative') ?><span class="fa arrow"></span></a> 
              <ul class="nav nav-second-level">
                          
  <li><a href="<?php echo $admin_url;?>admin"><?php echo lang('common_administrators') ?></a></li>
                            <li><a href="<?php echo $admin_url;?>team"><?php echo lang('common_teams_setting') ?></a></li>
                            <li><a href="<?php echo $admin_url;?>weekend_schedule"><?php echo lang('common_weekend_schedule_setting') ?></a></li>
                    
            </ul>  
            </li>
        

            </ul>

        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
          
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome to Tmt Online</span>
                </li>
                <li class="dropdown">
                    
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/a7.jpg');?>">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/a4.jpg');?>">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo base_url('assets/img/profile.jpg');?>">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    
						 <li><a href="<?php echo site_url($this->config->item('admin_folder').'/login/logout');?>"><?php echo lang('common_log_out') ?></a></li>
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
				<ol class="breadcrumb">
                      
                        <li class="active">
                            <h2><?php echo $page_title ?></h2>
                        </li>
                    </ol>
					
                
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <!--li>
                            <a>Forms</a>
                        </li-->
                        <li class="active">
                            <strong><?php echo $page_title ?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            
            
   <?php
    //lets have the flashdata overright "$message" if it exists
    if($this->session->flashdata('message'))
    {
        $message    = $this->session->flashdata('message');
    }
    
    if($this->session->flashdata('error'))
    {
        $error  = $this->session->flashdata('error');
    }
    
    if(function_exists('validation_errors') && validation_errors() != '')
    {
        $error  = validation_errors();
    }
    ?>
    
    <div id="js_error_container" class="alert alert-error" style="display:none;"> 
        <p id="js_error"></p>
    </div>
    
    <div id="js_note_container" class="alert alert-note" style="display:none;">
        
    </div>
    
    <?php if (!empty($message)): ?>
  
        <div class="alert alert-success alert-dismissable">
           <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <?php echo $message; ?>
        </div>
  
    <?php endif; ?>
    
    <?php if (!empty($error)): ?>
    
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">X</button>
            <?php echo $error; ?>
        </div>
	   
    <?php endif; ?>         
						