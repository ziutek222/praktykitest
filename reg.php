<?php
    include ("config.php");
    session_start();

    if(isset($_POST['submit'])){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $user = $_POST['user'];
            $email = $_POST['email'];
            $pass = md5($_POST['pass1']);
            $cpass = md5($_POST['cpass']);
            $user_type = $_POST['user_type'];

            $new_user = mysqli_real_escape_string($con, $user);
            $new_email = mysqli_real_escape_string($con, $email);

            //check there ara any existing recode in database
            
            $sql1 = "SELECT * FROM user_tbl WHERE username = '$new_user' && email = '$new_email' && pass = '$pass' ";
            $result1 = mysqli_query($con,$sql1);

            $nor = mysqli_num_rows($result1);



            if($nor > 0){
                $error[] = "User Already exist";
            }else{
                //chech Password and Confirm password is matched.
                if($pass != $cpass){
                    $error[] = "Password and Confirm password doesn't match...!";
                }
                else{
                    //insert data to database
                    $sql2 = "INSERT INTO user_tbl(username,email,pass,user_type,user_status) VALUES('$new_user','$new_email','$pass','$user_type','1')";
                    $result2 = mysqli_query($con, $sql2);

                    if(!$result2){
                        $error[] = "ERROR";
                    }else{
                        if($user_type == 'admin'){
                            setcookie('loginDemo',$user,time()+60*60);
                            $_SESSION['login'] =  $user;
                            header("location:admin.php");
                        }
                        else if($user_type == 'manager'){
                            setcookie('loginDemo',$user,time()+60*60);
                            $_SESSION['login'] =  $user;
                            header("location:manager.php");
                        }
                        else if($user_type == 'user'){
                            setcookie('loginDemo',$user,time()+60*60);
                            $_SESSION['login'] =  $user;
                            header("location:user.php");
                        }
                        else if($user_type == 'employee'){
                            setcookie('loginDemo',$user,time()+60*60);
                            $_SESSION['login'] =  $user;
                            header("location:employee.php");
                        }
                    }                    
                }
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
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <div class="content">
            <div class="form-container">
                <form action="<?php echo($_SERVER['PHP_SELF'])?>" method="POST">
                    <fieldset>
                        <legend>Registration</legend>

                        <?php
                                if(isset($error)){
                                    foreach($error as $error){
                                        echo("<p class='error'>".$error."</p>");
                                    }
                                }
                        ?>
                        <div class="FIELDS">    
                                <input type="text" name="user" id="user" placeholder="Enter Your Username">
                                <br>
                                <br>    
                                <input type="email" name="email" id="email" placeholder="Enter Your Email">
                                <br>
                                <br>
                                <input type="password" name="pass1" id="pass1" placeholder="Enter Your Password">
                                <br>
                                <br>
                                <input type="password" name="cpass" id="cpass" placeholder="Confirm Your Password">
                                <br>
                                <br>
                        </div>
                        <select name="user_type" id="user_type">
                            <option value="user">User</option>                          
                        </select>
                        
                            Already have an accout? <a href="login.php">Login</a>
                            <br>
                        
                        <input type="submit" value="Register" name="submit" class="submit">
                        <br>
                        <br>
                        
                        <input type="reset" value="Clear" class="reset">
                    </fieldset>

                </form>
            </div>
        </div>
    </div>

    
</body>
</html>
