<?php

require_once("klasy/baza.php");
require_once("klasy/game.php");
require_once("klasy/user.php");
require_once("klasy/review.php");



function dbGetUsers()
{
	$bb = new Baza("db", "root", "", "recenzje");
	$sqlGames = "SELECT * FROM users";

	if (($rezultat_game = @$bb->select($sqlGames)) != 0) {
		$rezultat = array_values($rezultat_game);
		$users = [];

		for ($i = 1; $i < count($rezultat); $i++) {
			array_push($users, new User($rezultat[$i]["Login"], $rezultat[$i]["Email"], $rezultat[$i]["Haslo"], $rezultat[$i]["Status"]));
		}
		//echo var_dump($games);
		return $users;
	} else {
		echo "Error:Brak dostepu do bazy danych!";
		return 0;
	}
}

function dbGetRecenzje()
{
	$db = new Baza("db", "root", "", "recenzje");
	$sqlRewievs = "SELECT * FROM reviews";
	if (($rezultat = @$db->select($sqlRewievs)) != 0) {
		$reviews = [];
		//echo "</br></br>";
		//echo var_dump($rezultat);
		//echo "</br></br>";
		for ($i = 1; $i < count($rezultat); $i++) {
			array_push($reviews, new Review($rezultat[$i]["id_review"], $rezultat[$i]["body"], $rezultat[$i]["user"], $rezultat[$i]["rate"], $rezultat[$i]["game_name"]));
		}

		$_SESSION['recenzje'] = $reviews;
		return $reviews;
	} else {
		echo "Error:Brak dostepu do bazy danych!";
		return 0;
	}
}



function dbGetGames()
{

	$bb = new Baza("db", "root", "", "recenzje");
	$sqlGames = "SELECT * FROM games";

	if (($rezultat_game = @$bb->select($sqlGames)) != 0) {
		$rezultat = array_values($rezultat_game);
		$games = [];

		for ($i = 1; $i < count($rezultat); $i++) {
			array_push($games, new Game($rezultat[$i]["name"], $rezultat[$i]["genre"], $rezultat[$i]["data"], $rezultat[$i]["publisher"]));
		}
		//echo var_dump($games);
		return $games;
	} else {
		echo "Error:Brak dostepu do bazy danych!";
		return 0;
	}
}

function getGameRates()
{
	$games = dbGetGames();
	$reviews = dbGetRecenzje();
	//echo var_dump($reviews);
	for ($i = 0; $i < count($games); $i++) {
		$games[$i]->calculateRate($reviews);
	}
	$_SESSION['gry'] = $games;
	//$zawartosc = "<div>Witaj ".$_SESSION['user']->getLogin()."!<div><ul>";
	$zawartosc = "<ul>";
	for ($i = 0; $i < count($games); $i++) {
		$zawartosc .= "<div class='list-group d-grid gap-2 border-0 gry' >
		<label class='list-group-item rounded-3 py-3 w-80 '>
		  
		  <div class=' display-6'>" . $games[$i]->getName() . "</div></br><div class='rating '>Ocena:</br>" . number_format($games[$i]->getAvg(), 2) . "/10.00</div>
		
		  <a class=' text-decoration-none gra-tytul rounded border border-dark opinieText' href='szczegolyGry.php?id=" . $games[$i]->getName() . "'>Przejdź do opinii</a>
		</label>
	  </div>";
	}
	$zawartosc .= "</ul>";

	//if ($_SESSION['user']->getStatus() == 2)
	//	$zawartosc .= "<div><a href='uzytkownicy.php'>Zarządzaj użytkownikami</a></div>";

	//$zawartosc .= "<div><a href='wyloguj.php'>Wyloguj</a></div>";

	return $zawartosc;
}


function listOfGames()
{
	$zawartosc = "<select name='gra'>";

	$games = $_SESSION['gry'];

	for ($i = 0; $i < count($games); $i++) {
		$zawartosc .= "<option value=\"" . $games[$i]->getName() . "\">" . $games[$i]->getName() . "</option>";
	}

	$zawartosc .= "</select>";
	return $zawartosc;
}

function getReviews($id)
{
	//$games = dbGetGames();

	$reviews = dbGetRecenzje();
	$reviewsOfGame = [];
	$zawartosc = "<div class='display-4 d-flex justify-content-center mt-4 mb-4'>Oceny gry - " . $id . "</div><div>";
	for ($i = 0; $i < count($reviews); $i++) {
		if ($reviews[$i]->getId_game() == $id) {
			$zawartosc .= "<div class='card-body p-4  d-flex justify-content-center '>
            <div class='card mb-4 w-50 '>
                <div class='card-body'>
                    <p class='opis'> " . $reviews[$i]->getBody() . "</p>

                    <div class='d-flex justify-content-between'>
                        <div class='d-flex flex-row align-items-center'>
                            <img src='user.webp' alt='avatar' width='25' height='25'>
                            <p class='medium mb-0 ms-2'>" . $reviews[$i]->getUser() . ": " . $reviews[$i]->getRate() . "/10</p>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>";
		}
	}
	$zawartosc .= "</div>";
	return $zawartosc;
}


function login()
{
?>

	<div class="container d-flex justify-content-center">
		<form action='zaloguj.php' method="post">
			<table>
				<tr>
					<th>
						<legend>Login:</legend>
					</th>
					<th><input class="form-control" type='text' name='login' placeholder="Nazwa użytkownika" /></th>
				</tr>
				<tr>
					<th>
						<legend>Password:</legend>
					</th>
					<th><input class="form-control" type='password' name='password' placeholder="Hasło" /></th>
				</tr>

				</br>




			</table>
			<span class="container d-flex justify-content-center">
				<ul class="inline">
					<input class="btn btn-success " type='submit' name='zaloguj' value='Zaloguj' />
					<input class="btn btn-primary" type='submit' name='rejestracja' value='Nie mam konta' />
				</ul>
			</span>

		</form>
	</div> <?php
		}

		function getUserslist()
		{
			$users = dbGetUsers();
			$zawartosc = "<form  action='aktualizuj.php' method='post' ><table><tr><th>Użytkownik</th><th>E-mail</th><th>Status</th></tr>";
			for ($i = 0; $i < count($users); $i++) {
				if ($users[$i]->getStatus() == 2) {
				} else {
					if ($users[$i]->getStatus() == 1) {
						$status = "Admin";
					} else {
						$status = "Użytkownik";
					}

					$zawartosc .= "<tr class='spacer'>";
					$zawartosc .= "<th>" . $users[$i]->getLogin() . ":</th>";
					//$zawartosc .= "<th>" . $users[$i]->getHaslo() . "</th>";
					$zawartosc .= "<th>" . $users[$i]->getEmail() . "</th>";
					$zawartosc .= "<th>" . $status . "</th>";
					$zawartosc .= "<th><input class='btn btn-primary' type='submit' name='akt" . $i . "' value='Aktualizuj Status'></th>";
					$zawartosc .= "<th><input class='btn btn-warning' type='submit' name='us" . $i . "' value='Usuń'></th>";
					$zawartosc .= "</tr>";
				}
			}
			$zawartosc .= "</table></form>";
			return $zawartosc;
		}
