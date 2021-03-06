<?php
namespace Tools\TestCase\Utility;

use Tools\Utility\Random;
use Tools\TestSuite\TestCase;

class RandomTest extends TestCase {

	public function testInt() {
		$is = Random::int(2, 200);
		//pr($is);
		$this->assertTrue($is >= 2 && $is <= 200);
	}

	public function testArrayValue() {
		$array = [
			'x',
			'y',
			'z',
		];
		$is = Random::arrayValue($array, null, null, true);
		$this->assertTrue(in_array($is, $array));

		// non-numerical indexes
		$array = [
			'e' => 'x',
			'f' => 'y',
			'g' => 'z',
		];
		$is = Random::arrayValue($array);
		$this->assertTrue(in_array($is, $array));
	}

	public function testPwd() {
		$result = Random::pwd(10);
		$this->assertTrue(mb_strlen($result) === 10);
	}

	public function testPronounceablePwd() {
		$is = Random::pronounceablePwd(6);
		//pr($is);
		$this->assertTrue(strlen($is) === 6);

		$is = Random::pronounceablePwd(11);
		//pr($is);
		$this->assertTrue(strlen($is) === 11);
	}

	//TOOD: other tests

}
