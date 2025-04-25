<?php 
    $title = "MVC_STORE: ERROR";

    ob_start();
?>

<h1 class="text-center btn btn-danger">ERREUR</h1>

<p>Vous n'avez pas les droits nécessaires pour accéder à cette ressource!</p>

<a href="index.php?action=home" class="btn btn-primary">Retour</a>

<?php 
    $content = ob_get_clean();
    require "view/template.php";
?>