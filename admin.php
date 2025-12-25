<?php include 'protected.php'; 
if($_SESSION['role'] != 'admin'){ header("Location: user.php"); exit(); }
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-white shadow mb-6">
<div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
<h1 class="text-xl font-semibold">Admin Panel</h1>
<a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">ออกจากระบบ</a>
</div>
</nav>

<div class="max-w-3xl mx-auto bg-white p-8 shadow-lg rounded-xl">
<h2 class="text-2xl font-bold mb-4">ยินดีต้อนรับ Admin</h2>
<p class="text-gray-700">ผู้ใช้งาน: <b><?php echo $_SESSION['username']; ?></b></p>
</div>
</body>
</html>
