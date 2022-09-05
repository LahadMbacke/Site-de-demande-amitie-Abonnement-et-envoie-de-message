<?php
  session_start();
  if (!isset($_SESSION['id'])) {
   header('Location:connexion.php');
}

  $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root",""); 
//On cherche les personnes qui ont demendes a etre amis
  $demandes = "SELECT * FROM amitie JOIN membre ON Idmembre = demendeur WHERE cible = ? AND etat = ?";
   $res= $connect->prepare($demandes);
    $res->execute(array($_SESSION['id'], 0));
   
  $demandesAmis= $res->fetchAll();

  if(!empty($_POST)){//on controle si ce qu'on a envoye dans le poste s'il nest pas vide


// ****************************************ACCEPTER DEMENDE***************************************************
    if(isset($_POST['accepter'])){

      $Iddmend=$_POST['id_demande'];
     

      //$demendeur = (int) $demendeur;
     //On verifie si la demnde tienne toujours
      $verifier_demende = "SELECT id FROM amitie WHERE id = ? AND etat = 0 ";
      $res = $connect->prepare($verifier_demende);
      $res->execute(array($Iddmend));
      $row= $res->fetch();
      
      if(isset($row['id'])){
            //on met a jour l'etat de la rquette a acceptee
        $req = "UPDATE amitie SET etat = 1 WHERE id = ? and cible = ?";
        $res=$connect->prepare($req);
        $res->execute(array($Iddmend, $_SESSION['id']));
     
        header('Location: amis.php');
        exit;
      }
    
    }
    // *****************************************REFUSER DEMENDE**********************************************


    elseif(isset($_POST['refuser'])){
      
      $id_demande = $_POST['id_demande'];;
      
        $req = $connect->prepare("DELETE FROM amitie WHERE id = ? AND cible = ?");
        $req->execute(array($id_demande, $_SESSION['id']));    
      
      header('Location: mesDemedesAmis.php');
      exit;
    }
  }
?>
<!DOCTYPE html>
  <html>
  <head>
    <title>Demandes d'amis</title>
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text
    /css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
  </head>
   <style >
       img{
          width: 15%;
          margin: 3px;
       }
         .container{
          width: 50%;
         }
   </style>
  <body>
   
    <?php include("menu.php"); ?>

     <div style="display:flex; margin-top:-240px">
      <?php
       if ($demandesAmis) {
            foreach($demandesAmis as $md){
      ?>

      <div  class="container ">
        <form method="post" >
            <img style="width: 55%;" alt="Avatar" src='<?php echo $md['photo']?>' />
            <h3><?= $md['prenom'] . ' ' . $md['nom']?><h3>
            <input type="hidden" name="id_demande" value="<?= $md['id'] ?>"/>
          <div>
            <input type="submit" name="accepter" value="Accepter" class="btn btn-success"/>
          
            <input type="submit" name="refuser" value="Refuser" class="btn btn-danger"/>
          </div>
         
        </form>
      </li>
    </div>
      <?php
        }
      }
      else
        ?>
            <h4 style="margin-top:-300px">Vous n'avez aucune demende</h4>
          <?php 
      ?>
  </body>
  </div>
</html>