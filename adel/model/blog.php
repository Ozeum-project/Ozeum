<?php
class Blog {
    private int $id;
    private string $titre;
    private string $categorie;
    private string $statut;
    private string $auteur;
    private DateTime $date_publication;
    private string $contenu;
    private string $thumbnail;

    /**
     * Blog constructor
     * 
     * @param int $id The blog post ID
     * @param string $titre The blog post title
     * @param string $categorie The blog post category
     * @param string $statut The blog post status (e.g., 'published', 'draft')
     * @param string $auteur The blog post author
     * @param DateTime $date_publication The blog post publication date
     * @param string $contenu The blog post content
     * @param string $thumbnail The blog post thumbnail image path
     */
    public function __construct(
        int $id, 
        string $titre, 
        string $categorie, 
        string $statut, 
        string $auteur, 
        DateTime $date_publication, 
        string $contenu, 
        string $thumbnail
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->categorie = $categorie;
        $this->statut = $statut;
        $this->auteur = $auteur;
        $this->date_publication = $date_publication;
        $this->contenu = $contenu;
        $this->thumbnail = $thumbnail;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getTitre(): string { return $this->titre; }
    public function getCategorie(): string { return $this->categorie; }
    public function getStatut(): string { return $this->statut; }
    public function getAuteur(): string { return $this->auteur; }
    public function getDatePublication(): DateTime { return $this->date_publication; }
    public function getContenu(): string { return $this->contenu; }
    public function getThumbnail(): string { return $this->thumbnail; }

    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setTitre(string $titre): void { $this->titre = $titre; }
    public function setCategorie(string $categorie): void { $this->categorie = $categorie; }
    public function setStatut(string $statut): void { $this->statut = $statut; }
    public function setAuteur(string $auteur): void { $this->auteur = $auteur; }
    public function setDatePublication(DateTime $date_publication): void { $this->date_publication = $date_publication; }
    public function setContenu(string $contenu): void { $this->contenu = $contenu; }
    public function setThumbnail(string $thumbnail): void { $this->thumbnail = $thumbnail; }

    /**
     * Format the blog post as a string representation
     * 
     * @return string The string representation of the blog post
     */
    public function __toString(): string {
        return "Blog(id={$this->id}, titre={$this->titre}, auteur={$this->auteur}, date=" . 
               $this->date_publication->format('Y-m-d H:i:s') . ", statut={$this->statut})";
    }
}
?>