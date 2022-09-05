<?php 
session_start();
 // Si le user ne sait pas connecter
if (!isset($_SESSION['id'])) {
   header('Location: connexion.php');
}
$connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
$id=$_SESSION['id'];
   // ****************************** SELECTIONNE LES DERNIER DISCUSSION*********************
$sql="SELECT distinct destinataire from message  where emetteur=$id order by dateHeur ASC";
$result=$connect->query($sql);
                
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	

        <?php include("menu.php"); ?>
        <section style="height: 1000px;  border: 1px solid white;">
        
        <div  style="width:35% ; display: flex; padding: 3px;" >
	     <?php 
	     // ************************************ AFFICHE LA DISCUSSION ********************
                 while($row=$result->fetch())
                 {
					    $p=$row['destinataire'];
					    $req="select * from membre where Idmembre=$p";
					    $res=$connect->query($req);
					    if($ligne=$res->fetch()){

					 ?>

                        <div style="width: 40%; float: right; border: 1px solid; margin-left: 20px; margin: auto; margin-top: -300px;" >

                        <img style="width: 90px; margin-left: 25px;" class="card-img-top"  src='<?php echo $ligne['photo']?>'/> 
                          <h4 class="card-title" style="font-size: 10px;margin-left: 35px"><span><?php echo $ligne['prenom']." ".$ligne['nom']; ?></span></h4>
                          <a  style="width:101%; font-size:10px;" class="btn btn-primary" href="message.php?id=<?= $ligne['Idmembre']?>">Envoyer Message</a>
                        </div>
                  
                  <?php 

					    }
					         
					}

	?>
     </div>          
</section>

</body>
</html>