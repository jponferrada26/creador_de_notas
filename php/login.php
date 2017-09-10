<?php
  session_start();
  include("class_conexion.php");
  $modelo = new Conexion();
  $user = $_POST['usuario'];
  $password = $_POST['password'];

  $rows[] = null;
  $conexion = $modelo->getConexion();
  $sql = "SELECT * FROM USUARIOS WHERE USUARIO = '".$user."' AND PASSWORD = '".$password."'";
  $declaracion = $conexion->prepare($sql);
  $declaracion->execute();

  while($result = $declaracion->fetch()){
    $rows[] = $result;
  }

  if(count($rows)>2){
    header('Location: ../index.html');
  }else{
    $_SESSION['usuario']=$rows[1]['USUARIO'];
    header('Location: ../principal.php');
  }
?>
