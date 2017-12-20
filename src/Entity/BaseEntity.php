<?php

namespace Ispa\Codi\Entity;


abstract class BaseEntity implements \JsonSerializable
{

	/**
	 * @param string $name
	 * @param mixed $value
	 */
	public function __set($name, $value)
	{
		if (method_exists($this, "set" . ucfirst($name))) {
			call_user_func([$this, "set" . ucfirst($name)], $value);
		} elseif (property_exists($this, $name)) {
			$this->{$name} = $value;
		} else {
			throw new \InvalidArgumentException("Property '$name' not exist");
		}

		$this->validate($name);
	}


	/**
	 * @param string $name
	 * @return mixed
	 */
	public function __get($name)
	{
		if (method_exists($this, "get" . ucfirst($name))) {
			return call_user_func([$this, "get" . ucfirst($name)]);
		} elseif (property_exists($this, $name)) {
			return $this->{$name};
		} else {
			throw new \InvalidArgumentException("Property '$name' not exist");
		}
	}


	/**
	 * @return array
	 */
	public function jsonSerialize()
	{
		$array           = [];
		$reflectionClass = new \ReflectionClass($this);
		foreach ($reflectionClass->getProperties() as $property) {
			$this->validate($property);
			$array[$property->getName()] = $this->{$property->getName()};
		}

		return $array;
	}


	/**
	 * @param string|\ReflectionProperty $name
	 * @return bool
	 */
	private function validate($name)
	{
		if ($name instanceof \ReflectionProperty) {
			$reflection = $name;
		} else {
			$reflection = new \ReflectionProperty($this, $name);
		}
		$value      = $this->{$reflection->getName()};
		$docComment = $reflection->getDocComment();
		if (preg_match('/@var\s+([^\s]+)/', $docComment, $matches)) {
			$types       = explode('|', $matches[1]);
			$isNullable  = (bool) array_intersect(['null', 'Null', 'NULL'], $types);
			$types       = array_filter($types, function ($type) {
				return !in_array($type, ['null', 'Null', 'NULL']);
			});

			if (is_null($value) && $isNullable) {
				return true;
			} elseif (is_object($value)) {
				foreach ($types as $type) {
					//todo check type without /...
					if(class_exists($type) && $value instanceof $type) {
						return true;
					}
				}
			} else {
				foreach ($types as $type) {
					$type = strtolower($type);
					if (function_exists("is_$type") && call_user_func("is_$type", $value)) {
						return true;
					}
				}
			}
		}

		return true;
	}

}