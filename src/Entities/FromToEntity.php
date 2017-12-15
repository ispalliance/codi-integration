<?php

namespace Ispa\Codi\Entity;


class FromToEntity
{

	/** @var int|null */
	public $from = null;

	/** @var int|null */
	public $to = null;


	/**
	 * @param int $from
	 */
	public function setFrom($from)
	{
		if (is_int($from)) {
			$this->from = $from;
		} elseif (ctype_digit($from) || is_float($from)) {
			$this->from = (int)$from;
		}
	}


	/**
	 * @param int $to
	 */
	public function setTo($to)
	{
		if (is_int($to)) {
			$this->to = $to;
		} elseif (ctype_digit($to) || is_float($to)) {
			$this->to = (int) $to;
		}
	}

}