<?php
// filepath: c:\xampp\htdocs\ozeum\ilyes\server\mvc\model\cartModel.php

class CartItem {
    private int $id;
    private string $user_email;
    private int $product_id;
    private int $quantity;

    public function __construct(
        int $id,
        string $user_email,
        int $product_id,
        int $quantity = 1
    ) {
        $this->id = $id;
        $this->user_email = $user_email;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getUserEmail(): string { return $this->user_email; }
    public function getProductId(): int { return $this->product_id; }
    public function getQuantity(): int { return $this->quantity; }

    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setUserEmail(string $user_email): void { $this->user_email = $user_email; }
    public function setProductId(int $product_id): void { $this->product_id = $product_id; }
    public function setQuantity(int $quantity): void { $this->quantity = $quantity; }
}