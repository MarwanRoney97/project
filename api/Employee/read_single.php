<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Employee.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Employee object
  $Employee = new Employee($db);

  // Get ID
  $Employee->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get Employee
  $Employee->read_single();

  // Create array
  $Employee_arr = array(
    'id' => $Employee->id,
    'email' => $Employee->email,
    'Username' => $Employee->Username,
    'vacation_balance' => $Employee->vacation_balance,
    'phone' => $Employee->phone,
    'bank_account' => $Employee->bank_account,
    'salary' => $Employee->salary,
    'reward' => $Employee->reward,
    'performance' => $Employee->performance
  );

  // Make JSON
  print_r(json_encode($Employee_arr));