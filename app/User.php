<?php
class User {
    private $conn;
    private $table_name = 'users';
    public $id;
    public $username;
    public $email;
    public $password;
    public $is_admin;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function getUsers()
    {
        $query = 'SELECT * FROM ' . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO ". $this->table_name ." (username, email, password, is_admin,created_at) 
                    VALUES (:value1, :value2, :value3, :value4, :value5)";
        $stmt = $this->conn->prepare($query);

        $this->username = htmlspecialchars(strip_tags($this->username));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->password = htmlspecialchars(strip_tags($this->password));
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bindParam(':value1', $this->username);
        $stmt->bindParam(':value2', $this->email);
        $stmt->bindParam(':value3', $this->password);
        $stmt->bindParam(':value4', $this->is_admin);
        $stmt->bindParam(':value5', $this->created_at);
        if($stmt->execute()){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function getOne($email)
    {
        $query = "SELECT id,username, email, password, is_admin FROM " . $this->table_name . "
          WHERE email = ?
          LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
		$stmt->bindParam(1,$email);
		$stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->id = $row['id'];
            $this->username = $row["username"];
            $this->email = $row["email"];
            $this->password = $row["password"];
            $this->is_admin = $row["is_admin"];
        }
    }
}
?>