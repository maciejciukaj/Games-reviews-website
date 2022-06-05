<?php
session_start();
require_once("klasy/baza.php");
require_once("klasy/user.php");
require_once("funkcje.php");


if(isset($_SESSION['newLogin']))
{
	$dd = new Baza("db", "root", "", "recenzje");
	$us=$_SESSION['newLogin'];
	$has=$_SESSION['newHaslo'];
	$email=$_SESSION['newEmail'];
	//echo $us.$has.$email;
	$sql="INSERT INTO `users`(`Login`, `Email`, `Haslo`, `Status`) VALUES ('$us','$email','$has','0')";
	//echo $sql;
	if(@$dd->zapytanie($sql))
	{
		unset($_SESSION['newLogin']);
		unset($_SESSION['newEmail']);
		unset($_SESSION['newHaslo']);
		header('location:index.php');
		exit();
	}
	else
	{
		echo "bląd";
	}
	unset($_SESSION['newLogin']);
	unset($_SESSION['newEmail']);
	unset($_SESSION['newHaslo']);
}

if((!isset($_POST['login'])) || (!isset($_POST['password'])))
{
	header('location:index.php');
	exit();
}

			
			
		if (isset($_POST['zaloguj'])) {
			$db = new Baza("db", "root", "", "recenzje");

			$login = htmlspecialchars($_POST['login']);
			$password = htmlspecialchars($_POST['password']);
			
			//$password=password_hash($password, PASSWORD_DEFAULT);

			//echo "POMOCY!!!!";
			$sql = "SELECT * FROM users WHERE Login='$login' AND Haslo='$password'";	

				
			if(($rezultat = $db->select($sql)) != 0)
			{

				$keys = array_keys($rezultat);
				$key = $keys[1];
				$user=new User($rezultat[$key]["Login"],$rezultat[$key]["Haslo"],$rezultat[$key]["Email"],$rezultat[$key]["Status"]);
				$_SESSION['user']=$user;
				
				$_SESSION['loged']= true;
						
				unset($_SESSION["blad"]);
				header('location:glowna.php');
				exit();
					
			}
			else
			{
				$_SESSION["blad"]="<span style='color:red'>Nieprawidłowy login lub haslo!</span>";
				header('location:index.php');
				exit();
			}
		}
		else if(isset($_POST['rejestracja']))
		{
			header('location: rejestruj.php');
			exit();
		}
		else if(isset($_POST['rejestruj']))
		{
			header('location: rejestruj.php');
			exit();
		}
		else
		{
			header('location:index.php');
			exit();
		}

				
			
		?>

