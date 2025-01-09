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


//login user
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
            $_SESSION['nim'] = $user ['nim'];
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

//login
function login($data) {
    global $conn;

    $role = isset($data['role']) ? htmlspecialchars($data['role']) : 'Admin';
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


//register
function register($data){
    global $conn;
    
    $username = htmlspecialchars($data['username']);
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $role = htmlspecialchars($data['role']);

    $role = isset($data['role']) ? htmlspecialchars($data['role']) : 'Admin';
    
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

//regis user
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


//tambah dosen
function tambah_dosen($data){
    global $conn;
    $nidn = htmlspecialchars($data['nidn_id']);
    $nama = htmlspecialchars($data['nama']);
    $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
    $status = htmlspecialchars($data['status']);

    $cek = "SELECT *FROM dosen WHERE nidn_id = '$nidn'";
    $cek1=mysqli_query($conn, $cek);

    if(mysqli_num_rows($cek1) > 0){  
        return -1;
    }

    $query = "INSERT INTO dosen (nidn_id, nama, jenis_kelamin, status) VALUES
                    ('$nidn', '$nama', '$jenis_kelamin', '$status' )";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


//tambah mhs
function daftar_mahasiswa($data){
    global $conn;
    $nama = htmlspecialchars($data['nama']);
    $nim_id = htmlspecialchars($data['nim_id']);
    $tanggal_lahir = htmlspecialchars($data['tanggal_lahir']);
    $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
    $judul = htmlspecialchars($data['judul']);

    $cek = "SELECT *FROM mahasiswa WHERE nim_id = '$nim_id'";
    $cek1=mysqli_query($conn, $cek);

    if(mysqli_num_rows($cek1) > 0){  
        return -1;
    }

    $query = "INSERT INTO mahasiswa (nama, nim_id, tanggal_lahir, jenis_kelamin, judul) VALUES
                    ('$nama', '$nim_id', '$tanggal_lahir', '$jenis_kelamin', '$judul')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


//manage
function manage($data){
    global $conn;
    $nim_id = htmlspecialchars($data['nim_id']);
    $mahasiswa_id = htmlspecialchars($data['mahasiswa_id']);
    $judul_id = htmlspecialchars($data['judul_id']);
    $nidn_idbim = htmlspecialchars($data['nidn_idbim']);
    $pembimbing_id = htmlspecialchars($data['pembimbing_id']);
    $nidn_iduji = htmlspecialchars($data['nidn_iduji']);
    $penguji_id = htmlspecialchars($data['penguji_id']);

    $cek = "SELECT *FROM penentuan WHERE nim_id = '$nim_id'";
    $cek1=mysqli_query($conn, $cek);

    if(mysqli_num_rows($cek1) > 0){  
        return -1;
    }

    $query = "INSERT INTO penentuan (nim_id, mahasiswa_id, judul_id, nidn_idbim, pembimbing_id, nidn_iduji, penguji_id) VALUES
                    ('$nim_id', '$mahasiswa_id', '$judul_id', '$nidn_idbim', '$pembimbing_id', '$nidn_iduji', '$penguji_id')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//pengajuan update
function updateStatus($id, $pengajuan) {
    global $conn;

    $id = htmlspecialchars($id);
    $pengajuan = htmlspecialchars($pengajuan);

    $query = "UPDATE mahasiswa SET pengajuan = ? WHERE nim_id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "si", $pengajuan, $id);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        return true;
    } else {
        mysqli_stmt_close($stmt);
        return false;
    }
}
?>