<?php
class Reclamation {
    private int $id;
    private string $name;
    private string $title;
    private string $email;
    private string $subject;
    private string $status;

    /**
     * Reclamation constructor
     * 
     * @param int $id The reclamation ID
     * @param string $name The reclamation name
     * @param string $title The reclamation title
     * @param string $email The sender's email
     * @param string $subject The reclamation subject
     * @param string $status The reclamation status
     */
    public function __construct(
        int $id, 
        string $name,
        string $title, 
        string $email, 
        string $subject, 
        string $status
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->title = $title;
        $this->email = $email;
        $this->subject = $subject;
        $this->status = $status;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getTitle(): string { return $this->title; }
    public function getEmail(): string { return $this->email; }
    public function getSubject(): string { return $this->subject; }
    public function getStatus(): string { return $this->status; }

    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setTitle(string $title): void { $this->title = $title; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setSubject(string $subject): void { $this->subject = $subject; }
    public function setStatus(string $status): void { $this->status = $status; }

    /**
     * Format the reclamation as a string representation
     * 
     * @return string The string representation of the reclamation
     */
    public function __toString(): string {
        return "Reclamation(id={$this->id}, title={$name->name}, title={$this->title}, email={$this->email}, subject={$this->subject}, status={$this->status})";
    }
}
?>