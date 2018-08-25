<?php

namespace CLSASC\EquivalentTime;

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

  public function construct($source_pool_length, $event, $time_source) {
    // Check pool length
    $this->pool_length_flag = PoolLengthParameters::getFlag($source_pool_length);
    $this->turns_per_hundred = TurnsPerHundred::getNumber($source_pool_length);

    if ($this->pool_length_flag == 0 || $this->turns_per_hundred == 0) {
      throw new \Exception("Unknown Pool Length", 1);
    }

    // Is this event allowed for the source pool length?
    if (!EVENT::isAllowed($source_pool_length, $event)) {
      throw new \Exception("Event not allowed in this pool", 1);
    }

    // Take source pool lenth and leave or turn to 50m time
    $this->source_pool_length = $source_pool_length;
    $this->time_source = $time_source;

    if ($this->turns_per_hundred == 1) {
      $this->time_50 = $time_source;
    } else {
      // Work it out
    }
    return null;
  }
}
