<?php 

	namespace Core\DB;


	use Core\Config\Config;
    use Core\Interfaces\ConnectionInterface;
    use PDO;

    /**
	 *
	 */
	class DB implements ConnectionInterface
	{

        /**
         * @var null
         */
        private static $connection;

        private static $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_PERSISTENT => true
        ];

        private static function parseConfig()
        {
            return Config::get();
        }

        /**
         * @return PDO|null
         */

        static public function getInstance(){
            if (!self::$connection instanceof PDO){
                self::$connection = self::connection();
            }
            return self::$connection;
        }



        /**
         * @return PDO
         */
		public static function connection(): PDO{
            $config = self::parseConfig();
            if (!$config) {
                die('Error en los datos de conexion en base de datos');
            }
            $host = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']}";
            return self::$connection =  new PDO($host, $config['db_user'], $config['db_password'], self::$options);
        }


        /**
         * @return PDO
         */
        public function getConnection()
        {
            return self::getInstance();
        }
	}