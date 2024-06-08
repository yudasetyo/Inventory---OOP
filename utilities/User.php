<?php 
    class User {
        private $conn;
        private $table_name = "users";

        public $id;
        public $name;
        public $email;
        public $password;

        public function __construct($db)
        {
            $this->conn = $db;            
        }

        private function sanitizeInput($input) {
            return htmlspecialchars(strip_tags(trim($input)));
        }

        public function validateEmail($email) {
            return filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);
        }

        public function validatePassword($password) {
            return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])[A-Za-z\d]{8,}$/',  $password);
        }

        public function register() {
            try {
                $this->name = $this->sanitizeInput($this->name);
                $this->email = $this->sanitizeInput($this->email);
                $this->password = $this->sanitizeInput($this->password);

                if (!$this->validateEmail($this->email)) {
                    throw new Exception("Invalid email format.");
                }

                if (!$this->validatePassword($this->password)) {
                    throw new Exception("Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one digit");
                }

                $query = "INSERT INTO " . $this->table_name . " (name, email, password) VALUES (:name, :email, :password)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':name', $this->name);
                $stmt->bindParam(':email', $this->email);
                $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
                $stmt->bindParam(':password', $hashedPassword);

                if ($stmt->execute()) {
                    return true;
                } else {
                    throw new Exception('Register failed');
                }
                
            } catch (Exception $e) {
                throw $e;
            }
        }

        public function login() {
            try {
                $this->email = $this->sanitizeInput($this->email);
                $this->password = $this->sanitizeInput($this->password);

                $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':email', $this->email);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row && password_verify($this->password, $row['password'])) {
                    $_SESSION['user_id'] = $row['id'];
                    setcookie('user', $row['name'], time() + (86400 * 30), "/");
                    return true;
                } else {
                    throw new Exception("Invalid email or password");
                }  
            } catch (Exception $e) {
                throw $e;
            }
        }

        public function logout() {
            session_destroy();
            setcookie('user', '', time() - 3600, "/");
        }
    }
?>