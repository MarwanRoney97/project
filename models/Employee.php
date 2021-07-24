<?php 
  class Employee {
    // DB stuff
    private $conn;
    private $table = 'employee';

    // Employee Properties
    public $id;
    public $Username;
    public $email;
    public $vacation_balance;
    public $phone;
    public $performance;
    public $bank_account;
    public $pure_salary;
    public $reward;
    

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get employee information
    public function read() {
      // Create query
      $query = 'SELECT DISTINCT
      employee.Username,
      employee.email,
      employee.vacation_balance,
      employee.phone,
      employee.performance,
      employee.bank_account,
      employee.id,
      salary.pure_salary,
      salary.reward,
      salary.user_id 
      FROM  employee
      INNER JOIN salary
      ON  salary.user_id = employee.id';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT * FROM pure_salary INNER JOIN employee
                                    WHERE
                                    employee.id = ?
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
          $this->Username = $row['Username'];
          $this->vacation_balance = $row['vacation_balance'];
          $this->performance = $row['performance'];
          $this->bank_account = $row['bank_account'];
          $this->pure_salary = $row['pure_salary'];
          $this->reward = $row['reward'];    
    }

    // Create Post
    public function create() {
          // Create query
          $query = 'INSERT INTO  employee SET 
          email = :email, 
          Username = :Username,
          vacation_balance = :vacation_balance,
          phone = :phone,
          bank_account = :bank_account,
          performance = :performance';
          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->Username = htmlspecialchars(strip_tags($this->Username));
          $this->vacation_balance = htmlspecialchars(strip_tags($this->vacation_balance));
          $this->phone = htmlspecialchars(strip_tags($this->phone));
          $this->bank_account = htmlspecialchars(strip_tags($this->bank_account));
          $this->performance = htmlspecialchars(strip_tags($this->performance));
         
      
         

          // Bind data
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':Username', $this->Username);
          $stmt->bindParam(':vacation_balance', $this->vacation_balance);
          $stmt->bindParam(':phone', $this->phone);
          $stmt->bindParam(':bank_account', $this->bank_account);
          $stmt->bindParam(':performance', $this->performance);
     
          
         
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
          $query = 'UPDATE employee 
          SET email = :email, 
          Username = :Username,
          vacation_balance = :vacation_balance,
          phone = :phone,
          bank_account = :bank_account,
          performance = :performance
          WHERE id = :id';
  // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->Username = htmlspecialchars(strip_tags($this->Username));
          $this->vacation_balance = htmlspecialchars(strip_tags($this->vacation_balance));
          $this->phone = htmlspecialchars(strip_tags($this->phone));
          $this->bank_account = htmlspecialchars(strip_tags($this->bank_account));
          $this->performance = htmlspecialchars(strip_tags($this->performance));
          $this->id = htmlspecialchars(strip_tags($this->id));
      
         

          // Bind data
          $stmt->bindParam(':email', $this->email);
          $stmt->bindParam(':Username', $this->Username);
          $stmt->bindParam(':vacation_balance', $this->vacation_balance);
          $stmt->bindParam(':phone', $this->phone);
          $stmt->bindParam(':bank_account', $this->bank_account);
          $stmt->bindParam(':performance', $this->performance);
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