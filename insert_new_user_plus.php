<?php
include 'config.php';
global $conn;
// check_api_key();

$email = $conn->real_escape_string($_POST['email'] ?? '');
$pass = $conn->real_escape_string($_POST['pass'] ?? '');
$te_std = $conn->real_escape_string($_POST['te_std'] ?? 'teacher');

// 1. محاولة تسجيل الدخول
$sql = "SELECT email, role FROM users WHERE email = '$email' AND password = '$pass'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    // دخول ناجح - JS يتوقع غالباً بيانات المستخدم هنا أو سكريبت تحديث
    echo 'success_login_data'; 
} else {
    // 2. محاولة التسجيل
    $sql_check = "SELECT email FROM users WHERE email = '$email'";
    if ($conn->query($sql_check)->num_rows == 0) {
        // إنشاء حساب جديد
        $sql_insert = "INSERT INTO users (email, password, role) VALUES ('$email', '$pass', '$te_std')";
        if ($conn->query($sql_insert) === TRUE) {
            echo 'yes'; // يدل على تسجيل جديد ناجح
        } else {
            echo 'no'; // فشل في قاعدة البيانات
        }
    } else {
        // فشل في المصادقة (كلمة مرور خاطئة)
        echo 'no'; 
    }
}
?>