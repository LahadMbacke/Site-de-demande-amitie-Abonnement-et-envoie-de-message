<?php
 session_start();             
  ?>
<?php 
    $id=null;
  $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
      if (isset($_POST["Id"]))
       {
        $id = $_POST["Id"];

        
        $req = "SELECT * from membre WHERE Idmembre=$id ";
        $Res=$connect->query($req);
                         while ($ligne=$Res->fetch()) 
                         {
                            //echo "<img src='".$ligne['photo']."'>";
                           echo $ligne["nom"];
                             echo "<br>";
                            echo $ligne["prenom"];
                         }

      }

             if (isset($_POST["Demender"])) 
             {
                echo "string";
               $sql = "INSERT INTO amitie (demendeur,cible,etat) VALUES (?,?,?)";
              $res = $connect->prepare($sql);
              $res->execute(array($_SESSION['id'],$id,0));
               echo $id;
               $res->closeCursor();
                header("Location:voirProfil.php");
            }
                   
                       $req="SELECT * FROM amitie WHERE demendeur=? and cible=?";
                   $res=$connect->prepare($req);
                   $res->execute(array($_SESSION['id'],$id));
                   $amitie=$res->fetch();
                    // $res->closeCursor();
                   echo "string";
                 // header("Location:voirProfil.php");
              
?>

  <!DOCTYPE html>
  <html>
  <head>
  	<meta charset="utf-8">
  	<title></title>
  </head>
  <body>
  	
  	<form method="post">
       <?php

            if (!isset($amitie['Idinv'])) 
            {
               echo '<input type="submit" name="Demender" value="Demende ami">';
            }
                   
            elseif($amitie['etat']==0) 
                     echo '<span>En attente</span>';
                       elseif($amitie['etat']==1) 
                       echo '<p>demende acceptee</p>';
                    elseif($amitie['etat']==-1) 
                        echo '<p>demende rejetee</p>';
                      else
                          echo '<p>vous etes bloques</p>';
         ?> 
    </form>
               
  </body>
  </html>

 <div class=" w3-row-padding">
                    <div class="w3-col">
                       <img class=""> src='<?= $profil['photo']?>'/> 
                    </div>
                       <h2><?= $profil['prenom']." ".$profil['nom'] ?></h2>
                 </div>














                   $req="SELECT * FROM membre WHERE Idmembre=?";
                   $res=$connect->prepare($req);
                   $res->execute(array($_SESSION['id']));
                      if ($membre=$res->fetch())
                       {
                         $req="SELECT * FROM amitie join membre WHERE (demendeur=? or cible=?) and etat=?"; 
                              $res=$connect->prepare($req);
                                $res->execute(array($_SESSION['id'],$_SESSION['id'],1));   
                                  if($res->rowCount() > 0)
                                  {
                                           while($ami=$res->fetch())
                                               {
                                                  echo $ami['prenom'];
                                                }
                                  }
                                  else
                                  {
                                    echo "Vous n'avez pas d'amis";
                                  }
                        }



                        //RECUPPPPPPPP IDDDD
                        id = <?php echo json_encode($id); ?>;//recupere l'ID du destinataire









                        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



                        <?php
     session_start();

    $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
$id =htmlentities(trim($_GET['id']));
 // $_SESSION['id_dest'] = $id =htmlentities(trim($_GET['id']));
 // echo $_SESSION['id_dest'];
 $idE=$_SESSION['id'];

            $req="SELECT *  FROM membre WHERE Idmembre = ?";
        $res = $connect->prepare($req);
        $res->execute(array($id));    
    $row= $res->fetch();
                 while($row=$res->fetch())
                 {
                  echo "string";
                   echo $row['prenom']." ".$row['nom'];
                 }
               

     if (isset($_POST['envoyer']))
      {
        $message = $_POST['msg'];
         $dateMess = date("Y-m-d h:i:s");;
           $req="INSERT INTO message(contenu,emetteur,destinataire,dateHeur) VALUES(?,?,?,?)";
           $res=$connect->prepare($req);
           $res->bindParam(1,$message);
           $res->bindParam(2,$_SESSION['id']);
           $res->bindParam(3,$id);
           $res->bindParam(4,$dateMess);
           $res->execute();
      }




           //       $req="SELECT * from message where (emetteur,destinataire)=($idE,$id) or ( emetteur,destinataire )=($id,$idE)";
           // $res=$connect->query($req);
           // // $res->execute(array('idE'=>$_SESSION['id'],'idD'=>$id));
           // $row=$res->fetch();
          


          //MES AMIS AVEC QUI J'AI DISCUTES AU MOINS UNE FOIS


       $req="SELECT distinct prenom,nom from message join membre where (emetteur,destinataire)=($idE,Idmembre) or ( emetteur,destinataire )=(Idmembre,$idE)";
                $ress=$connect->query($req);
                $row=$ress->fetch();
                  
                   

          
  ?>




  <!DOCTYPE html>
  <html>
  <head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="chat.css?t=<?php echo time();?>">
    <meta charset="utf-8">
    <title></title>
   
  </head>
  <body>
   <script src="jquery-3.6.0.min.js"></script>


   <div id="fil_messages">
       <?php 
            while($row=$ress->fetch())
                  {
                   echo "<div class='gauch'>
                         <p >".$row['prenom']." ".$row['nom']."</p>
                             </div> ";
                  }
       ?>
   </div>
                <!-- <?php 
                  while($row=$res->fetch())
                  {
                     echo "string";
                   echo $row['prenom']." ".$row['nom'];
                  }
               ?>  -->

      
               <div class="w3-card mysms"  id="load">
                <div id="alignement">
                <div  id='charger-message'></div>
                    
                </div>
      


          <div class="col-sm-12" style="margin-top: 20px;">
              <form method="post" id="envoyer">
            <div class="input-group ">

                <textarea class="form-control" placeholder="votre message......" name="msg" id="msg"></textarea>
                <span class="input-group-btn">
                <input class="btn btn-info " type="submit" name="envoyer" value="Envoyer">
                 </span>
             </div><!-- /input-group -->

              </form>

              </div>
          </div>
    


 

           
      <script >
         var scrollDown=function(){
            var chargeChat = document.getElementById('load');
             chargeChat.scrollTop=chargeChat.scrollHeight;
                 }
         $(document).ready(function(){
         scrollDown();            
        
   setInterval(chargMess, 2000); //apppel de la fonction qui charge les messages dans le div
                
  function chargMess(){
    id = <?php echo($id); ?>;//recupere l'ID du destinataire
    info ='?id='+id;
    var xhr=new XMLHttpRequest();
    var url="affiche_message.php";
    url+=info;
    xhr.open('GET',url);
  xhr.send(null);

  xhr.onreadystatechange=function()
  {
  
  if (xhr.readyState == 4 && xhr.status == 200) 
      {
        //document.write(xhr.responseText);
        document.querySelector("#charger-message").innerHTML=xhr.responseText;
        // document.getElementById('load').scrolltop=document.getElementById('load');
         scrollDown();
      }
    }
 };

   });

           
      </script>
  </body>
  
        
  </html>



  <!-- :::::::::::::::::::::::::::::::::::::::::::LISTE MEMBRES::::::::::::::::::::::::::::::::::::::::::::: -->






  
<?php
  session_start();
 $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
 
  if (!isset($_SESSION['id'])){
    header('Location: index.php');
    exit;
  }
  
  // On récupère tous les utilisateurs sauf l'utilisateur en cours
  $req="SELECT * FROM membre WHERE Idmembre <> ?";
  $afficher_profil = $connect->prepare($req);
    $afficher_profil->execute(array($_SESSION['id']));
  $afficher_profil = $afficher_profil->fetchAll(); // fetchAll() permet de récupérer plusieurs enregistrements
?>
 

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Utilisateurs du site</title>
    </head>

    <body>      
        <!-- <div>Utilisateurs</div> -->
        <table>
            <tr>
                <th>Nom</th> 
                <th>Prénom</th>
                <th>Voir le profil</th>
            </tr>
            <?php
                // Foreach agit comme une boucle mais celle-ci s'arrête de façon intelligente. 
                // Elle s'arrête avec le nombre de lignes qu'il y a dans la variable $afficher_profil

                // La variable $afficher_profil est comme un tableau contenant plusieurs valeurs
                // pour lire chacune des valeurs distinctement on va mettre un pointeur que l'on appellera ici $ap
                foreach($afficher_profil as $ap){
                    ?>
                        <tr>          
                            <td><?= $ap['nom'] ?></td>
                            <td><?= $ap['prenom'] ?></td>
                            <td><a href="voirProfil.php?id=<?= $ap['Idmembre'] ?>">Aller au profil</a></td>
                        </tr>
                    <?php
                }
            ?>
        </table>
    </body>
</html>


