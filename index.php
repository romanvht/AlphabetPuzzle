<?php
require_once 'inc/db.php';
require_once 'inc/func.php';

$gcel = int($_GET['cell']);
$cell = empty($gcel) || $gcel > 7  ? 4 : $gcel;

$go_cell = int($_COOKIE['cell']);
if(empty($gcel) && isset($_COOKIE['cell']))$cell = $go_cell;

if($cell == 4)setcookie ("cell", 4,time()+86400*30);
if($cell == 5)setcookie ("cell", 5,time()+86400*30);
if($cell == 6)setcookie ("cell", 6,time()+86400*30);
if($cell == 7)setcookie ("cell", 7,time()+86400*30);

require_once 'inc/head.php';
?>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {	 
        setInterval(load_get('top.php?cell=<?php echo $cell ?>', 'top', true),1000);  
    });
</script> 
 
<div id="p_prldr"><span class="svg_anm"></span></div>
  <?php 
	echo '<div class="main_links"><a class="link anim'.($cell == 4 ? ' selected' : '').'" href="4.mode">4x4</a><a class="link anim'.($cell == 5 ? ' selected' : '').'" href="5.mode">5x5</a><a class="link anim'.($cell == 6 ? ' selected' : '').'" href="6.mode">6x6</a><a class="link anim'.($cell == 7 ? ' selected' : '').'" href="7.mode">7x7</a><a id="top_link" class="link" href="#top">Топ</a></div>'."\n";
  ?>
    <div class="heading">
     <div class="nick-container">
       <div class="nick"><input id="nick" type="text"></div>
     </div>  
     <div class="scores-container">
      <div class="score-container">0</div>
      <div class="best-container">0</div>
     </div>
    </div>
    <div class="game-container">
     <div class="game-message">
      <p></p>
      <div class="lower">
       <a class="keep-playing-button">Продолжить</a>
       <a class="retry-button">Еще</a>
       <div class="score-sharing"></div>
       <div id="viewport"></div>
      </div>
     </div>
     
		<div class="game-body">
		<?php  
			if($cell == 4){
			  $echo_cell = "\n".'<div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>'."\n";
			}elseif($cell == 5){
			  $echo_cell = "\n".'<div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>'."\n";
			}elseif($cell == 6){
			   $echo_cell = "\n".'<div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>'."\n";
			}elseif($cell == 7){
			   $echo_cell = "\n".'<div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>
			   <div class="grid-cell"></div>'."\n";
			} 
		?>
		
			<div class="grid-container">
				<?php
					for ($start=0; $start<$cell; $start++){
						echo '<div class="grid-row">'."\n";
						echo $echo_cell;
						echo '</div>'."\n";
					}
				?>
			</div>
			
			 <div class="tile-container">
			  <div class="tile tile-2 tile-position-1-1 tile-new">
			   <div class="tile-inner">L</div>
			  </div>
			  <div class="tile tile-4 tile-position-1-2 tile-new">
			   <div class="tile-inner">O</div>
			  </div>
			  <div class="tile tile-6 tile-position-1-3 tile-new">
			   <div class="tile-inner">A</div>
			  </div>
			  <div class="tile tile-8 tile-position-1-4 tile-new">
			   <div class="tile-inner">D</div>
			  </div>
			 </div>
		</div>
    </div>
	<div class="control">
		<div class="restart-button"><span>&#8634;</span> Заного</div>
		<div class="color-button"><span id="color" class="color"></span> Цвета</div>
		<div class="cancel-button"><span>&#8630;</span> Отмена</div>
	</div>

  <script src="js/animframe_polyfill.js?<?php echo $version; ?>"></script>
  <script src="js/keyboard_input_manager.js?<?php echo $version; ?>"></script>
  <script src="js/html_actuator_ru.js?<?php echo $version; ?>"></script>
  <script src="js/grid.js?<?php echo $version; ?>"></script>
  <script src="js/tile.js?<?php echo $version; ?>"></script>
  <script src="js/game_manager.js?<?php echo $version; ?>"></script>
  <script src="js/dom_edit.js?<?php echo $version; ?>"></script>
  <script>
	window.requestAnimationFrame(function () {
		new GameManager(<?php echo $cell; ?>, KeyboardInputManager, HTMLActuator, LocalStorageManager);
	});  
  </script>
  <noscript>
  <p><b>Для работы приложения нужен включённый в браузере Javascript!</b></p>
  </noscript>

	<div class="ads">
	<?php
		if(!isClient()){
			echo '<a class="ads_link" href="https://romanvht-alphabet.ru.aptoide.com"><span><img style="width: 24px; height: 24px;" src="/ico/aptoide.ico" alt=""/> Download from Aptoide AppStore</span></a>';
		}
		$prints = array(
						'<a href="http://printlike.romanvht.ru" target="_blank"><img style="width: 100%; border-radius: 3px;" src="https://printbar.ru/upload/partners/images/banners/c7127.jpg"/></a>', 
						'<a href="http://printlike.romanvht.ru" target="_blank"><img style="width: 100%; border-radius: 3px;" src="https://printbar.ru/upload/partners/images/banners/46a57.gif"/></a>', 
						'<a href="http://printlike.romanvht.ru" target="_blank"><img style="width: 100%; border-radius: 3px;" src="https://printbar.ru/upload/partners/images/banners/46a57.gif"/></a>', 
						'<a href="http://printlike.romanvht.ru" target="_blank"><img style="width: 100%; border-radius: 3px;" src="https://printbar.ru/upload/partners/images/banners/32c0e.gif"/></a>',
						'<a href="http://printlike.romanvht.ru" target="_blank"><img style="width: 100%; border-radius: 3px;" src="https://printbar.ru/upload/partners/images/banners/2ff5e.gif"/></a>',
						'<a href="http://printlike.romanvht.ru" target="_blank"><img style="width: 100%; border-radius: 3px;" src="https://printbar.ru/upload/partners/images/banners/cc229.jpg"/></a>',
						'<a href="http://printlike.romanvht.ru" target="_blank"><img style="width: 100%; border-radius: 3px;" src="https://printbar.ru/upload/partners/images/banners/b1c44.jpg"/></a>',
						'<a href="http://printlike.romanvht.ru" target="_blank"><img style="width: 100%; border-radius: 3px;" src="https://printbar.ru/upload/partners/images/banners/28280.gif"/></a>',
						'<a href="http://printlike.romanvht.ru" target="_blank"><img style="width: 100%; border-radius: 3px;" src="https://printbar.ru/upload/partners/images/banners/c5a47.jpg"/></a>'
						);
		echo '<div class="ads_block">';
		echo $prints[rand(0,8)];		
		echo '</div>';

		echo '<a class="ads_link" href="http://jin.romanvht.ru"><span><img style="width: 24px; height: 24px;" src="https://jin.romanvht.ru/meta_images/favicon-32x32.png" alt=""/> Джинни читает ваши мысли</span></a>';
	?>
	</div>
	
	<div id="top"><div class="title">Топ</div><div class="top"><div class="list">Загрузка...</div></div></div>
		
	<a href="online.php?cell=<?php echo $cell ?>"><div class="href">Играют: <?php echo who() ?> чел.</div></a>	
	
<?php
require_once 'inc/foot.php';	
