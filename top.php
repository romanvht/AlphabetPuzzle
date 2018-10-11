<?php
header('Access-Control-Allow-Origin: *');
include_once 'inc/db.php';
include_once 'inc/func.php';
$cell = int($_GET['cell']);
?>	
	<div class="title"><span class="tit">Топ 10</span></div>
	<div class="top">
<?php
	$sql = $vht->query("SELECT * FROM `2048` WHERE `size` = '$cell' ORDER BY `score` DESC LIMIT 10");
	$i = 1;
		
	while($a = $sql->fetch_assoc()){
		echo '<div class="list">'.$i.'. <span>'.$a['name'].'</span> - <b>'.$a['score'].'</b> ['.r_time($a['time']).']</div>';  
		$i++;
	}
?>
	</div>