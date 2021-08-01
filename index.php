<?php include('inc/header.php') ?>
    
<div class="row">

    <div class= 'w-50 container border form-group mt-5 p-3 shadow-lg' style="border-radius: 50px">

        <div class="container-fluid">

            <div class="row shadow-sm border rounded-pill p-3 text-center mb-4" > 
                <h5 class="m-0">
                    Accounting System
                </h5>    
            </div>

            <div>
                <form action="proccess/login_processing.php" method="POST">
                    <h3 class="text-center"><strong>Login to the system</strong></h3>
                    <small>
                        <?php if (isset($_SESSION['error'])): ?>
                            <div id="error_indicator" class="alert <?php echo $_SESSION['errorClass']; ?>">
                                <strong class="text-center" ><?php echo $_SESSION['error'] ?></strong>
                            </div>
                        <?php endif ?>	
                    </small>

                        <div class="row">
                            <div class="col-sm">
                                <label class="col-form-label" for="inputDefault"><strong>Username</strong></label>
                                <input type="text" name="username" maxlength="20" class=" rounded-pill form-control" placeholder="Insert username here">
                            </div>
                        </div>

                        <div class= "row">
                            <div class="col-sm">
                                <label class="col-form-label" for="inputDefault"><strong>Password</strong></label>
                                <input type="password" name="password" minlength="4" maxlength="10" class="rounded-pill form-control" placeholder="Insert password here">
                            </div>
                        </div>
                        <br>
                    <div class="row">
                        <div class="col-sm">
                            <button type="submit" name="login" class="rounded-pill form-control btn btn-primary btn-lg btn-block">Login</button>
                        </div>
                    </div>
                </form>
            </div>
                
        </div>
        
    </div>

</div>

<?php include('inc/footer.php') ?>