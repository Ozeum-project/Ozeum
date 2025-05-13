<?php
// userModel.php
class User {
    private int $id;
    private string $name;
    private string $lastName;
    private string $email;
    private string $password;
    private string $image;
    private string $adresse;

    public function __construct(
        int $id,
        string $name,
        string $lastName,
        string $email,
        string $password,
        string $image,
        string $adresse
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->image = $image;
        $this->adresse = $adresse;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getLastName(): string { return $this->lastName; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getImage(): string { return $this->image; }
    public function getAdresse(): string { return $this->adresse; }

    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setLastName(string $lastName): void { $this->lastName = $lastName; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function setImage(string $image): void { $this->image = $image; }
    public function setAdresse(string $adresse): void { $this->adresse = $adresse; }

    // You might want to add a method to hash passwords
    public function hashPassword(): void {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    // And a method to verify passwords
    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->password);
    }
}
?>