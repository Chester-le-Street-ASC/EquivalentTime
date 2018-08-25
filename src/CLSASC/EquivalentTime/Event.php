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
}
