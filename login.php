<?php
include "db.php";
$users = $conn->query("SELECT username FROM users");
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Login</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style> body { font-family: 'Inter', sans-serif; } </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
    <h2 class="text-2xl font-bold text-center mb-6">เข้าสู่ระบบ</h2>

    <form action="check_login.php" method="POST" class="space-y-4">
        <div>
            <label class="font-medium">Username</label>
            <input list="usernames" name="username" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <datalist id="usernames">
                <?php while($row = $users->fetch_assoc()): ?>
                    <option value="<?php echo $row['username']; ?>">
                <?php endwhile; ?>
            </datalist>
        </div>

        <div>
            <label class="font-medium">Password</label>
            <input type="password" name="password" required
            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <button type="submit"
        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
            Login
        </button>
    </form>

    <p class="mt-4 text-center text-gray-600">
        ไม่มีบัญชี? 
        <a href="signup.php" class="text-blue-600 underline">สร้างตรงนี้</a>
    </p>

</div>

</body>
</html>
