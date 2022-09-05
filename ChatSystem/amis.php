<?php 
 session_start(); 
 if (!isset($_SESSION['id'])) {
   header('Location: connexion.php');
}
 
 ?>
   <!DOCTYPE html>
   <html>
   <head>
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
  <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
  <link rel="stylesheet" href="chat.css?t=<?php echo time();?>">
     <meta charset="utf-8">
     <title></title>
   </head>
   <body>
    <?php include("menu.php"); ?>
<div style="display: flex; margin-top: -260px;">
<?php 
  
   $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
 
  if (!isset($_SESSION['id'])){
      header('Location:connexion.php');
      exit;
    }

     $id = $_SESSION['id'];



    $sql = "select * from amitie";
    $res=$connect->query($sql);
       while($row=$res->fetch())
       {
            if ($row["demendeur"]==$id and $row["etat"]==1) {
              $c=$row["cible"];
             $sqll = " select * from membre where Idmembre = $c";
             $ress=$connect->query($sqll);
      ?>        
       <?php
               // echo "yesssssssssssss";
           while($membre=$ress->fetch())
          {
             ?>

                   <div class="card " style="width:35% ; text-align: margin: auto;" >
                        <div style="width: 25%; float: right;" class="card-body">

                        <img style="width: 100px;" class="card-img-top"  src='<?php echo $membre['photo']?>'/> 
                          <h4 class="card-title" style="font-size: 15px"><?php echo $membre['prenom']." ".$membre['nom']; ?></h4>
                          <p><em style="color:green"><?php echo $membre['statut'];?></em></p>
                          <a style="width:150%; font-size:10px;" class="btn btn-primary" href="message.php?id=<?= $membre['Idmembre']?>">Envoyer Message</a>
                        </div>
                  </div>


                
                 <?php
            }
          
          ?>
<?php 


        }

            elseif ($row["cible"]==$id and $row["etat"]==1) {
              $d= $row["demendeur"];
             $sqll = "select * from membre where Idmembre = $d";
             $rest=$connect->query($sqll);
              ?>        
       <?php
               // echo "yesssssssssssss";
           while($membre=$rest->fetch())
          {
             ?>

                    <div class="card hisFixed" style="width:35%" >
                        <div style="width: 25%; float: right;" class="card-body">

                        <img style="width: 100px;" class="card-img-top"  src='<?php echo $membre['photo']?>'/> 
                          <h4 class="card-title" style="font-size: 15px"><?php echo $membre['prenom']." ".$membre['nom']; ?></h4>
                          <!-- <p class="card-text">Some example text.</p> -->
                          <a style="width:150%; font-size:10px;" class="btn btn-primary" href="message.php?id=<?= $membre['Idmembre']?>">Envoyer Message</a>
                        </div>
                  </div>

                 <?php
            }
          }
        }   
 ?>
</div>


   </body>
   </html>