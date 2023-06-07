<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data yang di-submit melalui form
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['passwordConfirm'];

    // Validasi data yang diterima (contoh sederhana)
    $errors = [];

    if (empty($firstName)) {
        $errors[] = "First name is required";
    }

    if (empty($lastName)) {
        $errors[] = "Last name is required";
    }

    if (empty($email)) {
        $errors[] = "Email address is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    if ($password !== $passwordConfirm) {
        $errors[] = "Password confirmation does not match";
    }

    // Jika tidak ada error, proses penyimpanan data ke database
    if (empty($errors)) {
        // Lakukan operasi penyimpanan data ke database di sini

        // Contoh koneksi ke database menggunakan mysqli
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "vehicle_shop";

        // Buat koneksi ke database
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Periksa koneksi
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Gabungkan first_name dan last_name menjadi nama
        $nama = $firstName . " " . $lastName;

        // Lakukan operasi penyimpanan data ke tabel users
        $sql = "INSERT INTO users (nama, email, password) VALUES ('$nama', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
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
