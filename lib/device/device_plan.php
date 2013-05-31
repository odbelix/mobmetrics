<?php
?>
    <table class="summary">
    	<caption>VIEW 1</caption>
    	<thead>
    		<tr>
    			<th>#</th>
    			<th>Device name</th>
    			<th>Device IP</th>
    			<th>Device MAC</th>
    			<th>Device's plan</th>
    			<th>Last check - BWdown</th>
    			<th>Last check - BWup</th>
    			<th></th>
    		</tr>
    	</thead>
    	<tbody>
    		<?
    		$query = "select * from mob_device order by id";
			$results = $db->execute($query);
			$i=1;
			foreach($results as $data) {
    		?>
    		<tr>
    			<td><?=$i?></td>
    			<td><?=$data['name']?></td>
    			<td><?=$data['ipaddress']?></td>
    			<td><?=$data['mac']?></td>
    			<td></td>
    			<td></td>
    			<td></td>
    			<td></td>
    		</tr>
    		<?
    			$i++;
			}
    		?>
    	</tbody>
    </table>