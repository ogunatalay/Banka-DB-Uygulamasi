<?php

$servername = "localhost"; // Veritabanı sunucusunun adı veya IP adresi
$username = "root"; // Veritabanı kullanıcı adı
$password = ""; // Veritabanı kullanıcı şifresi
$dbname = "test"; // Veritabanının adı

// Veritabanı bağlantısını oluşturma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}
