<?php 
  class Salary {
    // DB stuff
    private $conn;
    private $table = 'salary';

    // pure_salary Properties
    public $id;
    public $pure_salary;
    public $reward;
    public $user_id;
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

   
    // Create pure_salary
    public function create() {
          // Create query
          $query = 'INSERT INTO  salary SET 
          pure_salary = :pure_salary, 
          reward = :reward,
          user_id = :user_id';
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->pure_salary = htmlspecialchars(strip_tags($this->pure_salary));
          $this->reward = htmlspecialchars(strip_tags($this->reward));
         
          $this->user_id = htmlspecialchars(strip_tags($this->user_id));
         
          // Bind data
          $stmt->bindParam(':pure_salary', $this->pure_salary);
          $stmt->bindParam(':reward', $this->reward);
          $stmt->bindParam(':user_id', $this->user_id);
          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Update Post
    public function update() {
          // Create query
          $query = 'UPDATE   salary SET 
          pure_salary = :pure_salary, 
          reward = :reward,
          user_id = :user_id
          WHERE id=:id';
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->pure_salary = htmlspecialchars(strip_tags($this->pure_salary));
          $this->reward = htmlspecialchars(strip_tags($this->reward));
          $this->user_id = htmlspecialchars(strip_tags($this->user_id));
          $this->id = htmlspecialchars(strip_tags($this->id));
          // Bind data
          $stmt->bindParam(':pure_salary', $this->pure_salary);
          $stmt->bindParam(':reward', $this->reward);
          $stmt->bindParam(':user_id', $this->user_id);
          $stmt->bindParam(':id', $this->id);
          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    // Delete Post
    public function delete() {
          // Create query
          $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam(':id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;
    }
    
  }