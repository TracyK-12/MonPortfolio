<?php
require_once "model/database.php";

class Article
{
    private int $id = 0;
    private ?string $name = null;
    private ?string $category = null;
    private int $quantity = 0;
   private int $alert_threshold = 0;
   private ?string $image = null;
    private ?string $created_at = null;


    public function getId(): int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getCategory(): ?string { return $this->category; }
    public function setCategory(string $category): self { $this->category = $category; return $this; }

    public function getQuantity(): int { return $this->quantity; }
    public function setQuantity(int $quantity): self { $this->quantity = $quantity; return $this; }

    public function getAlert_threshold(): int { return $this->alert_threshold; }
    public function setAlert_threshold(int $alert_threshold): self { $this->alert_threshold = $alert_threshold; return $this; }

    public function getImage(): ?string { return $this->image; }
    public function setImage(?string $img): self { $this->image = $img; return $this; }

    
    public function getCreated_at(): ?DateTime {
        return $this->created_at ? new DateTime($this->created_at) : null;
    }
    
    public function setCreated_at(DateTime|string $dt): self {
        $this->created_at = $dt instanceof DateTime ? $dt->format('Y-m-d H:i:s') : $dt;
        return $this;
    }
    

}

// ========================
// CRUD FUNCTIONS ADAPTÉES
// ========================

function getAllArticles(): array {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM articles";
        $stmt = $db->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
        return $stmt->fetchAll();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return [];
    }
}
function getArticleById(int $id): ?Article {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM articles WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article');
        return $stmt->fetch() ?: null;
    } catch (Exception $e) {
    var_dump($e->getMessage());
    return null;
}
        var_dump($e->getMessage());
        return null;
    }

    function createArticle(Article $article): bool {
        try {
            $db = dbConnect();
            $sql = "INSERT INTO articles (name, category, quantity, alert_threshold, image, created_at) 
                    VALUES (:name, :category, :quantity, :alert_threshold, :image, :created_at)";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':name', $article->getName());
            $stmt->bindValue(':category', $article->getCategory());
            $stmt->bindValue(':quantity', $article->getQuantity(), PDO::PARAM_INT);
            $stmt->bindValue(':alert_threshold', $article->getAlert_threshold(), PDO::PARAM_INT);
            $stmt->bindValue(':image', $article->getImage());
            $stmt->bindValue(':created_at', $article->getCreated_at()?->format('Y-m-d H:i:s'));
            return $stmt->execute();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return false;
        }
    }
    
    function updateArticle(Article $article): bool {
        try {
            $db = dbConnect();
            $sql = "UPDATE articles SET 
                        name = :name,
                        category = :category,
                        quantity = :quantity,
                        alert_threshold = :alert_threshold,
                        image = :image,
                        created_at = :created_at
                    WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $article->getId(), PDO::PARAM_INT);
            $stmt->bindValue(':name', $article->getName());
            $stmt->bindValue(':category', $article->getCategory());
            $stmt->bindValue(':quantity', $article->getQuantity(), PDO::PARAM_INT);
            $stmt->bindValue(':alert_threshold', $article->getAlert_threshold(), PDO::PARAM_INT);
            $stmt->bindValue(':image', $article->getImage());
            $stmt->bindValue(':created_at', $article->getCreated_at()?->format('Y-m-d H:i:s'));
            return $stmt->execute();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return false;
        }
    }
    
    function deleteArticle(int $id): bool {
        try {
            $db = dbConnect();
            $sql = "DELETE FROM articles WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return false;
        }
    }
    
