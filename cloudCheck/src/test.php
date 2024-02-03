<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
echo "Test Script Starting\n";
require('functions.inc.php');

class test extends TestCase
{
    public function testStringMatch(): void
    {
        $paragraph='This is test paragraph';
        $word='test';
        $expect=0;
        $answer=0;
        if (strpos($paragraph, $word) !== false){
        $answer= 0;
         } else{
        $answer= 1;
         }
        $this->assertEquals($expect,$answer);
        
    }
   
}
