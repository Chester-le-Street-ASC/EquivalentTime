<?php

namespace CLSASC\EquivalentTime;

use CLSASC\EquivalentTime\ConversionExceptions\UncateredConversionException;

/**
 * Get the turns per hundred
 *
 * @copyright Chester-le-Street ASC https://github.com/Chester-le-Street-ASC
 * @author Chris Heppell https://github.com/clheppell
 */
class PoolMeasure {

  /**
   * gets the value of the pool measure, used for conversions with non-metric
   * pools
   * @param  string $length length of pool
   * @param  string $event  event (required for 33 1/3y, 25y and 20y pools)
   * @return double pool measure
   */
  public static function getValue($length, $event = null) {
		$poolMeasure = null;

    switch ($length) {
			case '50m':
      case '33 1/3m':
      case '25m':
      case '20m':
				$poolMeasure = 1;
				break;
			case '36 2/3y':
			case '27 1/2y':
				$poolMeasure = 1.006041;
				break;
			case '33 1/3y':
			case '25y':
			case '20y':
				$poolMeasure = 10001;
				break;
			default:
        $poolMeasure = 10000;
		}

    if ($poolMeasure == 10001 && $event != null) {
      switch ($event) {
  			case '50 Free':
        case '50 Breast':
        case '50 Fly':
        case '50 Back':
  				$poolMeasure = 0.91147;
  				break;
        case '100 Free':
  				$poolMeasure = 0.91087;
  				break;
        case '200 Free':
  				$poolMeasure = 0.91157;
  				break;
        case '400 Free':
  				$poolMeasure = 0.91197;
  				break;
        case '800 Free':
  				$poolMeasure = 0.91217;
  				break;
        case '1500 Free':
  				$poolMeasure = 1.004155;
  				break;
        case '100 Breast':
  				$poolMeasure = 0.90895;
  				break;
        case '200 Breast':
        case '100 Fly':
  				$poolMeasure = 0.91097;
  				break;
        case '200 Fly':
  				$poolMeasure = 0.91177;
  				break;
        case '100 Back':
  				$poolMeasure = 0.91187;
  				break;
        case '200 Back':
  				$poolMeasure = 0.91247;
  				break;
        case '200 IM':
  				$poolMeasure = 0.90443;
  				break;
        case '400 IM':
  				$poolMeasure = 0.91046;
  				break;
  		}
    }

    if ($poolMeasure == null) {
      throw new UncateredConversionException();
    }

		return $poolMeasure;
  }
}
