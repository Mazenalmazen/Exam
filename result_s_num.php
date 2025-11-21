<?php
include 'new_exam/config.php'; // يجب تعديل المسار هنا ليكون صحيحاً من الجذر
global $conn;
// check_api_key();

$exam_num = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($exam_num > 0) {
    // هذا الملف كان يستخدم لغرض قديم (نتيجة الطالب حسب الرقم)، يتم محاكاة الرد هنا
    echo '<!-- Placeholder for result_s_num.php -->';
}
?>