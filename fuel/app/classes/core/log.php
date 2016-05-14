<?php

class Log extends Fuel\Core\Log {

	public static function _init() {
		parent::_init();
		\Config::load('log', true);
	}

	public static function write($level, $msg, $method = null) {
		$through_level = \Config::get('log.through_level');
		if ($through_level and ($level === $through_level)) {
			// convert the level to monolog standards if needed
			if (is_string($level)) {
				if (!$level = array_search($level, static::$levels)) {
					$level = 100;   // can't map it, convert it to a DEBUG
				}
			}
			static::$monolog->log($level, (empty($method) ? '' : $method . ' - ') . $msg);
			return true;
		}
		return parent::write($level, $msg, $method);
	}
}
