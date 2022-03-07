    <?php
    include ('config.php');
    session_start();

    if(isset($_POST['login'])){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $user = $_POST['user'];
            $pass = md5($_POST['pass']);

            $new_user = mysqli_real_escape_string($con,$user);
            
            $sql = "SELECT * FROM user_tbl WHERE username = '$new_user' && pass = '$pass'";
            $result = mysqli_query($con,$sql);



            if(mysqli_num_rows($result) > 0){

                $passn = md5($pass);
                $row = mysqli_fetch_assoc($result);
                if($row['user_status'] == 1){
                        if($row['user_type'] == 'admin'){
                            setcookie('loginDemo',$user,time()+60*60);
                            $_SESSION['login'] =  $user;
                            header('location:admin.php');
                        }
                        if($row['user_type'] == 'manager'){
                            setcookie('loginDemo',$user,time()+60*60);
                            $_SESSION['login'] =  $user;
                            header('location:manager.php');
                        }
                        if($row['user_type'] == 'user'){
                            setcookie('loginDemo',$user,time()+60*60);
                            $_SESSION['login'] =  $user;
                            header('location:user.php');
                        }
                        if($row['user_type'] == 'employee'){
                            setcookie('loginDemo',$user,time()+60*60);
                            $_SESSION['login'] =  $user;
                            header('location:employee.php');
                        }
                    }else{
                        $error[] = "Your account has been deactivated...!";
                    }
                }else{
                        $error[] = "Incorrect Password or Username";
                }
           
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="content">
             <div class="form-container">
                <form action="<?php echo($_SERVER['PHP_SELF'])?>" method="post">
                    <fieldset>
                        <legend>Login</legend>

                            <?php
                                    if(isset($error)){
                                        foreach($error as $error){
                                            echo("<p class='error'>".$error."</p>");
                                        }
                                    }
                            ?>
                            <input type="text" name="user" id="user" placeholder="Enter Your Username">
                            <input type="password" name="pass" id="pass" placeholder="Enter Your Password">
                            <p>
                                Don't have an account? <a href="reg.php">Create One</a>
                            </p>
                            <input type="submit" value="Login" class="login-submit" name="login">
                        </form>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>