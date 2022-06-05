<?php
require_once("review.php");


class Game {
	private $name;
    private $genre;
    private $data;
    private $publisher;
	private $avg;
	
	public function __construct($name,$genre,$data,$publisher) {
		$this->name=$name;
        $this->genre=$genre;
        $this->data=$data;
        $this->publisher=$publisher;
	$this->avg=0;
	} //koniec funkcji konstruktora
		
	public function __destruct() {
	}
		
	public function wyswietl() {
		
	}
	
	
	public function calculateRate($tabReviews){
		$suma=0;
		$ilosc=0;
		//echo "</br>";
//echo var_dump($tabReviews[1]);
		for($i=0;$i<count($tabReviews);$i++)
		{
//echo "POMOCY!!!";
			//echo $tabReviews[$i]->getId_game();
			if($tabReviews[$i]->getId_game() == $this->name)
			{
				$suma += $tabReviews[$i]->getRate();
				$ilosc += 1;
			}
		}
		if($ilosc>0)
			$this->avg = $suma/$ilosc;
		else
			$this->avg = 0;
	}

	public function getAvg(){
		return $this->avg;
	}

	public function getName(){
		return $this->name;
	}
}	
