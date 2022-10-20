<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'functions.php';

// ambil data di url
$id = $_GET["id"] ;

// query data siswa
$mhs = query("SELECT * FROM tb_siswa WHERE id = $id")[0];

// cek apakah submit sudah terkirim atau belum
if( isset($_POST["submit"]) ) {

if( ubah($_POST) > 0 ) {
   echo "
       <script>
           alert('data berhasil di ubah!');
           document.location.href = 'index.php';
        </script>
  ";
} else {
    echo "
    <script>
           alert('data gagal di ubah!');
           document.location.href = 'index.php';
        </script>
  ";
}

    
   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
    <style>
        body {
      display: block;
      background: #456;
      font-family: 'Open Sans', sans-serif;
     }
      .container {
      width: 60%;
      margin: 16px auto;
      font-size: 16px;
      margin-top: 50px;
     } 
     .title {
      background: #28d;
      padding: 20px;
      font-size: 40px;
      font-weight: bold;
      text-align: center;
      text-transform: uppercase;
      color: #fff;
      font-family: monospace;
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
      width: 50%;
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
     /* button {
        height: 60px;
        width: 1290px;
        text-align: center;
     } */
     .input {
      border: 2px solid blue;
     }

    </style>
</head>
<body>

<div class="container">

    <h1 class="title">ubah data siswa</h1>
    <form class="login-container" action="" method="post">
        <input type="hidden" name="id" value="<?= $mhs["id"] ; ?>">
    
    <ul>
        <li>
            <label for="nis">Nis :</label>
            <input class="form-control" type="text" name="nis" id="nis" required
            value="<?= $mhs["nis"]; ?>">
        </li>
        <li>
            <label for="nama">Nama :</label>
            <input class="form-control" type="text" name="nama" id="nama"
            value="<?= $mhs["nama"]; ?>">
        </li>
        <li>
            <label for="jurusan">jurusan :</label>
            <input class="form-control" type="text" name="jurusan" id="jurusan"
            value="<?= $mhs["jurusan"]; ?>">
        </li>
        <li>
            <label for="email"> email:</label>
            <input class="form-control" type="text" name="email" id="email"
            value="<?= $mhs["email"]; ?>">
        </li>
        <li>
            <label for="alamat">alamat :</label>
            <input class="form-control" type="text" name="alamat" id="alamat"
            value="<?= $mhs["alamat"]; ?>">
        </li>
        <br>
        <li>
            <button class="btn btn-success" type="submit" name="submit">ubah Data!!!</button>
        </li>
    </ul>
    
    </form>
    <br>
    <a class="btn btn-danger" href="index.php">kembali</a>

</div>

</body>
</html>