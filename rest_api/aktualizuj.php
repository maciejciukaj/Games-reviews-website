<?php       
require_once("funkcje.php");
require_once("klasy/user.php");
require_once("klasy/baza.php");
session_start();
if(!isset($_SESSION['loged']) || $_SESSION['user']->getStatus() != 2)
{
	header('Location: index.php');
	exit();
}

$users=dbGetUsers();
for ($i = 0; $i < count($users); $i++) {
    $zaw="akt".$i;

    if (isset($_POST[$zaw])) {
        if($users[$i]->getStatus() == 0)
            $sql = "UPDATE `users` SET `Status`= 1 WHERE Login = '".$users[$i]->getLogin()."';";
        if($users[$i]->getStatus() == 1)
            $sql = "UPDATE `users` SET `Status`= 0 WHERE Login = '".$users[$i]->getLogin()."';";
        
        $bb = new Baza("db", "root", "", "recenzje");
        if(@$bb->zapytanie($sql)){}
        else{
            echo "Error!";
        }
        header('Location: uzytkownicy.php');
	    exit();
    }

    $zaw="us".$i;
    if (isset($_POST[$zaw])) {
        $sql = "DELETE FROM `users` WHERE Login = '".$users[$i]->getLogin()."'";
        $bb = new Baza("db", "root", "", "recenzje");
        if(@$bb->zapytanie($sql)){}
        else{
            echo "Error!";
        }
        header('Location: uzytkownicy.php');
	    exit();
    }
    
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Recenzje</title>
        <link rel="stylesheet" href="CSS/style.css">
	</head>
	<body>
        <div class="navbar">
            <a href="glowna.php">Ranking</a>
            <a href="formularz.php">Dodaj recenzję</a>
        </div>
        <div class="recenzje">
            <?php
            
            echo getUserslist();
            
            ?>
        </div>
	</body>
</html>
