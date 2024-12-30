<?php
//koneksi
$conn = mysqli_connect("localhost", 
"root", "", "skripsi");

$rows=[];
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows =[];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

//tambah dosen
function tambah_dosen($data){
    global $conn;
    $nidn = htmlspecialchars($data['nidn']);
    $nama = htmlspecialchars($data['nama']);
    $email = htmlspecialchars($data['email']);
    $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
    $status = htmlspecialchars($data['status']);

    $cek = "SELECT *FROM dosen WHERE email = '$email'";
    $cek1=mysqli_query($conn, $cek);

    if(mysqli_num_rows($cek1) > 0){  
        return -1;
    }

    $query = "INSERT INTO dosen (nidn, nama, email, jenis_kelamin, status) VALUES
                    ('$nidn', '$nama', '$email', '$jenis_kelamin', '$status' )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


//tambah dosen
function daftar_mahasiswa($data){
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $nim = htmlspecialchars($data['nim']);
    $tanggal_lahir = htmlspecialchars($data['tanggal_lahir']);
    $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
    $alamat = htmlspecialchars($data['alamat']);

    $cek = "SELECT *FROM mahasiswa WHERE nim = '$nim'";
    $cek1=mysqli_query($conn, $cek);

    if(mysqli_num_rows($cek1) > 0){  
        return -1;
    }

    $query = "INSERT INTO mahasiswa (nama, nim, tanggal_lahir, jenis_kelamin, alamat) VALUES
                    ('$nama', '$nim', '$tanggal_lahir', '$jenis_kelamin', '$alamat' )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
?>