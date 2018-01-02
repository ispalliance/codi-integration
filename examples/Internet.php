<?php

require '../src/Entity/BaseEntity.php';
require '../src/Entity/CodiResponseEntity.php';
require '../src/Entity/CodiInternetResponseEntity.php';
require '../src/Entity/FromToEntity.php';
require '../src/Constant/Technology.php';
require '../src/Constant/Additional.php';

use Ispa\Codi\Constant\Technology;
use Ispa\Codi\Entity\CodiInternetResponseEntity;
use Ispa\Codi\Entity\FromToEntity;

header('Content-Type: application/json; charset=utf-8');

//user => password
$users = array('admin' => 'pass');

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || !isset($users[$_SERVER['PHP_AUTH_USER']]) || ($users[$_SERVER['PHP_AUTH_USER']] != $_SERVER['PHP_AUTH_PW'])) {
	header('WWW-Authenticate: Basic realm="My Realm"');
	header('HTTP/1.0 401 Unauthorized');
	echo 'Unauthorized';
	exit;
}

if (!isset($_GET['ruian'])) {
	header('HTTP/1.0 400 Bad Request');
	echo 'Ruian must be set';
	exit;
}

//todo implement your data filling
$ruian  = htmlspecialchars($_GET['id']);
$entity = new CodiInternetResponseEntity();

$entity->setTechnology(Technology::WIFI);

$speedUp = new FromToEntity();
$speedUp->setFrom(10);
$speedUp->setTo(20);

$speedDown = new FromToEntity();
$speedDown->setFrom(20);
$speedDown->setTo(40);

$price = new FromToEntity();
$price->setFrom(299);
$price->setTo(599);

$entity->speedUp    = $speedUp;
$entity->speedDown  = $speedDown;
$entity->price      = $price;
$entity->promoText  = 'Akční cena';
$entity->orderLink  = 'http://www.ispalliance.cz';
$entity->webLink    = 'http://www.ispalliance.cz/order';
$entity->additional = [\Ispa\Codi\Constant\Additional::TV, \Ispa\Codi\Constant\Additional::VOIP];

echo json_encode(["status" => "success","data" => [$entity]]);