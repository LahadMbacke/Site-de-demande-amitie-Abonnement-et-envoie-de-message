<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    #mdp{
      border:0px solid blue;
       margin:auto; 
      width:30%;
    }
  </style>
</head>
<body>
<?php
      session_start();
       $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");

 if (isset($_POST["mypname"]) && isset($_POST["myname"]) && isset($_POST["mylogin"]) && isset($_POST["mymdpCheck"]) && isset($_POST['mysex'])) {
         $mypname = $_POST["mypname"];
         $myname = $_POST["myname"];
         $mylogin = $_POST["mylogin"];
         $mypwd = $_POST["mymdpCheck"];
         $sex = $_POST['mysex'];
          $fic=null;
          
            if (isset($_FILES["PhotoProfil"]) and $_FILES["PhotoProfil"]['error']==0)
                                {
                                  //1. strrchr renvoie l'extension avec le point (« . »).
                                  //2. substr(chaine,1) ignore le premier caractère de chaine.
                                    //3. strtolower met l'extension en minuscules.
                                $extension_fichier = strtolower (substr(strrchr($_FILES["PhotoProfil"]["name"], '.') ,1) );
                                $extensions_ok = array('jpg','jpeg' , 'gif' , 'png' );
                                     if ( in_array($extension_fichier, $extensions_ok) )
                                       {
                                         echo "Extension correcte";
                                         echo "<br>";
                                       $MyPicture=$_FILES['PhotoProfil']['name'];//cette variable contient la photo
                                          $dhc=date("dmY_His",time());
                                      $fic="MesPhotos/".$dhc."_".$MyPicture;
                                      $res=(move_uploaded_file($_FILES['PhotoProfil']['tmp_name'], $fic));
                                            if ($res)
                                            {
                                                 // header("Location:connexion.php");
                                                 // echo '<img src="MesPhotos/'.$dhc."_".$MyPicture.' "/>'; 
                                              }
                                              else
                                                echo "Failed Uploded";

                                     }
                                 }

         

    //Insertion dans la base de donnee
    if($_POST['mymdp']==$_POST['mymdpCheck']){
      try{
      
      $req="INSERT INTO membre (prenom,nom,login,sexe,mdpasse,photo) VALUES(?,?,?,?,?,?)";
      $stmt = $connect->prepare($req);
  
   $stmt->bindParam(1, $mypname);
   $stmt->bindParam(2, $myname);
   $stmt->bindParam(3, $mylogin);
   $stmt->bindParam(4, $sex);                                    
   $stmt->bindParam(5, $mypwd);
   $stmt->bindParam(6, $fic);
   $stmt->execute(); 
   if ($stmt) {
      header("Location:connexion.php");  
   }
        
}

catch (Exception $e)
 {
   die('Erreur :'.$e->getMessage());
 }

    }

    else{
        echo "<div id='mdp'>";
             echo "<h1>la saisie est incorrect</h1><br/>";
             echo "<a  href='inscription.php'><h2>Retourner a la page d'inscription</h2></a>";
        echo"</div>";
    }
}


  ?>

  
</body>
</html>
