<?php

include "../../include/connexionDB.php";
	if (isset($_POST['stock_in'])) {
		
		$magasin = isset($_POST['magasin']) ? $_POST['magasin'] : null;
		$produit = isset($_POST['produit']) ? $_POST['produit'] : null;
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
		

			if ((float)$stock < (float)$quantite) {
				echo '<body onload ="alert(\'Ce retrait n\'est pas possible pour ce stock\')">';
			}else{
				$new_stock = (float)$stock-(float)$quantite;
			}
			
			


			/*MISE A JOUR DU NOUVEAU STOCK*/

			$req = $bdd->prepare("UPDATE stock SET QTE_STOCK = :qte WHERE ID_MAGASIN = :id_magasin AND PRODUIT = :produit");
			$req->execute(array('qte' => $new_stock,
								'id_magasin'=> $magasin,
								'produit' => $produit));

			
		
  
		/*INSERTION D'UNE LIGNE POUR LE SUIVI*/

		$suivi = $bdd->prepare("INSERT INTO suivi_actions(ID_MAGASIN, ID_USER, ACTION, QUANTITE) VALUES (:id_magasin, :user, :action, :quantite)");
		$suivi->execute(array('id_magasin' => $magasin,
							'user' => "1",
							'action' => "Retrait de stock",
							'quantite' => (float)$quantite));
		

		echo '<body onload ="alert(\'le retrait de '.$produit.' a bien ete enregistre \')">';
        echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=stock_out">';

	}