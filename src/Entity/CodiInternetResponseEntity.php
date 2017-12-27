<?php

namespace Ispa\Codi\Entity;

use Ispa\Codi\Constant\Additional;


class CodiInternetResponseEntity extends CodiResponseEntity
{

	/** @var \Ispa\Codi\Entity\FromToEntity */
	protected $speedUp;

	/** @var \Ispa\Codi\Entity\FromToEntity */
	protected $speedDown;

	/** @var \Ispa\Codi\Entity\FromToEntity */
	protected $price;

	/** @var array */
	protected $additional = [];

	/** @var string|null */
	protected $webLink;

	/** @var string|null */
	protected $orderLink;

	/** @var string|null */
	protected $promoText;


	/**
	 * @param array $additional
	 */
	public function setAdditional(array $additional)
	{
		$additionalNames = Additional::getNames();
		$forSet          = [];

		foreach ($additional as $item) {
			if (array_key_exists($item, $additionalNames)) {
				$forSet[] = $item;
			}
		}

		$this->additional = $forSet;
	}

}