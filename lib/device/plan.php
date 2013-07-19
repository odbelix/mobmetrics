<?php
?>
    <table class="table table-bordered table-hover">
    	<caption><h1><?=plan_detailtitle?></h1></caption>
    	<thead>
    		<tr>
    			<th>#</th>
    			<th><?=plan_bwdown?></th>
    			<th><?=plan_bwup?></th>
    			<th><?=plan_devices?></th>
    			<th><?=plan_images?></th>
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
    				if(file_exists('rrdimages/img-'.$data['id'].'-6h.png')){
    				?>
    				<center><a href="images.php?plan=<?=$data['id']?>" target="_blank"><img width="77" src="rrdimages/img-<?=$data['id']?>-6h.png" alt="Imagenes de Plan"></img></a></center></td>
    				<?
    				}
					else {
						echo notexists;
					}
    				?>
    			<td>
    				<?
    				if( $option_device!=0 ){
    				?>
    				<!-- OPTIONS-->
    						<div class="btn-group">
       		    				<a class="btn btn-primary" href="#"><i class="icon-cog icon-white"></i><?=options?></a>
  			    				<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
  			    				<ul class="dropdown-menu">
    			    				<li><a href="pdetail.php?plan_id=<?=$data['id']?>"><i class="icon-info-sign"></i><?=view_device?></a></li>
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
    