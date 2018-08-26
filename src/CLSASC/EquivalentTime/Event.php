<?php

namespace CLSASC\EquivalentTime;

/**
 * Handle the Pool Length Parameters. Creates a PoolMeasFlag
 *
 * @copyright Chester-le-Street ASC https://github.com/Chester-le-Street-ASC
 * @author Chris Heppell https://github.com/clheppell
 */
class Event {
	private $ev;
	private $spl;

	/**
	 * Function to let you know if the event is allowed in the pool
	 * @param  string  $spl   the length of the source pool, ie "50m", "20m", "33 1/3m"
	 * @param  string  $event the name of the event, ie "50 Free", "200 IM"
	 * @return boolean true if event is allowed in pool, false otherwise
	 */
  public static function isAllowed($spl = null, $event = null) {
		if ($spl == null && $this->spl != null && $event ==
		null && $this->ev != null) {
			$spl = $this->spl;
			$event = $this->ev;
		}

		if ($event == "50 Free") {
			switch ($spl) {
				case '50m':
				case '25m':
				case '27 1/2y':
				case '25y':
					return true;
					break;
				default:
					return false;
			}
		} else if ($event == "100 Free") {
			return true;
		} else if ($event == "200 Free") {
			return true;
		} else if ($event == "400 Free") {
			return true;
		} else if ($event == "800 Free") {
			return true;
		} else if ($event == "1500 Free") {
			switch ($spl) {
				case '33 1/3y':
				case '20y':
					return false;
					break;
				default:
					return true;
			}
		} else if ($event == "50 Breast") {
			switch ($spl) {
				case '50m':
				case '25m':
				case '27 1/2y':
				case '25y':
					return true;
					break;
				default:
					return false;
			}
		} else if ($event == "100 Breast") {
			return true;
		} else if ($event == "200 Breast") {
			return true;
		} else if ($event == "50 Fly") {
			switch ($spl) {
				case '50m':
				case '25m':
				case '27 1/2y':
				case '25y':
					return true;
					break;
				default:
					return false;
			}
		} else if ($event == "100 Fly") {
			return true;
		} else if ($event == "200 Fly") {
			return true;
		} else if ($event == "50 Back") {
			switch ($spl) {
				case '50m':
				case '25m':
				case '27 1/2y':
				case '25y':
					return true;
					break;
				default:
					return false;
			}
		} else if ($event == "100 Back") {
			return true;
		} else if ($event == "200 Back") {
			return true;
		} else if ($event == "200 IM") {
			return true;
		} else if ($event == "400 IM") {
			return true;
		}

		return false;
  }

	/**
	 * Get the distance for the event
	 * @param  string $event the name of the event, ie "1500 Free"
	 * @return int    the distance of the event, ie 1500
	 * @throws Exception if the event is invalid

	 */
	public static function distance($event = null) {
		if ($event == null && $this->ev != null) {
			$event = $this->ev;
		}

		$distance = 0;

		switch ($event) {
			case '50 Free':
			case '50 Breast':
			case '50 Fly':
			case '50 Back':
				$distance = 50;
				break;
			case '100 Free':
			case '100 Breast':
			case '100 Fly':
			case '100 Back':
			case '100 IM':
				$distance = 100;
				break;
			case '200 Free':
			case '200 Breast':
			case '200 Fly':
			case '200 Back':
			case '200 IM':
				$distance = 200;
				break;
			case '400 Free':
			case '400 IM':
				$distance = 400;
				break;
			case '800 Free':
				$distance = 800;
				break;
			case '1500 Free':
				$distance = 1500;
				break;
		}

		if ($distance != 0) {
			return $distance;
		} else {
			throw new \Exception("Invalid event", 1);
		}
  }
}
