<?php

class Review {
	private $id;
    private $body;
    private $user;
    private $rate;
	private $name_game;
	
	public function __construct($id,$body,$user,$rate,$name_game) {
		$this->id=$id;
        	$this->body=$body;
        	$this->user=$user;
        	$this->rate=$rate;
		$this->name_game=$name_game;

	} //koniec funkcji konstruktora
		
	public function __destruct() {
	}
		
	public function wyswietl() {
			
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getId_game(){
		return $this->name_game;
	}

	public function getRate(){
		return $this->rate;
	}

	public function getUser(){
		return $this->user;
	}
	
	public function getBody(){
		return $this->body;
	}
}		
