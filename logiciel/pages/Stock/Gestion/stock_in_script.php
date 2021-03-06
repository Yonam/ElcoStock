<?php

include "../../include/connexionDB.php";
	if (isset($_POST['stock_in'])) {
		
		$magasin = isset($_POST['magasin']) ? $_POST['magasin'] : null;
		$produit = isset($_POST['produit']) ? $_POST['produit'] : null;
		$conso = isset($_POST['consommation']) ? $_POST['consommation'] : null;
		$quantite = isset($_POST['quantite']) ? $_POST['quantite'] : null;

		/*$id_stock = $bdd->prepare("SELECT ID_STOCK FROM stock WHERE ID_MAGASIN = :id_magasin AND PRODUIT = :produit");
		$id_stock->execute(array('id_magasin'=> $magasin,
								'produit' => $produit ));
		$id_stock = $id_stock->fetchAll();*/
		


			/*##### GESTION DU STOCK #####*/

			/*SELECTION DE LA QUANTITE PRECEDENTE*/	

			$stock = $bdd->prepare("SELECT QTE_STOCK FROM stock WHERE ID_MAGASIN = :id_magasin AND PRODUIT = :produit");
			$stock->execute(array('id_magasin'=> $magasin,
									'produit' => $produit ));
			$stock = $stock->fetchAll();


			foreach($stock as $s){
				$stock = $s->QTE_STOCK;
			}

			


			/*DEDUCTION DU RESTE ET CALCUL DU NOUVEAU STOCK*/
		
			$restant = (float)$stock-(float)$conso;

			if ($restant < 0) {
				echo '<body onload ="alert(\'Cette consommation n\'est pas possible pour ce stock\')">';
			}else{
				$new_stock = $restant + (float)$quantite;
			}
			


			/*MISE A JOUR DU NOUVEAU STOCK*/

			$req = $bdd->prepare("UPDATE stock SET QTE_STOCK = :qte WHERE ID_MAGASIN = :id_magasin AND PRODUIT = :produit");
			$req->execute(array('qte' => $new_stock,
								'id_magasin'=> $magasin,
								'produit' => $produit));

			
		
  
		/*INSERTION D'UNE LIGNE POUR LE SUIVI*/

		$suivi = $bdd->prepare("INSERT INTO suivi_stock(ID_MAGASIN, PRODUIT, STOCK_INIT, QTE_AJOUTE, QTE_CONSOME, STOCK_FINAL) VALUES (:id_magasin, :produit, :stock_init, :qte_ajoute, :qte_consomme, :stock_final)");
		$suivi->execute(array('id_magasin' => $magasin,
							'produit' => $produit,
							'stock_init' => (float)$stock,
							'qte_ajoute' => (float)$quantite,
							'qte_consomme' => (float)$conso,
							'stock_final' => $new_stock));
		

		echo '<body onload ="alert(\'le Stock de '.$produit.' a bien ete enregistre \')">';
        echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=stock_in">';

	}