<?php

$conn = mysqli_connect("localhost", "root", "" , "daftar_siswa") ;
 
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [] ;
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows [] = $row;
    }
    return $rows;
} 

function tambah($data) {
    global $conn;

    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $alamat = htmlspecialchars($data["alamat"]);
 
    $query = "INSERT INTO tb_siswa
    VALUES
    ( '','$nis', '$nama', '$jurusan', '$email', '$alamat')
    ";

mysqli_query ($conn, $query);
 
return mysqli_affected_rows($conn);

}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_siswa WHERE id = $id");
    
    return mysqli_affected_rows($conn);
}


function ubah($data) {
    global $conn;
    
    $id = $data["id"];
    $nis = htmlspecialchars($data["nis"]);
    $nama = htmlspecialchars($data["nama"]);
    $jurusan = htmlspecialchars($data["jurusan"]);
    $email = htmlspecialchars($data["email"]);
    $alamat = htmlspecialchars($data["alamat"]);
 
    $query = "UPDATE tb_siswa SET
            nis = '$nis',
            nama = '$nama',
            jurusan = '$jurusan',
            email = '$email',
            alamat = '$alamat'
        WHERE id = $id
        ";

mysqli_query ($conn, $query);
 
return mysqli_affected_rows($conn);

}

function cari($keyword) {
    $query = "SELECT * FROM tb_siswa
               WHERE
              nama LIKE '%$keyword%' OR
              nis LIKE '%$keyword%' OR
              email LIKE '%$keyword%' or
              jurusan LIKE '%$keyword%' OR
              alamat LIKE '%$keyword%' 
             ";
    return query($query);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

// cek username udah ada atau belum
     $result = mysqli_query($conn, "SELECT username FROM user WHERE
             username = '$username'");

     if (mysqli_fetch_assoc($result) ) {
        echo "<script>
              alert('username sudah terdaftar!')
              </script>";
        return false;
     }

//    cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script>
                alert('konfirmasi password tidak sesuai!');
                </script>";
         return false;
     }
// enkripsi password
$password =password_hash($password, PASSWORD_DEFAULT);

// tambahkan userbaru ke database
mysqli_query($conn, "INSERT INTO user VALUES('','$username', '$password')");

return mysqli_affected_rows($conn);
}
