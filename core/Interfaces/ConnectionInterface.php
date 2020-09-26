<?php 
	namespace Core\Interfaces;

	use PDO;

    /**
	 * 
	 */
	interface ConnectionInterface
	{
		public static function connection() : PDO;

	}