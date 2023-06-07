<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang di-submit melalui form
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    // Validasi data yang diterima (contoh sederhana)
    $errors = [];

    if (empty($email)) {
        $errors[] = "Email address is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // Jika tidak ada error, lakukan proses autentikasi
    if (empty($errors)) {
        // Lakukan operasi autentikasi di sini

        // Contoh koneksi ke database menggunakan mysqli
        $servername = "localhost";
        $username = "root";
        $dbpassword = "";
        $dbname = "vehicle_shop";

        // Buat koneksi ke database
        $conn = new mysqli($servername, $username, $dbpassword, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Lakukan operasi pencarian user berdasarkan email dan password
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // User ditemukan, proses login berhasil
            echo "Login successful!";
        } else {
            // User tidak ditemukan atau password salah, proses login gagal
            echo "Invalid email or password";
        }

        // Tutup koneksi ke database
        $conn->close();
    } else {
        // Jika ada error, tampilkan pesan error
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
