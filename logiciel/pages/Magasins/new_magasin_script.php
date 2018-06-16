<?php

	include "../include/connexionDB.php";
	if (isset($_POST['new_magasin'])) {
		
		$magasin = isset($_POST['magasin']) ? $_POST['magasin'] : null;
		$region = isset($_POST['region']) ? $_POST['region'] : null;
		$gerant = isset($_POST['gerant']) ? $_POST['gerant'] : null;


		/*CONTROLES*/


		/*INSERTION DANS LA BASE*/

        /*table magasin*/
		$req_magasin = $bdd->prepare("INSERT INTO magasin(ID_GERANT, REGION, DEPARTEMENT) VALUES(:gerant, :region, :departement)");
		$req_magasin->execute(array('gerant' => $gerant,
							'region' => $region,
							'departement' => $magasin));
		$lastId_magasin = (int)$bdd->lastInsertId();
		
		
        $bdd->beginTransaction();

			/*table stock*/

			$req_stock = $bdd->prepare("INSERT INTO stock(ID_MAGASIN, PRODUIT) VALUES(:lastId ,:produit)");
			$req_stock->execute(array('lastId' => $lastId_magasin,
									'produit' => "NKP15 15 15"));

			$req_stock = $bdd->prepare("INSERT INTO stock(ID_MAGASIN, PRODUIT) VALUES(:lastId ,:produit)");
			$req_stock->execute(array('lastId' => $lastId_magasin,
									'produit' => "UREE 46%N"));


        $bdd->commit();
		

	}