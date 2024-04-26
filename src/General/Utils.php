<?php

namespace General;

class Utils
{
	/**
	 * Returns random integer between given range
	 *
	 * @param int $min
	 * @param int $max
	 * @return int
	 */
	static function getSecureRandom($min, $max)
	{
		$range = $max - $min;

		// calculate the number of bytes required to represent the range
		$bytes_to_fetch = (int) ceil(log($range, 2) / 8);

		do {
			// Generate random bytes
			$random_bytes = random_bytes($bytes_to_fetch);

			// Convert the bytes to an integer
			$rnd = hexdec(bin2hex($random_bytes));

			// Adjust the random num to the specified range
			$adjusted  = $rnd % $range;
		} while ($adjusted  >= $range);

		return $min + $adjusted;
	}
}
