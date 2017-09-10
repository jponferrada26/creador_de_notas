<?php
  include 'manager_bbdd.php';
  $managerBBDD = new ManagerBBDD();
  $managerBBDD->newNota($_POST['titulo'],$_POST['texto'],$_POST['usuario']);
?>
