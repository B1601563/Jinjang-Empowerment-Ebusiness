<?php
  session_start();
  $serverName = "localhost";
  $dbUserName = "root";
  $dbPassword = "";
  $dbName = "jee";
  $connection = new mysqli($serverName, $dbUserName, $dbPassword, $dbName);

  $userName = stripcslashes($_POST['Cusername']);
  $password = stripcslashes($_POST['Cpassword']);
  $companyName = stripcslashes($_POST['Ccompanyname']);
  $email = stripcslashes($_POST['Cemail']);
  $phone = stripcslashes($_POST['Cphone']);
  $userName = mysqli_real_escape_string($connection, $userName);
  $password = mysqli_real_escape_string($connection, $password);
  $companyName = mysqli_real_escape_string($connection, $companyName);
  $email = mysqli_real_escape_string($connection, $email);
  $phone = mysqli_real_escape_string($connection, $phone);

  $query = "SELECT * FROM user WHERE userName = '$userName'";
  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) > 0) {
    echo "<script>alert('sign up failed');</script>";
    $_SESSION['tSignUp'] = "failed";
    header("Location: index.php");
  }
  else {
    $query = "INSERT INTO  user (username, password, address, phoneNo, email, userType) VALUES
    ('$userName','$password','','$email', '$phone','client')";
    $query2 = "INSERT INTO  client (username, companyName, companyDescription) VALUES
    ('$userName', '$companyName', '')";
    mysqli_query($connection, $query);
    mysqli_query($connection, $query2);
    header("Location: index.php");
  }

  mysqli_close($connection);
?>