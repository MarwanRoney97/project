<?php

header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Admin.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Admin object
  $Admin = new Admin($db);

  // Blog Admin query
  $result = $Admin->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Admin
  if($num > 0) {
    // Admin array
    $Admin_arr = array();
     $Admin_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $Admin_item = array(
        'id' => $id,
        'email' => $email,
        'username' => $username,
        'password' => $password,
        'phone' => $phone
        
      );

      // Push to "data"
    //  array_push($Admin_arr, $Admin_item);
       array_push($Admin_arr['data'], $Admin_item);
    }

    // Turn to JSON & output
    echo json_encode($Admin_arr);

  } else {
    // No Admin
      echo json_encode(
        array('message' => 'No Admin Found')
    );
  }