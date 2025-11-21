<?php
include 'config.php';
global $conn;
// check_api_key();

// يفترض استقبال answers_data (الذي يتضمن degre_std_all_mqali) و num_exam عبر POST
$answers_data = $conn->real_escape_string($_POST['answers_data'] ?? '');
$num_exam = $conn->real_escape_string($_POST['num_exam'] ?? '');

$data_obj = json_decode($answers_data, true);
$answers_id = $data_obj['answers_id'] ?? '';
$new_degre_std = $data_obj['degre_std_all_mqali'] ?? 0;

if (!empty($answers_id) && $answers_id != 0) {
    $sql = "UPDATE answers SET answers_data = '$answers_data', degre_std = degre_std + '$new_degre_std' WHERE answers_id = '$answers_id' AND exam_num = '$num_exam'";
    
    if ($conn->query($sql) === TRUE) {
        echo 'done_update_mqali'; 
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Database update failed: " . $conn->error]);
    }
} else {
    http_response_code(400);
    echo json_encode(["error" => "Missing Answer ID"]);
}
?>