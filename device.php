<?php
/***********************************************************************
*
*  Author:: Manuel Moscoso <mmoscoso@mobiquos.cl>
* Copyright 2013, Mobiquos LTDA
************************************************************************/
include_once("lib/config.php");
$db = new DBmanager();
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
            <?
            include_once('lib/menu/main.php');
            ?>
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
	
    		<!--TABLE DEVICE -->
    		<?
    		if ( isset($_GET['view'])	 ){
    			switch ($_GET['view']) {
					case 'd':
						include_once("lib/device/list.php");
						break;
					case 'p':
						include_once("lib/device/plan.php");
						break;
					case 'dp':
						include_once("lib/device/device_plan.php");
						break;
					case 'ed':
						include_once("lib/device/edit_device.php?device_id=1");
						break;
					case 'r':
						include_once("lib/report/main.php");
						break;
					case 'v':
						$pathreport = str_replace("'","",$_GET['file']);
						include_once("lib/report/view.php");
				}
			}
			else {
			//DEFAULT VIEW
				include_once("lib/device/list.php");
			}
    		?>
    <!--END TABLE DEVICE-->
    		
    		
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