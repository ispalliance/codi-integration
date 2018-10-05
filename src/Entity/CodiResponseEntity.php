<?php

namespace Ispa\Codi\Entity;

use Ispa\Codi\Constant\Technology;


/**
 * @property string $technology
 */
abstract class CodiResponseEntity extends BaseEntity
{

	/** @var string */
	protected $technology;


	/**
	 * @param string $technology
	 */
	public function setTechnology($technology)
	{
		if (array_key_exists($technology, Technology::getNames())) {
			$this->technology = $technology;
		}
	}

}