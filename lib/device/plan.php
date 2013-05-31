<?php
?>
    <table class="table table-bordered table-hover">
    	<caption>View plan detail</caption>
    	<thead>
    		<tr>
    			<th>#</th>
    			<th>Plan - BWDOWN</th>
    			<th>Plan - BWUP</th>
    			<th>Plan's device</th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
    		<?
    		$query = "select * from mob_plan order by id";
			$results = $db->execute($query);
			$i=1;
			foreach($results as $data) {
				$option_device = countRecords("mob_device_plan"," plan = ".$data['id']);
    		?>
    		<tr>
    			<td><?=$i?></td>
    			<td><?=$data['bwdown']?></td>
    			<td><?=$data['bwup']?></td>
    			<td><?=$option_device?></td>
    			<td>
    				<?
    				if( $option_device!=0 ){
    				?>
    				<!-- OPTIONS-->
    						<div class="btn-group">
       		    				<a class="btn btn-primary" href="#"><i class="icon-cog icon-white"></i> Options</a>
  			    				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  			    				<ul class="dropdown-menu">
    			    				<li><a href="pdetail.php?plan_id=<?=$data['id']?>"><i class="icon-info-sign"></i>View devices</a></li>
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