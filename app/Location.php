<?php
class Location {
    private $conn;
    private $table_name = 'locations';
    public $id;
    public $location;
    public $created_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    public function getLocations()
    {
        $query = 'SELECT * FROM ' . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create()
    {
        $query = "INSERT INTO ". $this->table_name ." (location, created_at) 
                    VALUES (:value1, :value2)";
                    
        $stmt = $this->conn->prepare($query);

        $this->location = htmlspecialchars(strip_tags($this->location));
        
        $stmt->bindParam(':value1', $this->location);
        $stmt->bindParam(':value2', $this->created_at);
        if($stmt->execute()){
    		return true;
    	}else{
    		return false;
    	}
    }

    public function getOne($id)
    {
        $query = "SELECT id,location FROM " . $this->table_name . "
          WHERE id = ?
          LIMIT 1";
        $stmt = $this->conn->prepare($query);
        
		$stmt->bindParam(1,$id);
		$stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $this->id = $row['id'];
            $this->location = $row["location"];
        }
    }
}
?>