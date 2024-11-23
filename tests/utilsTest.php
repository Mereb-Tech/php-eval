<?php  

require_once 'utils.php';  

use PHPUnit\Framework\TestCase;  

class utilsTest extends TestCase {  
    public function testRandomNumberWithinRange() {  
        $min = 1;  
        $max = 100;  
        $randomNumber = utils::getSecureRandom($min, $max);  
        $this->assertGreaterThanOrEqual($min, $randomNumber);  
        $this->assertLessThanOrEqual($max, $randomNumber);  
    }  

    public function testRandomness() {  
        $min = 1;  
        $max = 10;  
        $randomNumbers = [];  
        for ($i = 0; $i < 1000; $i++) {  
            $randomNumbers[] = utils::getSecureRandom($min, $max);  
        }  
        $uniqueNumbers = array_unique($randomNumbers);  
        $this->assertGreaterThan(7, count($uniqueNumbers));  
    }  

    public function testEdgeCaseSingleValue() {  
        $min = 5;  
        $max = 5;  
        $randomNumber = utils::getSecureRandom($min, $max);  
        $this->assertEquals($min, $randomNumber);  
    }  
}