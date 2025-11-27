<?php
session_start(); 
include "db.php";

$username=$_POST['username']; 
$password=$_POST['password'];

$sql="SELECT * FROM users WHERE username=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$username);
$stmt->execute();
$result=$stmt->get_result();

if($result->num_rows==1){
    $row=$result->fetch_assoc();
    if(password_verify($password,$row['password'])){
        $_SESSION['user_id']=$row['id'];
        $_SESSION['username']=$row['username'];
        $_SESSION['role']=$row['role'];

        switch($row['role']){
            case 'admin': header("Location: admin.php"); exit();
            case 'user': header("Location: user.php"); exit();
        }

    } else {
        echo "รหัสผ่านไม่ถูกต้อง";
    }
} else {
    echo "ไม่พบบัญชีผู้ใช้";
}
?>
