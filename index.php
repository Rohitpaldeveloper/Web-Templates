<?php
include 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reg-img</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php

    // define variables and set to empty values
    $nameErr = $emailErr = $phonenoErr = $passwordErr = "";
    $name = $email = $phoneno = $password = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-1-9' ]*$/",$name)) {
      $nameErr = "Only letters and Numeric Numbers allowed";
    }
  }
}
    function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
    }

    $msg ="";
        if(isset($_POST['signup'])){
            //Store Image the uploaded file
            $target = "images/".basename($_FILES['image']['name']);

                $name       = $_POST['name'];
                $email      = $_POST['email'];
                $phoneno    = $_POST['phoneno'];
                $password   = $_POST['password'];
                $image      = $_FILES['image']['name'];

            $sql = "INSERT INTO acc(name,email,phoneno,password,image) VALUES (?,?,?,?,?)";
            $stmtinsert = $con->prepare($sql);
            $result = $stmtinsert->execute([$name,$email,$phoneno,$password,$image]);
            // if($result){
            //     echo "Data Successully Saved Properly In DataBase..";
            // }
            // else{
            //     echo "Some Errors Occured To Save Data In DataBase..";
            // }

            // header("location: welcome.php");

            //upload image move into folder..
            if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
                $msg = "Image Upload Successfully..";
            }
            else{
                $msg = "ERROR";
            }

        }

    ?>


    <div class="container">
        <h1>Registration Form</h1>
        <br>
        <hr>
    <div class="form">
        <form action="index.php" method="post" enctype="multipart/form-data">
        <label class="mr" for="">Name</label> <br>
        <input class="input-tag mr" type="text" name="name" id="name" placeholder="Enter Name" required> <br>
        <label class="mr" for="">E-Mail</label> <br>
        <input class="input-tag mr" type="email" name="email" id="email" placeholder="Enter E-mail" required> <br>
        <label class="mr" for="">Phone Number</label> <br>
        <input class="input-tag mr" type="number" name="phoneno" id="phoneno" placeholder="Enter Phone Number" required> <br>
        <label class="mr" for="">Password</label> <br>
        <input class="input-tag mr" type="password" name="password" id="password" placeholder="Choose Password." required> <br>
        <label class="mr" for="">Upload</label> <br>
        <input class="mr" type="file" name="image" id="image"> <br>
        <input class="mr" type="checkbox" name="" id="" required> I Accepted <a href="term.php"> Terms & Condition.</a> <br>
        <input class="btn"type="submit" value="Signup" name="signup" style="width:80px; height:30px; background-color:violet; border-radius: 15px;"> <br>
        <div class="div2"><a href="login.php">Already Have An Account</a></div>
        </form>
    </div>
    </div>
</body>
</html>