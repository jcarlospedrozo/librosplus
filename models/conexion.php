<?php

class Conexion
{
    static public function conectar()
    {
        $servername = "localhost";
        $username = "root";
        $pass = "";
        
        try {
            $conn = new PDO("mysql:host=$servername;dbname=librosplus", $username, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }
}
