<?php 
	namespace Core\Interfaces;

	use PDO;

    /**
	 * 
	 */
	interface ConnectionInterface
	{
		public function connection() : PDO;

	}