<?php class Auth{

	/**
	* Permet d'identifier un utilisateur et de garder ses infos dans une variable SESSION
	**/
	function login($d){
		global $bdd;
		$date = date("Y-m-d H:i:s");
		$ip = $_SERVER['REMOTE_ADDR'];
        
		return true;
		
	}	

	function vente($d){
		$tva = $_POST['tva']; 
		$achat =  $_POST['achat']; 
		$coef = $_POST['coef']; 
		$reduction = $_POST['reduction'];
		$vente = (((($tva * $achat)/100)*$coef))- $reduction;
		
			return $vente;
	}


	/**
	* Permet a l'utilisateur d'avoir une page forbidden en cas de non autorisation
	**/

	function allow($rang){
		global $bdd;
		$req=$bdd->prepare('SELECT level FROM privileges');
		$req->execute();
		$data=$req->fetchAll();
		$roles= array();
		foreach ($data as $d) {
			$roles[$d->level]=$d->level;
		}
		$this->user('level');
	}

	/**
	* Recupere des informations de l'utilisateur
	**/

	function user($field){
		if(isset($_SESSION['Auth']->slug)){
			
		}
	}

	function logout(){

		global $bdd;
		$date = date('Y-m-d H:i:s');
		$login = $_SESSION['Auth']->login;
		$ip = $_SERVER['REMOTE_ADDR'];

		/*$co = $bdd->prepare('INSERT INTO connexion(login, statut, ip, date_connexion, action) VALUES (:login, 1,:ip, :dated, "Deconnexion reussie")');
			$co -> execute(array('ip'=>$ip,'dated'=>$date,'login'=>$d['Login']));*/
		$req = $bdd->prepare("UPDATE utilisateur SET connecte=0 WHERE CODE_USER = ". $_SESSION['Auth']->code_user);
        $req->execute();

        header("Location:?page=");
	}

}

$Auth=new Auth();