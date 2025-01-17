<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Gelen verileri al
    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);
    $confirm_password = htmlspecialchars($_POST["confirm_password"]);

    // Şifre kontrolü
    if ($password !== $confirm_password) {
        die("Şifreler eşleşmiyor! Lütfen geri dönüp düzeltin.");
    }

    // Şifreyi hashle
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Veritabanı bağlantısı
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "my_database";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Bağlantı kontrolü
    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // SQL sorgusu
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Başarıyla üye oldunuz!";
    } else {
        echo "Kayıt sırasında bir hata oluştu: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Geçersiz istek.";
}
?>
