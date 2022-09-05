<?php

// DEMENDE D'AMITIER
             if (isset($_POST["Demender"])) 
             {
             	echo "YESSSS";
             	   $req="INSERT INTO amitie (demendeur,cible,etat) VALUES(?,?,?)";
             	   $res=$connect->prepare($req);
             	   $res->bindParam($_SESSION['id'],$id,0);
             	    $res->execute();
             	    header("Location:voirProfil.php".$id);
             }


?>