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

		/*table stock*/

		$req_stock = $bdd->prepare("INSERT INTO stock(ID_MAGASIN, DEPARTEMENT_STOCK) VALUES(:lastId , :magasin)");
		$req_stock->execute(array('lastId' => $lastId_magasin,
							'magasin' => $magasin));
		$lastId_stock = (int)$bdd->lastInsertId();


		/*Les tables de stock riz et angrais*/

		$req_riz = $bdd->prepare("INSERT INTO riz(ID_STOCK, ID_MAGASIN, DEPARTEMENT_STOCK) VALUES(:id_stock, :lastId , :magasin)");
		$req_riz->execute(array('id_stock' => $lastId_stock,
								'lastId' => $lastId_magasin,
								'magasin' => $magasin));

		/*$type[] = array("NPK15 15 15","UREE 46%N");*/
		$type = "NPK15 15 15";
		for ($i=0; $i=1 ; $i++) { 
			$req_engrais = $bdd->prepare("INSERT INTO engrais(ID_STOCK, ID_MAGASIN, DEPARTEMENT_STOCK, TYPE_ENGRAIS) VALUES(:id_stock, :lastId , :magasin, :type)");
				$req_engrais->execute(array('id_stock' => $lastId_stock,
								'lastId' => $lastId_magasin,
								'magasin' => $magasin,
								'type' => $type));
		}
		

	}