<?php 
	namespace Core\Interfaces;

	use PDO;

    /**
	 * 
	 */
	interface ConnectionInterface
	{
        /**
         * @return PDO
         */
        public static function connection() : PDO;

	}