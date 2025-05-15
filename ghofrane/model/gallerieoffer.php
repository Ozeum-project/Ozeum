<?php
class artiste {

private int $id;
private string $nom;
private string $email;
private string $status;

public function __construct(int $id, string $nom, string $email,string $status) {
    $this->id = $id;
    $this->nom = $nom;
    $this->email = $email;
    $this->status = $status;
}

// Getters
public function getId(): int { return $this->id; }
public function getNom(): string { return $this->nom; }
public function getEmail(): string { return $this->email; }
public function getStatus(): string { return $this->status; }

// Setters
public function setId(int $id): void { $this->id = $id; }
public function setNom(string $nom): void { $this->nom = $nom; }
public function setEmail(string $email): void { $this->email = $email; }
public function setStatus(string $status): void { $this->status = $status; }
}

?>