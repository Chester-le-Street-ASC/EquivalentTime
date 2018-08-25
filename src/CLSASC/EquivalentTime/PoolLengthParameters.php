<?php

namespace CLSASC\EquivalentTime;

/**
 * Handle the Pool Length Parameters. Creates a PoolMeasFlag
 *
 * @copyright Chester-le-Street ASC https://github.com/Chester-le-Street-ASC
 * @author Chris Heppell https://github.com/clheppell
 */
class PoolLengthParameters {

  public static function poolMeasure($source_pool_length) {
		$flag;

    switch ($source_pool_length) {
			case '50m':
			case '33.3m':
			case '33m':
			case '33 1/3m':
			case '25m':
			case '20m':
				$flag = 1;
				break;
			case '26 2/3y':
			case '26.6y':
			case '27 1/2y':
			case '27.5y':
				$flag = 2;
				break;
			case '33 1/3y':
			case '33.3y':
			case '25y':
			case '20y':
				$flag = 3;
				break;
			default:
				$flag = 0;
		}

		return $flag;
  }
}
