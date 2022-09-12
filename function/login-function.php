<?php 

    // เชื่อมฐานข้อมูล
    define('DB_SERVER', '192.168.0.208');
    define('DB_USER', 'root');
    define('DB_PASS', 'sd11087');
    define('DB_NAME', 'sd_den_calendar');
    
    class DB_con {

        function __construct() {
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
            $this->dbcon = $conn;

            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL : " . mysqli_connect_error();
            }
        }

        // main funtion crud

        // คิวรีข้อมูล
        public function fetchdata() {
            $result = mysqli_query($this->dbcon, "SELECT * FROM users");
            return $result;
        }

        // main funtion crud

        public function login($username, $password) {
            $loginquery = mysqli_query($this->dbcon, "SELECT * FROM users WHERE username = '$username' AND password = '$password'");
            return $loginquery;
        }


    }
    

?>