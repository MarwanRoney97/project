<?php include('config/database.php' )?>

<?php include('inc/header.php') ?>

<?php $user = DatabaseAccess::getInstance()->getUserById($_SESSION['userID'])  ?>

    <div>
        <?php echo $user['username'] ?>
    </div>

<?php include('inc/footer.php') ?>