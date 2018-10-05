<?php

namespace Ispa\Codi\Entity;


/**
 * @property int|null $from
 * @property int|null $to
 */
class FromToEntity extends BaseEntity
{

	/** @var int|null */
	protected $from = null;

	/** @var int|null */
	protected $to = null;


	/**
	 * @param int $from
	 */
	public function setFrom($from)
	{
		if (is_numeric($from)) {
			$this->from = (int)$from;
		}
	}


	/**
	 * @param int $to
	 */
	public function setTo($to)
	{
		if (is_numeric($to)) {
			$this->to = (int)$to;
		}
	}

}