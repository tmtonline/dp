<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo (!empty($seo_title)) ? $seo_title .' - ' : ''; echo $this->config->item('company_name'); ?></title>


<?php if(isset($meta)):?>	
	<meta name="description" content="<?php echo $meta;?>" />	
<?php else:?>
<meta name="Keywords" content="Shopping Cart, eCommerce, ThunderMatch, TMT.MY">
<meta name="Description" content="TMT.MY">
<?php endif;?>

<!--bootstrap3 css-->
<link href="<?php echo theme_url('assets/bootstrap/css/bootstrap.css') ?>" rel='stylesheet' type='text/css'>
	
<!--ion icon fonts css-->
<?php echo theme_css('ionicons.css', true);?>
<!--custom css-->
<?php echo theme_css('style.css', true);?>
<!--google raleway font family-->
 <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,100,700,500' rel='stylesheet' type='text/css'>
 <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!--flex slider css-->
<?php echo theme_css('flexslider.css', true);?>

<?php echo theme_css('owl-carousel/owl.carousel.css', true);?>
<?php echo theme_css('owl-carousel/owl.theme.css', true);?>
<?php echo theme_css('icomoon.min.css', true);?>
<?php echo theme_css('form.min.css', true);?>
  
 
<meta name="twitter:widgets:theme" content="light">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


<?php
//with this I can put header data in the header instead of in the body.
if(isset($additional_header_info))
{
	echo $additional_header_info;
}

?>
</head>

<body>


		
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>            
      <a href="<?php echo base_url()?>"><img	src="<?php echo theme_url('assets/img/tmt.png') ?>" class="navbar-brand" alt="logo-white">  </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!--li class="active"><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li-->
      </ul>
   
      <!--ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul-->
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>






	<?php
	/*
	 End header.php file
*/