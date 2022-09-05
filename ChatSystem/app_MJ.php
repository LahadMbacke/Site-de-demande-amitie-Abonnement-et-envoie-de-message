<?php
  session_start();
  $id = $_SESSION['id'];

    $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");


try {
    
if (isset($_POST["prenom"])) {
    $prenom = $_POST["prenom"];
}

 if (isset($_POST["nom"])) {
    $nom = $_POST["nom"];
 }



             ///////////////////////////////// MMEMBRE////////////////////  
  $sql = "UPDATE membre SET nom =:nom, prenom =:prenom WHERE Idmembre=:id";
   $stmt = $connect->prepare($sql);                                  
  $stmt->bindParam(':nom', $_POST['nom']);     
  $stmt->bindParam(':prenom',$_POST['prenom']);    
  $stmt->bindParam(':id',$_SESSION['id']);
   $stmt->execute();
if ($stmt) {
    header("Location:monProfil.php");
}


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
                                      $url="MesPhotos/".$dhc."_".$MyPicture;
                                      $res=(move_uploaded_file($_FILES['PhotoProfil']['tmp_name'], $url));
                                            if ($res)
                                            {
                                                       
                                     $updatephoto = $connect->prepare('UPDATE membre SET photo = :photo WHERE Idmembre = :id');
                                      $updatephoto->execute(array(
                                         'photo' =>  $url,
                                         'id' => $_SESSION['id']
                                         ));

                                              }
                                              else
                                                echo "Failed Uploded";

                                     }
                                 }

}
 catch (Exception $e) {
    
}
?>

      
  