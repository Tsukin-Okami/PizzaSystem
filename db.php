<?php

$host = "localhost";
$dbname = "pizzaria";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $th) {
    die("Erro ao conectar: " . $e->getMessage());
}

/*
class Connection
{
    public static $instance;

    public static function getConnection()
    {
        if (!isset($instance)) {
            try {
                self::$instance = new PDO("mysql:host=localhost;dbname=Concessionaria", "root", "");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro ao conectar: " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function closeConnection()
    {
        self::$instance = null;
    }
}
$conn = (new Connection)->getConnection();
*/