<?php

namespace Tests\Feature;

use App\Buzz;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FooBarQixTest extends TestCase
{
	public function test_function_exists(){
		$this->assertTrue(method_exists(\App\Buzz::class, 'foobarqix'));
	}

    public function test_function_returns_string(){
    	$result = Buzz::foobarqix(2);
    	$this->assertTrue(is_string($result));
    }

    public function test_function_expects_integer(){
    	Buzz::foobarqix(3);
    	$this->assertTrue(true);

    	$this->expectException(\TypeError::class);
    	Buzz::foobarqix('not_integer');
    }

    public function test_function_expects_integer_higher_than_0(){

    	$this->expectException(\Exception::class);
    	Buzz::foobarqix(-1);

    	$this->expectException(\Exception::class);
    	Buzz::foobarqix(0);

    	Buzz::foobarqix(1);
    	$this->assertTrue(true);
    }


    public function test_1(){

    	$result = Buzz::foobarqix(1);

    	$expected = "1";

    	$this->assertEquals($expected, $result);
    }

    public function test_2(){

    	$result = Buzz::foobarqix(2);

    	$expected = "2";

    	$this->assertEquals($expected, $result);
    }

    public function test_3(){

    	$result = Buzz::foobarqix(3);

    	$expected = 'FooFoo';

    	$this->assertEquals($expected, $result);
    }

    public function test_4(){
    	$result = Buzz::foobarqix(4);
    	$expected = '4';
    	$this->assertEquals($expected, $result);
    }

    public function test_5(){
    	$result = Buzz::foobarqix(5);
    	$expected = 'BarBar';
    	$this->assertEquals($expected, $result);
    }

    public function test_6(){
    	$result = Buzz::foobarqix(6);
    	$expected = 'Foo';
    	$this->assertEquals($expected, $result);
    }

    public function test_7(){
    	$result = Buzz::foobarqix(7);
    	$expected = 'QixQix';
    	$this->assertEquals($expected, $result);
    }

    public function test_8(){
    	$result = Buzz::foobarqix(8);
    	$expected = '8';
    	$this->assertEquals($expected, $result);
    }

    public function test_9(){
    	$result = Buzz::foobarqix(9);
    	$expected = 'Foo';
    	$this->assertEquals($expected, $result);
    }

    public function test_10(){
    	$result = Buzz::foobarqix(10);
    	$expected = 'Bar*';
    	$this->assertEquals($expected, $result);
    }

    public function test_13(){
    	$result = Buzz::foobarqix(13);
    	$expected = 'Foo';
    	$this->assertEquals($expected, $result);
    }

    public function test_15(){
    	$result = Buzz::foobarqix(15);
    	$expected = 'FooBarBar';
    	$this->assertEquals($expected, $result);
    }

    public function test_20(){
    	$result = Buzz::foobarqix(20);
    	$expected = 'Bar*';
    	$this->assertEquals($expected, $result);
    }

    public function test_21(){
    	$result = Buzz::foobarqix(21);
    	$expected = 'FooQix';
    	$this->assertEquals($expected, $result);
    }

    public function test_33(){
    	$result = Buzz::foobarqix(33);
    	$expected = 'FooFooFoo';
    	$this->assertEquals($expected, $result);
    }

    public function test_51(){
    	$result = Buzz::foobarqix(51);
    	$expected = 'FooBar';
    	$this->assertEquals($expected, $result);
    }

    public function test_53(){
    	$result = Buzz::foobarqix(53);
    	$expected = 'BarFoo';
    	$this->assertEquals($expected, $result);
    }

    public function test_101(){
    	$result = Buzz::foobarqix(101);
    	$expected = '1*1';
    	$this->assertEquals($expected, $result);
    }

    public function test_303(){
    	$result = Buzz::foobarqix(303);
    	$expected = 'FooFoo*Foo';
    	$this->assertEquals($expected, $result);
    }

    public function test_105(){
    	$result = Buzz::foobarqix(105);
    	$expected = 'FooBarQix*Bar';
    	$this->assertEquals($expected, $result);
    }

    public function test_10101(){
    	$result = Buzz::foobarqix(10101);
    	$expected = 'FooQix**';
    	$this->assertEquals($expected, $result);
    }




}
