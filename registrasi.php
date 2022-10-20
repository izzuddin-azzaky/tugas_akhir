<?php
require 'functions.php';

if( isset($_POST["register"]) ) {

    if( registrasi($_POST) > 0 ) {
        echo "<script>
            alert('user baru berhasil di tambahkan!');
             </script>";

        } else {
            echo mysqli_error($conn);
        }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registrasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        body {
         display: block;
         background: #456;
         font-family: 'Open Sans', sans-serif;
    
     }
     .container {
      width: 400px;
      margin: 16px auto;
      font-size: 16px;
      background-color: white;
      box-shadow: 3px 3px 3px black;
      text-align: center;
      border-radius: 20px;
      padding: 10px;
      padding-right: 30px;
      font-family: verdana;
      border: 5px solid #87CEFA;
     }
     .title {
      color: #456;
      font-size: 50px;
      font-family: monospace;
      font-weight: bold;
      

      
     }
        label {
            display:block;
        }

        form ul li {
        list-style: none;
    }

        button {
        height: 40px;
        width: 220px;
    }

    </style>
</head>
<body>
    <a  class="btn btn-danger btn-sm" href="index.php"><i class="bi bi-box-arrow-in-left"></i>|EXIT</a>
    <div class="container">
    <h1 class="title">Registrasi</h1>
    <br><br>
    <form action="" method="post">
     
    <ul>
        <li>
            <label for="username">username :</label>
            <input class="form-control" type="text" name="username" id="username" placeholder="masukan username...">
        </li>
        <br>
        <li>
            <label for="password">password :</label>
            <input class="form-control" type="password" name="password" id="password" placeholder="masukan password...">
        </li>
        <br>
        <li>
            <label for="password2">konfirmasi password :</label>
            <input class="form-control" type="password" name="password2" id="password2" placeholder="konfirmasi passsword...">
        </li>
        <br>
        <li>
            <button  class="btn btn-primary btn-sm" type="submit" name="register">REGISTER</button>
        </li>
    </ul>

    </form>
    </div>
    
</body>
</html>