<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\Utils;

use Nette;


/**
 * Secure random string generator.
 */
final class Random
{
	public const RANGE_VALIDATOR_PATTERN = '0-9a-zA-Z';

	use Nette\StaticClass;

	/**
	 * Generate random string.
	 */
	public static function generate(int $length = 10, string $charlist = '0-9a-z'): string
	{
		$charlist = count_chars(preg_replace_callback('#(.)-(.)#', function (array $m): string {
			if (!preg_match('/^' . self::RANGE_VALIDATOR_PATTERN . '$/', $m[1]) || !preg_match('/^' . self::RANGE_VALIDATOR_PATTERN . '$/', $m[2])) {
				throw new Nette\InvalidArgumentException('Range character must match "' . self::RANGE_VALIDATOR_PATTERN . '", but "' . $m[1] . '" - "' . $m[2] . '" given.');
			}

			return implode('', range($m[0][0], $m[0][2]));
		}, $charlist), 3);
		$chLen = strlen($charlist);

		if ($length < 1) {
			throw new Nette\InvalidArgumentException('Length must be greater than zero.');
		} elseif ($chLen < 2) {
			throw new Nette\InvalidArgumentException('Character list must contain at least two chars.');
		}

		$res = '';
		for ($i = 0; $i < $length; $i++) {
			$res .= $charlist[random_int(0, $chLen - 1)];
		}
		return $res;
	}
}
