<?php
  session_start();

  $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root",""); 
//On cherche les personnes qui ont demendes a etre amis
  $demandes = "SELECT * FROM amitie JOIN membre ON Idmembre = demendeur WHERE cible = ? AND etat = ?";
   $res= $connect->prepare($demandes);
    $res->execute(array($_SESSION['id'], 0));
   
  $demandesAmis= $res->fetchAll();

  if(!empty($_POST)){//on controle si ce qu'on a envoye dans le poste s'il nest pas vide

    if(isset($_POST['accepter'])){

      $Iddmend=$_POST['id_demande'];
      // echo $demendeur;

      //$demendeur = (int) $demendeur;
     //On verifie si la demnde tienne toujours
      $verifier_demende = "SELECT * FROM amitie WHERE Idinv= ?";
      $res = $connect->prepare($verifier_demende);
      $res->execute(array($Iddmend));
     
      $row= $res->fetch();
      
      if(isset($row['demendeur'])){
            //on met a jour l'etat de la rquette a acceptee
        $req = "UPDATE amitie SET etat = ? WHERE demendeur = ?";
        $res=$connect->prepare($req);
          $res->execute(array(1, $row['demendeur']));
     
        //header('Location: mesDemendesAmis.php');
        exit;
      }
    
    }elseif(isset($_POST['refuser'])){
 
       $Iddmend=$_POST['id_demande'];
       //Si la cible decide de ne pas accepter la demende
      $del="DELETE FROM etat WHERE Idinv = ?";
      $supp=$connect->prepare($del);
      $supp->execute(array($Iddmend));
      header('Location:mesDemedesAmis.php');
      exit;
    }
  }
?>
<!DOCTYPE html>
  <html>
  <head>
    <title>Demandes d'amis</title>
  </head>
  <body>
    <table>
      <tr>
        <th>Nom prénom</th>
        <th></th>
        <th></th>
      </tr>
      <?php
        foreach($demandesAmis as $md){
      ?>
      <tr>
        <form method="post">
          <td>
            <?= $md['nom'] . ' ' . $md['prenom']?>
            <input type="hidden" name="id_demande" value="<?= $md['Idinv']?>"/>
          </td>
          <td>
            <input type="submit" name="accepter" value="Accepter"/>
          </td>
          <td>
            <input type="submit" name="refuser" value="Refuser"/>
          </td>
        </form>
      </tr>
      <?php
        }
      ?>
    </table>
  </body>
</html>