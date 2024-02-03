<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
echo "Test Script Starting\n";
require('functions.inc.php');

class test extends TestCase
{
    public function testStringMatch(): void
    {
        $paragraph='This is test paragraph';
        $expect=4;
        $answer = str_word_count($paragraph);
        $this->assertEquals($expect,$answer);
        
    }
   
}
