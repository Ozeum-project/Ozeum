<?php
// product.php
class Product {
    private int $id;
    private string $titre;
    private string $description;
    private float $prix_normale;
    private float $prix_promotion;
    private int $quantite;
    private string $image;
    private string $category;

    public function __construct(
        int $id,
        string $titre,
        string $description,
        float $prix_normale,
        float $prix_promotion,
        int $quantite,
        string $image,
        string $category
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->prix_normale = $prix_normale;
        $this->prix_promotion = $prix_promotion;
        $this->quantite = $quantite;
        $this->image = $image;
        $this->category = $category;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getTitre(): string { return $this->titre; }
    public function getDescription(): string { return $this->description; }
    public function getPrixNormale(): float { return $this->prix_normale; }
    public function getPrixPromotion(): float { return $this->prix_promotion; }
    public function getQuantite(): int { return $this->quantite; }
    public function getImage(): string { return $this->image; }
    public function getCategory(): string { return $this->category; }

    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setTitre(string $titre): void { $this->titre = $titre; }
    public function setDescription(string $description): void { $this->description = $description; }
    public function setPrixNormale(float $prix_normale): void { $this->prix_normale = $prix_normale; }
    public function setPrixPromotion(float $prix_promotion): void { $this->prix_promotion = $prix_promotion; }
    public function setQuantite(int $quantite): void { $this->quantite = $quantite; }
    public function setImage(string $image): void { $this->image = $image; }
    public function setCategory(string $category): void { $this->category = $category; }


}
?>