<?php 
  class Admin {
    // DB stuff
    private $conn;
    private $table = 'admin';

    // Admin Properties
    public $id;
    public $username;
    public $email;
    public $password;
    public $phone;
    
   
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Admin information
    public function read() {
      // Create query
      $query = 'SELECT *FROM  admin WHERE id =id';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM admin 
                                    WHERE
                                    Admin.id = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->id);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->phone = $row['phone'];
          $this->email = $row['email'];
          $this->username = $row['username'];
          $this->password = $row['password'];
          $this->id = $row['id'];
          
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO  admin SET 
          email = :email, 
          username = :username,
          password = :password,
          phone = :phone';
       
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->username = htmlspecialchars(strip_tags($this->username));
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->phone = htmlspecialchars(strip_tags($this->phone));
          // Bind data
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':username', $this->username);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':phone', $this->phone);
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
          $query = 'UPDATE Admin 
          SET email = :email, 
          username = :username,
          password = :password,
          phone = :phone
          WHERE id = :id';
  // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->username = htmlspecialchars(strip_tags($this->username));
          $this->password = htmlspecialchars(strip_tags($this->password));
          $this->phone = htmlspecialchars(strip_tags($this->phone));
          $this->id = htmlspecialchars(strip_tags($this->id));
          // Bind data
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':username', $this->username);
          $stmt->bindParam(':password', $this->password);
          $stmt->bindParam(':phone', $this->phone);
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