<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Online Child Adoption System</title>
	<meta name="description" content="Online Child Adoption System">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<link rel="stylesheet" href="./font-awesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="./css/default_theme.css">
    <link rel="stylesheet" href="css/nprogress.css">
	<link rel="stylesheet" href="./css/aos.css">
    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="./css/magnific-popup.css">
    <base "/">

</head>

<body>
<div id="successNot" class="notification alert alert-success" style="width:50%;">
<i class="fa fa-close pull-right"></i>
 <p class="text-success text-center"></p>	
 </div>
<div id="warnNot" class="notification alert alert-warning" style="width:50%; ">
<i class="fa fa-close pull-right"></i>
 <p class="text-warning text-center"></p>	
</div>
	<!--[if lt IE 7]>
			<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

    <!-- Navigation -->
    <div class="top-bar">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="pull-left">
                    <li><i class="fa fa-phone"> </i> &nbsp; +25675940447</li>
                    <li><i class="fa fa-envelope"> </i> &nbsp; info@childadoption.com</li>
                </ul>
                <ul class="pull-right">
                    <li><i class="fab fa-facebook"> </i></li>
                    <li><i class="fab fa-twitter"> </i> &nbsp; @onlineadoption</li>
                </ul>
            </div>
        </div>
        </div>
    </div>
    <nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="./">
	  <img style="height:100px; background:#fff; paddign:5px; float:left;" src="./img/logo.png" class="img img-responsive">
	  <span style="color:#fff; float:left; padding-left:10px;"> Online Child Adoption System</span></a>
    </div>
    <ul class="pull-right nav navbar-nav">
      <li class="home-link"><a href="./"><i class="fa fa-home"> </i> &nbsp; Home</a></li>
      <li class="adopt-link">
          <a class="" href="./adopt.php">Adopt a child </a>
    </li>
           
        <?php 
		   if(
            isset($_SESSION['ocas-user_id']) && !empty($_SESSION['ocas-user_id']) &&
            isset($_SESSION['ocas-user_name']) && !empty($_SESSION['ocas-user_name']) &&
            isset($_SESSION['ocas-user_account'])
           ) 
		   {
		?> 
            <li data-toggle="modal" data-target="#profileModal" class="account-link">
        <a class="active-account" data-id="<?php echo $_SESSION['ocas-user_id']; ?>" href="./account.php"><i class="fas fa-user-circle"></i> &nbsp; <?php echo $_SESSION['ocas-user_name']; ?></a></li>
        <?php
            }else{
        ?>
      <li class="account-link">
        <a href="./account.php">Login / Register</a></li>
        <?php
            }
        ?>
    </ul>
  </div>
</nav>


           
      