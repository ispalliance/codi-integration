<?php

namespace Ispa\Codi\Constant;


final class PriceLevel
{

	const
		A = 'level_a',
		B = 'level_b',
		C = 'level_c';

	private static $NAMES = [
		self::A => "Price level A",
		self::B => "Price level B",
		self::C => "Price level C",
	];


	/**
	 * PriceLevel constructor.
	 */
	private function __construct() {}


	/**
	 * @return array
	 */
	public static function getNames()
	{
		return self::$NAMES;
	}

}