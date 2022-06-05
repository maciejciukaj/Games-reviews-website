<?php
require_once("klasy/baza.php");
require_once("klasy/user.php");
session_start();
if (isset($_POST['submit'])) {

	$body = $_POST['tresc'];
	$user = $_SESSION['user'];
	$user_name=$user->getLogin();
	$rate = $_POST['ocena'];
	$game_id = $_POST['gra'];

	if($body == " ")
	{
		$_SESSION['validacja_rev'] = "<span style='color:red'>Wprowadz recenzje!</br></span>";
		header('location:formularz.php');
	}
	else
	{
		$db = new Baza("db", "root", "", "recenzje");
		$sql = "INSERT INTO `reviews`(`body`, `user`, `rate`, `game_name`) VALUES ('$body','$user_name','$rate','$game_id')";
		if (@$db->zapytanie($sql)) {
			header('location:glowna.php');
			exit();
		} else {
			echo "Error!";
		}
	}

}
else
{
	header('location:formularz.php');
}
