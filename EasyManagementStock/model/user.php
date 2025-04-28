<?php
require_once "model/database.php";

class User
{
    private int $id = 0;
    private ?string $name = null;
    private ?string $email = null;
    private ?string $password = null;
    private ?string $status = null;
    private ?string $profile_image = null;
    private ?string $created_at = null;


    public function getId(): int { return $this->id; }
    public function setId(int $id): self { $this->id = $id; return $this; }

    public function getName(): ?string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }

    public function getStatus(): ?string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }

    public function getProfile_image(): ?string { return $this->profile_image; }
    public function setProfile_image(?string $img): self { $this->profile_image = $img; return $this; }

    public function getCreated_at(): ?DateTime {
        return $this->created_at ? new DateTime($this->created_at) : null;
    }
    
    public function setCreated_at(DateTime|string $dt): self {
        $this->created_at = $dt instanceof DateTime ? $dt->format('Y-m-d H:i:s') : $dt;
        return $this;
    }
    

    // ✅ Correction ici
    public function encryptPassword(string $clearPassword): self {
        $this->password = password_hash($clearPassword, PASSWORD_DEFAULT);
        return $this;
    }

    public function checkPassword(string $clearPassword): bool {
        return password_verify($clearPassword, $this->password);
    }
}

// ========================
// CRUD FUNCTIONS ADAPTÉES
// ========================

function getAllUsers(): array {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM users";
        $stmt = $db->query($sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetchAll();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return [];
    }
}

function getUserById(int $id): ? User {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch() ?: null;
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return null;
    }
}

function getUserByEmail(string $email): ? User {
    try {
        $db = dbConnect();
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $stmt->fetch() ?: null;
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return null;
    }
}

function createUser(User $user): bool {
    try {
        $db = dbConnect();
        $sql = "INSERT INTO users (name, email, password, status, profile_image, created_at) 
                VALUES (:name, :email, :password, :status, :profile_image, :created_at)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':status', $user->getStatus());
        $stmt->bindValue(':profile_image', $user->getProfile_image());
        $stmt->bindValue(':created_at', $user->getCreated_at()?->format('Y-m-d H:i:s'));
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}

function updateUser(User $user): bool {
    try {
        $db = dbConnect();
        $sql = "UPDATE users SET name = :name, email = :email, password = :password, status = :status, 
                profile_image = :profile_image, created_at = :created_at WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $user->getId());
        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());
        $stmt->bindValue(':status', $user->getStatus());
        $stmt->bindValue(':profile_image', $user->getProfile_image());
        $stmt->bindValue(':created_at', $user->getCreated_at()?->format('Y-m-d H:i:s'));
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}

function deleteUser(int $id): bool {
    try {
        $db = dbConnect();
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}

function changeStatusUser(int $id, string $status): bool {
    try {
        $db = dbConnect();
        $sql = "UPDATE users SET status = :status WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}
