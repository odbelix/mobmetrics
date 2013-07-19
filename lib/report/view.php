<?php
if(isset($_GET['file'])){
    		$pathreport = str_replace("'","",$_GET['file']);
    		echo $pathreport;
}
?>
<object data="<?=$pathreport?>" type="application/vnd.ms-excel">
<?=error?>
<a href="<?=$pathreport?>"><?=download?></a>.
</object>
