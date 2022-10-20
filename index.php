<?php
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}
// koneksi ke database
require 'functions.php' ;
$siswa = query( "SELECT * FROM tb_siswa" );

// tombol cari tekan
if( isset($_POST["cari"]) ) {
    $siswa = cari($_POST["keyword"]);
}

$n = 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        
         /* .container {
            background-color: #D3D3D3;
        }  */
          body {
            background-color: grey;
          }                  
          .tampilan {
            width : 150px;
            height : 50px;
            color : white;
            margin-right: 50px;
            font-family: helvetica;
            text-align : center;
            background-color: white;
             } 
        
         tr td {
            width : 100px;
            height : 60px;
            text-align : center;
            font-family: verdana;
            margin-right: 50px;
            background-color: white;
        
            

        } 

        .table {
            background-color: white;
        }

        .title {
            text-align: center;
        }
        
        
    </style>
</head>
<body>

    <a class="btn btn-danger btn-sm" href="logout.php"><i class="bi bi-box-arrow-left"></i>|keluar</a>
    <div class="container">
    <h1 class="title">Daftar siswa</h1>

    <a class="btn btn-success" href="tambah.php">tambah data siswa <i class="bi bi-plus-circle-dotted"></i></a>
    <br><br>

    <a class="btn btn-success" href="registrasi.php">registrasi</a>
    <br><br>

    <form action="" method="post">

         <input class="search" type="text" name="keyword" size="40" autofocus
         placeholder="search" autocomplete="off">
         <button  class="btn btn-primary btn-sm" type="submit" name="cari"><i class="bi bi-search"></i></button>

        </form>
    <br>
    <table class="table table-striped table-hover" border="1" cellpading="10" cellspacing="0">
        <tr class="tampilan">
            <th>No.</th>
            <th>aksi</th>
            <th>nis</th>
            <th>nama</th>
            <th>email</th>
            <th>jurusan</th>
            <th>alamat</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach( $siswa as $row ) : ?>
        <tr class="tampilan2">
            <td><?= $i; ?></td>
            <td>
                <a href="ubah.php?id=<?= $row["id"]; ?>"><i class="bi bi-pen-fill text-success"></i></a> |
                <a href="hapus.php?id=<?= $row["id"]; ?>" onclick="
                return confirm('yakin bang?');"><i class="bi bi-trash-fill text-danger"></i></a>
            </td>
            <td><?= $row["nis"]; ?></td>
            <td><?= $row["nama"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
            <td><?= $row["alamat"]; ?></td>
        </tr
        <?php $i++; ?>
        <?php endforeach; ?>

    </table>
        </div>
</body>
</html>