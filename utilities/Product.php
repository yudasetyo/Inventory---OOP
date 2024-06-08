<?php 
    class Product {
        private $conn;
        private $table_name = "products";

        public $id;
        public $name;
        public $stock;
        public $category;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        public function read() {
            try {
                $query = "SELECT * FROM " . $this->table_name;
                $stmt = $this->conn->prepare($query);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }
        }

        public function create() {
            try {
                $query = "INSERT INTO " . $this->table_name . " (name, stock, category) VALUES (:name, :stock, :category)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':name', $this->name);
                $stmt->bindParam(':stock', $this->stock);
                $stmt->bindParam(':category', $this->category);
                if ($stmt->execute()) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function readOne() {
            try {
                $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $this->id);
                $stmt->execute();
                return $stmt;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return null;
            }
        }

        public function update() {
            try {
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
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }

        public function delete() {
            try {
                $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $this->id);
                if ($stmt->execute()) {
                    return true;
                }
                return false;
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                return false;
            }
        }
    }
?>