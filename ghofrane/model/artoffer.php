<?php
class Art {

private string $code;
private string $nom;
private DateTime $date;
private string $disponibilite;
private string $ida; 
private string $category;
private string $img; 
public function __construct(
    string $code,
    string $nom,
    DateTime $date,
    string $disponibilite,
    string $ida,
    string $category,
    string $img
) {
    $this->code = $code;
    $this->nom = $nom;
    $this->date = $date;
    $this->disponibilite = $disponibilite;
    $this->ida = $ida;
    $this->category = $category;
    $this->img = $img;
}

// Getters
public function getCode(): string { return $this->code; }
public function getNom(): string { return $this->nom; }
public function getDate(): DateTime { return $this->date; }
public function getDisponibilite(): string { return $this->disponibilite; }
public function getIda(): string { return $this->ida; }
public function getImg(): string { return $this->img; }
public function getCategory(): string { return $this->category; }

// Setters
public function setCode(string $code): void { $this->code = $code; }
public function setNom(string $nom): void { $this->nom = $nom; }
public function setDate(DateTime $date): void { $this->date = $date; }
public function setDisponibilite(string $disponibilite): void { $this->disponibilite = $disponibilite; }
public function setIda(string $ida): void { $this->ida = $ida; }
public function setImg(string $img): void { $this->img = $img; }
public function setCategory(string $category): void { $this->category = $category; }
}
?>