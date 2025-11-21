<?php
include 'config.php';
global $conn;
// check_api_key();

$delete_mode = $conn->real_escape_string($_POST['deleteExam'] ?? '');
$num_delete = $conn->real_escape_string($_POST['num_deleteExam'] ?? '');

if ($num_delete) {
    if ($delete_mode == 'deleteExam') {
        // حذف الاختبار وجميع نتائجه
        $conn->query("DELETE FROM exams WHERE t_num = '$num_delete'");
        $conn->query("DELETE FROM answers WHERE exam_num = '$num_delete'");
        echo 'done_exam and ans';
    } else if ($delete_mode == 'ansONLY') {
        // حذف النتائج فقط
        $conn->query("DELETE FROM answers WHERE exam_num = '$num_delete'");
        echo 'done_ans';
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Invalid delete mode."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Missing exam number."]);
}
?>