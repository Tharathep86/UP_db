<?php
include "protected.php";
include "db.php";

$products = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>รายการสินค้า</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-white shadow mb-6">
<div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
<h1 class="text-xl font-semibold">รายการสินค้า</h1>
<a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">ออกจากระบบ</a>
</div>
</nav>

<div class="max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-xl">
<h2 class="text-xl font-bold mb-4">สินค้า</h2>
<table class="w-full table-auto border-collapse border border-gray-300">
<thead>
<tr class="bg-gray-100">
<th class="border px-4 py-2">ID</th>
<th class="border px-4 py-2">ชื่อสินค้า</th>
<th class="border px-4 py-2">คำอธิบาย</th>
<th class="border px-4 py-2">ราคา</th>
</tr>
</thead>
<tbody>
<?php while($row = $products->fetch_assoc()): ?>
<tr>
<td class="border px-4 py-2"><?php echo $row['id']; ?></td>
<td class="border px-4 py-2"><?php echo $row['name']; ?></td>
<td class="border px-4 py-2"><?php echo $row['description']; ?></td>
<td class="border px-4 py-2"><?php echo number_format($row['price'],2); ?></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</body>
</html>
