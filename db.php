<?php
$s_mysql = array(
	'host' => 'localhost',
	'user' => 'root',
	'pass' => '',
	'base' => 'studylab'
);

$db = new mysqli($s_mysql['host'], $s_mysql['user'], $s_mysql['pass'], $s_mysql['base']);
if($db -> connect_errno):	  		
	exit('> Не удалость установить соединение с базой данных.');
else:
	$db-> query("set names utf8");
endif;

?>
