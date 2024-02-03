<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
echo "Test Script Starting\n";
require('functions.inc.php');

class test extends TestCase
{
    public function testStringMatch(): void
    {
        $paragraph='This is test paragraph test';
        $word = 'test';
        $expect=2;
        $answer = substr_count(strtolower($paragraph), strtolower($word));
        $this->assertEquals($expect,$answer);
        
    }
   
}
