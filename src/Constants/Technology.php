<?php

namespace Ispa\CodiLibs\Constant;


final class Technology
{

	//todo incomplete enum
	const
		XDSL = 'XDSL',
		WIFI = 'WIFI',
		FWA  = 'FWA',
		CATV = 'CATV',
		FTTH = 'FTTH',
		FTTB = 'FTTB',
		FTTC = 'FTTC';

	private static $NAMES = [
		self::XDSL => "Pevný internet (XDSL)",
		self::WIFI => "Bezdrátový internet (WIFI)",
		self::FWA  => "Bezdrátový internet (FWA)",
		self::CATV => "Pevný internet (CATV)",
		self::FTTH => "Optický internet (FTTH)",
		self::FTTB => "Optický internet (FTTB)",
		self::FTTC => "Optický internet (FTTC)"
	];


	/**
	 * Technology constructor.
	 */
	private function __construct() {}


	/**
	 * @param string $technology
	 * @param string $default
	 * @return string
	 */
	public static function getName($technology, $default = '')
	{
		return array_key_exists($technology, self::$NAMES) ? self::$NAMES[$technology] : $default;
	}


	/**
	 * @return array
	 */
	public static function getNames()
	{
		return self::$NAMES;
	}

}
