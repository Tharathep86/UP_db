<?php
include "db.php";
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $message = "มีชื่อผู้ใช้นี้แล้ว!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username,password,role) VALUES (?,?,?)");
        $stmt->bind_param("sss",$username,$password,$role);
        if($stmt->execute()){
            $message = "สมัครสมาชิกเรียบร้อย! <a href='login.php' class='text-blue-600 underline'>ไปที่หน้า Login</a>";
        } else {
            $message = "เกิดข้อผิดพลาด!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">สมัครสมาชิก</h2>

    <?php if($message != ""): ?>
        <div class="mb-4 text-center text-red-600"><?php echo $message; ?></div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-4">
        <div>
            <label class="font-medium">Username</label>
            <input type="text" name="username" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="font-medium">Password</label>
            <input type="password" name="password" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
            <label class="font-medium">Role</label>
            <select name="role" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">-- เลือกสิทธิ์ --</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
        </div>

        <button type="submit"
        class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition">
            สมัครสมาชิก
        </button>
    </form>

    <p class="mt-4 text-center text-gray-600">
        มีบัญชีแล้ว? <a href="login.php" class="text-blue-600 underline">ไปที่หน้า Login</a>
    </p>
</div>

</body>
</html>
