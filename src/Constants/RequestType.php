<?php

namespace Ispa\CodiLibs\Constant;


final class RequestType
{

	const
		INTERNET     = "internet",
		OPEN_ACCESS  = "openAccess",
		AVAILABILITY = "availability";

	private static $USED_TYPES = [
		self::INTERNET    => "INTERNET",
		self::OPEN_ACCESS => "OPEN ACCESS"
	];

	private static $NAMES = [
		self::INTERNET     => "internet",
		self::OPEN_ACCESS  => "openAccess",
		self::AVAILABILITY => "availability",
	];


	/**
	 * RequestType constructor.
	 */
	private function __construct() {}


	/**
	 * @return array
	 */
	public static function getTypes()
	{
		return [
			self::INTERNET, self::OPEN_ACCESS, self::AVAILABILITY
		];
	}


	/**
	 * @param string $type
	 * @return boolean
	 */
	public static function isTypeEnableForUse($type)
	{
		return array_key_exists($type, self::$USED_TYPES);
	}


	/**
	 * @param string $type
	 * @param string $default
	 * @return string
	 */
	public static function getName($type, $default = '')
	{
		return array_key_exists($type, self::$NAMES) ? self::$NAMES[$type] : $default;
	}


	/**
	 * @return array
	 */
	public static function getNames()
	{
		return self::$NAMES;
	}

}