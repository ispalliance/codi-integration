<?php

namespace Ispa\Codi\Entity;


class CodiInternetResponseEntity
{

	/** @var string */
	public $technology;

	/** @var FromToEntity */
	public $speedUp;

	/** @var FromToEntity */
	public $speedDown;

	/** @var FromToEntity */
	public $price;

	/** @var array */
	public $additional = [];

	/** @var string|null */
	public $webLink;

	/** @var string|null */
	public $orderLink;

	/** @var string|null */
	public $promoText;

}