<?php
require_once "model/dbaccess.php";

class User {
    private int $id;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $password;
    private string $statut;

    public function getId(): int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getStatut(): string { return $this->statut; }

    public function setId(int $id): self { $this->id = $id; return $this; }
    public function setNom(string $nom): self { $this->nom = $nom; return $this; }
    public function setPrenom(string $prenom): self { $this->prenom = $prenom; return $this; }
    public function setEmail(string $email): self { $this->email = $email; return $this; }
    public function setPassword(string $password): self { $this->password = $password; return $this; }
    public function setStatut(string $statut): self { $this->statut = $statut; return $this; }

    public function encryptPassword(string $clearPassword): string {
        return password_hash($clearPassword, PASSWORD_DEFAULT);
    }

    public function checkPassword(string $clearPassword): bool {
        return password_verify($clearPassword, $this->password);
    }
}

function getUserByEmail(string $email): ?User {
    try {
        $ctx = dbConnect();
        $stmt = $ctx->prepare("SELECT * FROM utilisateur WHERE email = :email");
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $user = $stmt->fetch();
        return $user ?: null;
    } catch (PDOException $e) {
        return null;
    }
}

function addUser(User $user): bool {
    try {
        $ctx = dbConnect();
        $stmt = $ctx->prepare("INSERT INTO utilisateur (nom, prenom, email, password, statut) VALUES (:nom, :prenom, :email, :password, :statut)");
        $stmt->bindValue(':nom', $user->getNom(), PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $user->getPrenom(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $user->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':password', $user->getPassword(), PDO::PARAM_STR);
        $stmt->bindValue(':statut', $user->getStatut(), PDO::PARAM_STR);
        return $stmt->execute();
    } catch (PDOException $e) {
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
