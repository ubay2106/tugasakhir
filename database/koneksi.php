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

//register
function register($data){
    global $conn;
    
    $username = htmlspecialchars($data['username']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $role = htmlspecialchars($data['role']);
    
    // Cek role untuk menentukan nilai NIDN atau NIM
    $nidn = ($role !== 'Mahasiswa') ? htmlspecialchars($data['nidn']) : null;
    $nim = ($role === 'Mahasiswa') ? htmlspecialchars($data['nim']) : null;

    // Validasi apakah NIM atau NIDN sudah terdaftar
    $cek = "SELECT * FROM users WHERE ";
    if ($role === 'Mahasiswa') {
        $cek .= "nim = '$nim'";
    } else {
        $cek .= "nidn = '$nidn'";
    }
    
    $cek1 = mysqli_query($conn, $cek);

    if (mysqli_num_rows($cek1) > 0) {  
        return -1; // Indikasi bahwa NIM atau NIDN sudah terdaftar
    }

    // Query insert data ke tabel dosen/mahasiswa sesuai role
    $query = "INSERT INTO users (username, nim, nidn, password, role) VALUES
              ('$username', ";
    if ($role === 'Mahasiswa') {
        $query .= " '$nim', NULL, '$password', '$role')";
    } else {
        $query .= "NULL,'$nidn', '$password', '$role')";
    }

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//login
function login($data) {
    global $conn;

    $role = htmlspecialchars($data['role']);
    $password = htmlspecialchars($data['password']);

    if ($role === 'Admin') {
        $identifier = htmlspecialchars($data['nidn']);
        $query = "SELECT * FROM users WHERE nidn = '$identifier' AND role = 'Admin'";
    } elseif ($role === 'Kaprodi') {
        $identifier = htmlspecialchars($data['nidn']);
        $query = "SELECT * FROM users WHERE nidn = '$identifier' AND role = 'Kaprodi'";
    } elseif ($role === 'Penguji') {
        $identifier = htmlspecialchars($data['nidn']);
        $query = "SELECT * FROM users WHERE nidn = '$identifier' AND role = 'Penguji'";
    } elseif ($role === 'Pembimbing') {
        $identifier = htmlspecialchars($data['nidn']);
        $query = "SELECT * FROM users WHERE nidn = '$identifier' AND role = 'Pembimbing'";
    } else {
        return false; // Role tidak valid
    }

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Password cocok, simpan session
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        } else {
            // Password salah
            return false;
        }
    }

    // NIM/NIDN tidak ditemukan
    return false;
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


function register_user($data){
    global $conn;
    
    $username = htmlspecialchars($data['username']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $role = htmlspecialchars($data['role']);

    $role = isset($data['role']) ? htmlspecialchars($data['role']) : 'Mahasiswa';
    
    // Cek role untuk menentukan nilai NIDN atau NIM
    $nidn = ($role !== 'Mahasiswa') ? htmlspecialchars($data['nidn']) : null;
    $nim = ($role === 'Mahasiswa') ? htmlspecialchars($data['nim']) : null;

    // Validasi apakah NIM atau NIDN sudah terdaftar
    $cek = "SELECT * FROM users WHERE ";
    if ($role === 'Mahasiswa') {
        $cek .= "nim = '$nim'";
    } else {
        $cek .= "nidn = '$nidn'";
    }
    
    $cek1 = mysqli_query($conn, $cek);

    if (mysqli_num_rows($cek1) > 0) {  
        return -1; // Indikasi bahwa NIM atau NIDN sudah terdaftar
    }

    // Query insert data ke tabel dosen/mahasiswa sesuai role
    $query = "INSERT INTO users (username, nim, nidn, password, role) VALUES
              ('$username', ";
    if ($role === 'Mahasiswa') {
        $query .= " '$nim', NULL, '$password', '$role')";
    } else {
        $query .= "NULL,'$nidn', '$password', '$role')";
    }

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function login_user($data) {
    global $conn;

    $role = isset($data['role']) ? htmlspecialchars($data['role']) : 'Mahasiswa';
    $password = htmlspecialchars($data['password']);

    // Cek role untuk menentukan login dengan NIM atau NIDN
    if ($role === 'Mahasiswa') {
        $identifier = htmlspecialchars($data['nim']);
        $query = "SELECT * FROM users WHERE nim = '$identifier' AND role = 'Mahasiswa'";
    } elseif ($role === 'Kaprodi') {
        $identifier = htmlspecialchars($data['nidn']);
        $query = "SELECT * FROM users WHERE nidn = '$identifier' AND role = 'Kaprodi'";
    } elseif ($role === 'Penguji') {
        $identifier = htmlspecialchars($data['nidn']);
        $query = "SELECT * FROM users WHERE nidn = '$identifier' AND role = 'Penguji'";
    } elseif ($role === 'Pembimbing') {
        $identifier = htmlspecialchars($data['nidn']);
        $query = "SELECT * FROM users WHERE nidn = '$identifier' AND role = 'Pembimbing'";
    } else {
        return false; // Role tidak valid
    }

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Password cocok, simpan session
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        } else {
            // Password salah
            return false;
        }
    }

    // NIM/NIDN tidak ditemukan
    return false;
}
?>