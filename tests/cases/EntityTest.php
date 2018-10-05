<?php

namespace Tests\Cases;

require __DIR__ . '/../bootstrap.php';

use Ispa\Codi\Constant\Additional;
use Ispa\Codi\Constant\PriceLevel;
use Ispa\Codi\Constant\Technology;
use Ispa\Codi\Entity\CodiInternetResponseEntity;
use Ispa\Codi\Entity\CodiOpenAccessResponseEntity;
use Ispa\Codi\Entity\FromToEntity;
use Tester\Assert;
use Tester\TestCase;


class EntityTest extends TestCase
{

	public function testFromToEntity()
	{
		$fromToEntity = new FromToEntity();
		$fromToEntity->from = 'asd';

		Assert::null($fromToEntity->from);

		$fromToEntity->from = 56.27;
		Assert::equal(56, $fromToEntity->from);

		$fromToEntity->from = 42;
		Assert::equal(42, $fromToEntity->from);

		$fromToEntity->from = "77";
		Assert::equal(77, $fromToEntity->from);

		$fromToEntity->to = 45;

		Assert::equal('{"from":77,"to":45}', json_encode($fromToEntity, JSON_UNESCAPED_SLASHES));
	}


	public function testCodiInternetResponseEntityBasic()
	{
		$entity             = new CodiInternetResponseEntity();
		$entity->technology = Technology::WIFI;
		$fromToEntity       = new FromToEntity();
		$fromToEntity->setFrom(10);
		$fromToEntity->setTo(16);

		$entity->speedUp   = $fromToEntity;
		$entity->speedDown = $fromToEntity;
		$entity->price     = $fromToEntity;
		Assert::equal('{"speedUp":{"from":10,"to":16},"speedDown":{"from":10,"to":16},"price":{"from":10,"to":16},"additional":[],"webLink":null,"orderLink":null,"promoText":null,"technology":"wifi"}', json_encode($entity, JSON_UNESCAPED_SLASHES));
	}


	public function testCodiInternetResponseEntityComplete()
	{
		$entity             = new CodiInternetResponseEntity();
		$entity->technology = Technology::FTTB;
		$fromToEntityU      = new FromToEntity();
		$fromToEntityU->setFrom(8);
		$fromToEntityU->setTo(16);
		$fromToEntityD = new FromToEntity();
		$fromToEntityD->setFrom(16);
		$fromToEntityD->setTo(32);
		$fromToEntityP = new FromToEntity();
		$fromToEntityP->setFrom(259);
		$fromToEntityP->setTo(999);

		$entity->speedUp    = $fromToEntityU;
		$entity->speedDown  = $fromToEntityD;
		$entity->price      = $fromToEntityP;
		$entity->additional = [Additional::IPV6,Additional::VOIP,Additional::TV];
		$entity->webLink    = "http://ispa.cz";
		$entity->orderLink  = "http://ispa.cz/order";
		$entity->promoText  = "Zde se nachazi nejaky text, ktery by mel byt akcni nabidkou, zobrazenou poterncialnimu zakaznikovi, pri vyhledani neseho pripojeni.";

		Assert::equal('{"speedUp":{"from":8,"to":16},"speedDown":{"from":16,"to":32},"price":{"from":259,"to":999},"additional":["IPV6","VOIP","TV"],"webLink":"http://ispa.cz","orderLink":"http://ispa.cz/order","promoText":"Zde se nachazi nejaky text, ktery by mel byt akcni nabidkou, zobrazenou poterncialnimu zakaznikovi, pri vyhledani neseho pripojeni.","technology":"fttb"}', json_encode($entity, JSON_UNESCAPED_SLASHES));
	}


	public function testCodiInternetResponseEntityBadTechnology()
	{
		$entity             = new CodiInternetResponseEntity();
		Assert::exception(function() use ($entity) {
			$entity->technology = 'XYZ';
		}, \UnexpectedValueException::class, 'Entity validation Error, contain unexpected value');
	}


	public function testCodiInternetResponseEntityBadAdditional()
	{
		$entity             = new CodiInternetResponseEntity();
		$entity->technology = Technology::WIFI;
		$fromToEntity       = new FromToEntity();
		$fromToEntity->setFrom(10);
		$fromToEntity->setTo(16);
		$entity->speedUp    = $fromToEntity;
		$entity->speedDown  = $fromToEntity;
		$entity->price      = $fromToEntity;
		$entity->additional = ['XYZ'];

		Assert::equal('{"speedUp":{"from":10,"to":16},"speedDown":{"from":10,"to":16},"price":{"from":10,"to":16},"additional":[],"webLink":null,"orderLink":null,"promoText":null,"technology":"wifi"}', json_encode($entity, JSON_UNESCAPED_SLASHES));
	}

	public function testCodiInternetResponseEntityNoFromTo()
	{
		$entity             = new CodiInternetResponseEntity();
		$entity->technology = Technology::WIFI;

		Assert::exception(function() use ($entity) {
			json_encode($entity, JSON_UNESCAPED_SLASHES);
		}, \Exception::class);
	}


	public function testCodiInternetResponseEntityNoSpeedDown()
	{
		$entity             = new CodiInternetResponseEntity();
		$entity->technology = Technology::WIFI;
		$fromToEntity       = new FromToEntity();
		$fromToEntity->setFrom(10);
		$fromToEntity->setTo(16);
		$entity->speedUp    = $fromToEntity;
		$entity->price      = $fromToEntity;

		Assert::exception(function() use ($entity) {
			json_encode($entity, JSON_UNESCAPED_SLASHES);
		}, \Exception::class);
	}


	public function testCodiInternetResponseEntityNoSpeedUp()
	{
		$entity             = new CodiInternetResponseEntity();
		$entity->technology = Technology::WIFI;
		$fromToEntity       = new FromToEntity();
		$fromToEntity->setFrom(10);
		$fromToEntity->setTo(16);
		$entity->speedDown  = $fromToEntity;
		$entity->price      = $fromToEntity;

		Assert::exception(function() use ($entity) {
			json_encode($entity, JSON_UNESCAPED_SLASHES);
		}, \Exception::class);
	}


	public function testCodiInternetResponseEntityNoPrice()
	{
		$entity             = new CodiInternetResponseEntity();
		$entity->technology = Technology::WIFI;
		$fromToEntity       = new FromToEntity();
		$fromToEntity->setFrom(10);
		$fromToEntity->setTo(16);
		$entity->speedUp    = $fromToEntity;
		$entity->speedDown  = $fromToEntity;

		Assert::exception(function() use ($entity) {
			json_encode($entity, JSON_UNESCAPED_SLASHES);
		}, \Exception::class);
	}


	public function testCodiOpenAccessResponseEntityBasic()
	{
		$entity             = new CodiOpenAccessResponseEntity();
		$entity->technology = Technology::WIFI;

		Assert::equal('{"note":null,"priceLevel":null,"speedUp":null,"speedDown":null,"technology":"wifi"}', json_encode($entity, JSON_UNESCAPED_SLASHES));
	}


	public function testCodiOpenAccessResponseEntityWithNote()
	{
		$entity             = new CodiOpenAccessResponseEntity();
		$entity->technology = Technology::WIFI;
		$entity->note       = "Text";

		Assert::equal('{"note":"Text","priceLevel":null,"speedUp":null,"speedDown":null,"technology":"wifi"}', json_encode($entity, JSON_UNESCAPED_SLASHES));
	}


	public function testCodiOpenAccessResponseEntityComplete()
	{
		$entity             = new CodiOpenAccessResponseEntity();
		$entity->technology = Technology::WIFI;
		$entity->note       = "Text";
		$entity->priceLevel = PriceLevel::A;
		$entity->speedDown  = 4096;
		$entity->speedUp    = 512;

		Assert::equal('{"note":"Text","priceLevel":"level_a","speedUp":512,"speedDown":4096,"technology":"wifi"}', json_encode($entity, JSON_UNESCAPED_SLASHES));
	}


	public function testCodiOpenAccessResponseEntityBadTechnology()
	{
		$entity             = new CodiOpenAccessResponseEntity();
		Assert::exception(function() use ($entity) {
			$entity->technology = 'XYZ';
		}, \UnexpectedValueException::class, 'Entity validation Error, contain unexpected value');
	}

}
(new EntityTest())->run();