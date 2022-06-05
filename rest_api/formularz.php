<?php

require_once("funkcje.php");
require_once("klasy/user.php");

session_start();

if (!isset($_SESSION['loged'])) {
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

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
                    <li><img class="docker" src="docker_logo.webp"> </li>
                    <li><a href="index.php" class="nav-link px-3 nav-text">Recenzje</a></li>
                    <li><a href="formularz.php" class="nav-link px-3 nav-text">Oceń grę</a></li>
		<?php if ($_SESSION['user']->getStatus() == 1 || $_SESSION['user']->getStatus() == 2)
                	echo "<li><a href='formularzGra.php' class='nav-link px-3 nav-text'>Dodaj grę</a></li>";  
		?>
                    <li><a href="autorzy.php" class="nav-link px-3 nav-text">Autorzy</a></li>
                </ul>
                <!-- 
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control form-control-dark text-white bg-dark" placeholder="Search..." aria-label="Search">
                </form> -->

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo "Witaj, " . $_SESSION['user']->getLogin() . "!" ?>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="wyloguj.php">Wyloguj</a>
                        <a class="dropdown-item" href="uzytkownicy.php"><?php if ($_SESSION['user']->getStatus() == 2)
                                                                            echo "Zarządzaj użytkownikami";  ?></a>

                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="display-4 d-flex justify-content-center mt-4">Podziel się swoją opinią 📝</div>

        <form action="dodajrev.php" method="post">
            <div class="form-group mt-3">
                </br>
                <legend class="mb-3">Wybierz grę:</legend>
                <?php
                echo listOfGames();
                ?></br>
		<?php if ($_SESSION['user']->getStatus() == 1 || $_SESSION['user']->getStatus() == 2)
                	echo "<span class='text-info'>
                    Nie znalazłeś swojej gry?</span>
                <input class='btn btn-primary mt-2 ' type='submit' name='dodaj' value='Dodaj tutaj'>";  
		?>
                
                </br></br>
                <label for="tresc">
                    <legend>Recenzja:</legend>
                </label></br>
                <textarea class="form-control w-50" name='tresc'> </textarea></br></br>
                <?php
		/*<label for="uzytkownik">
                    <legend>Nazwa użytkownika:</legend>
                </label></br>
                <input class="form-control w-50 h-120" type="text" name="uzytkownik"></input></br>*/
		?></br>
                <fieldset>
                    <legend class="mb-3">Ocena gry:</legend>

                    <input class="form-check-input" type="radio" id="1" name="ocena" value="1" checked>
                    <label for="1">1</label>

                    <input class="form-check-input" type="radio" id="2" name="ocena" value="2">
                    <label for="2">2</label>

                    <input class="form-check-input" type="radio" id="3" name="ocena" value="3">
                    <label for="3">3</label>

                    <input class="form-check-input" type="radio" id="4" name="ocena" value="4">
                    <label for="4">4</label>

                    <input class="form-check-input" type="radio" id="5" name="ocena" value="5">
                    <label for="5">5</label>

                    <input class="form-check-input" type="radio" id="6" name="ocena" value="6">
                    <label for="6">6</label>

                    <input class="form-check-input" type="radio" id="7" name="ocena" value="7">
                    <label for="7">7</label>

                    <input class="form-check-input" type="radio" id="8" name="ocena" value="8">
                    <label for="8">8</label>

                    <input class="form-check-input" type="radio" id="9" name="ocena" value="9">
                    <label for="9">9</label>

                    <input class="form-check-input" type="radio" id="10" name="ocena" value="10">
                    <label for="10">10</label>

                </fieldset>

                <input class="btn btn-primary mt-5" type="submit" name="submit" value="Submit">
            </div>
        </form>
	<?php
		if (isset($_SESSION['validacja_rev'])) {
			echo $_SESSION['validacja_rev'];
			unset($_SESSION['validacja_rev']);
		}
	?>
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-muted">
                Programownie aplikacji w chmurze obliczeniowej
            </p>

            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>

            <div class="navjustify-content-end">2022</div>
        </footer>
    </div>

</body>


</html>
