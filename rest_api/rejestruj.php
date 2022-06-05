<?php
require_once("klasy/baza.php");
require_once("funkcje.php");
require_once("klasy/user.php");

session_start();


if (!isset($_POST['logowanie'])) {
	if (isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password2'])) {
		$args = [
			'login' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => ['regexp' => '/^[A-Za-z0-9]{3,10}$/']
			],
			'email' => ['filter' => FILTER_VALIDATE_EMAIL],
			'password' => [
				'filter' => FILTER_VALIDATE_REGEXP,
				'options' => ['regexp' => '/^\S*(?=\S{5,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/']
			]
		];

		$dane = filter_input_array(INPUT_POST, $args);
		//var_dump($dane);
		if ($dane['password'] != false) {
			if ($dane['login'] != false) {
				if ($dane['email'] != false) {
					if ($dane['password'] === $_POST['password2']) {
						$db = new Baza("db", "root", "", "recenzje");
						$login1 = $_POST['login'];
						$sql = "SELECT * FROM users WHERE Login='$login1'";
						if (!(($rezultat = @$db->select($sql)) != 0)) {
							//echo $dane['login'];
							$_SESSION['newLogin'] = $dane['login'];
							$_SESSION['newHaslo'] = $dane['password'];
							//$_SESSION['newHaslo']=password_hash($dane['password'], PASSWORD_DEFAULT);
							$_SESSION['newEmail'] = $dane['email'];
							//echo $_SESSION['newLogin'];
							header('location: zaloguj.php');
							exit();
						} else {
							$_SESSION['validacja'] = "<span style='color:red'>Podany login już istnieje w bazie danych!</br>
							</span>";
						}
					} else {
						$_SESSION['validacja'] = "<span style='color:red'>Niepasujace hasło!</br>
							</span>";
					}
				} else {
					$_SESSION['validacja'] = "<span style='color:red'>Niepoprawny email!</br>
						</span>";
				}
			} else {
				$_SESSION['validacja'] = "<span style='color:red'>Niepoprawny login!</br>
					*od 3 do 15 znaków
					*login składa się z małych, dużych liter i cyfr
					</span>";
			}
		} else {
			$_SESSION['validacja'] = "<span style='color:red'>Niepoprawne hasło!</br>
				*od 5 do 15 znaków
				*haslo musi zawierac chociaż po jednej małej,duże literze i czyfrze
				</span>";
		}
	} else {
		/*$_SESSION['validacja']="<span style='color:red'>Uzupełnij wszystkie pola!</br>
			</span>";*/
	}
} else {
	header('location:index.php');
}

?>
<!DOCTYPE html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />

<head>
	<meta charset="UTF-8">
	<title>Recenzje</title>
	<link rel="stylesheet" href="CSS/style.css">
</head>

<body>
	<header class="p-3 bg-dark text-white">
		<div class="container">
			<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
				<a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
					<svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
						<use xlink:href="#bootstrap"></use>
					</svg>
				</a>

				<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
					<li><img class="docker" src="docker_logo.webp" /></li>

				</ul>
				<!-- 
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-white bg-dark" placeholder="Search..." aria-label="Search">
                </form> -->

				<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
				<div class="dropdown">

				</div>
			</div>
		</div>
	</header>
	<div class="container">
		<div class="display-4 d-flex justify-content-center mt-4 mb-4">Rejestracja</div>
		<div class="d-flex justify-content-center">
			<form method="post">
				<table>
					<tr>
						<th>
							<legend>Email:</legend>
						</th>
						<th><input class="form-control" type='text' name='email' /></th>
					</tr>
					<tr>
						<th>
							<legend>Login:</legend>
						</th>
						<th><input class="form-control" type='text' name='login' /></th>
					</tr>
					<tr>
						<th>
							<legend>Hasło:</legend>
						</th>
						<th><input class="form-control" type='password' name='password' /></th>
					</tr>
					<tr>
						<th>
							<legend>Powtórz hasło:</legend>
						</th>
						<th><input class="form-control" type='password' name='password2' /></th>
					</tr>



				</table>
				<span class="container d-flex justify-content-center">
					<ul class="inline">
						<input class="btn btn-success" type='submit' name='rejestruj' value='Zarejestruj' />

						<input class="btn btn-primary" type='submit' name='logowanie' value='Mam konto' />
					</ul>
				</span>
				<?php
				if (isset($_SESSION['validacja'])) {
					echo $_SESSION['validacja'];
					unset($_SESSION['validacja']);
				}
				?>

			</form>
		</div>
	</div>
</body>

</html>
