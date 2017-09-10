<?php
  session_start();
  include 'manager_bbdd.php';
  $managerBBDD = new ManagerBBDD();
  $managerBBDD->modifyUsuario($_POST['email'],$_SESSION['usuario']);
?>
