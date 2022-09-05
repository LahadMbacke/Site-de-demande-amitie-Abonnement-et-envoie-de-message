<?php
 session_start();
 $id= $_SESSION['id'];
if (!isset($_SESSION['id'])) {
   header('Location: connexion.php');
}
    $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
      $req="SELECT * FROM membre WHERE Idmembre = ?";
       $res= $connect->prepare($req);
         $res->execute(array($_SESSION['id']));
           $row= $res->fetchAll();
      
         
  ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
    <link rel="stylesheet" href="chat.css?t=<?php echo time();?>">
    <meta charset="utf-8">
    <title></title>

    <style>
        #lesMembres
     {
      position: relative;
      left: 20px;
      z-index: ;
     }
    </style>
</head>
<body>
    <?php include("menu.php"); ?>
  <section id="Accueil">
         <?php
            foreach($row as $profil){
                ?>
                 <div  class="w3-card-4 w3-container w3-row profil">
                    <div class="imgProfil"> <img class="rounded-circle" src='<?php echo $profil['photo']?>'/> </div> 
                       <h2 id="nom_prenom"><?php echo $profil['prenom']." ".$profil['nom'] ?></h2>
                       <p id="statut"><?php echo $profil['statut'] ?></p>
                 </div>
                 <?php
                }
                  
             ?>
           <h2> Voici Quelques suggestions pour vous  </h2>
             <div id="resultatMembre">

            </div>

            <div style="display:flex;margin-top: -200px;" class="row">
                <?php

                   $reqq = "SELECT *  from membre WHERE Idmembre NOT IN (SELECT cible from amitie WHERE demendeur=$id)and (Idmembre NOT in(SELECT demendeur FROM amitie WHERE cible=$id)) and Idmembre!=$id"; 
                   $ress= $connect->query($reqq);
                    // $ress->execute(array($_SESSION['id']));

                while( $roww = $ress->fetch())
                 {
                    ?> 
                    <!-- <div class="col"> -->
                       <div class="col">
                                <div >

                                     <a href="voirProfil.php?id=<?= $roww['Idmembre'] ?>">
                                         <img alt="Avatar" src="<?php echo $roww['photo'];?>" width="150"/>
                                    </a>
                                     <h5><?= $roww['prenom']." ".$roww['nom'] ?></h5>
                                </div>

                       </div>
                    <!-- </div> -->
                    <?php
                }
            
         ?>
            </div>
  </section>     
      
</body>

 <script >
     
       // var recherchInput = document.querySelector("#cherche"); //recuperer le recherche
 var nom = document.querySelector("#RechercheMembre"); //recuperer le recherche
    var resultDisp = document.querySelector("#resultatMembre"); //contenir les suggesstion
    resultDisp.style.visibility="hidden";
      
     

      nom.addEventListener("keyup",function(e){
            //resultDisp.style.visibility="visible";
              //resultDisp.innerHTML=nom.value;
            

            var nt = nom.value;

           var xhr = new XMLHttpRequest();
            var url = "listMembre.php";
            xhr.open("POST",url);
             xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
              xhr.send("nom="+nt);

            xhr.onreadystatechange=function()
            {
              if (xhr.readyState == 4 && xhr.status == 200) 
                 {
                    //document.write(xhr.responseText);
                    resultDisp.innerHTML=xhr.responseText;
                    resultDisp.style.visibility="visible";
                   }
            }
      },false);

   </script>
</html>

 

