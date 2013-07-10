<?php
?>
	<table class="table table-bordered table-striped">
    	<caption><h1><?=report_title?></h1></caption>
    	<thead>
    		<tr>
    			<th>Nombre</th>
    			<th>Descargar</th>
    		</tr>
    	</thead>
    	<tbody>
    		<?
    		//Directory of reportes
    		$pathreport = "reports/";
    		//$pathreport = "js/";
			if ($handle = opendir($pathreport)) {
		    	while (false !== ($file = readdir($handle))) {
		    		if($file != '..' || $file != '.') {
    			?>
    			<tr>
    				<td><?=$file?></td>
    				<td>
    					<a class="btn btn-large" href="<?=$pathreport.$file?>"><i class="icon-download-alt"></i><?=download?></a>
    				</td>
    			</tr>
    			<?
					}
				}
				closedir($handle);
			}
			else {
				?>
				<tr class="error">
    				<td colspan="2">No existen el Reportes vigentes</td>
    			</tr>
    			<?
			}
    		?>
    	</tbody>
   </table>
   
