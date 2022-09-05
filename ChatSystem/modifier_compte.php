<?php
session_start();
      $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");

           $receive = "SELECT * FROM membre  where Idmembre =? ";
             $resultat=$connect->prepare($receive); //permet de faire la requte preparer
              $resultat->bindParam(1, $_SESSION['id']);
              $resultat->execute();//execute la requete          
               $row = $resultat->fetch();

      ?>

  <!DOCTYPE html>
  <html>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
        <link rel="stylesheet" href="CSS/emploi.css?t=<?php echo time();?>">
        <link rel="stylesheet" href="CSS/w3.css">
    <title>Compte</title>
  <body>
         <?php
            include("menu.php");
         ?>
  
        <div class="w3-content" style="max-width:1232px; height: 415px; margin-top:-250px">
          <h3 class="w3-bottombar w3-green w3-center w3-padding">Mon compte</h3>
          <form method="post" class="w3-container w3-row-padding w3-margin-top w3-form" enctype="multipart/form-data" action="app_MJ.php" >
            <div class="w3-row-padding">
                                <div class="w3-col m6">
                                    <p> <span class="w3-bottombar">  Prénom : </span>  <input type="texte" name="prenom" value="<?php echo $row['prenom'] ?>"></p>
                                </div>
                                <div class="w3-col m6">
                                    <p> <span class="w3-bottombar">Nom : </span> <input type="texte" name="nom" value="<?php echo $row['nom'] ?>"></p>
                                </div>

                                 <div class="w3-col m6">
                                    <p> <span class="w3-bottombar">Modifier le photo profil : </span> <input type="file" name="PhotoProfil"></p>
                                </div>
                                
                            </div>
                            <br>

            <input type="submit" class="w3-padding w3-green w3-block w3-button" name="updatt" value="Enregistrer les modifications"> 
           </form>
          
        </div>


        <!-- Page footer -->
    <?php
        // include("footer.php");
    ?>
              
       

  </body>
  </html>


