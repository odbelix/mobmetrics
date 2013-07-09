<?php
/***********************************************************************
*
*  Author:: Manuel Moscoso <mmoscoso@mobiquos.cl>
* Copyright 2013, Mobiquos LTDA
************************************************************************/
include_once("lib/config.php");
include_once("lib/Paginator.php");
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
  			<div class="span4">
  				<table class="table table-bordered table-striped">
    				<thead>
    					<tr><th colspan="2"><?=summar_devicetitle?></th></tr>
    				</thead>
    				<tbody>
    					<tr><td><?=version?></td><td>0.1</td></tr>
    					<tr><td><?=lastcheck?></td><td><?
    						if ( countRecords("mob_bwdown","device=device order by datereg desc limit 1") != 0 ) {
    							echo getRecord("datereg","mob_bwdown","device=device order by datereg desc limit 1");
							}
							else {
								echo "Not records";	
							}
    						?></td></tr>
    					<tr><td><?=currenttime?></td><td><?  echo date('m/d/Y h:i:s a', time()); ?></td></tr>
    				</tbody>
    			</table>
  			</div>
  			<div class="span8">
  				<table class="table table-bordered table-striped">
    				<thead>
    					<tr><th colspan="4"><?=summar_devicetitle?></th></tr>
    					<tr>
    						<th>#</th>
    						<th><?=device_name?></th>
    						<th><?=device_mac?></th>
    						<th><?=device_ip?></th>
    					</tr>
    				</thead>
    				<tbody>
    					<tr>
    						<td><?=$_GET['device_id']?></td>
    						<td><?=getRecord("name","mob_device","id=".$_GET['device_id'])?></td>
    						<td><?=getRecord("mac","mob_device","id=".$_GET['device_id'])?></td>
    						<td><?=getRecord("ipaddress","mob_device","id=".$_GET['device_id'])?></td>
    					</tr>
    				</tbody>
    			</table>
  			</div>
  			<div class="span12" >
  				<?
  				$where = " id =".$_GET['plan_id'];
  				$results = getRecords("id,bwdown,bwup","mob_plan",$where);
  				$data = $results[0];
  				?>
  				<h1><?=information?></h1>
  				<ul class="nav nav-tabs" id="plantabs">
  					<li><a href="#plan<?=$data['id']?>" data-toggle="tab">Plan<?=$data['id']?> | <?=$data['bwdown']?>/<?=$data['bwup']?></a></li>
  				</ul>
				<div class="tab-content">
  				<div class="tab-pane" id="plan<?=$data['id']?>">
  					<!-- Content of tab-->
  					<div class="span6">
  						<table class="table table-bordered table-striped" style="background-color: #d5ffd5">
  							<thead>
  								<tr>
  									<th colspan="4"><?=device_bwdown?></th>
  								</tr>
  							</thead>
  							<thead>
  								<tr>
  									<th>#</th>
  									<th><?=check_time?></th>
  									<th><?=bwdown_bits?></th>
  									<th><?=kbps?></th>
  								</tr>
  							</thead>
  							<tbody>
  								<?
  								if ( countRecords("mob_bwdown","device=".$_GET['device_id']." and plan=".$data['id']) == 0 ){
  									echo '<tr><td colspan="4">'.notexists.'</td></tr>';
  								}
								else {
									if(isset($_GET['offset']))
										$where = "device=".$_GET['device_id']." and plan=".$data['id']." ORDER BY datereg desc LIMIT ".$_GET['offset'].",40";
									else 
										$where = "device=".$_GET['device_id']." and plan=".$data['id']." ORDER BY datereg desc LIMIT 0,40";
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
  										<td><?=number_format((intval($dbw['bw'])/1024),4,'.','')?></td>
  									</tr>
  								<?
  									$count++;
									}
									?>
									<tr>
										<td colspan="4">
										<?
										$total = countRecords("mob_bwdown","device = ".$_GET['device_id']." and plan = ".$data['id']);
										if(isset($_GET['offset']))
											Paginator::paginate($_GET['offset'],$total,40,"full_detail.php?device_id=".$_GET['device_id']."&plan_id=".$data['id']."&offset=");
										else
											Paginator::paginate(0,$total,40,"full_detail.php?device_id=".$_GET['device_id']."&plan_id=".$data['id']."&offset=");
										?>			
										</td>
									</tr>
									<?
								}
  								?>
  							</tbody>
  						</table>
  					</div><!-- /span6 -->
  					 <div class="span6">
  						<table class="table table-bordered table-striped" style="background-color: #e9edff">
  							<thead>
  								<tr>
  									<th colspan="4"><?=device_bwup?></th>
  								</tr>
  							</thead>
  							<thead>
  								<tr>
  									<th>#</th>
  									<th><?=check_time?></th>
  									<th><?=bwup_bits?></th>
  									<th><?=kbps?></th>
  								</tr>
  							</thead>
  							<tbody>
  								<?
  								if ( countRecords("mob_bwup","device=".$_GET['device_id']." and plan=".$data['id']) == 0 ){
  									echo '<tr><td colspan="4">'.notexists.'</td></tr>';
  								}
								else {
									if(isset($_GET['offset']))
										$where = "device=".$_GET['device_id']." and plan=".$data['id']." ORDER BY datereg desc LIMIT ".$_GET['offset'].",40";
									else 
										$where = "device=".$_GET['device_id']." and plan=".$data['id']." ORDER BY datereg desc LIMIT 0,40";
  									$results = getRecords("datereg,bw","mob_bwup",$where);
									$count = 1;
									foreach($results as $dbw){
  								?>
  									<tr>
  										<td><?=$count?></td>
  										<td><?=$dbw['datereg']?></td>
  										<td><?=$dbw['bw']?></td>
  										<td><?=number_format(((intval($dbw['bw'])/1024)/1024),4,'.','')?></td>
  									</tr>
  								<?
  									$count++;
									}
									?>
									<tr>
										<td colspan="4">
										<?
										$total = countRecords("mob_bwup","device = ".$_GET['device_id']." and plan = ".$data['id']);
										if(isset($_GET['offset']))
											Paginator::paginate($_GET['offset'],$total,40,"full_detail.php?device_id=".$_GET['device_id']."&plan_id=".$data['id']."&offset=");
										else
											Paginator::paginate(0,$total,40,"full_detail.php?device_id=".$_GET['device_id']."&plan_id=".$data['id']."&offset=");
										?>	
										</td>
									</tr>
									<?
								}
  								?>
  							</tbody>
  						</table>
  					</div><!-- /span6 -->
  					
  					</div>
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
