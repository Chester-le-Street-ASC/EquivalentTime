<?php

namespace CLSASC\EquivalentTime\ConversionExceptions;

/**
 * The NegativeOutputException class
 *
 * @copyright Chester-le-Street ASC https://github.com/Chester-le-Street-ASC
 * @author Chris Heppell https://github.com/clheppell
 */
class NegativeOutputException extends \Exception {
  // Redefine the exception so message isn't optional
  public function __construct($message, $code = 0, Exception $previous = null) {
    parent::__construct($message, $code, $previous);
  }

  // custom string representation of object
  public function __toString() {
    return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
  }
}
