<?php
     session_start();

    $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
 // $id =htmlentities(trim($_GET['id']));
 $idE=$_SESSION['id'];

            $req="SELECT count(*) as nbr from amitie where (demendeur = :id or cible= :id) and etat=1";
           $res=$connect->prepare($req);
           $res->execute(array('id'=>$_SESSION['id']));
           $row=$res->fetch();
           echo $row['nbr'];
          
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
      <?php 
               while($row=$res->fetch()){
                     echo"<br/>";
                   if ($row['emetteur']==$_SESSION['id']) {
                      echo "<p id='E'>".$row['contenu']."</p> ";

                   }
                   else
                    echo "<p id='R'>".$row['contenu']."</p> ";
                }
      ?>
          <div class="col-sm-12" style="margin-top: 20px;">
          	  <form method="post">
          	  	<textarea placeholder="votre message......" name="msg"></textarea>
          	  	<input type="submit" name="envoyer" value="Envoyer">
          	  </form>
          </div>
  </body>

  <script >
  	
  
  </script>
  </html>