<?php
  class Conexion{
    public function getConexion(){
      $user = "root";
      $password = "admin";
      $host = "127.0.0.1";
      $db = "BBDD_CREADOR_NOTAS";
      return new PDO("mysql:host=$host;dbname=$db;",$user,$password);
    }
  }
?>
