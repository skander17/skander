<?php 

	namespace Core;


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

        /**
         * @return PDO|null
         */

        static public function getInstance(){
            if (!self::$connection instanceof PDO){
                self::$connection = self::connection();
            }
            return self::$connection;
        }


        private static $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_PERSISTENT => true
        ];
        /**
         * @return PDO
         */
		public static function connection(): PDO{
            $config = self::parse_config();
            if (!$config) {
                die('Error en los datos de conexion en base de datos');
            }
            $host = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']}";
            return self::$connection =  new PDO($host, $config['db_user'], $config['db_password'], self::$options);
        }

        /**
         * @param string $key
         * @return mixed|null
         */
        public static function config($key){
		    $config =  self::parse_config();
		    if (isset($config->$key)){
		        return $key;
            }
		    return null;
        }

		/**
		 * @return array|null
		 */
		public static function parse_config(){
			$file_path = ROOT_PATH .  'config/config.json';
			$file = fopen($file_path, 'r');
            $file_json = fread($file,1000);
			return json_decode($file_json, true);
		}

        /**
         * @return PDO
         */
        public function getConnection()
        {
            return self::getInstance();
        }
	}