<?php

namespace CLSASC\EquivalentTime;

require_once 'Event.php';
require_once 'PoolLengthParameters.php';
require_once 'Turns.php';
require_once 'PoolMeasure.php';
require_once 'ConversionExceptions/IllegalEventException.class.php';
require_once 'ConversionExceptions/NegativeOutputException.class.php';
require_once 'ConversionExceptions/UncateredConversionException.class.php';
require_once 'ConversionExceptions/UndefinedPoolLengthException.class.php';

use CLSASC\EquivalentTime\ConversionExceptions\IllegalEventException;
use CLSASC\EquivalentTime\ConversionExceptions\NegativeOutputException;
use CLSASC\EquivalentTime\ConversionExceptions\UncateredConversionException;
use CLSASC\EquivalentTime\ConversionExceptions\UndefinedPoolLengthException;

/**
 * A PHP Class to implement the British Swimming Equivalent Time Algorithm
 *
 * @copyright Chester-le-Street ASC https://github.com/Chester-le-Street-ASC
 * @author Chris Heppell https://github.com/clheppell
 */
class EquivalentTime {
  private $source_pool_length;
  private $time_source;
  private $time_50;
  private $event;
  private $distance;
  private $pool_length_flag;
  private $turns_per_hundred;
  private $formattedString;

  /**
   * The constructor for a time object. This will contain the information about
   * the source pool and time, as well as T50
   * @param string $source_pool_length descibes the length of the source pool,
   * ie "50m"
   * @param string $event              describes the event, ie "50 Free"
   * @param double $time_source        time in the source pool as a double eg
   * 62.56 or 27.59
   * @throws IllegalEventException if the event was not recognised or is not
   * allowed
   * @throws NegativeOutputException if the output time or a section of the output
   * time is negative (hence illegal)
   * @throws UncateredConversionException if a conversion for this event/pool has
   * not been implemented or is not provided for in the SPORTSYSTEMS/ASA
   * specification for this converter
   * @throws UndefinedPoolLengthException if the source pool length or requested
   * conversion length does not exist
   */
  public function __construct($source_pool_length, $event, $time_source) {
    $this->formattedString = false;
    // Check pool length
    $this->pool_length_flag = PoolLengthParameters::getFlag($source_pool_length);
    $this->turns_per_hundred = Turns::perHundred($source_pool_length);

    if ($this->pool_length_flag == 0 || $this->turns_per_hundred == 0) {
      throw new UndefinedPoolLengthException();
    }

    // Is this event allowed for the source pool length?
    if (!EVENT::isAllowed($source_pool_length, $event)) {
      throw new IllegalEventException();
    }

    $this->event = $event;

    if (gettype($time_source) == "integer") {
      $time_source = (float) $time_source;
    }

    // Verify the time at this step
    if (gettype($time_source) != "double") {
      throw new \InvalidArgumentException();
    }

    if ($time_source < 0) {
      throw new \InvalidArgumentException();
    }

    // Take source pool lenth and leave or turn to 50m time
    $this->source_pool_length = $source_pool_length;
    $this->time_source = $time_source;

    if ($this->turns_per_hundred == 1) {
      $this->time_50 = $time_source;
      $this->distance = EVENT::distance($this->event);
    } else {
      // Get PoolMeasure
      $pool_measure = PoolMeasure::getValue($this->source_pool_length, $this->event);

      $this->distance = EVENT::distance($this->event);

      $d1;
      // Numb turn factor
      if ($this->distance == 1500 && $this->pool_length_flag == 3) {
        $d1 = 1650; // Yards Equivalent !!! UNKNOWN MEANING
      } else {
        $d1 = $this->distance;
      }

      if (($d1 == 1650 && $this->turns_per_hundred%2 == 0) || ($this->event ==
      "200 IM" && $this->turns_per_hundred%2 == 0) || ($d1 == 50 &&
      $this->turns_per_hundred%2 == 0)) {
        throw new UncateredConversionException();
      }

      $num_turn_factor = $this->distance/100*($d1/100)*($this->turns_per_hundred-1);
      $turn_factor = Turns::getFactor($this->event);

      $this->time_50 = ($this->time_source + sqrt($this->time_source *
      $this->time_source + 4 * $pool_measure * $turn_factor * $num_turn_factor)) /
      (2 * $pool_measure);
    }
  }

  /**
   * Method to get a conversion
   *
   * @author Chris Heppell https://github.com/clheppell
   * @param string $target_pool_length string representing the length of pool to
   * convert the time to
   * @throws IllegalEventException if the event was not recognised or is not
   * allowed
   * @throws NegativeOutputException if the output time or a section of the output
   * time is negative (hence illegal)
   * @throws UncateredConversionException if a conversion for this event/pool has
   * not been implemented or is not provided for in the SPORTSYSTEMS/ASA
   * specification for this converter
   * @throws UndefinedPoolLengthException if the source pool length or requested
   * conversion length does not exist
   */
  public function getConversion($target_pool_length) {
    $pool_length_flag = PoolMeasure::getValue($target_pool_length, $this->event);
    $pool_measure = PoolMeasure::getValue($target_pool_length, $this->event);
    $turns_per_hundred = Turns::perHundred($target_pool_length);
    $turn_factor = Turns::getFactor($this->event);

    // Test for special case 1500 in yards pool
    $imperial_distance = $this->distance;
    if ($this->distance == 1500 && $this->pool_length_flag == 3) {
      $imperial_distance = 1650;
    }

    $turn_value = $turn_factor / $this->time_50 * ($this->distance / 100);

    $dist_time = $this->time_50 * $pool_measure;
    $turn_time = $turn_value * ($imperial_distance / 100) * ($turns_per_hundred - 1);
    $conversion_time = $dist_time - $turn_time + 0.05;

    $floored_time = floor(($conversion_time*10))/10;

    if ($this->formattedString) {
      $seconds = (int) $floored_time;
      $mins = (int) ($seconds / 60);
      $hunds = $floored_time - $seconds;
      $seconds = $seconds - $mins*60;
      if ($seconds < 0 || $mins < 0 || $seconds < 0) {
        throw new NegativeOutputException();
      } else {
        return sprintf('%02d', $mins) . ":" . sprintf('%02d', $seconds) . ":" . round($hunds*10, 1);
      }
    } else {
      if ($floored_time < 0) {
        throw new NegativeOutputException();
      }
      return $floored_time;
    }
  }

  /**
   * Set the output type for conversions to a string. Default is false (output
   * as float/double)
   *
   * @author Chris Heppell https://github.com/clheppell
   * @param boolean $boolean set true to output conversion as a string, false to
   * output a float (double)
   */
  public function setOutputAsString($boolean = true) {
    $this->formattedString = $boolean;
  }

  /**
   * Set the output type for conversions to a string. Default is false (output
   * as float/double)
   *
   * @author Chris Heppell https://github.com/clheppell
   * @param boolean $boolean set true to output conversion as a string, false to
   * output a float (double)
   */
  public function setOutputAsReal() {
    $this->setOutputAsString(false);
  }
}
