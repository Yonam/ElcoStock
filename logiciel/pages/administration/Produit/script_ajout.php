<?php

include "../../include/connexionDB.php";
if (isset($_POST['addProduit'])){



    $reference = isset($_POST['Reference']) ? $_POST['Reference'] : null;
    $nom = isset($_POST['nom']) ? $_POST['nom'] : null;
    $prix = isset($_POST['prix']) ? $_POST['prix'] : null;
    //Formattage
    $nom = htmlspecialchars($nom);
    $prix = htmlspecialchars($prix);

    $verif = $bdd->prepare("SELECT * FROM pains WHERE LIBELLE = :nom OR REFERENCE = :ref");
    $verif ->execute(array('nom'=>$nom, 'ref'=>$reference));
    $pains = $verif->fetchAll();

    if (count($pains) > 0) {
        echo '<body onload ="alert(\'Produit existant\')">';
     echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=list_produit">';
    }else {
        $req = $bdd->prepare("INSERT INTO pains (REFERENCE,LIBELLE, PRIX_UNIT) VALUES(:reference,:nom,:prix)");
            $req->execute(array(
            'reference'=>$reference,
            'nom'=>$nom, 
            'prix'=>$prix));
        $lastId = (int)$bdd->lastInsertId();
    }
}
   
    echo '<body onload ="alert(\'Produit ajouté avec succès\')">';
     echo '<meta http-equiv="refresh" content="0;URL=../../../index.php?page=list_produit">';
          //  }
     //  }
//}


?>