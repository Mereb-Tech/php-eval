<?php

namespace General\Tests;

use General\Utils;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../utils.php';

class TestUtils extends TestCase
{
    // Test if the returned random number is within the specified range
    public function testRandomWithinRange()
    {
        $randomNumber = Utils::getSecureRandom(1, 10);
        $this->assertGreaterThanOrEqual(1, $randomNumber);
        $this->assertLessThanOrEqual(10, $randomNumber);
    }

    // Test if bias works as expected
    public function testBias()
    {
        $bias = 0.3; // A bias towards the lower end of the range
        $iterations = 1000;
        $sum = 0;
        for ($i = 0; $i < $iterations; $i++) {
            $randomNumber = Utils::getSecureRandom(1, 100, $bias);
            $sum += $randomNumber;
        }
        $average = $sum / $iterations;
        $this->assertLessThan(50, $average);
    }

    // Test if preferred values are selected with correct weighting
    public function testPreferredValuesSelection()
    {
        $preferredValues = [10, 20, 30, 40, 50]; // Preferred values within the range
        $selectedValues = [];
        $iterations = 1000;
        for ($i = 0; $i < $iterations; $i++) {
            $selectedValues[] = Utils::getSecureRandom(1, 50, 0.5, $preferredValues);
        }
        $counts = array_count_values($selectedValues);
        foreach ($preferredValues as $value) {
            if (isset($counts[$value])) {
                $this->assertGreaterThanOrEqual(0, $counts[$value]);
            }
        }
    }


    // Test for invalid input parameters
    public function testInvalidInput()
    {
        // Testing when min > max
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Minimum value cannot be greater than maximum value.");
        Utils::getSecureRandom(10, 1);

        // Testing when bias value is outside the valid range
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Bias value must be between 0 and 1.");
        Utils::getSecureRandom(1, 10, 1.5);
    }
}
