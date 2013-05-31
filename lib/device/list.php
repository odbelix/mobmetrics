<?php
?>
    <table class="table table-bordered table-striped">
    	<caption>View device details</caption>
    	<thead>
    		<tr>
    			<th>#</th>
    			<th>Device name</th>
    			<th>Device IP</th>
    			<th>Device MAC</th>
    			<th>Device's plan</th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
    		<?
    		$query = "select * from mob_device order by id";
			$results = $db->execute($query);
			$i=1;
			foreach($results as $data) {
				$option_plans = countRecords("mob_device_plan"," device = ".$data['id']);
    		?>
    		<tr>
    			<td><?=$i?></td>
    			<td><?=$data['name']?></td>
    			<td><?=$data['ipaddress']?></td>
    			<td><?=$data['mac']?></td>
    			<td><?=$option_plans?></td>
    			<td>
    				<?
    				if( $option_plans!=0 ){
    				?>
    				<!-- OPTIONS-->
    						<div class="btn-group">
       		    				<a class="btn btn-primary" href="#"><i class="icon-cog icon-white"></i> Options</a>
  			    				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  			    				<ul class="dropdown-menu">
    			    				<li><a href="detail.php?device_id=<?=$data['id']?>"><i class="icon-info-sign"></i>View detail</a></li>
  			    				</ul>
		   					</div>
    				<!-- END OPTIONS -->
    				<?
    				}
    				?>
    			</td>
    		</tr>
    		<?
    			$i++;
			}
    		?>
    	</tbody>
    </table>