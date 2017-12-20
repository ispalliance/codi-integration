<?php

namespace Ispa\Codi\Entity;


class CodiInternetResponseEntity extends BaseEntity
{

	/** @var string */
	protected $technology;

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

}