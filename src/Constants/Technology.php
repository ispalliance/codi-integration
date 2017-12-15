<?php

namespace Ispa\Codi\Constant;


final class Technology
{

	const
		WIFI              = 'wifi',
		FWA_FREEBAND      = 'fwa_free',
		FWA_LICENSED_BAND = 'fwa_licensed',
		FTTB              = 'fttb',
		FTTH_P2P          = 'ftth_p2p',
		FTTH_XPON         = 'ftth_xpon',
		XDSL              = 'xdsl',
		OTHER             = 'other';

	private static $NAMES = [
		self::WIFI               => "WiFi",
		self::FWA_FREEBAND       => "FWA freeband",
		self::FWA_LICENSED_BAND  => "FWA licensed band",
		self::FTTB               => "FTTB",
		self::FTTH_P2P           => "FTTH P2P",
		self::FTTH_XPON          => "FTTH xPON",
		self::XDSL               => "xDSL",
		self::OTHER              => "Other"
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
