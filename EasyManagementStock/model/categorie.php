<?php
require_once "model/database.php";

class Categorie
{
    private int $id;
    private string $name;
    private string $description;
    private ?string $created_at = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCreated_at(): ?DateTime {
        return $this->created_at ? new DateTime($this->created_at) : null;
    }
    
    public function setCreated_at(DateTime|string $dt): self {
        $this->created_at = $dt instanceof DateTime ? $dt->format('Y-m-d H:i:s') : $dt;
        return $this;
    }
}

// ********************
// *  CRUD Catégories    *
// ********************

function getAllCategories(){

    $cats = [];
    $sqlReq = "SELECT * FROM  categorie";

    try{
        $db = dbConnect();
        $stmt = $db->query($sqlReq);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Categorie::class);
        $cats = $stmt->fetchAll();
    }
    catch (Exception $e){
        var_dump($e->getMessage());
    }
    return $cats;
}

// ********************

function getCategorieById(int $id): ?Categorie {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM categorie WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        return $stmt->fetch() ?: null;
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return null;
    }
}
// *********************
function getCategorieByName(string $name): ?Categorie {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM categorie WHERE name = :name";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
        return $stmt->fetch() ?: null;
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return null;
    }
}

// *********************
function createCategorie(Categorie $categorie): bool {
    try {
        $db = dbConnect();
        $sql = "INSERT INTO categorie (name, description, created_at) 
                VALUES (:name, :description, :created_at)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $categorie->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':description', $categorie->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}
// *********************
function updateCategorie(Categorie $categorie): bool {
    try {
        $db = dbConnect();
        $sql = "UPDATE categorie SET name = :name, description = :description WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $categorie->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':name', $categorie->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':description', $categorie->getDescription(), PDO::PARAM_STR);
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}
// *********************
function deleteCategorie(int $id): bool {
    try {
        $db = dbConnect();
        $sql = "DELETE FROM categorie WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}
// *********************