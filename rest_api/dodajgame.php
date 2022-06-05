<?php
require_once("klasy/baza.php");
require_once("funkcje.php");
session_start();
if (isset($_POST['submit'])) {

	$nazwa = $_POST['nazwa'];
	$gatunek = $_POST['gatunek'];
	$date = $_POST['date'];
	$wydawca = $_POST['wydawca'];
	
	if($nazwa == "" || $gatunek == "" || $wydawca == "")
	{
		$_SESSION['validacja_game'] = "<span style='color:red'>Wymagane wszystkie wartości!</br></span>";
		header('location:formularzGra.php');
	}
	else
	{
		
		$db = new Baza("db", "root", "", "recenzje");
	
		$sql1 = "SELECT * FROM games WHERE name='$nazwa'";

		if (!(($rezultat = @$db->select($sql1)) != 0)) {
			
			$sql = "INSERT INTO `games`(`name`, `genre`, `data`, `publisher`) VALUES ('$nazwa','$gatunek','$date','$wydawca')";
			
			if (@$db->zapytanie($sql)) {
				header('location:glowna.php');
				exit();
			} else {
				echo "Error!";
				echo $date;
			}				
		
		} else {
			$_SESSION['validacja_game'] = "<span style='color:red'>Podana gra już istnieje w bazie danych!</br></span>";
			header('location:formularzGra.php');
		}


	}

}
else
{
	header('location:formularzGra.php');
}
