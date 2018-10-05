<?php

namespace Ispa\Codi\Constant;


final class PriceLevel
{

	const
		A = 'level_a',
		B = 'level_b',
		C = 'level_c';

	private static $NAMES = [
		self::A => "level_a",
		self::B => "level_b",
		self::C => "level_c",
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