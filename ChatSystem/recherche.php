<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="bootstrap-5.0.2-dist/css/bootstrap.css">
	<link rel="stylesheet" href="chat.css?t=<?php echo time();?>">
	<title></title>
   <style>
     
   </style>
</head>
<body>
	<?php include("menu.php"); ?>

       <form method="post" action="listMembre.php" class="formCH">
       	 <p>
       	      <input id="Rechercher" type="search" name="Recherche">
       	      <input type="submit" value="Rechercher"> 
       	 </p>
       </form>


      <!--  <h3>Voici quelques membres du site</h3>

       <div id="lesMembres">
       	
       </div> -->
</body>

<script >
	var cherche = document.querySelector("#Rechercher");
	var membre = document.querySelector("#lesMembres");
        membre.style.visibility="hidden";

           cherche.addEventListener("keyup",function(){
              var n = cherche.value;
                    var xhr = new XMLHttpRequest();
                    var url = "listMembre.php";
                    xhr.open("POST",url);
                    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
                    xhr.send("nom="+n);

                 xhr.onreadystatechange=function()
            {
              if (xhr.readyState == 4 && xhr.status == 200) 
                  {
                    membre.innerHTML=xhr.responseText;
                    membre.style.visibility="visible";
                   }
            }
           },false)

</script>
</html>