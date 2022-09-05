<?php
    session_start();

     $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");

    // if (!isset($_SESSION['id'])){
    //     header('Location: index.php'); 
    //     exit;
    // }

    // Récupèration de l'id passer en argument dans l'URL
    $id =htmlentities(trim($_GET['id']));

    // On récupère les informations de l'utilisateur grâce à son ID
    $req="SELECT *  FROM membre WHERE Idmembre = ?";
        $afficher_profil = $connect->prepare($req);
        $afficher_profil->execute(array($id));    
    $afficher_profil = $afficher_profil->fetch();


  //DEMENDE AMI

            //On cherche s'il ya une relation entre demendeur et cible
    $req="SELECT * FROM amitie WHERE demendeur=? and cible=?";
                   $res=$connect->prepare($req);
                   $res->execute(array($_SESSION['id'],$id));
                   $amitie=$res->fetch();




                   //On fait la demende d'amitie
                   if (isset($_POST["Demender"])) 
                     {
                        // echo "string";
                        $sql = "INSERT INTO amitie (demendeur,cible,etat) VALUES (?,?,?)";
                       $res = $connect->prepare($sql);
                       $res->execute(array($_SESSION['id'],$id,0));
                        $res->closeCursor();
                       // header("Location:voirProfil.php");
                        
                      }

    
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mon profil</title>
    </head>

    <body>
        <h2>Voici le profil de <?= $afficher_profil['nom'] . " " .  $afficher_profil['prenom']; ?></h2>

        <div>Quelques informations sur lui : </div>
            <ul>
                <li>Votre id est : <?= $afficher_profil['Idmembre'] ?></li>
            </ul>



            <form method="post">

                <?php
                 if (!isset($amitie['etat'])) {
                     echo ' <input type="submit" name="Demender" value="Ajouter ami">';
                  } 

                  elseif($amitie['etat']==0)
                    echo "<span>Demende en attente </span>";
                       elseif($amitie['etat']==1)
                           echo "<span>Demende acceptee </span>";
                             elseif($amitie['etat']==-1)
                                echo "<span>Demende en rejetee </span>";
                                    elseif($amitie['etat']==-2)
                                        echo "<span>Demende bloquee </span>";

                           
                 ?>
                
            </form>
    <body>
</html>
























