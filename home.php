<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="POST" > 

<input type="search" name="SEARCH-INPUT" id="TITLE">
<input type="submit" value="chercher" name="SEARCH-BTN">

</form>
<?php
include('connection.php');
$upcomingquery="SELECT * FROM evenement 
INNER JOIN version ON evenement.idEvenement = version.idEvenement 
WHERE dateEvenement > current_date()";

if(isset($_POST['SEARCH-BTN'])){        
            if(!empty($_POST['SEARCH-INPUT'])){

        $statment = $connect->prepare($upcomingquery.' AND  titre LIKE :search_input');
        $valueSearch="%".$_POST['SEARCH-INPUT']."%";
        $statment->bindParam(":search_input", $valueSearch);
        

}


}
else{
    $statment = $connect->prepare($upcomingquery);
}


$statment->execute();
$data = $statment->fetchAll(PDO::FETCH_ASSOC);

//Afficher les événements
$i=0;
while($i<COUNT($data)){
echo $data[$i]['titre'] . "  " . $data[$i]['dateEvenement'] ." ". $data[$i]['categorie'];

echo"<a href='Details.php?IDV=" .$data[$i]['numVersion']."'>Buy now</a>";


echo"</br>";
$i++;
    }
    

?>


</body>
</html>