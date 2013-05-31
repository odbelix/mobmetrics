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
  			<div class="span4">
  				<table class="table table-bordered table-striped">
    				<thead>
    					<tr><th colspan="2">Devices Information</th></tr>
    				</thead>
    				<tbody>
    					<tr><td>Total Devices</td><td><?
    						$count = countRecords("mob_device","id=id");
							if($count!=0){
								echo '<a alt="View devices" href="device.php?view=d">'.$count.'</a>';
							}
							else {
								echo 'Device does not exist';
							}
    						?></td></tr>
    					<tr><td>Total plans</td><td><?
    						$count = countRecords("mob_plan","id=id");
							if($count!=0){
								echo '<a alt="View plans" href="device.php?view=p">'.$count.'</a>';
							}
							else {
								echo 'Plan does not exist';
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
    						<th colspan="3">Menu Nav</th>
    					</tr>
    				</thead>
    				<tbody>
    					<tr><td><a href="device.php?view=d">View device detail</td></tr>
    					<tr><td><a href="device.php?view=p">View plan detail</td></tr>
    					<tr><td><a href="device.php?view=dp">View device/plan relationship</td></tr>
    				</tbody>
    			</table>
  			</div>