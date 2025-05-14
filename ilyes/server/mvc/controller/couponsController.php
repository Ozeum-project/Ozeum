<?php
include_once 'C:\xampp\htdocs\ozeum\ilyes\server\config.php';
include_once 'C:\xampp\htdocs\ozeum\ilyes\server\mvc\model\couponsModel.php';

class CouponsController {
    public function getAllCoupons() {
        $db = config::getConnexion();
        $sql = "SELECT * FROM coupons";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $coupons = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $coupons[] = new Coupon(
                $row['id'],
                $row['coupon'],
                $row['promotion']
            );
        }
        return $coupons;
    } 

    public function addCoupon($coupon, $promotion) {
        $db = config::getConnexion();
        $sql = "INSERT INTO coupons (coupon, promotion) VALUES (:coupon, :promotion)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':coupon', $coupon, PDO::PARAM_STR);
        $stmt->bindValue(':promotion', intval($promotion), PDO::PARAM_INT);
        $stmt->execute();
    }


}