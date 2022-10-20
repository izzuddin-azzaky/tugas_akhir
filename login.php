<?php
require 'functions.php';

session_start();

// cek cookie
if( isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
   $id = $_COOKIE['id'];
   $key = $_COOKIE['key'];


   // ambil username berdasarkan id
   $result = mysqli_query($conn, "SELECT username FROM user WHERE
       id = $id");
   $row = mysqli_fetch_assoc($result);

   // cek cookie dan username
   if( $key === hash('sha256', $row['username']) ) {
       $_SESSION['login'] = true;
   }
}
if( isset($_SESSION["login"]) ) {
    header("location: index.php");
    exit;
}

if( isset($_POST["login"]) )  {

    $username = $_POST["username"];
    $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

   //    cek username
   if( mysqli_num_rows($result) === 1 ) {

   // cek password
   $row = mysqli_fetch_assoc($result);
   if( password_verify($password, $row["password"]) ) {
    // set session
    $_SESSION["login"] = true;

   //  cek remember me
    if( isset($_POST['remember']) ) {
      // buat cookie
      setcookie('id', $row['id'], time()+60);
      setcookie('key', hash('sha256', $row['username']), time()+60);
    }

    header("location: index.php");
       exit;
   }
}

    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>

     body {
      display: block;
      background: #456;
      font-family: 'Open Sans', sans-serif;
     }

     .container {
      width: 40%;
      margin: 16px auto;
      font-size: 16px;
      text-align: center;
     }
     .title {
      background: #28d;
      padding: 20px;
      font-size: 1.4em;
      font-weight: normal;
      text-align: center;
      text-transform: uppercase;
      color: #fff;
     }
     .login-container {
      background: #ebebeb;
      padding: 12px;
     }
     .login p {
      padding: 20px;
     }
     .login input {
      box-sizing: border-box;
      display: block;
      width: 100%;
      border-width: 1px;
      border-style: solid;
      padding: 16px;
      outline: 0;
      font-family: inherit;
      font-size: 0.95em;
     }
     .login input[type="text"],
      .login input[type="password"] {
      background: #fff;
      border-color: #bbb;
      color: #555;
      border: 2px solid blue;
      border : none;
      }
      .login input[type="text"]:focus,
      .login input[type="password"]:focus {
      border-color: #888;
      }
      form ul li {
        list-style: none;
    }
     button {
        height: 40px;
        width: 285px;
     }
     .input {
      border: 2px solid blue;
     }



    </style>
</head>
<body>
    <div class="container">
    <h1 class="title">form login</h1>

    <?php if( isset($error) ) : ?>
        <p style="color : red; font-style: italic;">username / password salah bang</p>
    <?php endif; ?>
    <form class="login-container" action="" method="post">
    <ul>
           <li>
              <label class="username" for="username">Username:</label>
              <input type="text" name="username" id="username" placeholder="masukan username....">
           </li>
           <br>
           <li>
              <label  class="password" for="password">Password :</label>
              <input type="password" name="password" id="password" placeholder="masukan password....">
          </li>
           <li>
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">remember me</label>
           </li>
           <br>
           <li>
               <button  class="btn btn-primary btn-sm" type="submit" name="login">LOGIN</button>
           </li>
       </ul>
    </form>
    </div>
</body>
</html>