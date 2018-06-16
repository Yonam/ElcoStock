<?php
    global $bdd;
    $bdd->beginTransaction();
        $gerant = $bdd->prepare('SELECT ID_GERANT, NOM_GERANT, PRENOM_GERANT FROM gerant' );
        $gerant->execute();
    $bdd->commit();

?>

<div class="page-head">
    <h1>Enregistrer un nouveau magasin</h1>
    <hr>
</div>

<div  >
    <h2 class="page-head"><code>Formulaire d'enregistrement</code></h2>

    <form role="form" method="post" action="pages/Magasins/new_magasin_script.php">
        <div class=" form-group col-lg-12"> 

            <div class="form-group col-lg-5  col-lg-offset-1">
                <label for="magasin">*Departement</label>
                <input type="text" name="magasin" class="form-control" id="magasin" required="required">
            </div>

            <div class="form-group col-lg-5">
                <label for="region">*Selection de la region</label>
                <select class="form-control" id="region" name="region">
                    
                    <option value="Maritime" > Maritime </option>
                    <option value="Plateaux" > Plateaux </option>
                    <option value="Centrale" > Centrale </option>
                    <option value="Kara" > Kara  </option>
                    <option value="Savane" > Savane </option>
                </select>
            </div>

            <div class="form-group col-lg-5  col-lg-offset-1">
                <label for="gerant">*Choix du gerant</label>
                <select class="form-control" id="gerant" name="gerant">
                     <?php foreach ($gerant as $g) { ?>
                        <option value="<?=$g->ID_GERANT?>" > <?=$g->NOM_GERANT." ".$g->PRENOM_GERANT?> </option>
                    <?php } ?>
                </select>
            </div>
            
        </div>

    <hr class="form-group col-lg-8 col-lg-offset-2">

    
    <div class="col-lg-8 col-lg-push-2">
        <input type="reset" class="btn btn-default btn-lg  col-lg-5" value="ANNULER" name="reset" />
        <input type="submit" class="btn btn-success btn-lg  col-lg-5 col-lg-push-2 submit" name="new_magasin" value="ENREGISTRER" />
    </div>
</form>
</div>
    