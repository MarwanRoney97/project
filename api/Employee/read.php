<?php

header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Employee.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Employee object
  $Employee = new Employee($db);

  // Blog Employee query
  $result = $Employee->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Employee
  if($num > 0) {
    // Employee array
    $Employee_arr = array();
     $Employee_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $Employee_item = array(
        'id' => $id,
        'email' => $email,
        'Username' => $Username,
        'vacation_balance' => $vacation_balance,
        'phone' => $phone,
        'performance' => $performance,
        'bank_account' => $bank_account,
        'salary' => $salary,
        'reward' => $reward   
      );

      // Push to "data"
    //  array_push($Employee_arr, $Employee_item);
       array_push($Employee_arr['data'], $Employee_item);
    }

    // Turn to JSON & output
    echo json_encode($Employee_arr);

  } else {
    // No Employee
      echo json_encode(
        array('message' => 'No Employee Found')
    );
  }