<?php
include 'config.php';
global $conn;
// check_api_key();

// يفترض استقبال exam_name, exam_info, exam_email, exam_data (JSON) عبر POST
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$name = $conn->real_escape_string($_POST['exam_name'] ?? '');
$info = $conn->real_escape_string($_POST['exam_info'] ?? '');
$email = $conn->real_escape_string($_POST['exam_email'] ?? '');
$data = $conn->real_escape_string($_POST['exam_data'] ?? '');

if ($id > 0) {
    $sql = "UPDATE exams SET t_name = '$name', t_info = '$info', exam_data = '$data' WHERE t_num = '$id' AND t_email = '$email'";
    if ($conn->query($sql) === TRUE) {
        echo $id; // يرد برقم الاختبار المعدل
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Database update failed: " . $conn->error]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Missing ID"]);
}
?>