<?php

namespace CLSASC\EquivalentTime;

/**
 * Get the turns per hundred
 *
 * @copyright Chester-le-Street ASC https://github.com/Chester-le-Street-ASC
 * @author Chris Heppell https://github.com/clheppell
 */
class Turns {

  /**
   * Returns the number of turns per hundred in a pool
   * @param  string $source_pool_length the source pool length, ie "50m", "25y"
   * @return int the number of turns per hundred
   */
  public static function perHundred($source_pool_length) {
		$flag;

    switch ($source_pool_length) {
			case '50m':
				$flag = 1;
				break;
			case '33 1/3m':
			case '36 2/3y':
			case '33 1/3y':
				$flag = 2;
				break;
			case '27 1/2y':
			case '25m':
			case '25y':
				$flag = 3;
				break;
			case '20y':
			case '20m':
				$flag = 4;
				break;
			default:
				$flag = 0;
		}

		return $flag;
  }

  /**
   * Get the turn factor, the key ingredient in conversions
   * @param  string $event The event name, ie "400 IM"
   * @return double turn factor
   */
	public static function getFactor($event) {
		$turn_factor;

		switch ($event) {
			case '50 Free':
			case '100 Free':
				$turn_factor = 42.245;
				break;
			case '200 Free':
				$turn_factor = 43.786;
				break;
			case '400 Free':
				$turn_factor = 44.233;
				break;
			case '800 Free':
				$turn_factor = 45.525;
				break;
			case '1500 Free':
				$turn_factor = 46.221;
				break;
			case '50 Breast':
			case '100 Breast':
				$turn_factor = 63.616;
				break;
			case '200 Breast':
				$turn_factor = 66.598;
				break;
			case '50 Fly':
			case '100 Fly':
				$turn_factor = 38.269;
				break;
			case '200 Fly':
				$turn_factor = 39.76;
				break;
			case '50 Back':
			case '100 Back':
				$turn_factor = 40.5;
				break;
			case '200 Back':
				$turn_factor = 41.98;
				break;
			case '200 IM':
				$turn_factor = 49.7;
				break;
			case '400 IM':
				$turn_factor = 55.366;
				break;
			default:
				$turn_factor = 0;
				break;
		}

		if ($turn_factor == 0) {
			throw new \Exception("Unknown event", 1);
		}

		return $turn_factor;
  }
}
