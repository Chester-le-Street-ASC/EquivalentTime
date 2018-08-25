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

  public function construct($source_pool_length, $time_source) {
    // Take source pool lenth an leave or turn to 50m time
    $this->source_pool_length = $source_pool_length;
    $this->time_source = $time_source;

    if ($this->source_pool_length == "50M") {
      $this->time_50 = $time_source;
    } else {
      // Work it out
    }
    return null;
  }
}
