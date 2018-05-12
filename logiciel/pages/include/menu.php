<nav id="sidebar">
    <div id="dismiss">
        <i class="glyphicon glyphicon-arrow-left"></i>
    </div>

    <div class="sidebar-header">
        <h3>Elco Stock</h3>
    </div>

    <ul class="list-unstyled components">
        <p>Gestion des stocks</p>
        <li class="active">
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Stocks</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li><a href="?page=stock_in">Entrées en stock</a></li>
                <li><a href="?page=stock_out">Sortie stock</a></li>
                <li>
                    <a href="#verifSubmenu" data-toggle="collapse" aria-expanded="false">Vérifications stock</a>
                    <ul class="collapse list-unstyled" id="verifSubmenu">
                        <li><a href="?page=byRegion">Par region</a></li>
                        <li><a href="?page=byStore">Par magasin</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Gestion interne</a>
            <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false">Ventes</a>
            <ul class="collapse list-unstyled" id="pageSubmenu2">
                <li><a href="#">Nouvelle vente client</a></li>
                <li><a href="#">Suivi des ventes</a></li>
            </ul>

            <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false">Achats</a>
            <ul class="collapse list-unstyled" id="pageSubmenu3">
                <li><a href="#">Nouvel achat</a></li>
                <li><a href="#">Fournisseurs</a></li>
            </ul>

            <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false">Magasins</a>
            <ul class="collapse list-unstyled" id="pageSubmenu4">
                <li><a href="#">Gestion magasins</a></li>
                <li><a href="#">Gestion gérant</a></li>
            </ul>
        </li>
        <li>
            <a href="#">Etats</a>
            <a href="#pageSubmenu5" data-toggle="collapse" aria-expanded="false">Graphique</a>
            <ul class="collapse list-unstyled" id="pageSubmenu5">
                <li><a href="#">Ventes</a></li>
                <li><a href="#">Achats</a></li>
                <li><a href="#">Evolution magasins</a></li>
            </ul>

            <!-- <a href="#pageSubmenu6" data-toggle="collapse" aria-expanded="false">Achats</a>
            <ul class="collapse list-unstyled" id="pageSubmenu6">
                <li><a href="#">Nouvel achat</a></li>
                <li><a href="#">Fournisseurs</a></li>
            </ul>

            <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false">Magasins</a>
            <ul class="collapse list-unstyled" id="pageSubmenu4">
                <li><a href="#">Gestion magasins</a></li>
                <li><a href="#">Gestion gérant</a></li>
            </ul> -->
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
    </ul>
</nav>

<!-- Page Content Holder -->
<div id="content">

    <nav class="navbar navbar-default">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                    <i class="glyphicon glyphicon-align-left"></i>
                    <span>Prixane | Hello</span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" class="btn btn-warning">Me déconnecter</a></li>
                </ul>
            </div>
        </div>
    </nav>