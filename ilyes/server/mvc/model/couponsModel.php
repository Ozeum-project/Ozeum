<?php

class Coupon {
    private int $id;
    private string $coupon;
    private int $promotion;

    public function __construct(int $id, string $coupon, int $promotion) {
        $this->id = $id;
        $this->coupon = $coupon;
        $this->promotion = $promotion;
    }

    // Getters
    public function getId(): int { return $this->id; }
    public function getCoupon(): string { return $this->coupon; }
    public function getPromotion(): int { return $this->promotion; }

    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setCoupon(string $coupon): void { $this->coupon = $coupon; }
    public function setPromotion(int $promotion): void { $this->promotion = $promotion; }
}