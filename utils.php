<?php

namespace General;

use InvalidArgumentException;

class Utils
{
	/**
	 * Returns random integer between given range
	 *
	 * @param int $min
	 * @param int $max
	 * @return int
	 */
	static function getSecureRandomOld($min, $max)
	{
		$range = $max - $min;
		$range_log = log($range, 2);
		$bytes_to_fetch = (int) ($range_log / 8) + 1;
		//possibly not as large as bytes to fetch (eg only care about 6 bits in 1 byte)
		$bits_to_fetch = (int) $range_log + 1;
		//rng filter to assist in requiring less loops to generate random numbers
		//the filter doesn't constrain random numbers to our exact range, but it does
		//get them closer.	eg Only care about 6 bits and generate random data for one byte
		//we discard the 2 highest bits and then see if that result is still greater than our range
		//filter in bin has all bits set to 1 of length $bits_to_fetch 
		$rng_filter = (int) (1 << $bits_to_fetch) - 1;
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes_to_fetch)));
			// discard irrelevant bits
			$rnd = $rnd & $rng_filter;
		} while ($rnd > $range);
		return $min + $rnd;
	}


	/**
	 * Generates a cryptographically secure random number within a specified range,
	 * with optional bias towards the center or specific values.
	 *
	 * This function utilizes the PHP 7.1+ random_int function along with best practices for
	 * secure random number generation and offers additional customization options.
	 *
	 * @param int $min The minimum value for the random number (inclusive).
	 * @param int $max The maximum value for the random number (inclusive).
	 * @param float $bias (optional) A value between 0 and 1 to bias the distribution
	 *                  towards the center (0.5 for even distribution). Defaults to 0.5.
	 * @param array $preferredValues (optional) An array of preferred values within the range.
	 *                  The function will attempt to select from this list first, weighted
	 *                  randomly based on their presence within the range. Defaults to empty array.
	 * @return int A cryptographically secure random number within the specified range,
	 *             potentially biased or chosen from preferred values.
	 * @throws InvalidArgumentException If the minimum value is greater than the maximum value,
	 *                                  or the bias value is outside the valid range.
	 */
	static function getSecureRandom(int $min, int $max, float $bias = 0.5, array $preferredValues = []): int
	{
		// Validate input
		if ($min > $max) {
			throw new InvalidArgumentException("Minimum value cannot be greater than maximum value.");
		}
		if ($bias < 0 || $bias > 1) {
			throw new InvalidArgumentException("Bias value must be between 0 and 1.");
		}

		// Calculate absolute difference (range)
		$range = abs($max - $min);

		// Check for preferred values within range
		$filteredPreferredValues = array_filter($preferredValues, function ($value) use ($min, $max) {
			return $value >= $min && $value <= $max;
		});

		// Prioritize preferred values if available
		if (!empty($filteredPreferredValues)) {
			$weightedValues = [];
			foreach ($filteredPreferredValues as $value) {
				$weight = abs($value - (($min + $max) / 2)) / ($range / 2);
				$weightedValues[] = [$value, $weight];
			}
			$distribution = array_sum(array_column($weightedValues, 1));
			$randomIndex = mt_rand(1, $distribution);
			$selectedValue = null;
			$currentSum = 0;
			foreach ($weightedValues as $weightedValue) {
				$currentSum += $weightedValue[1];
				if ($currentSum >= $randomIndex) {
					$selectedValue = $weightedValue[0];
					break;
				}
			}
			if ($selectedValue !== null) {
				return $selectedValue;
			}
		}

		// Generate random number with bias (optional)
		$adjustedRange = $range * (1 - abs($bias - 0.5));
		$randomOffset = random_int(0, (int) $adjustedRange);

		// Adjust for minimum value and bias direction
		$adjustedRandom = $min + ($bias < 0.5 ? $randomOffset : $range - $randomOffset);

		return $adjustedRandom;
	}
}
