<?php
require_once "model/dbaccess.php";

/**
 * Class User
 * Représente un utilisateur de la plateforme.
 */
class User {
    private int $id = 0;
    private string $nom = '';
    private string $prenom = '';
    private string $email = '';
    private string $password = '';
    private string $statut = '';

    // === Getters & Setters ===

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): self {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self {
        $this->prenom = $prenom;
        return $this;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;
        return $this;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): self {
        $this->password = $password;
        return $this;
    }

    public function getStatut(): string {
        return $this->statut;
    }

    public function setStatut(string $statut): self {
        $this->statut = $statut;
        return $this;
    }

    // === Méthodes de sécurité ===

    /**
     * Crypte un mot de passe en clair
     */
    public function encryptPassword(string $clearPassword): string {
        $this->password = password_hash($clearPassword, PASSWORD_DEFAULT);
        return $this->password;
    }

    /**
     * Vérifie si le mot de passe correspond
     */
    public function checkPassword(string $clearPassword): bool {
        return password_verify($clearPassword, $this->password);
    }
}

//
// === FONCTIONS CRUD UTILISATEUR ===
//

function getAllUsers(): array {
    $users = [];
    $sql = "SELECT * FROM utilisateur";

    try {
        $ctx = dbConnect();
        $req = $ctx->query($sql);
        $req->setFetchMode(PDO::FETCH_CLASS, 'User');
        $users = $req->fetchAll();
    } catch (Exception $e) {
        var_dump($e->getMessage());
    }
    return $users;
}

function getUserById(int $id): ?User {
    $sql = "SELECT * FROM utilisateur WHERE id = :id";

    try {
        $ctx = dbConnect();
        $req = $ctx->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $req->fetch() ?: null;
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return null;
    }
}

function getUserByEmail(string $email): ?User {
    $sql = "SELECT * FROM utilisateur WHERE email = :email";

    try {
        $ctx = dbConnect();
        $req = $ctx->prepare($sql);
        $req->bindValue(':email', $email, PDO::PARAM_STR);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'User');
        return $req->fetch() ?: null;
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return null;
    }
}

function addUser(User $user): bool {
    $sql = "INSERT INTO utilisateur (nom, prenom, email, password, statut) VALUES (:nom, :prenom, :email, :password, :statut)";
    try {
        $ctx = dbConnect();
        $req = $ctx->prepare($sql);
        $req->bindValue(':nom', $user->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $user->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':password', $user->encryptPassword($user->getPassword()), PDO::PARAM_STR);
        $req->bindValue(':statut', $user->getStatut(), PDO::PARAM_STR);
        return $req->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}

function updateUser(User $user): bool {
    $sql = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, password = :password, statut = :statut WHERE id = :id";
    try {
        $ctx = dbConnect();
        $req = $ctx->prepare($sql);
        $req->bindValue(':nom', $user->getNom(), PDO::PARAM_STR);
        $req->bindValue(':prenom', $user->getPrenom(), PDO::PARAM_STR);
        $req->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $req->bindValue(':password', $user->encryptPassword($user->getPassword()), PDO::PARAM_STR);
        $req->bindValue(':statut', $user->getStatut(), PDO::PARAM_STR);
        $req->bindValue(':id', $user->getId(), PDO::PARAM_INT);
        return $req->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}

function deleteUser(int $id): bool {
    $sql = "DELETE FROM utilisateur WHERE id = :id";
    try {
        $ctx = dbConnect();
        $req = $ctx->prepare($sql);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        return $req->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}

function changeUserStatut(int $id, string $newStatut): bool {
    $sql = "UPDATE utilisateur SET statut = :statut WHERE id = :id";
    try {
        $ctx = dbConnect();
        $req = $ctx->prepare($sql);
        $req->bindValue(':statut', $newStatut, PDO::PARAM_STR);
        $req->bindValue(':id', $id, PDO::PARAM_INT);
        return $req->execute();
    } catch (Exception $e) {
        var_dump($e->getMessage());
        return false;
    }
}
