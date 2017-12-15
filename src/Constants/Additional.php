<?php

namespace Ispa\Codi\Constant;


final class Additional
{

	// todo incomplete enum
	const
		TV   = 'TV',
		VOIP = 'VOIP';

	private static $NAMES = [
		self::TV   => "Televize",
		self::VOIP => "Voip"
	];


	/**
	 * Additional constructor.
	 */
	private function __construct() {}


	/**
	 * @param string $additional
	 * @param string $default
	 * @return string
	 */
	public static function getName($additional, $default = '')
	{
		return array_key_exists($additional, self::$NAMES) ? self::$NAMES[$additional] : $default;
	}


	/**
	 * @return array
	 */
	public static function getNames()
	{
		return self::$NAMES;
	}

}