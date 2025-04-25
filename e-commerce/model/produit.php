<?php 

require_once "model/dbaccess.php";

class Produit {
    private int $id;
    private string $nom;
    private string $description;
    private int $categorie_id;
    private string $categorie_name;
    private float $prix;
    private ?string $image = null;

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

    /**
     * Get the value of categorie_id
     */
    public function getCategorieId(): int
    {
        return $this->categorie_id;
    }

    /**
     * Set the value of categorie_id
     */
    public function setCategorieId(int $categorie_id): self
    {
        $this->categorie_id = $categorie_id;

        return $this;
    }
    public function getCategorieName(): string
    {
        return $this->categorie_name;
    }
    public function setCategorieName(string $categorie_name): self
    {
        $this->categorie_name = $categorie_name;

        return $this;
    }

    /**
     * Get the value of prix
     */
    public function getPrix(): float
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     */
    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
    // * Get the value of image
     
    public function getImage(): ?string {
        return $this->image;
    }
    // * Set the value of image
    public function setImage(?string $image): self {
        $this->image = $image;
        return $this;
    }
}

// ********************
// *  CRUD Produit    *
// ********************

// Récupérer tous les produits
function getAllProds() {
    $prods = [];
    $sqlReq = "SELECT * FROM produit";

    try {
        $ctxDB = dbConnect();
        
        $req = $ctxDB->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'produit');

        $prods = $req->fetchAll();
    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $prods;
    }
}

// Récupérer un produit
function getProdById(int $id) {
    $prod = null;

    $sqlReq = "SELECT * FROM produit";
    $sqlReq .= " WHERE id= :id";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $ret = $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        if($ret) {
            $prod = $req->fetch();
        }
    }
    catch (Exception $ex) {
        var_dump($ex->getMessage());
        die();
    }
    finally {
        return $prod;
    }



}

// Rajouter un produit
function addProd(Produit $prod) {
    $ret = false;
    $sqlReq = "INSERT INTO produit (nom, description, categorie_id, prix, image) VALUES (:nom, :description, :categorie_id, :prix, :image)";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':nom', $prod->getNom(), PDO::PARAM_STR);
        $req->bindValue(':description', $prod->getDescription(), PDO::PARAM_STR);
        $req->bindValue(':categorie_id', $prod->getCategorieId(), PDO::PARAM_INT);
        $req->bindValue(':prix', $prod->getPrix(), PDO::PARAM_STR);
        $req->bindValue(':image', $prod->getImage(), PDO::PARAM_STR);
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
// Modifier un produit
function updateProd(Produit $prod) {
    $ret = false;
    $sqlReq = "UPDATE produit SET nom = :nom, description = :description, categorie_id = :categorie_id, prix = :prix, image = :image WHERE id = :id";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':nom', $prod->getNom(), PDO::PARAM_STR);
        $req->bindValue(':description', $prod->getDescription(), PDO::PARAM_STR);
        $req->bindValue(':categorie_id', $prod->getCategorieId(), PDO::PARAM_INT);
        $req->bindValue(':prix', $prod->getPrix(), PDO::PARAM_STR);
        $req->bindValue(':image', $prod->getImage(), PDO::PARAM_STR);
        $req->bindValue(':id', $prod->getId(), PDO::PARAM_INT);
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

// Supprimer un produit 
function deleteProd(int $id) {
    $ret = false;
    $sqlReq = "DELETE FROM produit WHERE id = :id";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->prepare($sqlReq);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
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
function getSelectedProds($prodIds) {
    $prods = [];

    $sqlReq = "SELECT * FROM produit";

    // [1, 8, 13] => "1,8,13"
    $sqlReq .= " WHERE id IN(".implode(',', $prodIds).")";

    try {
        $ctxDb = dbConnect();
        $req = $ctxDb->query($sqlReq);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Produit');
        $prods = $req->fetchAll();
    }
    catch (Exception $ex){
        var_dump($ex->getMessage());
    }
    finally {
        return $prods;
    }
}





?>