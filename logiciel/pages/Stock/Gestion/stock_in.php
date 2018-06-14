<?php
        global $bdd;
        $bdd->beginTransaction();
            $magasin = $bdd->prepare('SELECT * FROM magasin');
            $magasin->execute();

            /*$localite = $bdd->prepare('SELECT * FROM localite');
            $localite->execute();

            $magasin = $bdd->prepare('SELECT ID_MAGASIN, NOM_MAGASIN FROM magasin');
            $magasin->execute();

            $produit = $bdd->prepare('SELECT ID_PRODUIT, LIBELLE FROM produit');
            $produit->execute();*/
        $bdd->commit();

?>

<div class="page-head">
    <h1>Nouvelle entrée en stock</h1>
    <hr>
</div>

<div  >
    <h2 class="page-head"><code>Formulaire d'enregistrement</code></h2>

    <form role="form" method="post" action="pages/stock/Gestion/stock_in_script.php">
        <div class=" form-group col-lg-12"> 

            <div class="form-group col-lg-5  col-lg-offset-1">
                <label for="magasin">*Sélection du magasin</label>
                <select class="form-control" id="magasin" name="magasin">
                    <?php foreach ($magasin as $l) { ?>
                        <option value="<?=$l->ID_MAGASIN?>" > <?=$l->DEPARTEMENT ?> </option>
                    <?php } ?>
                    
                </select>
            </div>

            <div class="form-group col-lg-5">
                <label for="produit">*Selection du produit</label>
                <select class="form-control" id="produit" name="produit">
                    
                    <option value="engrais_type1" > Engrais type 1 </option>
                    <option value="engrais_type2" > Engrais type 2 </option>
                    <option value="riz" > riz  </option>
                </select>
            </div>

            <div class="form-group col-lg-5  col-lg-offset-1">
                <label for="consommation">* consommation</label>
                <input type="number" class="form-control" id="consommation" name="consommation" REQUIRED/>
            </div>

            <div class="form-group col-lg-5">
                <label for="quantite">* quantite a ajouter</label>
                <input type="number" class="form-control" id="quantite" name="quantite" REQUIRED/>
            </div>
            
        </div>

    <hr class="form-group col-lg-8 col-lg-offset-2">

    
    <div class="col-lg-8 col-lg-push-2">
        <input type="reset" class="btn btn-default btn-lg  col-lg-5" value="ANNULER" name="reset" />
        <input type="submit" class="btn btn-success btn-lg  col-lg-5 col-lg-push-2 submit" name="stock_in" value="ENREGISTRER" />
    </div>
</form>
</div>
    