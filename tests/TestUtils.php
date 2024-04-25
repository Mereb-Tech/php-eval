<?php

namespace General\Tests;

use General\Utils;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../utils.php';

class TestUtils extends TestCase
{
    public function testRandomInRange()
    {
        $min = 10;
        $max = 20;
        $iterations = 1000;

        for ($i = 0; $i < $iterations; $i++) {
            $random = Utils::getSecureRandom($min, $max);
            $this->assertGreaterThanOrEqual($min, $random);
            $this->assertLessThanOrEqual($max, $random);
        }
    }

    public function testRandomNumberDistribution()
    {
        $min = 1;
        $max = 10;
        $iterations = 10000;
        $counts = array_fill(0, $max - $min + 1, 0);

        for ($i = 0; $i < $iterations; $i++) {
            $random = Utils::getSecureRandom($min, $max);
            $index = $random - $min;
            $counts[$index]++;
        }

        // Check for roughly even distribution
        $expectedCount = $iterations / ($max - $min + 1);
        $tolerance = 0.1 * $expectedCount; // Allow 10% deviation

        foreach ($counts as $count) {
            $this->assertGreaterThanOrEqual($expectedCount - $tolerance, $count);
            $this->assertLessThanOrEqual($expectedCount + $tolerance, $count);
        }
    }

    public function testRandomNumberUniqueness()
    {
        $min = 0;
        $max = 100;
        $iterations = 10;
        $uniqueNumbers = [];

        for ($i = 0; $i < $iterations; $i++) {
            $random = Utils::getSecureRandom($min, $max);
            $this->assertFalse(in_array($random, $uniqueNumbers));
            $uniqueNumbers[] = $random;
        }
    }
}
