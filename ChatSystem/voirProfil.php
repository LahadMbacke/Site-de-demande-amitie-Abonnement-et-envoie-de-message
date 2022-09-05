<?php
    session_start();

     $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");

 

// Récupèration de l'id passer en argument dans l'URL
$id =htmlentities(trim($_GET['id']));

    // On récupère les informations de l'row grâce à son ID
        if(isset($_SESSION['id'])){
    
        $req = $connect->prepare("SELECT m.*, a.demendeur, a.cible, a.etat, a.id_bloquee
            FROM membre m
            LEFT JOIN amitie a ON (cible = m.Idmembre AND demendeur = :id2) OR (cible = :id2 AND demendeur = m.Idmembre) 
            WHERE m.Idmembre = :id1");
            
        $req->execute(array('id1' => $id, 'id2' => $_SESSION['id']));
        
    }
   $row = $req->fetch();

  // *******************************************DEMENDE AMI**************************************************

     $valid = true;

                   //On fait la demende d'amitie
                   if (isset($_POST["Demender"])) 
                     {

                             //On cherche s'il ya une relation entre demendeur et cible
                   $req="SELECT id FROM amitie WHERE (demendeur=? and cible=?) or (cible=? and demendeur=?)";
                   $res=$connect->prepare($req);
                   $res->execute(array($_SESSION['id'], $row['Idmembre'], $row['Idmembre'],$_SESSION['id']));
                   $amitie=$res->fetch();

                             if (isset($amitie["id"])) {
                                $valid=false;
                             }

                                 if ($valid) {
                                   
                                    $sql = "INSERT INTO amitie (demendeur,cible,etat) VALUES (?,?,?)";
                                    $res = $connect->prepare($sql);
                                    $res->execute(array($_SESSION['id'], $row['Idmembre'],0));
                                  header('Location: voirProfil.php?id=' .$row['Idmembre']);
                                   exit;
                                 }
                  
                      }
// ****************************************************BLOQUER***************************************************
          elseif(isset($_POST["Bloquer"]))
          {
           $sql = "INSERT INTO amitie (demendeur,cible,etat,id_bloquee) VALUES (?,?,?,?)";
                    $res = $connect->prepare($sql);
                    $res->execute(array($_SESSION['id'], $row['Idmembre'],3, $row['Idmembre']));
                    header('Location: voirProfil.php?id=' .$row['Idmembre']);
                    exit;

          }
// **************************************************ANNULER UNE DEMENDE*******************************************
                 elseif(isset($_POST["AnnuleDemend"]))
                      {
                       $req="DELETE FROM amitie WHERE (demendeur=? and cible=?) or (cible=? and demendeur=?)";
                               $res=$connect->prepare($req);
                               $res->execute(array($_SESSION['id'], $row['Idmembre'], $row['Idmembre'],$_SESSION['id']));
                               header('Location: voirProfil.php?id=' .$row['Idmembre']);
                               exit;
                      }
// ************************************************************DEBLOQUER************************************************
                       elseif(isset($_POST["Debloquer"]))
                      {
                       $req="DELETE FROM amitie WHERE (demendeur=? and cible=?) or (cible=? and demendeur=?)";
                               $res=$connect->prepare($req);
                               $res->execute(array($_SESSION['id'], $row['Idmembre'], $row['Idmembre'],$_SESSION['id']));
                              header('Location: voirProfil.php?id=' . $row['Idmembre']);
                              exit;
                      }
                      

    
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
        <title>Mon profil</title>
    </head>

    <body>
 <?php include("menu.php"); ?>

                    <div class="vpfixed">
                                <div class="w3-container w3-center">
                                      <img alt="Avatar" src="<?php echo $row['photo'];?>" width="150"/>
                                     <h5><?= $row['prenom']." ".$row['nom'] ?></h5>
            



            
                        <form method="post">
                            <?php
                                if(!isset($row['etat'])){
                            ?>
                            <input type="submit" name="Demender" value="Ajouter" class="btn btn-success">
                            <?php
                                }elseif(isset($row['etat']) && $row['demendeur'] == $_SESSION['id'] && !isset($row['id_bloquee']) && $row['etat'] != 1){
                            ?>
                            <div>Demande envoyer</div>
                            <?php
                                }elseif(isset($row['etat']) && $row['cible'] == $_SESSION['id'] && !isset($row['id_bloquee']) && $row['etat'] != 1){
                            ?>
                            <div>Vous avez une demande à accepter</div>
                            <?php   
                                }elseif(isset($row['etat']) && $row['etat'] == 1 && !isset($row['id_bloquee'])){
                            ?>
                            <div>Vous êtes amis</div>
                            <?php   
                                }
                                if(isset($row['etat']) && !isset($row['id_bloquee']) && $row['demendeur'] == $_SESSION['id'] && $row['etat'] != 1){
                            ?>      
                            <input type="submit" name="AnnuleDemend" value="Retirer la  demende" class="btn btn-warning">
                            <?php
                                }
                                if((isset($row['etat']) || $row['etat'] == NULL) && !isset($row['id_bloquee'])){
                            ?>
                            <input type="submit" name="Bloquer" value="Bloquer" class="btn btn-danger">
                            <?php
                                }
                                elseif($row['id_bloquee'] != $_SESSION['id']){
                            ?>
                            <input type="submit" name="Debloquer" value="Debloquer" class="btn btn-info">
                            <?php       
                                }else{
                            ?>
                            <div>Vous avez été bloqué </div>
                            <?php
                                }
                            ?>
                        </form>
                    </div>

                 </div>
                    
    <body>
</html>
i