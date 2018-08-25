<?php

namespace CLSASC\EquivalentTime;

require 'Event.php';
require 'PoolLengthParameters.php';
require 'Turns.php';
require 'PoolMeasure.php';

/**
 * A PHP Class to implement the British Swimming Equivalent Time Algorithm
 *
 * @copyright Chester-le-Street ASC https://github.com/Chester-le-Street-ASC
 * @author Chris Heppell https://github.com/clheppell
 */
class EquivalentTime {
  private $source_pool_length;
  private $target_pool_length;
  private $time_source;
  private $time_50;
  private $time_target;
  private $event;
  private $pool_length_flag;
  private $turns_per_hundred;

  public function __construct($source_pool_length, $event, $time_source) {
    // Check pool length
    $this->pool_length_flag = PoolLengthParameters::getFlag($source_pool_length);
    $this->turns_per_hundred = Turns::perHundred($source_pool_length);

    if ($this->pool_length_flag == 0 || $this->turns_per_hundred == 0) {
      throw new \Exception("Unknown Pool Length", 1);
    }

    // Is this event allowed for the source pool length?
    if (!EVENT::isAllowed($source_pool_length, $event)) {
      throw new \Exception("Event not allowed in this pool", 1);
    }

    $this->event = $event;

    // Verify the time at this step
    //

    // Take source pool lenth and leave or turn to 50m time
    $this->source_pool_length = $source_pool_length;
    $this->time_source = $time_source;

    if ($this->turns_per_hundred == 1) {
      $this->time_50 = $time_source;
    } else {
      // Get PoolMeasure
      $pool_measure = PoolMeasure::getValue($this->source_pool_length, $this->event);

      $distance = EVENT::distance($this->event);
      $d1;
      // Numb turn factor
      if ($distance == 1500 && $this->pool_length_flag == 3) {
        $d1 = 1650; // Yards Equivalent !!! UNKNOWN MEANING
      } else {
        $d1 = $distance;
      }

      $num_turn_factor = $distance/100*($d1/100)*($this->turns_per_hundred-1);
      $turn_factor = Turns::getFactor($this->event);

      $this->time_50 = ($this->time_source + sqrt($this->time_source *
      $this->time_source + 4 * $pool_measure * $turn_factor * $num_turn_factor)) /
      (2 * $pool_measure);
    }
  }
}

try {
  $obj = new EquivalentTime("25m", "100 Free", 55.12);
} catch (Exception $obj) {
  var_dump($obj);
}
var_dump($obj);
