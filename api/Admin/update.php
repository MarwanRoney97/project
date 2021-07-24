<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Admin.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Admin post object
  $post = new Admin($db);

  // Get raw Admin data
  $data = json_decode(file_get_contents("php://input"));
  $post->id = $data->id;
  $post->username = $data->username;
  $post->email = $data->email;
  $post->password = $data->password;
  $post->phone = $data->phone;


  // update post
  if($post->update()) {
    echo json_encode(
      array('message' => 'Admin Updated')
    );
  } else {
        echo json_encode(
          array('message' => 'Admin  Not Updated')
    );
  }