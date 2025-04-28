<?php
require_once "model/database.php";

// Important pour getUser()
require_once "model/user.php"; 

class Feedback
{
    private int $id = 0;
    private int $user_id = 0;
    private ?string $message = null;
    private ?string $image = null;
    private ?string $created_at = null;

    public function getId(): int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getUser_id(): int { return $this->user_id; }
    public function setUser_id(int $user_id): self { $this->user_id = $user_id; return $this; }

    public function getMessage(): ?string { return $this->message; }
    public function setMessage(?string $message): self { $this->message = $message; return $this; }

    public function getImage(): ?string { return $this->image; }
    public function setImage(?string $image): self { $this->image = $image; return $this; }

    public function getCreated_at(): ?DateTime {
        return $this->created_at ? new DateTime($this->created_at) : null;
    }

    public function setCreated_at(DateTime|string $dt): self {
        $this->created_at = $dt instanceof DateTime ? $dt->format('Y-m-d H:i:s') : $dt;
        return $this;
    }

    // ✅ Récupérer l’objet utilisateur lié
    public function getUser(): ?User {
        return getUserById($this->user_id);
    }
}

////////////////////////////////////
// CRUD FUNCTIONS
////////////////////////////////////

function getAllFeedback(): array {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM feedback ORDER BY created_at DESC";
        $stmt = $db->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Feedback');
        return $stmt->fetchAll();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return [];
    }
}

function getFeedbackById(int $id): ?Feedback {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM feedback WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Feedback');
        return $stmt->fetch() ?: null;
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return null;
    }
}

function createFeedback(Feedback $f): bool {
    try {
        $db = dbConnect();
        $sql = "INSERT INTO feedback (user_id, message, image, created_at)
                VALUES (:user_id, :message, :image, :created_at)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $f->getUser_id(), PDO::PARAM_INT);
        $stmt->bindValue(':message', $f->getMessage());
        $stmt->bindValue(':image', $f->getImage());
        $stmt->bindValue(':created_at', $f->getCreated_at()?->format('Y-m-d H:i:s'));
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}

function updateFeedback(Feedback $f): bool {
    try {
        $db = dbConnect();
        $sql = "UPDATE feedback SET message = :message, image = :image WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $f->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':message', $f->getMessage());
        $stmt->bindValue(':image', $f->getImage());
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}

function deleteFeedback(int $id): bool {
    try {
        $db = dbConnect();
        $sql = "DELETE FROM feedback WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}

function getFeedbacksByUserId(int $userId): array {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM feedback WHERE user_id = :uid ORDER BY created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':uid', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Feedback');
        return $stmt->fetchAll();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return [];
    }
}
