<?php
$dbname = "farha";
$user = "root";
$pass = "Hossam2003@SQL";

// Partie connection
try {
    $connect = new PDO("mysql:host=localhost;dbname=$dbname", $user, $pass);
} catch (PDOException $ex) {
    echo $ex->getMessage();
}
function verify_user($email, $pdo)
{
    $stmCheckUser = $pdo->prepare("SELECT * FROM utilisateur WHERE email=:email");
    $stmCheckUser->bindParam(':email', $email);
    $stmCheckUser->execute();
    $data = $stmCheckUser->fetchAll(PDO::FETCH_ASSOC);

    if (count($data) > 0)
        return true;
    else
        return false;
}
function login_user($email, $pw, $pdo)
{

    $stmLoginUser = $pdo->prepare("SELECT * FROM utilisateur WHERE email=:email and motPasse=:pw");
    $stmLoginUser->bindParam(':email', $email);
    $stmLoginUser->bindParam(':pw', $pw);
    $stmLoginUser->execute();
    $data = $stmLoginUser->fetchAll(PDO::FETCH_ASSOC);

    return $data[0]['idUtilisateur'];
}

function detailsUser($idUser, $pdo)
{

    $stmDetailsUser = $pdo->prepare("SELECT * FROM utilisateur WHERE idUtilisateur = :idUser ");
    $stmDetailsUser->bindParam(':idUser', $idUser);

    $stmDetailsUser->execute();
    $data = $stmDetailsUser->fetch(PDO::FETCH_ASSOC);


    echo '<div> Nom : ' . $data['nom'] . ' <br>
     prenom : ' . $data['prenom'] . ' <br>
    email : ' . $data['email'] . ' 
    </div>';
}
function VersionDetails($pdo, $IDV)
{

    $stmDetailsVersion = $pdo->prepare("SELECT * FROM evenement E  INNER JOIN   version V on E.idEvenement = V.idEvenement  WHERE numVersion = :IDV ");
    $stmDetailsVersion->bindParam(':IDV', $IDV);

    $stmDetailsVersion->execute();
    $data = $stmDetailsVersion->fetch(PDO::FETCH_ASSOC);


    echo '<div> <h1>  ' . $data['titre'] . '</h1> 
     <p>Description : ' . $data['description'] . '  </p> 
     <span>Tarif Normal :' . $data['tarifnormal'] . '</span>
     <span>Tarif Reduit : ' . $data['tarifReduit'] . '</span><br>
     <p>
        La Date :  ' . $data['dateEvenement'] . '
  la Categorie : ' . $data['categorie'] . '
     </p>
    
    </div>';
}

function getCapacityVersion($pdo, $IDV){
    $stmCapacity = $pdo->prepare("SELECT capacite FROM salle INNER JOIN version on salle.numSalle = version.numSalle WHERE numVersion = :IDV");
    $stmCapacity->bindParam(':IDV', $IDV);

    $stmCapacity->execute();
    $data = $stmCapacity->fetch(PDO::FETCH_ASSOC);
    return $data['capacite'];
}

function getCountTicket($pdo, $IDV){
    $stmCountTicket = $pdo->prepare("SELECT COUNT(*) as NBTicket FROM facture INNER JOIN billet on facture.idFacture = billet.idFacture WHERE numVersion = :IDV");
    $stmCountTicket ->bindParam(':IDV', $IDV);

    $stmCountTicket ->execute();
    $data = $stmCountTicket ->fetch(PDO::FETCH_ASSOC);
    return $data['NBTicket'];
}