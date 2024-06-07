<?php 
    class Product {
        private $conn;
        private $table_name = "products";

        public $id;
        public $name;
        public $stock;
        public $category;

        public function __construct($id)
        {
            $this->conn = $id;
        }

        public function read() {
            $query = "SELECT * FROM " . $this->table_name;
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        public function create() {
            $query = "INSERT INTO " . $this->table_name . " (name, stock, category) VALUES (:name, :stock, :category)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':stock', $this->stock);
            $stmt->bindParam(':category', $this->category);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function readOne() {
            $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->execute();
            return $stmt;
        }

        public function update() {
            $query = "UPDATE " . $this->table_name . " SET name = :name, stock = :stock, category = :category WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':stock', $this->stock);
            $stmt->bindParam(':category', $this->category);
            $stmt->bindParam(':id', $this->id);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function delete() {
            $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id);
            if ($stmt->execute()) {
                return true;
            }
            return false;
        }
    }
?>