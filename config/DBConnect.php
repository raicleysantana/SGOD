<?php

require_once "Config.php";

class DBConnect
{
    public static $instance;

    const DB_SERVER = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_NAME = "sgodp";

    public static function PDO()
    {
        date_default_timezone_set('America/Manaus');

        if (empty(session_id()) && !headers_sent()) {
            session_start();
        }

        $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::DB_SERVER;

        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
            } catch (PDOException $e) {
                throw new Exception('Connection failed: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }

    public function auth()
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            header("Location:" . Config::$baseUrl);
        }
    }

    public function authLogin()
    {
        session_start();

        if (isset($_SESSION['id'])) {
            header("Location: " . Config::$baseUrl . "/admin");
        }
    }

    public function checkAuth()
    {
        session_start();
        if (!isset($_SESSION['id'])) {
            return false;
        } else {
            return true;
        }
    }

    public function login($username, $password)
    {
        session_start();

        $stmt = self::PDO()->prepare("SELECT * FROM participantes WHERE part_usuario=? AND part_senha=?");
        $stmt->execute([$username, $password]);

        if ($stmt->rowCount() > 0) {
            session_start();
            $emp = $stmt->fetchAll();
            foreach ($emp as $e) {
                $_SESSION['id'] = $e['part_id'];
                $_SESSION['usu_nome'] = $username;
            }

            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location:" . Config::$baseUrl);
    }


}

?>
