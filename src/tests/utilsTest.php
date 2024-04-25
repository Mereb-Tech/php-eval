<?php

use PHPUnit\Framework\TestCase;
use General\Utils;

class UtilsTest extends TestCase
{
    public function testBounds()
    {
        // Test if generated numbers are within the specified range
        $min = 40;
        $max = 50;
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

    public function testRepeatedCalls()
    {
        // Test whether repeated calls produce different random numbers
        $min = 1;
        $max = 100;
        $random_numbers = [];

        // Generate random numbers and store them in an array
        for ($i = 0; $i < 10; $i++) {
            $random_numbers[] = Utils::getSecureRandom($min, $max);
        }

        // Check if all generated numbers are different
        $this->assertCount(10, array_unique($random_numbers));
    }
}
