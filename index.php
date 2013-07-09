<?php
/***********************************************************************
*
*  Author:: Manuel Moscoso <mmoscoso@mobiquos.cl>
* Copyright 2013, Mobiquos LTDA
************************************************************************/
include_once("lib/config.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Mobmetrics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="index.php">mobmetrics</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php"><?=home?></a></li>
              <li><a href="device.php?view=d"><?=devices?></a></li>
              <li><a href="device.php?view=p"><?=plans?></a></li>
              <li><a href="device.php?view=p"><?=config?></a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row-fluid">
      		<div class="span12">
      		<?
  			include_once('lib/summary/state.php');
  			?>
      		</div>
	  </div>
    </div> <!-- /container -->
    <!-- include js-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <!-- end include js -->
  </body>
</html>
