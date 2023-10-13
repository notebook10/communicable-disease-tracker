<?php
class Post {
    private $conn;
    private $table_name = 'posts';
    public $id;
    public $location_id;
    public $disease_id;
    public $user_id;
    public $date;
    public $time;
    public $created_at;
    public $location;
    public $disease;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function getPosts()
    {
        $query = 'SELECT 
                p.id,
                l.location AS location,
                d.disease AS disease,
                u.username AS username,
                p.date AS date,
                p.time AS time
            FROM ' . $this->table_name . ' p
                JOIN locations l ON l.id = p.location_id
                JOIN diseases d ON d.id = p.disease_id
                JOIN users u ON u.id = p.user_id';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO ". $this->table_name ." (location_id, disease_id, user_id, date, time, created_at) 
                    VALUES (:value1, :value2, :value3, :value4, :value5, :value6)";
                    
        $stmt = $this->conn->prepare($query);

        $this->disease = htmlspecialchars(strip_tags($this->disease));
        
        $stmt->bindParam(':value1', $this->location_id);
        $stmt->bindParam(':value2', $this->disease_id);
        $stmt->bindParam(':value3', $_SESSION['user_id']);
        $stmt->bindParam(':value4', $this->date);
        $stmt->bindParam(':value5', $this->time);
        $stmt->bindParam(':value6', $this->created_at);
        if($stmt->execute()){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function getOne($id)
    {
        $query = "SELECT id,location_id, disease_id,date,time FROM " . $this->table_name . "
          WHERE id = ?
          LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
		$stmt->bindParam(1,$id);
		$stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->id = $row['id'];
            $this->location_id = $row["location_id"];
            $this->disease_id = $row["disease_id"];
            $this->date = $row["date"];
            $this->time = $row["time"];
        }
    }

    public function search()
    {
        $query = 'SELECT 
            p.id,
            l.location AS location,
            d.disease AS disease,
            u.username AS username,
            p.date AS date,
            p.time AS time,
            u.username
        FROM ' . $this->table_name . ' p
            JOIN locations l ON l.id = p.location_id
            JOIN diseases d ON d.id = p.disease_id
            JOIN users u ON u.id = p.user_id
        WHERE
            p.location_id = :value1 and
            p.date = :value2 and
            p.time = :value3';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':value1', $this->location_id);
        $stmt->bindParam(':value2', $this->date);
        $stmt->bindParam(':value3', $this->time);
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        $query = "update ". $this->table_name ." SET location_id = :value1, disease_id = :value2, date = :value3, time = :value4
                    WHERE id=:value5";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':value1', $this->location_id);
        $stmt->bindParam(':value2', $this->disease_id);
        $stmt->bindParam(':value3', $this->date);
        $stmt->bindParam(':value4', $this->time);
        $stmt->bindParam(':value5', $this->id);
        if($stmt->execute()){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function delete()
    {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id=' . $this->id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>