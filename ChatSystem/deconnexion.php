<?php
  session_start();
 
  header('location:connexion.php'); // Ici il faut mettre la page sur lequel l'utilisateur sera redirigé.
   session_destroy();
  exit;
?>