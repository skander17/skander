<?php 

	namespace Core;


	use Core\Interfaces\ConnectionInterface;
    use PDO;

    /**
	 *
	 */
	class Connection implements ConnectionInterface
	{

        private  $connection = null;


        private $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_PERSISTENT => true
        ];

        function __construct()
		{
            if (!$this->connection instanceof PDO){
                $this->connection = $this->connection();
                //echo "conexion exitosa at " . microtime(true). "\n";
            }
		}
        /**
         * @return PDO
         */
		public function connection() : PDO {
            $config = $this->parse_config();
            if (!$config) {
                die('Error de conexion en base de datos');
            }
            $host = "{$config['driver']}:host={$config['host']};port={$config['port']};dbname={$config['database']}";
            return $this->connection =  new PDO($host, $config['db_user'], $config['db_password'], $this->options);
        }

        /**
         * @param string $key
         * @return mixed|null
         */
        public function config($key){
		    $config =  $this->parse_config();
		    if (isset($config->$key)){
		        return $key;
            }
		    return null;
        }

		/**
		 * @return array|null
		 */
		public function parse_config(){
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
            return $this->connection;
        }
	}