<?php 

require_once "model/categorie.php";


// Toute les catégories
function ctlGetAllCats(){
    
    // Récupérer les produits à partir du model
    $cats = getAllCats(); 

    // Construire la vue
    require "view/show_cats.php";
}
 // function pour Rajouter une nouvelle catégorie à la liste
function ctlAddCat() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nom = $_POST['nom'];
        $description = $_POST['description'];

        $cat = new Categorie();
        $cat->setNom($nom)
            ->setDescription($description);

            $res = addCat($cat->getNom(), $cat->getDescription());


        if ($res) {
            header("Location: index.php?action=get_all_cats");
            exit();
        } else {
            echo "<p class='text-danger text-center'>Erreur lors de l'ajout de la catégorie.</p>";
        }
    }

    require "view/categorie_form.php";
}


?>