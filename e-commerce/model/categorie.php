<?php 

require_once "model/dbaccess.php";

class Categorie {
    private int $id;
    private string $nom;
    private string $description;
    
    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

}

// ********************
// *  CRUD Catégories    *
// ********************

// Récupérer toutes les catégories
function getAllCats() {
    $cats = [];
    $sqlReq = "SELECT * FROM categorie";

    try {
        $ctxDB = dbConnect();
        
        $req = $ctxDB->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Categorie');

        $cats = $req->fetchAll();
    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $cats;
    }
}

// Récupérer une catégorie par son id
function getCatById(int $id) {
    $cat = null;

    $sqlReq = "SELECT * FROM categorie";
    $sqlReq .= " WHERE id= :id";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $ret = $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        if($ret) {
            $cat = $req->fetch();
        }
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $cat;
    }

}

// Ajouter une catégorie
function addCat(string $nom, string $description) {
    $sqlReq = "INSERT INTO categorie (nom, description) VALUES (:nom, :description)";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':nom', $nom, PDO::PARAM_STR);
        $req->bindValue(':description', $description, PDO::PARAM_STR);
        $ret = $req->execute();
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $ret;
    }
}







?>