<?php
$vht = new mysqli('mysql101.1gb.ru', 'gb_alphabet', 'a643b29289', 'gb_alphabet');
if($vht->connect_errno){
	die('Ошибка подключения '.$vht->connect_error);
}
$vht->set_charset('utf8');