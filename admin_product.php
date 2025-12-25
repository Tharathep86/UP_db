<?php 
include "protected.php"; 
if($_SESSION['role'] != 'admin'){ header("Location: user.php"); exit(); }

include "db.php";
$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO products (name,description,price) VALUES (?,?,?)");
    $stmt->bind_param("ssd",$name,$description,$price);

    if($stmt->execute()){
        $message = "เพิ่มสินค้าสำเร็จ!";
    } else {
        $message = "เกิดข้อผิดพลาด!";
    }
}

$products = $conn->query("SELECT * FROM products ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>จัดการสินค้า (Admin)</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<nav class="bg-white shadow mb-6">
<div class="max-w-5xl mx-auto px-4 py-4 flex justify-between items-center">
<h1 class="text-xl font-semibold">Admin Product Panel</h1>
<a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">ออกจากระบบ</a>
</div>
</nav>

<div class="max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-xl mb-6">
<h2 class="text-xl font-bold mb-4">เพิ่มสินค้าใหม่</h2>

<?php if($message != ""): ?>
    <div class="mb-4 text-green-600"><?php echo $message; ?></div>
<?php endif; ?>

<form action="" method="POST" class="space-y-4">
    <input type="text" name="name" placeholder="ชื่อสินค้า" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
    <textarea name="description" placeholder="คำอธิบายสินค้า" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
    <input type="number" step="0.01" name="price" placeholder="ราคา" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">เพิ่มสินค้า</button>
</form>
</div>

<div class="max-w-3xl mx-auto bg-white p-6 shadow-lg rounded-xl">
<h2 class="text-xl font-bold mb-4">รายการสินค้า</h2>
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
