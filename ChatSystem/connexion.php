<?php
    session_start();
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
     <link rel="stylesheet" href="chat.css?t=<?php echo time();?>">
	<title></title>
</head>
<body>
	
  <section  style="margin-top: 3px">
   <form method="post" action="control-connexion.php" class="myForm">
       <div class="row">
   	   <div class="col">
   	      <label class="col-form-label">Login</label>
   	      <input class="form-control" type="email
          " name="mylogin">
   	   </div>
       </div>
            <div class="row">
   	        <div class="col">
   	        	<label class="col-form-label">Mot de passe</label>
   	        	<input class="form-control" type="password" name="mymdp">
   	        </div>
             </div>

<div class="col-form-label"><input type="submit" style="width:100%" value="Se connecter" class="btn btn-success"></div>

<a href="inscription.php" class="btn btn-warning"style="display: block;text-align: center;text-decoration: none">
                Vous n'avez pas de compte? Inscrire ici
            </a>

   </form>
   </section>
 
</body>
</html>