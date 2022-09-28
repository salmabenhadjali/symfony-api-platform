<?php

namespace App\Format;

use App\Format\BaseFormat;

class JSON extends BaseFormat 
		implements FromStringInterface, NamedFormatInterface, FormatInterface {
	const DATA = [
		'success' => true
	];

	public function convert(): string
	{
		return $this->toJSON();
	}

	private function toJSON() : string
	{
		return json_encode($this->data);
	}

	public static function convertData() : string
	{
		return json_encode(self::DATA);
	}

	public function convertFromString($string) : array
	{
		return json_decode($string, true);
	}

	public function getName() : string
	{
		return 'JSON';
	}
}