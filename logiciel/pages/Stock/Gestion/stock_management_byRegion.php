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
                <a href="?page=new_client" class="btn btn-danger">Nouvelle entree</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Region</th>
                            <th>Nbre de magasins</th>
                            <th>Stock riz</th>
                            <th>stock engrais</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                            foreach ($Region as $r) { 
                                /*Recuperation du nombre de magasins de la region*/
                                $nbre = $bdd->prepare("SELECT COUNT(ID_MAGASIN) AS NBRE FROM magasin WHERE REGION = :region");
                                $nbre->execute(array('region'=>$r->REGION));

                                $magasin = $bdd->prepare("SELECT M.ID_MAGASIN, S.ID_STOCK FROM magasin M JOIN stock S ON M.ID_MAGASIN = S.ID_MAGASIN WHERE M.REGION = :region");
                                $magasin->execute(array('region'=>$r->REGION));

                                foreach ($nbre as $n) {
                                    $nombre = $n->NBRE;
                                }

                                /*Recuperation des elements du stocks*/

                                ?> 
                                
                                <tr class="odd gradeA">
                                    <td><?= $r->REGION ?></td>
                                    <td><?= $nombre ?></td>
                                    <td>20000 t</td>
                                    <td>40 000 t</td>
                                    <td>
                                        <a class="btn btn-primary" href="?page=edit_client">Modifier</a>
                                        
                                    </td>
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
	