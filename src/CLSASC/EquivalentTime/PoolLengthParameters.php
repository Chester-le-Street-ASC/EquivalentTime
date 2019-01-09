<?php

namespace CLSASC\EquivalentTime;

use CLSASC\EquivalentTime\ConversionExceptions\UndefinedPoolLengthException;

/**
 * Handle the Pool Length Parameters. Creates a PoolMeasFlag
 *
 * @copyright Chester-le-Street ASC https://github.com/Chester-le-Street-ASC
 * @author Chris Heppell https://github.com/clheppell
 */
class PoolLengthParameters {

  /**
   * gets the pool length flag for use later
   * @param string $source_pool_length Source pool length, ie "50m", "25m"
   * @return int integer flag value
   */
  public static function getFlag($source_pool_length) {
		$flag = null;

    switch ($source_pool_length) {
			case '50m':
			case '33 1/3m':
			case '25m':
			case '20m':
				$flag = 1;
				break;
			case '26 2/3y':
			case '27 1/2y':
				$flag = 2;
				break;
			case '33 1/3y':
			case '25y':
			case '20y':
				$flag = 3;
				break;
			default:
				$flag = null;
		}

    if ($flag == null) {
      throw new UndefinedPoolLengthException();
    }

		return $flag;
  }
}
