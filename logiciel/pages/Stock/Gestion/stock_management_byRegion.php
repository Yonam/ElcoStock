<?php 
/*global $bdd;
$clients=$bdd->prepare('SELECT C.ID_CLIENT, LIBELLE_NIVEAU, NOM_CLIENT, PRENOM_CLIENT, TEL_CLIENT, ADRESSE_CLIENT, FRUITS FROM niveau N JOIN client C ON N.ID_NIVEAU = C.ID_NIVEAU LEFT JOIN preference P ON C.ID_CLIENT = P.ID_CLIENT');
$clients->execute();
$data=$clients->fetchAll();
$four=array();*/




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
                       <!--  <?php
                            /*foreach ($data as $d) {*/ ?> -->
                                <tr class="odd gradeA">
                                    <td>Region 1</td>
                                    <td>10</td>
                                    <td>20000 t</td>
                                    <td>40 000 t</td>
                                    <td>
                                        <a class="btn btn-primary" href="?page=edit_client">Modifier</a>
                                        
                                    </td>
                                </tr>
                        <!-- <?php  /* }*/
                        ?> -->
                        
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
	