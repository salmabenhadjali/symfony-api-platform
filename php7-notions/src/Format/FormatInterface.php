<?php

namespace App\Format;

interface FormatInterface {
	public function setData(array $data): void;
	public function convert(): string;
}