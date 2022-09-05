<?php 
session_start();

    $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
    $idE = $_SESSION['id'];
      $id = $_GET['id'];
$req="SELECT url,contenu,emetteur,destinataire from message M LEFT JOIN photo P on P.Idmessage=M.Idmessage where (emetteur,destinataire)=($idE,$id) or (emetteur,destinataire )=($id,$idE)
UNION

SELECT url,contenu,emetteur,destinataire from message M RIGHT JOIN photo P on P.Idmessage=M.Idmessage where (emetteur,destinataire)=($idE,$id) or (emetteur,destinataire )=($id,$idE)";

           $res=$connect->query($req);

         
               while($row=$res->fetch()){
                     echo"<br/>";
                   if ($row['emetteur']==$_SESSION['id']) {
                      $photo=$row['url'];

                      echo "<div class='droite'>";
                         echo $row['contenu'];
                         if($photo!=null){
                            echo "<p ><img src='$photo' width='150'/></p>";
                         }
                       
                       echo "</div>"; 
                   }

                   else{
                   
                    $photo=$row['url'];

                    
                       echo "<div class='gauch'>";
                         echo $row['contenu'];
                         if($photo!=null){
                            echo "<p ><img src='$photo' width='150'/></p>";
                         }
                       
                       echo "</div>"; 
                }
             }
             
?>
