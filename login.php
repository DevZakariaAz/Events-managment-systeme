<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <form action="" method="post">
        <label for="email">email:</label>
        <input name="email" id="email" type="email" >
        <label for="password">password:</label>
        <input name="password" id="password" type="password">
        <button name="send" type="submit">send</button>
    </form>
</body>
</html>
<?php
session_start();
include "connection.php";
if(isset($_POST ['send'])){
    if(!empty($_POST['email']) && !empty($_POST['password'])) {
        $idus = login_user($_POST['email'], $_POST['password'], $connect);
      if($idus !=NUll ){

        $_SESSION['id_user'] = $idus;



      header('location:profile.php');
       } else{
        echo "<span class='error'>email ou mot de pass inccorect </span>";
       }


    }

       else{
        echo "<span class='error'>email ou mot de pass reqi </span>";
       }

}
?>