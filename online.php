<?php 
require_once 'inc/db.php'; 
require_once 'inc/func.php';  

$do = in_t($_GET['do']);
$cell = int($_GET['cell']);

require_once 'inc/head.php';
?> 
<div id="p_prldr"><div class="contpre"><span class="svg_anm"></span><small></small></div></div> 
		<?php
			switch($do){
				default:
					$page=intval($_GET['page']);  
					$count= $vht->query("SELECT `id` FROM `online` WHERE `bot` = '0'")->num_rows;  
					$count_bots= $vht->query("SELECT `id` FROM `online` WHERE `bot` = '1'")->num_rows;  
					$n = new navigator($count, '10', '/online.php?');
					$query = $vht->query('SELECT * FROM `online` WHERE `bot` = 0 ORDER BY `time` DESC '.$n->limit);
					$info = false;
					
					echo '<div class="main_links"><a class="link anim c3" href="'.$cell.'.mode">Назад</a><a class="link anim selected c3" href="?cell='.$cell.'">Люди ('.$count.')</a><a class="link anim c3" href="?cell='.$cell.'&do=bots">Боты ('.$count_bots.')</a></div>';
		
					echo '<div class="text_block">';
					while($arr = $query->fetch_assoc()){
						if($_SESSION['hash'] == $arr['hash'])$style = ' style="background: green; color: #fff; border-radius: 5px;"';
						else $style = '';
						echo '<div class="list"'.$style.'>';
						echo '<b>IP:</b> '.$arr['ip'];
						echo '<br/><b>UA:</b> '.$arr['ua'];
						echo '</div>';
					}
					echo $n->navi();
					echo '</div>';
				break;
				
				case 'bots':
					$page=intval($_GET['page']);  
					$count= $vht->query("SELECT `id` FROM `online` WHERE `bot` = '1'")->num_rows;  
					$count_users= $vht->query("SELECT `id` FROM `online` WHERE `bot` = '0'")->num_rows;  
					$n = new navigator($count, '10', '/online.php?do=bots&');
					$query = $vht->query('SELECT * FROM `online` WHERE `bot` = 1 ORDER BY `time` DESC '.$n->limit);
					$info = false;
					
					echo '<div class="main_links"><a class="link anim c3" href="'.$cell.'.mode">Назад</a><a class="link anim c3" href="?cell='.$cell.'">Люди ('.$count_users.')</a><a class="link anim selected c3" href="?cell='.$cell.'&do=bots">Боты ('.$count.')</a></div>';
					
					echo '<div class="text_block">';
					while($arr = $query->fetch_assoc()){
						if($_SESSION['hash'] == $arr['hash'])$style = ' style="background: green; color: #fff; border-radius: 5px;"';
						else $style = '';
						echo '<div class="list"'.$style.'>';
						echo '<b>IP:</b> '.$arr['ip'];
						echo '<br/><b>UA:</b> '.$arr['ua'];
						echo '</div>';
					}
					echo $n->navi();
					echo '</div>';
				break;
			}
		?>
<?php
require_once 'inc/foot.php';	
