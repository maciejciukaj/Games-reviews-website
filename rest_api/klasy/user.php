<?php
class User {
	private $login;
	private $haslo;
	private $email;
	private $status;
	
	public function __construct($login,$haslo,$email,$status) {
		$this->login=$login;
		$this->haslo=$haslo;
		$this->email=$email;
		if($status == 1 || $status == 2)
		{
			$this->status=$status;
		}
		else
		{
			$this->status=0;
		}
	} //koniec funkcji konstruktora
		
	public function __destruct() {
	}
		
	public function getLogin() {
		return $this->login;
	}

	public function getHaslo() {
		return $this->haslo;
	}

	public function getEmail() {
		return $this->haslo;
	}

	public function getStatus() {
		return $this->status;
	}
}
