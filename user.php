<?php
    include ("config.php");
    session_start();

  

    if(isset($_POST['submit'])){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $promien = $_POST['promien'];
            $kula = $_POST['wynik'];
            

            $kula = mysqli_real_escape_string($con, $kula);
            $promien = mysqli_real_escape_string($con, $promien);

            //check there ara any existing recode in database
            
            $sql1 = "SELECT * FROM kula WHERE wynik = '$kula' && promien = '$promien'";
            $result1 = mysqli_query($con,$sql1);

            $nor = mysqli_num_rows($result1);



            if($nor > 0){
                $error[] = "User Already exist";
            }else{
                //chech Password and Confirm password is matched.
                
                
                    //insert data to database
                    $sql2 = "INSERT INTO kula(wynik, promien) VALUES('$promien','$kula')";
                    $result2 = mysqli_query($con, $sql2);

                    if(!$result2){
                        $error[] = "ERROR";
                        
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
    <title>Kalkulator objetosci kuli!</title>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <div class="naglowek">
        <H1>Kalkulator kuli!!</H1>
        <div class="logout">
        <h4><?php echo($_COOKIE['loginDemo']);?></h4>

    <a href="logout.php"><button class="logout">Logout</button></a>
        </div>
    </div>
    <div class="info">
        <h1>Objetosc i powierzchnia kuli</h1>
        Kula jest określona promieniem lub średnicą, jest zbiorem punktów, które są odległe od środka maksymalnie długością równą promieniowi.
        </div>
        <div class="obj">
            <h3>Wzor:</h3>
            <img src="img/wzor.png" alt="">
            <div class="kula"><img src="img/kula.jpg" alt=""></div>
        </div>
        <form action="<?php echo($_SERVER['PHP_SELF'])?>" method="POST">        
            <div class="kalkulator">
                r = <input onkeydown="return noNumbers(event)" name="promien" placeholder="Wprowadz promien" id="promien" type="text"  >
                <button id="oblicz" onclick="oblicz2()"   name="submit" type="submit">Oblicz!</button>
                    <div class="wynik">

                        V = <input onkeydown="return noNumbers(event)" name="wynik" id="wynik" placeholder="Wynik!" type="text">
                        <button type="submit" onclick="clean()">Wyczysc</button>
                    </div>
                    <div class="zapisz">
                        <input name="submit" value="Register" class="submit" type="submit">
                    </div>
            </div>
         </form>        
</body>
</html>
