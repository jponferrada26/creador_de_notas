<?php
  include 'manager_bbdd.php';
  $managerBBDD = new ManagerBBDD();
  $managerBBDD->modifyNota($_POST['titulo_antiguo'],$_POST['titulo'],$_POST['texto'],$_POST['usuario']);
?>
