<?php 
 $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");
$dhcp=date('H:i:s');
$id=$_SESSION['id'];
if(isset($_POST['submit'])){
     $statut="hors ligne depuis $dhcp ";
     $sql="UPDATE membre set statut='$statut' where Idmembre=$id";
     $result=$connect->query($sql);
      header("Location:connexion.php");
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
	<link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="chat.css?t=<?php echo time();?>">
	<title></title>


</head>
<body>
         <header>
         	<nav>
         		
         		<div class="Navgauch">
         			<a href="my-Accueil-compte.php"><p><i class="bi bi-house">Accueil</i></p></a>
         			<a href="historique.php"><p><i class="bi bi-chat">message</i></p></a>
         			<a href="mesDemedesAmis.php"><p><i class="bi bi-person-plus-fill">Mes demendes</i></p></a>
         			<a href="amis.php"><p><i class="bi bi-people"></i>Mes amis</p></a>
         		</div>

         		        <div>
         			       <form class="d-flex" method="post" action="my-Accueil-compte.php">
                             <input class="form-control me-sm-2" type="text" id="RechercheMembre" placeholder="Recherche">
                             <button class="btn btn-secondary" type="submit">Recherche</button>
                           </form>
         		         </div>

                        <div class="Navdroite">
                    <a href="monProfil.php"><p>Profil</p></a>
                               <div class='container'>  
                                    <form method="post" action="">
                            <input class="btn btn-danger" type="submit" name="submit" value="Deconnexion">
                             </form> 
                              </div>
                   </div>
         		        
         	</nav>
         </header>

         <div id="resultatMembre" class="cherchFixed">

         </div>

<script src="jquery-3.6.0.min.js"></script>
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
          <script >
               
// **************************************************************
       $(document).ready(function(){ 
       $('#resultatMembre').css("visibility","hidden");  
      $('#RechercheMembre').keyup(function(){  
      	 $('#resultatMembre').css("visibility","visible");
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"listMembre.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#resultatMembre').fadeIn();  
                          $('#resultatMembre').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#RechercheMembre').val($(this).text());  
           $('#resultatMembre').fadeOut();  
      });  
 }); 

// ***********************************************************************************

  $(document).ready(function(){ 
        
      $('#RechercheMembre').keyup(function(){  
           $('#resultatMembre').css("visibility","visible");
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"listMembre.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#resultatMembre').fadeIn();  
                          $('#resultatMembre').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#RechercheMembre').val($(this).text());  
           $('#resultatMembre').fadeOut();  
      });  
 }); 

   </script>
</body>
</html>