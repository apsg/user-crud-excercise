<?php

namespace Tests\Feature;

use App\Buzz;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuzzFizzTest extends TestCase
{
    public function test_function_exists(){
    	$this->assertTrue( method_exists(\App\Buzz::class, 'fizz') );
    }

    public function test_function_returns_array(){
    	$result = Buzz::fizz(3);
    	$this->assertTrue(is_array($result));
    }

    public function test_function_expects_integer(){
    	Buzz::fizz(3);
    	$this->assertTrue(true);

    	$this->expectException(\TypeError::class);
    	Buzz::fizz('not_integer');
    }

    public function test_function_expects_integer_higher_than_0(){

    	$this->expectException(\Exception::class);
    	Buzz::fizz(-1);

    	$this->expectException(\Exception::class);
    	Buzz::fizz(0);

    	Buzz::fizz(1);
    	$this->assertTrue(true);
    }

    public function test_1(){
    	$result = Buzz::fizz(1);

    	$expected = [1];

    	$this->assertEquals($result, $expected);
    }


    public function test_2(){
    	$result = Buzz::fizz(2);

    	$expected = [1,2];

    	$this->assertEquals($result, $expected);
    }

    public function test_3(){
    	$result = Buzz::fizz(3);

    	$expected = [1,2,'three'];

    	$this->assertEquals($result, $expected);
    }

    public function test_4(){
    	$result = Buzz::fizz(4);

    	$expected = [1,2,'three', 4];

    	$this->assertEquals($result, $expected);
    }

    public function test_5(){
    	$result = Buzz::fizz(5);

    	$expected = [1,2,'three', 4, 'five'];

    	$this->assertEquals($result, $expected);
    }

    public function test_6(){
    	$result = Buzz::fizz(6);

    	$expected = [1,2,'three', 4, 'five', 'three'];

    	$this->assertEquals($result, $expected);
    }

    public function test_10(){
    	$result = Buzz::fizz(10);

    	$expected = [1,2,'three', 4, 'five', 'three', 7, 8, 'three', 'five'];

    	$this->assertEquals($result, $expected);
    }

    public function test_15(){
    	$result = Buzz::fizz(15);

    	$expected = [
    		1,2,'three', 4, 'five', 
    		'three', 7, 8, 'three', 'five',
    		11, 'three', 'three', 14, 'threefive',
    	];

    	$this->assertEquals($result, $expected);
    }

    public function test_20(){
    	$result = Buzz::fizz(20);

    	$expected = [
    		1,2,'three', 4, 'five', 
    		'three', 7, 8, 'three', 'five',
    		11, 'three', 'three', 14, 'threefive',
    		16, 17, 'three', 19, 'five', 
    	];
    	$this->assertEquals($result, $expected);
    }

    public function test_25(){
    	$result = Buzz::fizz(25);

    	$expected = [
    		1,2,'three', 4, 'five', 
    		'three', 7, 8, 'three', 'five',
    		11, 'three', 'three', 14, 'threefive',
    		16, 17, 'three', 19, 'five', 
    		'three', 22, 'three', 'three', 'five',
    	];
    	$this->assertEquals($result, $expected);
    }


    public function test_50(){
    	$result = Buzz::fizz(50);

    	$expected = [
    		1,2,'three', 4, 'five', 
    		'three', 7, 8, 'three', 'five',
    		11, 'three', 'three', 14, 'threefive',
    		16, 17, 'three', 19, 'five', 
    		'three', 22, 'three', 'three', 'five',
    		26, 'three', 28, 29, 'threefive',
    		'three', 'three', 'three', 'three', 'threefive',
    		'three', 'three', 'three', 'three', 'five',
    		41, 'three', 'three', 44, 'threefive', 
    		46, 47, 'three', 49, 'five',
    	];
    	$this->assertEquals($result, $expected);
    }

}
