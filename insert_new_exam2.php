<?php
include 'config.php';
global $conn;
// check_api_key();

// يفترض استقبال exam_name, exam_info, exam_email, exam_data (JSON) عبر POST
$name = $conn->real_escape_string($_POST['exam_name'] ?? '');
$info = $conn->real_escape_string($_POST['exam_info'] ?? '');
$email = $conn->real_escape_string($_POST['exam_email'] ?? '');
$data = $conn->real_escape_string($_POST['exam_data'] ?? '');

// توليد رقم اختبار فريد (4 أرقام)
do {
    $t_num = rand(1000, 9999);
    $check_sql = "SELECT t_num FROM exams WHERE t_num = '$t_num'";
} while ($conn->query($check_sql)->num_rows > 0);

$sql = "INSERT INTO exams (t_num, t_name, t_info, t_email, exam_data) 
        VALUES ('$t_num', '$name', '$info', '$email', '$data')";

if ($conn->query($sql) === TRUE) {
    echo $t_num; // يرد برقم الاختبار الجديد
} else {
    http_response_code(500);
    echo json_encode(["error" => "Database insert failed: " . $conn->error]);
}
?>