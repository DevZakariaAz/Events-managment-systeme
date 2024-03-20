<?php
session_start();
include 'connection.php';
if(isset($_GET['IDV'])){
        VersionDetails($connect,$_GET['IDV']);
        echo '<form action="" method="POST">
        <label for="normal">Normal</label>
        <input type="number" name="normal" id="normal">
        <label for="reduit">Reduit</label>
        <input type="number" name="reduit" id="reduit">
        <input type="submit" value="acheter" name="submit">
        </form>';
            if(isset($_POST['submit'])){

                 if(isset($_SESSION['id_user'])){
                    $NBnormal = (int)$_POST['normal'];
                    $NBreduit = (int)$_POST['reduit'];

                        if($NBnormal > 0 || $NBreduit > 0){
                            $salleCapacity = getCapacityVersion($connect, $_GET['IDV']);
                            echo $salleCapacity.'<br>';
                            $countTicket = getCountTicket($connect, $_GET['IDV']);
                            echo $countTicket;
                        }else{
                            echo "mentionner le nombre de buillet";
                        }

                         }
                else{
                        echo "Connécter vous " . '<a href="login.php">Login</a>';
                   }
        }
        }
    else{
            echo"Version not found";
        }



?>