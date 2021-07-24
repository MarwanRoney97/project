<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Admin.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Admin object
  $Admin = new Admin($db);

  // Get ID
  $Admin->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get Admin
  $Admin->read_single();

  // Create array
  $Admin_arr = array(
    'id' => $Admin->id,
    'email' => $Admin->email,
    'username' => $Admin->username,
    'password' => $Admin->password,
    'phone' => $Admin->phone
  );

  // Make JSON
  print_r(json_encode($Admin_arr));