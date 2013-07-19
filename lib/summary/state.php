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
								echo notexists;	
							}
    						?></td></tr>
    					<tr><td><?=currenttime?></td><td><?  echo date('m/d/Y h:i:s a', time()); ?></td></tr>
    				</tbody>
    			</table>
  			</div>
  			<div class="span4">
  				<table class="table table-bordered table-striped">
    				<thead>
    					<tr><th colspan="2"><?=summar_devicetitle?></th></tr>
    				</thead>
    				<tbody>
    					<tr><td><?=totaldevices?></td><td><?
    						$count = countRecords("mob_device","id=id");
							if($count!=0){
								echo '<a alt="View devices" href="device.php?view=d">'.$count.'</a>';
							}
							else {
								echo notexists;
							}
    						?></td></tr>
    					<tr><td><?=totalplans?></td><td><?
    						$count = countRecords("mob_plan","id=id");
							if($count!=0){
								echo '<a alt="View plans" href="device.php?view=p">'.$count.'</a>';
							}
							else {
								echo notexists;
							}
							?>
    						</td></tr>
    				</tbody>
    			</table>
  			</div>
  			<div class="span4">
  				<table class="table table-bordered table-striped">
    				<thead>
    					<tr>
    						<th colspan="3"><?=summar_menunavtitle?></th>
    					</tr>
    				</thead>
    				<tbody>
    					<tr><td><a href="device.php?view=d"><?=view_device?></td></tr>
    					<tr><td><a href="device.php?view=p"><?=view_plan?></td></tr>
    				</tbody>
    			</table>
  			</div>