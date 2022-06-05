<?php
class Baza
{
	private $mysqli; //uchwyt do BD
	public function __construct($serwer, $user, $pass, $baza)
	{
		$this->mysqli = new mysqli($serwer, $user, $pass, $baza);
		/* sprawdz połączenie */
		if ($this->mysqli->connect_errno != 0) {
			printf(
				"Nie udało sie połączenie z serwerem: %s\n",
				$mysqli->connect_error
			);
			exit();
		}
		/* zmien kodowanie na utf8 */
		if ($this->mysqli->set_charset("utf8")) {
			//udało sie zmienić kodowanie
		}
	} //koniec funkcji konstruktora

	function __destruct()
	{
		$this->mysqli->close();
	}


	public function select($sql)
	{
		//echo $sql;
		if ($result = $this->mysqli->query($sql)) {
			$ile = $result->num_rows;
			//echo $ile;
			if ($ile > 0) {
				$tab[] = "";
				for ($i = 0; $i < $ile; $i++) {
					$wiersz = $result->fetch_assoc();
					//echo array_keys($wiersz)[0]."</br>";
					$tab[$wiersz[array_keys($wiersz)[0]]] = $wiersz;
				}
				$result->free_result();

				return $tab;
			} else {
				//echo "blad";
			}
		}
		return 0;
	}

	public function zapytanie($sql)
	{
		if ($this->mysqli->query($sql)) return true;
		else return false;
	}

	public function getMysqli()
	{
		return $this->mysqli;
	}
} //koniec klasy Baza
