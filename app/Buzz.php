<?php

namespace App;

class Buzz{
	
	public static function fizz(int $number){

		if($number < 1){
			throw new \Exception('Must provide positive integer higher than 1');
		}
		
		$result = [];

		for($i=1; $i<=$number; $i++){

			$is_three = false;
			$is_five = false;

			if($i%3 == 0 || strpos((string)$i, '3') !== false){
				$is_three = true;
			}

			if($i%5 == 0 || strpos((string)$i, '5') !== false){
				$is_five = true;
			}

			if($is_three || $is_five){
				$result[] = ($is_three ? 'three' : '').($is_five ? 'five' : '');
			}else
				$result[] = $i;
		}

		return $result;
	}

	public static function foobarqix(int $number){

		if($number < 1){
			throw new \Exception("Wrong number", 1);
		}

		$result = (string)$number;

		$is_3 = $number%3 == 0;
		$is_5 = $number%5 == 0;
		$is_7 = $number%7 == 0;

		$is_divisible = $is_3 || $is_5 || $is_7;

		$result_contain = str_replace(
			['3', '5', '7'], 
			['Foo', 'Bar', 'Qix'], 
			(string)$number
		);

		$is_contains = $result_contain != (string)$number;

		if($is_contains){
			$result_contain = str_replace(  
				['1', '2', '4', '6', '8', '9', '0'],
				['',  '',  '',  '',  '',  '',  '*'],
				$result_contain
			);
		}

		if($is_divisible || $is_contains){
			$result = ($is_3 ? 'Foo' : '')
				.($is_5 ? 'Bar' : '')
				.($is_7 ? 'Qix' : '')
				.($is_contains ? $result_contain : 
					str_replace(
						['1', '2', '4', '6', '8', '9', '0'],
						['',  '',  '',  '',  '',  '',  '*'],
				 		(string)$number
				 	)
				);
		}else{
			$result = str_replace('0', '*', $result);
		}

		return $result;
	}

}