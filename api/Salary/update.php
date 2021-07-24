<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Salary.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate employee post object
  $post = new Salary($db);

  // Get raw Employee data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $post->id = $data->id;
  
  $post->pure_salary = $data->pure_salary;
 
  $post->reward = $data->reward;
  $post->user_id = $data->user_id;

  // Create post
  if($post->update()) {
    echo json_encode(
      array('message' => 'employee Updated')
    );
  } else {
        echo json_encode(
          array('message' => 'employee  Not Updated')
    );
  }