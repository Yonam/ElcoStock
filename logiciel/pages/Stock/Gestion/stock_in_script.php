<?php

include "../../include/connexionDB.php";
	if (isset($_POST['stock_in'])) {
		
		$magasin = isset($_POST['magasin']) ? $_POST['magasin'] : null;
		$produit = isset($_POST['produit']) ? $_POST['produit'] : null;
		$conso = isset($_POST['consommation']) ? $_POST['consommation'] : null;
		$quantite = isset($_POST['quantite']) ? $_POST['quantite'] : null;

		$id_stock = $bdd->prepare("SELECT ID_STOCK FROM stock WHERE ID_MAGASIN = :id_magasin");
		$id_stock->execute(array('id_magasin'=> $magasin ));
		$id_stock = $id_stock->fetchAll();
		foreach($id_stock as $s){
			$id_stock = $s->ID_STOCK;
		}

		if ($produit == "riz" ) {

			/*##### GESTION DU STOCK DE RIZ #####*/

			/*SELECTION DE LA QUANTITE PRECEDENTE*/	

			$stock = $bdd->prepare("SELECT QTE_STOCK_RIZ FROM riz WHERE ID_STOCK = :id_stock AND ID_MAGASIN = :id_magasin");
			$stock->execute(array('id_stock' => $id_stock,
								'id_magasin' => $magasin));
			$stock = $stock->fetchAll();
			foreach($stock as $s){
				$stock = $s->QTE_STOCK_RIZ;
			}


			/*DEDUCTION DU RESTE ET CALCUL DU NOUVEAU STOCK*/
			var_dump($stock);
			var_dump($conso);
			var_dump($_POST);

			$restant = (int)$stock-(int)$conso;

			if ($restant < 0) {
				echo '<body onload ="alert(\'Cette consommation n\'est pas possible pour ce stock\')">';
			}else{
				$new_stock = $restant + (int)$quantite;
			}
			


			/*MISE A JOUR DU NOUVEAU STOCK*/

			$req = $bdd->prepare("UPDATE riz SET QTE_STOCK_RIZ = :qte WHERE ID_STOCK = :id_stock AND ID_MAGASIN = :id_magasin");
			$req->execute(array('qte' => $new_stock,
								'id_stock' => $id_stock,
								'id_magasin' => $magasin));


		} else {

			/*##### GESTION DU STOCK D'ENGRAIS #####*/


			/*SELECTION DE LA QUANTITE PRECEDENTE*/	

			$stock = $bdd->prepare("SELECT QTE_STOCK_ENGRAIS FROM engrais WHERE ID_STOCK = :id_stock AND ID_MAGASIN = :id_magasin AND TYPE_ENGRAIS = :type_engrais");
			$stock->execute(array('id_stock' => $id_stock,
								'id_magasin' => $magasin,
								'type_engrais' => $produit));
			$stock = $stock->fetchAll();
			foreach($stock as $s){
				$stock = $s->QTE_STOCK_ENGRAIS;
			}

			/*DEDUCTION DU RESTE ET CALCUL DU NOUVEAU STOCK*/

			$restant = (int)$stock - (int)$conso;

			if ($restant < 0) {
				echo '<body onload ="alert(\'Cette consommation n\'est pas possible pour ce stock \')">';
			}else{
				$new_stock = $restant + (int)$quantite;	
			}
			


			/*MISE A JOUR DU NOUVEAU STOCK*/

			$req = $bdd->prepare("UPDATE engrais SET QTE_STOCK_ENGRAIS = :qte WHERE ID_STOCK = :id_stock AND ID_MAGASIN = :id_magasin AND TYPE_ENGRAIS = :type_engrais");
			$req->execute(array('qte' => $new_stock,
								'id_stock' => $id_stock,
								'id_magasin' => $magasin,
								'type_engrais' => $produit));
		}

		/*INSERTION D'UNE LIGNE POUR LE SUIVI*/

		$suivi = $bdd->prepare("INSERT INTO suivi_stock(ID_STOCK, PRODUIT, DATE_ENREGISTREMENT, STOCK_INIT, QTE_AJOUTE, QTE_CONSOMME, STOCK_FINAL) VALUES (:id_stock, :produit, :date_enregistrement, :stock_init, :qte_ajoute, qte_consomme, stock_final)");
		$suivi->execute(array('id_stock' => $id_stock,
							'produit' => $produit,
							'date_enregistrement' => date("Y-m-d H:i:s"),
							'stock_init' => (int)$stock,
							'qte_ajoute' => (int)$quantite,
							'qte_consomme' => (int)$conso,
							'stock_final' => $new_stock));
		var_dump((int)$new_stock);
	}