<?php

class OrderDetailModel {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // READ all details belonging to one order
    public function readByOrder($orderNum) {
        $sql = "SELECT d.*, p.fld_product_name, p.fld_product_price
                FROM tbl_orders_details_a223784 d
                LEFT JOIN tbl_products_a223784 p ON p.fld_product_num = d.fld_product_num
                WHERE d.fld_order_num = :order_num
                ORDER BY d.fld_order_detail_num ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':order_num', $orderNum, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // READ a single order detail by ID
    public function readById($id) {
        $sql = "SELECT * FROM tbl_orders_details_a223784
                WHERE fld_order_detail_num = :detail_num";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':detail_num', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // CREATE a new order detail
    public function create($data) {
        $sql = "INSERT INTO tbl_orders_details_a223784
                (fld_order_num, fld_product_num, fld_order_detail_quantity)
                VALUES (:order_num, :product_num, :quantity)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':order_num', $data['order_num'], PDO::PARAM_INT);
        $stmt->bindValue(':product_num', $data['product_num'], PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $data['quantity'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    // UPDATE an order detail
    public function update($data) {
        $sql = "UPDATE tbl_orders_details_a223784
                SET fld_product_num = :product_num,
                    fld_order_detail_quantity = :quantity
                WHERE fld_order_detail_num = :detail_num";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':detail_num', $data['detail_num'], PDO::PARAM_INT);
        $stmt->bindValue(':product_num', $data['product_num'], PDO::PARAM_STR);
        $stmt->bindValue(':quantity', $data['quantity'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    // DELETE an order detail
    public function delete($id) {
        $sql = "DELETE FROM tbl_orders_details_a223784
                WHERE fld_order_detail_num = :detail_num";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':detail_num', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}

?>
