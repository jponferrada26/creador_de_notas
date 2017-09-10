<?php
  include 'manager_bbdd.php';
  $managerbbdd = new ManagerBBDD();
  $managerbbdd->removeNote($_POST['note_to_delete']);
  header('Location: ../principal.php');
?>
