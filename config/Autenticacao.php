<?php
require_once "Config.php";
require_once "DBConnect.php";

class Autenticacao
{
    public function auth()
    {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: http://localhost/BDManagement");
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
        if (!isset($_SESSION['part_id'])) {
            return false;
        } else {
            return true;
        }
    }

    public function login($usuario, $senha)
    {
        $db = DBConnect::PDO();

        $stmt = $db->prepare("SELECT part_id FROM participantes WHERE part_usuario=? AND part_senha=?");
        $stmt->execute([$usuario, $senha]);
        if ($stmt->rowCount() > 0) {
            session_start();

            $emp = $stmt->fetchAll();

            foreach ($emp as $e) {
                $_SESSION['id'] = $e['part_id'];
                $_SESSION['usuario'] = $usuario;
                $_SESSION['senha'] = $senha;
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

    public function getParticipantesById($id)
    {
        $db = DBConnect::PDO();
        $stmt = $db->prepare("SELECT * FROM participantes WHERE part_id=?");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
}