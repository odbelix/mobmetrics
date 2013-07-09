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
          <a class="brand" href="#">mobmetrics</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li><a href="device.php?view=d">Equipos</a></li>
              <li><a href="device.php?view=p">Planes</a></li>
              <li><a href="contact">Contacto</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row-fluid">
  		<div class="span12">
  			<div class="span4">
  				<table class="table table-bordered table-striped">
    				<thead>
    					<tr><th colspan="2">Devices Information</th></tr>
    				</thead>
    				<tbody>
    					<tr><td>Version</td><td>0.1</td></tr>
    					<tr><td>Last check</td><td><?
    						if ( countRecords("mob_bwdown","device=device order by datereg desc limit 1") != 0 ) {
    							echo getRecord("datereg","mob_bwdown","device=device order by datereg desc limit 1");
							}
							else {
								echo "Not records";	
							}
    						?></td></tr>
    					<tr><td>Current time</td><td><?  echo date('m/d/Y h:i:s a', time()); ?></td></tr>
    				</tbody>
    			</table>
  			</div>
  			<div class="span8">
  				<table class="table table-bordered table-striped">
    				<thead>
    					<tr><th colspan="4">Plan Information</th></tr>
    					<tr>
    						<th>#</th>
    						<th>Plan - BWDOWN</th>
    						<th>Plan - BWUP</th>
    						<th>Plan's device</th>
    					</tr>
    				</thead>
    				<tbody>
    					<tr>
    						<td><?=$_GET['plan_id']?></td>
    						<td><?=getRecord("bwdown","mob_plan","id=".$_GET['plan_id'])?></td>
    						<td><?=getRecord("bwup","mob_plan","id=".$_GET['plan_id'])?></td>
    						<td><?=countRecords("mob_device_plan","plan = ".$_GET['plan_id'])?></td>
    					</tr>
    				</tbody>
    			</table>
  			</div>
  			<div class="span12" >
  				<h1>Devices</h1>
  				<?
  				$where = "id in (select device from mob_device_plan where plan = ".$_GET['plan_id']." order by device )";
  				$results = getRecords("id,name,mac,ipaddress","mob_device",$where);
  				?>
  				<ul class="nav nav-tabs" id="plantabs">
  					<?
  					foreach($results as $data){
  					?>
  						<li><a href="#plan<?=$data['id']?>" data-toggle="tab"><?=$data['name']?> | <?=$data['ipaddress']?></a></li>
  					<?
					}
  					?>
				</ul>
				<div class="tab-content">
				<?
				foreach($results as $data){
				?>
  				<div class="tab-pane" id="plan<?=$data['id']?>">
  					<!-- Content of tab-->
  					<div class="span6">
  						<table class="table table-bordered table-striped" style="background-color: #d5ffd5">
  							<thead>
  								<tr>
  									<th colspan="3">Bandwidth DOWN</th>
  								</tr>
  							</thead>
  							<thead>
  								<tr>
  									<th>#</th>
  									<th>Check datetime</th>
  									<th>BW-down (bits)</th>
  								</tr>
  							</thead>
  							<tbody>
  								<?
  								if ( countRecords("mob_bwdown","device=".$data['id']." and plan=".$_GET['plan_id']) == 0 ){
  									echo '<tr><td colspan="3">Records does not exist.</td></tr>';
  								}
								else {
									$where = "device=".$data['id']." and plan=".$_GET['plan_id']." ORDER BY datereg desc LIMIT 40";
  									$results = getRecords("datereg,bw","mob_bwdown",$where);
									$count = 1;
									foreach($results as $dbw){
										if( $dbw['bw']<= '0' ){
											$class='error';
										}
										else {
											$class='';	
										}
  								?>
  									<tr class="<?=$class?>">
  										<td><?=$count?></td>
  										<td><?=$dbw['datereg']?></td>
  										<td><?=$dbw['bw']?></td>
  									</tr>
  								<?
  									$count++;
									}
								}
  								?>
  							</tbody>
  						</table>
  					</div><!-- /span6 -->
  					 <div class="span6">
  						<table class="table table-bordered table-striped" style="background-color: #e9edff">
  							<thead>
  								<tr>
  									<th colspan="3">Bandwidth UP</th>
  								</tr>
  							</thead>
  							<thead>
  								<tr>
  									<th>#</th>
  									<th>Check datetime</th>
  									<th>BW-UP (bits)</th>
  								</tr>
  							</thead>
  							<tbody>
  								<?
  								if ( countRecords("mob_bwup","device=".$data['id']." and plan=".$_GET['plan_id']) == 0 ){
  									echo '<tr><td colspan="3">Records does not exist.</td></tr>';
  								}
								else {
									$where = "device=".$data['id']." and plan=".$_GET['plan_id']." ORDER BY datereg desc LIMIT 40";
  									$results = getRecords("datereg,bw","mob_bwup",$where);
									$count = 1;
									foreach($results as $dbw){
  								?>
  									<tr>
  										<td><?=$count?></td>
  										<td><?=$dbw['datereg']?></td>
  										<td><?=$dbw['bw']?></td>
  									</tr>
  								<?
  									$count++;
									}
								}
  								?>
  							</tbody>
  						</table>
  					</div><!-- /span6 -->
  					<!-- end content tab -->
  					</div>
				<?
				}
				?>
				</div><!-- /tab-content -->
  			</div>
  		</div> <!-- /span12-->
	  </div> <!-- /row-fluid -->
    </div> <!-- /container -->
    <!-- include js-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script>
    $('#plantabs a').click(function (e) {
  		e.preventDefault();
  		$(this).tab('show');
	})
	$(function () {
    	$('#plantabs a:first').tab('show');
  	})
	</script>
    <!-- end include js -->
  </body>
</html>
