<?php
 session_start();
      // $_SESSION['id']=null; 
      //           $_SESSION["prenom"]=null;
      //           $_SESSION["nom"]=null;
       $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    #deco{
      border:0px solid blue;
      width:50%;
      margin:auto;
    }
  </style>
</head>
<body>
<?php
       try {

           $req = "SELECT * FROM membre WHERE login = ?";
           $res=$connect->prepare($req);
            $res->execute([$_POST['mylogin']]);
                 $row = $res->fetch();
             if (($_POST['mymdp']==$row['mdpasse']))
             {
                   $id=$row['Idmembre'];
                   $statut="En ligne";
                $_SESSION['id']=$row['Idmembre']; 
                $_SESSION["prenom"]=$row["prenom"];
                $_SESSION["nom"]=$row["nom"];
                 $sql="UPDATE membre set statut='$statut' where Idmembre=$id";
                 $result=$connect->query($sql);
                 if($result){
                  header("Location:my-Accueil-compte.php");  
                 }
             } else {

              ?>
              <script>  
                 alert("Indentifiant invalid!");
            </script>
            <div id="deco">
               <h1>Indentifiant invalide</h1>
               <a  href='connexion.php'><h2>Réessayer</h2></a>
             </div>
                 <?php
                 
                    }
           
       } catch (Exception $e) {
           
       }
    
  ?>




  
  
</body>
</html>




  