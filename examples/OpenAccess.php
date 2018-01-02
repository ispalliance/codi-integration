<?php

require '../src/Entity/BaseEntity.php';
require '../src/Entity/CodiResponseEntity.php';
require '../src/Entity/CodiOpenAccessResponseEntity.php';
require '../src/Constant/Technology.php';

use Ispa\Codi\Constant\Technology;
use Ispa\Codi\Entity\CodiOpenAccessResponseEntity;

header('Content-Type: application/json; charset=utf-8');

//user => password
$users = array('admin' => 'pass');

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || !isset($users[$_SERVER['PHP_AUTH_USER']]) || ($users[$_SERVER['PHP_AUTH_USER']] != $_SERVER['PHP_AUTH_PW'])) {
	header('WWW-Authenticate: Basic realm="My Realm"');
	header('HTTP/1.0 401 Unauthorized');
	echo json_encode(["status" => "error", "message" => "Unauthorized"]);
	exit;
}

if (!isset($_GET['ruian'])) {
	header('HTTP/1.0 400 Bad Request');
	echo json_encode(["status" => "error", "message" => "Ruian must be filled"]);
	exit;
}


//todo implement your data filling
$ruian  = htmlspecialchars($_GET['id']);
$entity = new CodiOpenAccessResponseEntity();

$entity->setTechnology(Technology::WIFI);
$entity->note = 'Poznámka';

echo json_encode(["status" => "success","data" => [$entity]]);