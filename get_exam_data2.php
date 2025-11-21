<?php
include 'config.php';
global $conn;
// check_api_key(); 

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT t_name, t_info, t_email, exam_data FROM exams WHERE t_num = '$id' LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // الكود الأمامي يتوقع كل البيانات الميتا (metadata) إضافة إلى exam_data
        $response = [
            "exam_name" => $row['t_name'],
            "exam_info" => $row['t_info'],
            "exam_email" => $row['t_email'],
            "exam_data" => $row['exam_data'],
            // تضاف الحقول المتبقية هنا إذا كانت مطلوبة بشكل صريح في JS
        ];
        echo json_encode($response);
    } else {
        echo json_encode(["exam_data" => false]);
    }
} else {
    echo json_encode(["exam_data" => false]);
}
?>