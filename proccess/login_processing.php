<?php 

include('../config/database.php');
session_start();

if (isset($_POST['login'])) {
    
    //fetching login data
    $username = $_POST['username'];
    $password = $_POST['password'];

    //checking to see if the value is not null
    if (!empty($username) && !empty($password)) {
        
        $user = DatabaseAccess::getInstance()->authenticate($username, $password);
        //logging in the user
        if (!empty($user)) {
            $_SESSION['userID'] = $user['id'];
            header('Location: ../dashboard.php');   
        } 
        //username or password is incorrect
        else {
            $_SESSION['error'] = "Error, username or password is incorrect";
            $_SESSION['errorClass'] = "alert-danger";
            header("Location: ../index.php");
        }

    } 
    //fields are empty
    else {
        $_SESSION['error'] = "One of the fields are empty";
        $_SESSION['errorClass'] = "alert-danger";
        header("Location: ../index.php");
    }

}

?>