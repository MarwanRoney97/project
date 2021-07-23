<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Employee.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate employee post object
  $post = new Employee($db);

  // Get raw Employee data
  $data = json_decode(file_get_contents("php://input"));

  $post->Username = $data->Username;
  $post->email = $data->email;
  $post->vacation_balance = $data->vacation_balance;
  $post->phone = $data->phone;
  $post->performance = $data->performance;
  $post->bank_account = $data->bank_account;

  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'employee Updated')
    );
  } else {
        echo json_encode(
          array('message' => 'employee  Not Updated')
    );
  }