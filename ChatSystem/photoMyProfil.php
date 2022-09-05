<?php
session_start();
    $connect=new PDO("mysql:host=127.0.0.1;port=3306;dbname=Mychat","root","");

  ?>


  <!DOCTYPE html>
  <html>
  <head>
  	<meta charset="utf-8">
  	<title></title>
  </head>
  <body>
        <form method="post" action="" enctype="multipart/form-data">
        	<p>
      	      <label>Photo profil</label>
      	     </p>
      	     <p>
      	      <input name="PhotoProfil" type="file" />
      	      <input type="submit" value="soumettre">
      	    </p> 
        </form>
  </body>
  </html>