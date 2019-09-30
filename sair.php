<?php
require 'autoload.php';
$sql = new Chat();

if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
	$sql->delLogados($_SESSION['user']['id']);
	$sql->delMensagens($_SESSION['user']['id']);
	$sql->sair($_SESSION['user']['nick']);
	unset($_SESSION['user']);
	header('location: index.php');
}