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


<body>
<?php if($this->auth->is_logged_in(false, false)):?>
 
            <?php $admin_url = site_url($this->config->item('admin_folder')).'/';?>
            
            <a class="brand" href="<?php echo $admin_url;?>"></a>
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
       
                
             
				<li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'dashboard') ? 'class="active"' : ''; ?>>
                    <a href="<?php echo $admin_url;?>"><i class="fa fa-home"></i> <span class="nav-label"><?php echo lang('common_home');?></span></a>
					
                </li>   
                
			   <?php
                    // Restrict access to Admins only
                    if($this->auth->check_access('Admin')) : ?>
               <li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'leaves') ? 'class="active"' : ''; ?>>
			   
			    <a href="#"><i class="fa fa-mars-stroke"></i> <span class="nav-label"><?php echo lang('common_leave_app');?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                       
                            <li><a href="<?php echo $admin_url;?>leaves/bulk_leave" ><span class="nav-label"><?php echo lang('common_leave') ?></span></a></li>
                       	 
				   </ul>
                </li>
				<?php else:?>
				  
               <li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'leaves') ? 'class="active"' : ''; ?>>
			    <a href="#"><i class="fa fa-mars-stroke"></i> <span class="nav-label"><?php echo lang('common_leave_app');?></span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                       
                            <li><a href="<?php echo $admin_url;?>leaves" ><?php echo lang('common_leave') ?></a></li>
                       	    <li><a href="<?php echo $admin_url;?>leaves/form" ><?php echo lang('common_apply_leave') ?></a></li>
				   </ul>
                </li>
				<?php endif; ?>
				
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
          <?php
                    // Restrict access to Admins only
                    if($this->auth->check_access('Admin')) : ?>
			 <li <?php echo (isset($activemenu) && !empty($activemenu) && $activemenu == 'admin') ? 'class="active"' : ''; ?>>
			
			     <a href="#"><i class="fa fa-user"></i> <span class="nav-label"><?php echo lang('common_administrative');?></span> <span class="fa arrow"></span></a>
           
              <ul class="nav nav-second-level">
                          
                            <li><a href="<?php echo $admin_url;?>admin"><?php echo lang('common_administrators') ?></a></li>  
							
							
                            <li><a href="<?php echo $admin_url;?>team"><?php echo lang('common_teams_setting') ?></a></li>
							
                            <li><a href="<?php echo $admin_url;?>weekend_schedule"><?php echo lang('common_weekend_schedule_setting') ?></a></li>
                 
            </ul> 
          </li>

            </ul>
 <?php endif; ?>
        </div>
    </nav>
<?php endif;?>
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
						