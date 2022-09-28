<?php

namespace App\Service;

use App\Format\FormatInterface;

class Serializer {
	public function __construct(FormatInterface $format)
	{
		$this->format = $format;
	}

	public function serialize(array $data): string
	{
		$this->format->setData($data);
		return $this->format->convert();
	}
}