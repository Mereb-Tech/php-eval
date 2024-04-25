<?php

use PHPUnit\Framework\TestCase;
use General\Utils;

class UtilsTest extends TestCase
{
    public function testRandomness()
    {
        // Test the randomness of generated numbers
        $random_numbers = [];
        for ($i = 0; $i < 1000; $i++) {
            $random_numbers[] = Utils::getSecureRandom(1, 100);
        }

        // Use statistical tests to check randomness
        $mean = array_sum($random_numbers) / count($random_numbers);
        $variance = array_sum(array_map(function ($x) use ($mean) {
            return pow($x - $mean, 2);
        }, $random_numbers)) / count($random_numbers);
        $std_deviation = sqrt($variance);

        // Assert that the standard deviation is within a reasonable range
        $this->assertLessThan(20, $std_deviation);
    }

    public function testBounds()
    {
        // Test if generated numbers are within the specified range
        $min = 10;
        $max = 20;
        $random_number = Utils::getSecureRandom($min, $max);

        $this->assertGreaterThanOrEqual($min, $random_number);
        $this->assertLessThanOrEqual($max, $random_number);
    }

    public function testEdgeCases()
    {
        // Test edge cases where min and max are equal
        $min = $max = 5;
        $random_number = Utils::getSecureRandom($min, $max);

        $this->assertEquals($min, $random_number);
    }
}
