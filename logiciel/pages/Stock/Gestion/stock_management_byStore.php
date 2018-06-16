<?php 
global $bdd;

$Region=$bdd->prepare('SELECT DISTINCT(REGION) FROM magasin');
$Region->execute();
$Region = $Region->fetchAll();




if (isset($_SERVER['HTTP_REFERER'])) {
    if (strstr($_SERVER['HTTP_REFERER'], 'script_update_client.php')) {
    echo '<div class="alert alert-success alert-dismissable col-lg-8 col-lg-offset-1 pull-center">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        Modification effectuée avec succès! 
        </div>';
    }
}


?>

<div class="page-head">
	<h1>Etat des stocks</h1>
	<hr>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="?page=stock_in" class="btn btn-danger">Nouvelle entree</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Region</th>
                            <th>Nbre de magasins</th>
                            <th>Stock NPK</th>
                            <th>stock UREE</th>
                            <!-- <th>Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                            foreach ($Region as $r) { 
                                /*Recuperation du nombre de magasins de la region*/
                                $nbre = $bdd->prepare("SELECT COUNT(ID_MAGASIN) AS NBRE FROM magasin WHERE REGION = :region");
                                $nbre->execute(array('region'=>$r->REGION));

                                /*Boucle de recuperation des magasins de la region*/

                                $magasin = $bdd->prepare("SELECT ID_MAGASIN FROM magasin WHERE REGION = :region");
                                $magasin->execute(array('region'=>$r->REGION));

                                $stock_npk = $bdd->prepare("SELECT SUM(QTE_STOCK) AS NPK FROM stock S JOIN magasin M ON S.ID_MAGASIN = M.ID_MAGASIN WHERE M.REGION = :region AND S.PRODUIT = 'NKP15 15 15'");
                                $stock_npk->execute(array('region' => $r->REGION));
                                $stock_npk = $stock_npk->fetchAll();

                                $stock_uree = $bdd->prepare("SELECT SUM(QTE_STOCK) AS UREE FROM stock S JOIN magasin M ON S.ID_MAGASIN = M.ID_MAGASIN WHERE M.REGION = :region AND S.PRODUIT = 'UREE 46%N'");
                                $stock_uree->execute(array('region' => $r->REGION));
                                $stock_uree = $stock_uree->fetchAll();

                                foreach ($nbre as $n) {
                                    $nombre = $n->NBRE;
                                }

                                foreach ($stock_npk as $npk) {
                                    $stock_npk = $npk->NPK;
                                }

                                foreach ($stock_uree as $uree) {
                                    $stock_uree = $uree->UREE;
                                }

                                /*Recuperation des elements du stocks*/

                                ?> 
                                
                                <tr class="odd gradeA">
                                    <td><?= $r->REGION ?></td>
                                    <td><?= $nombre ?></td>
                                    <td><?= $stock_npk ?></td>
                                    <td><?= $stock_uree ?></td>
                                    <!-- <td>
                                        <a class="btn btn-primary" href="?page=edit_client">Modifier</a>
                                        
                                    </td> -->
                                </tr>
                        <?php   }
                        ?> 
                        
                    </tbody>
                </table>
                <!-- /.table-responsive -->
                
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
	