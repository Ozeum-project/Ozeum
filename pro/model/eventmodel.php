<?php


class Event {
    private $id;
    private string $titre;
    private DateTime $datedebut;
    private DateTime $heuredebut;
    private DateTime $datefin;
    private DateTime $heurefin;
    private string $lieu;
    private string $categorie;
    private int $nbMax;
    private string $description;
    private string $image;

    public function __construct(
         $id,
        string $titre,
        DateTime $datedebut,
        DateTime $heuredebut,
        DateTime $datefin,
        DateTime $heurefin,
        string $lieu,
        string $categorie,
        int $nbMax,
        string $description,
        string $image
    ) {
        $this->id = $id;
        $this->titre = $titre;
        $this->datedebut = $datedebut;
        $this->heuredebut = $heuredebut;
        $this->datefin = $datefin;
        $this->heurefin = $heurefin;
        $this->lieu = $lieu;
        $this->categorie = $categorie;
        $this->nbMax = $nbMax;
        $this->description = $description;
        $this->image = $image;
    }

    // Getters and setters
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getTitre(): string {
        return $this->titre;
    }

    public function setTitre(string $titre): void {
        $this->titre = $titre;
    }

    public function getDatedebut(): DateTime {
        return $this->datedebut;
    }

    public function setDatedebut(DateTime $datedebut): void {
        $this->datedebut = $datedebut;
    }

    public function getHeuredebut(): DateTime {
        return $this->heuredebut;
    }

    public function setHeuredebut(DateTime $heuredebut): void {
        $this->heuredebut = $heuredebut;
    }

    public function getDatefin(): DateTime {
        return $this->datefin;
    }

    public function setDatefin(DateTime $datefin): void {
        $this->datefin = $datefin;
    }

    public function getHeurefin(): DateTime {
        return $this->heurefin;
    }

    public function setHeurefin(DateTime $heurefin): void {
        $this->heurefin = $heurefin;
    }

    public function getLieu(): string {
        return $this->lieu;
    }

    public function setLieu(string $lieu): void {
        $this->lieu = $lieu;
    }

    public function getCategorie(): string {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): void {
        $this->categorie = $categorie;
    }

    public function getNbMax(): int {
        return $this->nbMax;
    }

    public function setNbMax(int $nbMax): void {
        $this->nbMax = $nbMax;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function setImage(string $image): void {
        $this->image = $image;
    }
}

?>