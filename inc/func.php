<?php
/* Автор: romanvht 
roman.vkostin@gmail.com */ 

function in_t($a){
global $vht;
$a = $vht->real_escape_string(htmlspecialchars(trim($a)));
return $a;
}

function in_url($a){
global $vht;
$a = $vht->real_escape_string(htmlentities(urlencode(trim($a))));
return $a;
}

function int($a){
$a = abs(intval($a));
return $a;
}

function isClient() { 
	return preg_match("/AlphabetApp/i", $_SERVER["HTTP_USER_AGENT"]);
}

function isMobile() { 
	return preg_match("/(android|avantgo|Alphabet|Jinny|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function isBot() { 
	return preg_match("/(YandexBot|Googlebot|yandex.com\/bots|msnbot|Yahoo|StackRambler)/i", $_SERVER["HTTP_USER_AGENT"]);
}

function who(){
	global $vht;
	$ip_on = $_SERVER['REMOTE_ADDR'];
	$ua_on = $_SERVER['HTTP_USER_AGENT'];
	
	$hash = isset($_COOKIE['hash']) ? in_t($_COOKIE['hash']) : md5($ip_on.$ua_on);
	$_SESSION['hash'] = $hash;
	$bot = 0;
	
	if(isBot())$bot = 1;
	
	$onl = $vht->query("SELECT `id` FROM `online` WHERE `hash` = '$hash'")->num_rows;
	
	if(empty($onl))$vht->query("INSERT INTO `online`(`time`,`ip`,`ua`, `hash`, `bot`) VALUES ('".(time()+600)."','".$ip_on."','".$ua_on."', '".$hash."', '".$bot."')");
	else $vht->query("UPDATE `online` SET `time` = '".(time()+600)."',  `ip` = '".$ip_on."', `ua` = '".$ua_on."', `bot` = '".$bot."' WHERE `hash` = '".$hash."'");
	
	setcookie("hash", $hash, time()+86400*365);
	
	$vht->query("DELETE FROM `online` WHERE `time`< '".time()."'");
	$online = $vht->query("SELECT `id` FROM `online` WHERE `bot` = '0'")->num_rows;
	return $online;
}

function r_time($time) { 
	$timep = date("j M Y в H:i", $time); 
	if (date("Y", $time) == date("Y")) $timep = date("j M в H:i", $time);
	$time_p[0] = date("j n Y", $time); 
	$time_p[1] = date("H:i", $time); 
	if ($time_p[0] == date("j n Y")) $timep = 'Сегодня в '.date("H:i", $time); 
	if ($time_p[0] == date("j n Y", time() - 60 * 60 * 24)) $timep = "Вчера в $time_p[1]";
	$timep = str_replace("Jan","Янв", $timep); 
	$timep = str_replace("Feb","Фев", $timep); 
	$timep = str_replace("Mar","Марта", $timep); 
	$timep = str_replace("May","Мая", $timep); 
	$timep = str_replace("Apr","Апр", $timep); 
	$timep = str_replace("Jun","Июня", $timep); 
	$timep = str_replace("Jul","Июля", $timep); 
	$timep = str_replace("Aug","Авг", $timep); 
	$timep = str_replace("Sep","Сент", $timep); 
	$timep = str_replace("Oct","Окт", $timep); 
	$timep = str_replace("Nov","Ноября", $timep); 
	$timep = str_replace("Dec","Дек", $timep); 
	return $timep;
}

class navigator { 
    public $all = 0; 
    public $page; 
    public $start = 0; 
    public $end = 0; 
    public $limit = 'LIMIT 0'; 
    public $htmlForm =  '<form action="%s" method="post">На стр: <input type="text" name="page" size="2" value="%s"><input type="submit" name="" value=">"></form>'; 
    public $buttonBack = '<a href="%spage=%s"><span class="nav_back">« Назад</span></a> | '; 
    public $buttonBackName = '<span class="nav_sel">« Назад</span> | '; 
    public $buttonForward = '<a href="%spage=%s"><span class="nav_next">Далее »</span></a>'; 
    public $buttonForwardName = '<span class="nav_sel">Далее »</span>';  
    public $separator = ' '; 
    public $listStr = '<br/>%s <span class="nav_next"><a href="%spage=%s" title="Далее">»</a></span><br />'; 
    public $blocAllNavi = '%1$s %2$s %3$s'; 

    function __construct($all, $pnumber, $skript = ''){ 
        $this->all = $all; 
        $this->skript = $skript == '' ? $_SERVER['SCRIPT_NAME'] . '?' : rtrim($skript); 
        $this->page = isset($_REQUEST['page']) && (int)$_REQUEST['page'] ? (int)$_REQUEST['page'] : 1; 
        $this->num_pages = ceil($all / $pnumber); 
        if (isset($_GET['last'])) $this->page = $this->num_pages; 
        if ($this->page > $this->num_pages || $this->page < 1) $this->page = 1; 
        if ($all) { 
            $this->start = $this->page * $pnumber - $pnumber; 
            $this->end = ($end = $this->start + $pnumber) > $all ? $all : $end; 
            $this->limit = sprintf('LIMIT %s,%s', $this->start, $pnumber); 
        } 
        $this->pnumber = $pnumber; 
    } 

    function form(){ 
        return ($this->num_pages < 2) ? '' : sprintf($this->htmlForm, $this->skript, $this->page); 
    } 

    function button(){ 
        $back = $this->page > 1 ? sprintf($this->buttonBack, $this->skript, $this->page-1) : $this->buttonBackName; 
        $forward = $this->page != $this->num_pages ? sprintf($this->buttonForward, $this->skript, $this->page+1) : $this->buttonForwardName; 
        return ($this->num_pages < 2) ? '' : $back . $this->separator . $forward; 
    } 

    function str(){ 
        $buff = ''; 
        for($pr = '', $i = 1; $i <= $this->num_pages; $i++){ 
            $buff .= $pr = (($i == 1 || $i == $this->num_pages || abs($i - $this->page) < 3) ? ($i == $this->page ? '<span class="nav_sel">'.$i.'</span>' : sprintf(' <span class="nav_nosel"><a href="%spage=%s">%2$s</a></span> ', $this->skript, $i)) : (($pr == ' ... ' || $pr == '') ? '' : ' ... ')); 
        } 
        return ($this->num_pages < 2) ? '' :  sprintf($this->listStr, $buff, $this->skript, ($this->page != $this->num_pages ? $this->page+1 : $this->page) ); 
    } 

    function navi($str = true, $button = true, $form = true){ 
        $str = $str ? $this->str() : ''; 
        $button = $button ? $this->button() : ''; 
        $form = ($form AND  $this->num_pages >= 10) ? $this->form() : ''; 
        $div1 = ($this->num_pages > 1) ? '<div align="center">' : '';
        $div2 = ($this->num_pages > 1) ? '</div>' : '';
        return $div1.sprintf($this->blocAllNavi, $button, $str, $form).$div2; 
    } 

}

session_start();