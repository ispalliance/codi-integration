<?php

namespace Tests\Cases;

require __DIR__ . '/../bootstrap.php';

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


}
(new EntityTest())->run();