<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form action="" method="post">
        <label for="nom">nom</label>
        <input type="text" name="nom" id="nom"><br>
        <label for="prenom">prenom</label>
        <input type="text" name="prenom" id="prenom"><br>
        <label for="email">email</label>
        <input type="email" name="email" id="email"> <br>
        <label for="password">password</label>
        <input type="password" name="password" id="password"><br>
        <button type="submit" name="submit">submit</button>
    </form>
</body>
<?php
include('connection.php');

if (isset($_POST['submit'])) {
    if (!empty(($_POST['nom'])) && !empty(($_POST['prenom'])) && !empty(($_POST['email'])) && !empty(($_POST['password'])) && strlen($_POST['password']) >= 6) {
     
     if (!verify_user($_POST['email'], $connect)){

     
     
     
     
     
        $insertQuery= "INSERT INTO utilisateur (nom,prenom,email,motPasse) VALUES (:name,:lastName,:email,:password)";
       $stmInsertUser= $connect->prepare($insertQuery);
        $stmInsertUser->bindParam(':name', $_POST['nom']);
        $stmInsertUser->bindParam(':lastName', $_POST['prenom']);
        $stmInsertUser->bindParam(':email', $_POST['email']);
        $stmInsertUser->bindParam(':password', $_POST['password']);
        $stmInsertUser->execute();
        echo "inscription reussi";

     }
     else
            echo "<span class='error'>Email existent </span> <br>";
    } else {
        if (empty(($_POST['nom'])))
            echo "<span class='error'> saisir le nom </span> <br>";

        if (empty(($_POST['prenom'])))
            echo "<span class='error'> saisir le prenom </span> <br>";

        if (empty(($_POST['email'])))
            echo "<span class='error'> saisir l'email </span> <br>";

        if (empty(($_POST['password'])))
            echo "<span class='error'> saisir le mot de passe </span> <br>";
        else
            if(strlen($_POST['password']) <6)
             echo "<span class='error'>minimun 6 caracteres </span> <br>";
    }
}

?>

</html>