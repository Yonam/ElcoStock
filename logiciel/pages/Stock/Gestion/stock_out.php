<?php
        global $bdd;
        $bdd->beginTransaction();
            $region = $bdd->prepare('SELECT * FROM region');
            $region->execute();

            $localite = $bdd->prepare('SELECT * FROM localite');
            $localite->execute();

            $magasin = $bdd->prepare('SELECT ID_MAGASIN, NOM_MAGASIN FROM magasin');
            $magasin->execute();

            $produit = $bdd->prepare('SELECT ID_PRODUIT, LIBELLE FROM produit');
            $produit->execute();
        $bdd->commit();

?>

<div class="page-head">
    <h1>Enregistrer une sortie de stock</h1>
    <hr>
</div>

<div  >
    <h2 class="page-head"><code>Formulaire d'enregistrement</code></h2>

    <form role="form" method="post" action="pages/Boutique/Gestion/new_client_script.php">
        <div class=" form-group col-lg-12"> 

            <div class="form-group col-lg-5  col-lg-offset-1">
                <label for="localite">*Sélection de la localité</label>
                <select class="form-control" id="localite" name="localite">
                    <?php foreach ($localite as $l) { ?>
                        <option value="<?=$l->ID_LOCALITE?>" > <?=$l->NOM_LOCALITE ?> </option>
                    <?php } ?>
                    
                </select>
            </div>

            <div class="form-group col-lg-5">
                <label for="magasin">*Selection du magasin</label>
                <select class="form-control" id="magasin" name="magasin">
                    <?php foreach ($magasin as $m) { ?>
                        <option value="<?=$m->ID_MAGASIN?>" > <?=$m->NOM_MAGASIN ?> </option>
                    <?php } ?>
                    
                </select>
            </div>

            <div class="form-group col-lg-5  col-lg-offset-1">
                <label for="Produit">*Produit voulu</label>
                <select class="form-control" id="produit" name="produit">
                    <?php foreach ($produit as $p) { ?>
                        <option value="<?=$p->ID_PRODUIT?>" > <?=$p->LIBELLE ?> </option>
                    <?php } ?>
                    
                </select>
            </div>


            <div class="form-group col-lg-5">
                <label for="quantite">* quantite a retirer</label>
                <input type="number" class="form-control" id="quantite" name="quantite" REQUIRED/>
            </div>
            
        </div>

    <hr class="form-group col-lg-8 col-lg-offset-2">

    
    <div class="col-lg-8 col-lg-push-2">
        <input type="reset" class="btn btn-default btn-lg  col-lg-5" value="ANNULER" name="reset" />
        <input type="submit" class="btn btn-success btn-lg  col-lg-5 col-lg-push-2 submit" name="addcli" value="ENREGISTRER" />
    </div>
</form>
</div>
    