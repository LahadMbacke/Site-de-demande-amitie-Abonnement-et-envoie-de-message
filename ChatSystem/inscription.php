<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
     <link rel="stylesheet" href="chat.css?t=<?php echo time();?>">
     <title>Welcom to my chat system</title>
</head>
<body>

     <section id="contenu" style="margin-top: 3px">
     <form method="post" action="control-inscription.php" enctype="multipart/form-data" class="container myform"> 
      <fieldset> 

       <div class="row">
          <div class="col">
             <legend>Information personnelle</legend> 
               <label class="col-form-label">Prenom</label>
              <input type="text" class="form-control" name="mypname">
              <label class="col-form-label">Nom</label>
               <input type="text" class="form-control" name="myname" required>
          </div>
       </div>
      </fieldset>
          
      <label>Sexe</label>
          <div>               
                 <input type="radio" name="mysex" value="Masculin" checked>
                 <label class="form-check-label">Masculin</label>
          </div>
          <div>          
                 <input type="radio" name="mysex" value="Feminin">
                 <label class="form-check-label">Feminin</label>
          </div>
           <div class="row">
              <div class="col">
                    <label class="col-form-label">Entrer votre login</label>
                    <input type="email" class="form-control" name="mylogin" required>

                           <label class="col-form-label">Entrer votre mot de passe</label>
                           <input type="password" id="mymdp" class="form-control" name="mymdp" required maxlength="10">

                           <label class="col-form-label">Confirm votre mot de passe</label>
                            <input type="password" id="mymdpcheck" class="form-control" name="mymdpCheck" required maxlength="10">
                         <label>Photo profil</label>
                           <input type="file" class="form-control-file border" name="PhotoProfil">
                </div>
           </div>

                <div class="col-form-label"><input style="width: 100%;" type="submit" id="sub" value="Valider votre inscription"  class="btn btn-warning"></div>
                <a href="connexion.php" class="btn btn-success"style="display: block;text-align: center;text-decoration: none">
                Vous avez un compte? Connecter ici
            </a>
     </form>

   </section>
</body>
<script>
     var mymdp=document.getElementById("mymdp");
     var mymdpCheck=document.getElementById("mymdpcheck");
     var sub=document.getElementById("sub");
     sub.addEventListener("click",function(){
          if(mymdp.value!=mymdpCheck.value){
               alert("les deux mot de passe ne correspondent pas");
          }
     })
</script>
</html>