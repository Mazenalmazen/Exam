<?php
include 'config.php';
global $conn;
// check_api_key();

// تم تضمين هذا الكود سابقاً في الرد الأخير (رقم 57) وهو جاهز.
// لا يوجد تغيير هنا.
$num_exam = $conn->real_escape_string($_POST['num_exam'] ?? '');
$answers_data = $conn->real_escape_string($_POST['answers_data'] ?? '');
$num_device = $conn->real_escape_string($_POST['num_device'] ?? '');
$name_std = $conn->real_escape_string($_POST['name_std'] ?? '');
$info_std = $conn->real_escape_string($_POST['info_std'] ?? '');
$degre_std = $conn->real_escape_string($_POST['degre_std'] ?? 0);

$answers_id = uniqid('ans_', true); 

$sql = "INSERT INTO answers (answers_id, exam_num, name_std, num_std, answers_data, degre_std, info_std, send_status) 
        VALUES ('$answers_id', '$num_exam', '$name_std', '$num_device', '$answers_data', '$degre_std', '$info_std', 'yes')";

if ($conn->query($sql) === TRUE) {
    $order_sql = "SELECT COUNT(*) as `order` FROM answers WHERE exam_num = '$num_exam'";
    $order_result = $conn->query($order_sql);
    $order = $order_result->fetch_assoc()['order'];

    echo json_encode([
        "answers_id" => $answers_id,
        "order" => $order,
        "status" => "success"
    ]);

    $conn->query("UPDATE app_stats SET stat_value = stat_value + 1 WHERE stat_key = 'All_Ans'");

} else {
    http_response_code(500);
    echo json_encode(["error" => "Database insertion failed: " . $conn->error]);
}
?>