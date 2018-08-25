<?php

namespace CLSASC\EquivalentTime;

/**
 * Get the turns per hundred
 *
 * @copyright Chester-le-Street ASC https://github.com/Chester-le-Street-ASC
 * @author Chris Heppell https://github.com/clheppell
 */
class TurnsPerHundred {

  public static function turnsPerHundred($source_pool_length) {
		$flag;

    switch ($source_pool_length) {
			case '50m':
				$flag = 1;
				break;
			case '33.3m':
			case '33m':
			case '33 1/3m':
			case '36 2/3y':
			case '36.6y':
			case '33 1/3y':
			case '33.3y':
				$flag = 2;
				break;
			case '27 1/2y':
			case '27.5y':
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
}
