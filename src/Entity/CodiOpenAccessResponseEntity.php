<?php

namespace Ispa\Codi\Entity;


use Ispa\Codi\Constant\PriceLevel;

/**
 * @property $note
 * @property $priceLevel
 * @property $speedUp
 * @property $speedDown
 */
class CodiOpenAccessResponseEntity extends CodiResponseEntity
{

	/** @var string|null */
	protected $note;

	/** @var string|null */
	protected $priceLevel;

	/** @var int|null */
	protected $speedUp;

	/** @var int|null */
	protected $speedDown;


	/**
	 * @param string $priceLevel
	 */
	public function setPriceLevel($priceLevel)
	{
		if (array_key_exists($priceLevel, PriceLevel::getNames())) {
			$this->priceLevel = $priceLevel;
		}
	}


	/**
	 * @param int $speedUp
	 */
	public function setSpeedUp($speedUp)
	{
		if (is_numeric($speedUp)) {
			$this->speedUp = (int)$speedUp;
		}
	}


	/**
	 * @param int $speedDown
	 */
	public function setSpeedDown($speedDown)
	{
		if (is_numeric($speedDown)) {
			$this->speedDown = (int)$speedDown;
		}
	}

}