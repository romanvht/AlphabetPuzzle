<?php
	$version = 'v1.2.1';
?>
<!DOCTYPE html>
  <html>
    <head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Перемещайте буквы по полю. Когда две одинаковые буквы вместе, они сливаются в новую плитку со следующей буквой! Бейте рекорды игроков и соревнуйтесь с друзьями :)">
	<title>Головоломка Алфавит</title>
	<script src="js/local_storage_manager.js?<?php echo $version; ?>"></script>
	<link id="style" href="" rel="stylesheet" type="text/css">
	<script>
		var storage = new LocalStorageManager;
		var version = "<?php echo $version; ?>";
		document.getElementById("style").setAttribute("href", "css/"+storage.getStyle()+".css?"+version);
	</script> 
	<link href="css/style.css?<?php echo $version; ?>" rel="stylesheet" type="text/css">
	<link href="css/<?php echo $cell; ?>.css?<?php echo $version; ?>" rel="stylesheet" type="text/css">
	<link href="css/block-color.css?<?php echo $version; ?>" rel="stylesheet" type="text/css">
	<link rel="apple-touch-icon" sizes="57x57" href="/images/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/images/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/images/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/images/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/images/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/images/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/images/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/images/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/images/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/images/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/images/favicon-16x16.png">
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#000000">
	<meta name="msapplication-TileImage" content="/images/ms-icon-144x144.png">
	<meta id="theme-meta" name="theme-color" content="#000000">
	<script>
		window.onload = function () {
			var preloader = document.getElementById('p_prldr');
			preloader.classList.add('fadeout');
			setTimeout(function(){
				preloader.parentNode.removeChild(preloader);
			}, 200);
		};
	</script> 
  </head>
<body>
