<?php
$host="localhost"; 
$user="root"; 
$pass="";
$conn=new mysqli($host,$user,$pass);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Installer</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-xl">
<h2 class="text-2xl font-bold mb-4">ติดตั้งระบบ UP</h2>

<?php
if($conn->connect_error){
    echo "<p class='text-red-600 font-medium'>เชื่อมต่อฐานข้อมูลไม่ได้</p>";
} else {
    $conn->query("CREATE DATABASE IF NOT EXISTS LOG_db");
    $conn->select_db("LOG_db");

    // ตาราง users
    $conn->query("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100),
        password VARCHAR(255),
        role ENUM('admin','user'),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // ผู้ใช้เริ่มต้น
    $pass=password_hash("123456",PASSWORD_DEFAULT);
    $conn->query("INSERT INTO users (username,password,role) VALUES
        ('admin01','$pass','admin'),
        ('user01','$pass','user')
    ");

    echo "<p class='text-green-600 font-medium'>ติดตั้งเสร็จสิ้น!</p>";
    echo "<a href='login.php' class='mt-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>ไปที่หน้า Login</a>";
}
?>
</div>
</body>
</html>
