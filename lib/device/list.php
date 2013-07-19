<?php
?>
    <table class="table table-bordered table-striped">
    	<caption><h1><?=device_detailtitle?></h1></caption>
    	<thead>
    		<tr>
    			<th>#</th>
    			<th><?=device_name?></th>
    			<th><?=device_ip?></th>
    			<th><?=device_mac?></th>
    			<th><?=device_plans?></th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
    		<?
    		$query = "select * from mob_device order by id";
			$results = $db->execute($query);
			$i=1;
			if(count($results) ==  0){
				?>
				<tr>
					<td colspan="6"><?=notexists?></td>
				</tr>
				<?
			}
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
       		    				<a class="btn btn-primary" href="#"><i class="icon-cog icon-white"></i><?=options?></a>
  			    				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  			    				<ul class="dropdown-menu">
    			    				<li><a href="detail.php?device_id=<?=$data['id']?>"><i class="icon-info-sign"></i><?=view_detail?></a></li>
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